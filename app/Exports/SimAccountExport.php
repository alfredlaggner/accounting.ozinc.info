<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Customer;

class SimAccountExport implements FromView
{
    public function view(): View

    {
        $customers = Customer::whereNotNull('internal_debtor_id')
            ->where('total_due', '>', 0)
            ->limit(1)
            ->get();

        //    dd($customers);
        $results = [];
        $all_results = [];

        foreach ($customers as $customer) {
            //  dd($customer);
            /*            $output = str_replace(';', ',', $customer->email);
                        $output2 = explode(',', $output);
                        $email = $output2[0];
                        if (!filter_var($email[0], FILTER_VALIDATE_EMAIL)) {
                            $email = "";
                        }*/
            $results =
                [
                    "Account" => $customer->internal_debtor_id,
                    "BusinessName" => 'OZ Distribution, Inc.',
                    "DisplayName" => $customer->name,
                    "ClientName" => $customer->name,
                    "Street" => $customer->street,
                    "City" => $customer->city,
                    "Zip" => $customer->zip,
                    "Email" => $customer->email,
                    "Phone" => $customer->phone,
                    "License" => $customer->license,
                    "SaleOrderCount" => 0,
                    "TotalDue" => $customer->total_due,
                    "TotalInvoiced" => 0.00,
                ];

        array_push($all_results, $results);
        }
        return view('export.sim_customers', compact('all_results'));
    }
}

