<?php

namespace Tests\Feature\Api;

use BluesFlix\Models\User;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTGuard;

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
        $this->makeJWTToken()
            ->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function  testNotAuthorizeAccessApi()
    {
        $this->get('api/user')
            ->assertStatus(500);
    }

    public function testRefreshToken()
    {
        $testResponse = $this->makeJWTToken();
        $token = $testResponse->json()['token'];

        sleep(61);
        $this->clearAuth();

        $testResponse = $this->get('api/user', [
            'Authorization' => "Bearer $token"
        ])->assertJsonStructure(['user' => ['name']]);

        $headers = $testResponse->baseResponse->headers;
        $bearerToken = $headers->get('Authorization');

        $this->assertNotEquals("Bearer $token", $bearerToken);

        sleep(31);
        $this->clearAuth();

        $this->get('api/user', [
            'Authorization' => "Bearer $token"
        ])->assertStatus(500);


    }

    protected function clearAuth(){
        $reflectionClass = new ReflectionClass(JWTGuard::class);

        $reflectionProperty = $reflectionClass->getProperty('user');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue(\Auth::guard('api'), null);

        $jwt = app(JWT::class);
        $jwt->unsetToken();
        $dingoAuth = app(\Dingo\Api\Auth\Auth::class);
        $dingoAuth->setUser(null);


    }

    protected function makeJWTToken()
    {
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        return $this->post($urlGenerator->route('api.access_token'),[
            'email' => 'admin@user.com',
            'password' => 'secret'
        ]);
    }

}
