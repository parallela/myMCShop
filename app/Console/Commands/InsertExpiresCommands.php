<?php

namespace App\Console\Commands;

use App\ExpireCmd;
use App\MCUser;
use App\Product;
use App\Token;
use Illuminate\Console\Command;

class InsertExpiresCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:expirecmds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert into token table expired cmd to be runned in minecraft';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d h:i:s');
        $check = Token::where('expirable',1)->where('run_at','<=',$date);
        if(count($check->get()) > 0) {
            $check->update(['runned'=>0,'expirable'=>0]);
        }

    }
}
