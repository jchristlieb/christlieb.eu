<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->enableForeignKeys();
    }

    /**
     * Enables foreign keys.
     *
     * @return void
     */
    public function enableForeignKeys()
    {
        $db = app()->make('db');
        $db->getSchemaBuilder()->enableForeignKeyConstraints();
    }

    /**
     * Creates a user and triggers actingAs.
     */
    protected function signIn()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser',
            'email' => 'test@test.de',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);
    }
}
