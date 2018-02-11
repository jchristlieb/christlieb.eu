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
        $user = factory(\App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $this->command->info('User created');

        $articles = factory(\App\Article::class, 20)->create(['user_id' => $user->id]);
        $this->command->info('Articles created');
        
        $articles->each(function ($article){
            $article->tags()->saveMany(factory(\App\Tag::class,rand(1,3))->create());
        });

        $this->command->info('Tags created');
    }
}
