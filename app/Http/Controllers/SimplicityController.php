<?php

namespace App\Http\Controllers;

use App\Imports\SimplicityCollection;
use App\MetrcTag;
use App\Models\Simplicity;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SimplicityController extends Controller
{
    function Start(Request $request)
    {

        $now = Carbon::now();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $start = $start->format("m-d-Y");
        $end = $end->format("m-d-Y");

        return view('accounting', compact('start', 'end'));
    }


    public function import_tags(Request $request)
    {
        $request->validate(['import_file' => 'required']);
        //  dd($request);
        //   dd($request->file('import_file'));
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        //  dd($path);
        //    DB::table('metrc_tags')->delete();
        Excel::import(new SimplicityCollection, $path);
        $count = 0;
        $count = $this->update_costomers();
        return redirect('/')->with('status', $count . ' debitors imported!');
    }

    public function import_simplicity()
    {
        $files = scandir(storage_path('app/public/simplicity'), SCANDIR_SORT_DESCENDING);
        $newest_file = $files[0];
        $path = storage_path('app/public/simplicity/') . $newest_file;
        Excel::import(new SimplicityCollection, $path);
        $count = 0;
        $count = $this->update_costomers();
        return redirect('/')->with('status', $count . ' debitors imported!');
    }

    public function update_costomers()
    {
        $customers = Customer::get();
        $count = 0;
        foreach ($customers as $customer) {

            $sim = Simplicity::where('license', 'like', trim($customer->license))->first();
            if ($sim) {
                $count++;
                echo $sim->deptor_company . '<br>';
                //        echo $customer->name . $sim->debtor_company . " " .$sim->internal_case_id.  ' ' . $sim->internal_debtor_id . "<br>";;
            //    $customer->internal_case_id = $sim->internal_case_id;
                $customer->internal_debtor_id = $sim->internal_debtor_id;
                $customer->debtor_company = $sim->deptor_company;
            //    $customer->case_number = $sim->case_number;
                $customer->save();

                $sim->found = true;
                $sim->save();
            }
        }
        return ($count);
    }
}
