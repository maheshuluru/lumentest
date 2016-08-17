<?php

namespace App\Console\Commands;

use Queue;
use Illuminate\Console\Command;
use App\Jobs\TransferDataSent;

class Transfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:bs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send transfer data to billing system';

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
        $this->line(PHP_EOL . "Transfer handled" . PHP_EOL);
        // Push job to queue
        Queue::push(new TransferDataSent);
    }
}
