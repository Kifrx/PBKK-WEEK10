<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_opens_the_login_page_for_guests(): void
    {
        $response = $this->followingRedirects()->get('/');

        $response->assertStatus(200);
        $response->assertSee('Masuk Portal');
    }
}
