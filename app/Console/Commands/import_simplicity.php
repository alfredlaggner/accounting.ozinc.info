<?php

namespace App\Console\Commands;

use App\Imports\SimplicityCollection;
use App\Models\Customer;
use App\Models\Simplicity;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class import_simplicity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sim:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periodically updates Odoo with simplicity internal Ids';

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
        $files = scandir(storage_path('app/public/simplicity'), SCANDIR_SORT_DESCENDING);
        $newest_file = $files[0];
        $path = storage_path('app/public/simplicity/') . $newest_file;
        Excel::import(new SimplicityCollection, $path);
        $count = 0;
        $count = $this->update_costomers();
        $this->info($count . ' files updated');
        $this->info(date_format(date_create(), 'Y-m-d H:i:s'));

    }

        public function update_costomers()
    {
        $customers = Customer::get();
        $count = 0;
        foreach ($customers as $customer) {

            $sim = Simplicity::where('license', 'like', trim($customer->license))->first();
            if ($sim) {
                $count++;
                $customer->internal_debtor_id = $sim->internal_debtor_id;
                $customer->save();

                $sim->found = true;
                $sim->save();
            }
        }
        return ($count);
    }
}
