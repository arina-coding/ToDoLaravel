<?php
namespace Tests\Feature;
use Tests\TestCase;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase{
    use RefreshDatabase;

    //гость не может открыть заметки
    public function test_guest_cannot_view_notes(): void
    {
        $response = $this->get('/notes');

        $response->assertRedirect('/login');
    }

    //гость не может создавать заметку
    public function test_guest_cannot_create_note() :void
    {
        $response = $this->post('/notes', [
            'name' => 'test',
            'text' => 'text',
            'category' => 'personal',
        ]);

        $response->assertRedirect('/login');
    }

    //пользователь видит только свои заметки
    public function test_user_sees_only_own_notes(): void
    {
        $user1= User::factory()->create();
        $user2= User::factory()->create();

        Note::create([
            'name' => 'Заметка юзер1',
            'text' => 'Текст',
            'category' => 'personal',
            'status' => 'Новая',
            'user_id' => $user1->id,
        ]);

        Note::create([
            'name' => 'Заметка юзер2',
            'text' =>'Текст',
            'category' => 'personal',
            'status' => 'Новая',
            'user_id' => $user2->id,
        ]);

        $response = $this->actingAs($user1)->get('/notes');

        $response->assertSee('Заметка юзер1');
        $response->assertDontSee('Заметка юзер2');
    }

    //пользователь может создавать заметки
    public function test_user_can_create_note() :void
    {
        $user= User::factory()->create();

        $response= $this->actingAs($user)->post('/notes', [
            'name' => 'test',
            'text' => 'text',
            'category' => 'personal',
        ]);

        $response->assertRedirect('/notes');

        $this->assertDatabaseHas('notes', [
            'name' => 'test',
            'user_id' => $user->id,
        ]);
    }

    //пользователь может удалить свою заметку
    public function test_user_cannot_delete_own_note():void
    {
        $user=User::factory()->create();

        $note= Note::create([
            'name' => 'Заметка юзер',
            'text' => 'Текст',
            'category' => 'personal',
            'status' => 'Новая',
            'user_id' => $user->id,
        ]);

        $response= $this->actingAs($user)->post("/notes/{$note->id}/delete");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseMissing('notes',[
            'id' => $note->id,
        ]);
    }

    public function test_user_can_delete_others_note() :void
    {
        $user1= User::factory()->create();
        $user2= User::factory()->create();

        $note = Note::create([
            'name' => 'Чужая заметка',
            'text' => 'Текст',
            'category' => 'personal',
            'status' => 'Новая',
            'user_id' => $user2->id,
        ]);

        $response= $this->actingAs($user1)->post("/notes/{$note->id}/delete");

        $response->assertStatus(404);

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
        ]);
    }
}
