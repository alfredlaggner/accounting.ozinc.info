<?php

namespace App\Console\Commands;

use App\MetrcNoProduct;
use App\MetrcTag;
use App\MetrcUpdate;
use App\Models\Customer;
use App\Models\Simplicity;
use App\Package;
use App\Product;
use App\TmpOdooLot;
use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Exports\SimAccountExport;
use Maatwebsite\Excel\Facades\Excel;

class simUpdateAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sim:update_accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new account';

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
        return Excel::store(new SimAccountExport, 'invoices.csv', 'public');
    }
}
