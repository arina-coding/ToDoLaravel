document.querySelectorAll(".checkbox").forEach((checkbox) => {
    checkbox.addEventListener("change", function (event) {
        event.preventDefault();

        const noteId = this.dataset.id;

        fetch(`/notes/${noteId}/toggle`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "Выполнена") {
                    checkbox.checked = true;
                    checkbox.closest(".tasks-group").classList.add("completed");
                } else {
                    checkbox.checked = false;
                    checkbox
                        .closest(".tasks-group")
                        .classList.remove("completed");
                }
            });
    });
});

document.querySelectorAll(".close").forEach((button) => {
    button.addEventListener("click", function (event) {
        event.preventDefault();

        const noteId = this.dataset.id;

        fetch(`/notes/${noteId}/delete`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    button.closest(".tasks-group").remove();
                }
            });
    });
});

const searchInput = document.querySelector('input[name="search"]');
const notesList = document.querySelector(".notes-list");

if (searchInput && notesList) {
    let debounceTimer;

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            const search = this.value;

            fetch(`/notes?search=${search}`, {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.text())
                .then((html) => {
                    notesList.innerHTML = html;
                });
        }, 300);
    });
}

//звезды
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("stars-canvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    let width = (canvas.width = window.innerWidth);
    let height = (canvas.height = window.innerHeight);

    const starCount = 1500;
    const stars = [];
    const mouse = {
        x: -1000,
        y: -1000,
        radius: 70,
    };

    const colors = [
        "rgba(255, 255, 255, ",
        "rgba(220, 200, 255, ",
        "rgba(180, 200, 255, ",
    ];

    for (let i = 0; i < starCount; i++) {
        stars.push({
            x: Math.random() * width,
            y: Math.random() * height,
            size: Math.random() * 1.5 + 0.5,
            opacity: Math.random() * 0.6 + 0.4,
            opacitySpeed: (Math.random() - 0.5) * 0.02,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: 0,
            vy: 0,
        });
    }

    window.addEventListener("resize", () => {
        const oldWidth = width;
        const oldHeight = height;

        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;

        const scaleX = width / oldWidth;
        const scaleY = height / oldHeight;

        for (let i = 0; i < stars.length; i++) {
            stars[i].x *= scaleX;
            stars[i].y *= scaleY;
        }
    });

    window.addEventListener("mousemove", (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });

    window.addEventListener("mouseleave", () => {
        mouse.x = -1000;
        mouse.y = -1000;
    });

    function animate() {
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < stars.length; i++) {
            const star = stars[i];

            const dx = star.x - mouse.x;
            const dy = star.y - mouse.y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < mouse.radius && distance > 0) {
                const force = (mouse.radius - distance) / mouse.radius;
                star.vx += (dx / distance) * force * 0.5;
                star.vy += (dy / distance) * force * 0.5;
            }

            star.vx *= 0.95;
            star.vy *= 0.95;

            star.x += star.vx;
            star.y += star.vy;

            if (star.x < 0) star.x = width;
            if (star.x > width) star.x = 0;
            if (star.y < 0) star.y = height;
            if (star.y > height) star.y = 0;

            star.opacity += star.opacitySpeed;
            if (star.opacity <= 0.2 || star.opacity >= 1) {
                star.opacitySpeed = -star.opacitySpeed;
            }

            ctx.beginPath();
            ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
            ctx.fillStyle = star.color + star.opacity + ")";
            ctx.shadowBlur = 20;
            ctx.shadowColor = star.color + "0.8)";
            ctx.fill();
        }

        requestAnimationFrame(animate);
    }

    animate();
});
