<?php

namespace App\Console\Commands;

use Queue;
use Illuminate\Console\Command;
use App\Jobs\TransferDataSent;

class TransferResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get transfer status from billing system.';

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
        $this->line(PHP_EOL . "Transfer notification" . PHP_EOL);
        // Push job to queue
        Queue::push(new TransferDataSent);
    }
}
