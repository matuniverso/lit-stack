<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class InertiaTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_welcome_renders()
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertInertia(function (Assert $assert) {
                $assert->url('/')
                    ->component('Welcome')
                    ->whereAll([
                        'laravelVersion' => Application::VERSION,
                        'phpVersion' => PHP_VERSION
                    ]);
            });
    }

    public function test_dashboard_renders()
    {
        /** @var Authenticatable */
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertInertia(function (Assert $assert) {
                $assert->component('Dashboard');
            });
    }

    public function test_list_users_renders()
    {
        /** @var Authenticatable */
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('users'))
            ->assertOk()
            ->assertInertia(function (Assert $assert) {
                $assert->component('Users/Index')
                    ->url('/list-users')
                    ->has('users.data');
            });
    }
}
