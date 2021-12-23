<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App cache command: combine route, cache, config, view cache';

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
     *
     * @return int
     */
    public function handle()
    {
        $this->info('===== Start App Cache command =====');

        $this->info('--- clear-compiled Start');
        Artisan::call('clear-compiled');
        $this->info('--- clear-compiled Done');


        $this->info('--- Package Discover Start');
        Artisan::call('package:discover');
        $this->info('--- Package Discover Done');


        $this->info('--- Config Cache Start');
        Artisan::call('config:cache');
        $this->info('--- Config Cache Done');

        $this->info('--- View Cache Start');
        Artisan::call('view:cache');
        $this->info('--- View Cache Done');

        $this->info('--- Route Cache Start');
        Artisan::call('route:cache');
        $this->info('--- Route Cache Done');

        $this->info('--- Event Cache Start');
        Artisan::call('event:cache');
        $this->info('--- Event Cache Done');
        //php artisan permission:cache-reset
        $this->info('--- permission:cache-reset Start');
        Artisan::call('permission:cache-reset');
        $this->info('--- permission:cache-reset Done');

        $this->info('==== End App Cache Command ====');

        return 0;
    }
}
