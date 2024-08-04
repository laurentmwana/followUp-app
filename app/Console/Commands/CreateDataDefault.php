<?php

namespace App\Console\Commands;

use App\Fake\DataFaker;
use Illuminate\Console\Command;

class CreateDataDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:data-default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DataFaker::generate();
    }
}
