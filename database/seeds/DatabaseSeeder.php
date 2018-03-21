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
            'image_id' => 1,
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
                'image_id' => rand(1, 3),
            ]));
        });

        $articles->each(function ($article) use ($tags) {
            factory(\App\Comment::class, rand(1, 10))->create(['article_id' => $article->id]);
            $article->tags()->saveMany($tags->random(rand(1, 4)));
            $article->image()->associate(factory(\App\Image::class)->states('seedImages')->create());
            $article->save();
        });
        $this->command->info('Tags created');

        collect([1, 2, 3])->each(function ($state) use ($articles) {
            $articles->random()->update(['promoted' => $state]);
        });

        $this->command->info('Promoted Articles created');
    }
}
