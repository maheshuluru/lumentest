<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TransferUap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:uap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer user application program';

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
        $this->line(PHP_EOL . "TransferUap handled" . PHP_EOL);
    }
}
