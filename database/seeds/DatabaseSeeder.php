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

        $tags = collect();

        collect(['javascript', 'php', 'laravel', 'vue'])->each(function ($tag) use ($tags) {
            $tags->push(factory(\App\Tag::class)->create([
                'name' => $tag,
                'slug' => $tag,
            ]));
        });

        // Create comments for each post
        $articles->each(function ($article) use ($tags) {
            $article->tags()->saveMany($tags->random(rand(1, 4)));
        });
        $this->command->info('Tags created');

        // Create three posts with distinct promotion status
        collect(['promoted_first', 'promoted_second', 'promoted_third'])->each(function ($state){
            factory(\App\Article::class)->states($state)->create();
        });
    }
}
