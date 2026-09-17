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

let debounceTimer;

searchInput.addEventListener("input", function () {
    clearTimeout(debounceTimer);

    debounceTimer = setTime(() => {
        const search = this.value;

        fetch("/notes?search=${search}", {
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
