<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $this->command->info('User created');

        factory(\App\Article::class, 20)->create();
        $this->command->info('Articles created');
        
        factory(\App\Tag::class,10)->create();
        $this->command->info('Tags created');
    }
}
