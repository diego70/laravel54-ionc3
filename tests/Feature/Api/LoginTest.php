<?php

namespace Tests\Feature\Api;

use BluesFlix\Models\User;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    Use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessToken()
    {
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        $this->post($urlGenerator->route('api.access_token'),[
            'email' => 'admin@user.com',
            'password' => 'secret'
        ])
            ->assertStatus(200)
        ->assertJsonStructure(['token']);
    }
}
