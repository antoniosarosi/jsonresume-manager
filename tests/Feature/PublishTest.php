<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\Theme;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $publish;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $resume = $this->user->resumes()->create(Resume::factory()->make()->toArray());
        $theme = new Theme(['theme' => 'classy']);
        $theme->save();
        $this->publish = $this->user->publishes()->create([
            'resume_id' => $resume->id,
            'theme_id' => $theme->id,
            'visibility' => 'private'
        ]);
    }

    public function test_cannot_see_private_publish_if_not_logged_in()
    {
        $response = $this->get(route('publishes.show', $this->publish->id));
        $response->assertStatus(302);
    }

    public function test_cannot_see_private_publish_if_doesnt_belong_to_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('publishes.show', $this->publish->id));
        $response->assertForbidden();
    }

    public function test_can_access_public_publish()
    {
        $this->withoutExceptionHandling();
        $this->user->publishes()->where('id', $this->publish->id)->first()->update([
            'visibility' => 'public',
        ]);
        $user = User::factory()->create();
        $response = $this->get(route('publishes.show', $this->publish->id));
        $response->assertOk();
        $this->actingAs($user);
        $response = $this->get(route('publishes.show', $this->publish->id));
        $response->assertOk();
    }
}
