<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser',
            'email' => 'test@test.de',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);
    }

    protected function getViewData(TestResponse $response)
    {
        return $response->getOriginalContent()->getData();
    }
    
}
