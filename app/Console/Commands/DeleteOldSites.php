<?php

namespace App\Console\Commands;

use App\Site;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sites:checkforexpires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if have expired site and remove it';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d h:i:s');
        DB::table('site_user')->whereDate('expires_at','<=',$date)->delete();
    }
}
