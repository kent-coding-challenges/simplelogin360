<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that invalid user/password is not authenticated.
     *
     * @return void
     */
    public function testUnauthenticatedUserIsRedirectedToLogin()
    {
        // Without any user logged in, homepage should redirect to login route.
        $response = $this->get('/');
        $response->assertRedirect('login');	
    }

    /**
     * Test that valid user is authenticated.
     *
     * @return void
     */
    public function testAuthenticatedUserCanAccessHome()
    {
        // Create a new mock user in db, and log in (act as) the mocked user.
        $user = factory(User::class)->create();
        $this->actingAs($user, 'web');

        // Ensure home path returns HTTP Status OK (200), not redirect to login (302).
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
