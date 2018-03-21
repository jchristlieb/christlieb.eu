<?php

namespace App\Console\Commands;

use App\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'christlieb:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command publishes all articles which are not published but have a publish_date in the past';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Article::withDrafts()->where('is_published', false)->where('published_at', '<=', Carbon::now())->update(['is_published' => true]);
    }
}
