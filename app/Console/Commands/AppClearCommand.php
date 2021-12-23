<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App clear command: combine route, cache, config, view clear';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('===== Start App Clear command =====');

        $this->info('--- Cache Clear Start');
        Artisan::call('cache:clear');
        $this->info('--- Cache Clear Done');

        $this->info('--- Config Clear Start');
        Artisan::call('config:clear');
        $this->info('--- Config Clear Done');

        $this->info('--- View Clear Start');
        Artisan::call('view:clear');
        $this->info('--- View Clear Done');

        $this->info('--- Route Clear Start');
        Artisan::call('route:clear');
        $this->info('--- Route Clear Done');

        $this->info('--- Event Clear Start');
        Artisan::call('event:clear');
        $this->info('--- Event Clear Done');

        $this->info('--- Debugbar Clear Start');
        Artisan::call('debugbar:clear');
        $this->info('--- Debugbar Clear Done');

        $this->info('--- clear-compiled Start');
        Artisan::call('clear-compiled');
        $this->info('--- clear-compiled Done');

        $this->info('==== End App Clear Command ====');
        return 0;
    }
}
