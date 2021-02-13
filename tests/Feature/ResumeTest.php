<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Resume;
use App\Models\User;

class ResumeTest extends TestCase {
    use RefreshDatabase;

    private $user;

    protected function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    private function resume(): array {
        return Resume::factory()->make()->toArray();
    }

    public function test_create_resume_view() {
        $response = $this->get(route('resumes.create'));
        $response->assertOk();
    }

    public function test_store_resume() {
        $resume = Resume::factory()->make()->toArray();
        $response = $this->post(route('resumes.store'), $resume);
        $this->assertDatabaseCount('resumes', 1);
        $response->assertCreated();
    }

    public function test_store_resume_with_missing_required_data() {
        $resume = $this->resume();
        $resume['title'] = "";
        $response = $this->post(route('resumes.store'), $resume);
        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('resumes', 0);
    }

    public function test_store_resume_with_missing_optional_data() {
        $resume = $this->resume();
        $resume['content']['basics']['profile'] = [];
        $resume['content']['work'] = [];
        $response = $this->post(route('resumes.store'), $resume);
        $response->assertCreated();
        $this->assertDatabaseCount('resumes', 1);
    }

    public function test_store_resume_with_incorrect_format() {
        $resume = $this->resume();
        $resume['content']['basics']['profiles'] = 5;
        $resume['content']['work'] = 'test';
        $response = $this->post(route('resumes.store'), $resume);
        $response->assertSessionHasErrors(['content.basics.profiles', 'content.work']);
        $this->assertDatabaseCount('resumes', 0);
    }

    public function test_update_resume() {
        $resume = Resume::factory()->create(['user_id' => $this->user->id]);
        $data = $resume->toArray();
        $title = 'Test';
        $data['title'] = $title;
        $response = $this->put(route('resumes.update', $resume->id), $data);
        $response->assertOk();
        $this->assertDatabaseCount('resumes', 1);
        $this->assertEquals(Resume::find($resume->id)->title, $title);
    }
}
