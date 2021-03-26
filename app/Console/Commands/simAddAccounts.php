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

class simAddAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sim:send_accounts';

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

        $client = new Client([
            'base_uri' => "http://app.simplicitycollect.com//accounts/add",
            'timeout' => 10.0,
        ]);
        $headers = [
            'headers' => ['content-type' => 'application/json', 'Accept' => 'application/json'],
        ];
        $api_token = 'e3367925-707e-11eb-b109-128234efe66d';

        $customers = Customer::whereNull('internal_debtor_id')
            ->where('total_overdue', '>', 0)
            ->limit(1)
            ->get();
        $count = 0;
        $client = "Oz Distribution, Inc.";
        foreach ($customers as $customer) {
            //  dd($customer);
            $license = $customer->license;
            $output = str_replace(';', ',', $customer->email);
            $output2 = explode(',', $output);
            $email = $output2[0];
            if (!filter_var($email[0], FILTER_VALIDATE_EMAIL)) {
                $email = "";
            }
            $data =
                [
                    "ApiToken" => $api_token,
                    "AccountNumber" => $customer->ext_id,
                    "ClientName" => $client,
                    "DebtorAddressOne" => $customer->street,
                    "DebtorCity" => $customer->city,
                    "DebtorState" => "California",
                    "DebtorZip" => $customer->zip,
                    "DebtorIsCompany" => true,
                    "DebtorEmail" => $email,
                    "DebtorCompanyName" => $customer->display_name,
                    "DebtorPhone" => $customer->phone,
                    "OriginalAmount" => $customer->total_overdue,
                    "AccountCustomFields" => [
                        [
                            "FieldName" => "License",
                            "FieldValue" => $license,
                            "TableColumnName" => "license",
                            "DataType" => "varchar(255)"
                        ],
                        [
                            "FieldName" => "Sale Order Count",
                            "FieldValue" => $customer->sale_order_count,
                            "TableColumnName" => "Sale Order Count",
                            "DataType" => "int(11)"
                        ],
                        [
                            "FieldName" => "Total Invoiced",
                            "FieldValue" => $customer->sale_order_count,
                            "TableColumnName" => "Total Invoiced",
                            "DataType" => "double(10,2)"
                        ],
                    ]
                ];
            //     dd(json_encode($data));
            $client = new Client();
            $url = "http://app.simplicitycollect.com/api/accounts/add";
            $response = $client->post($url . '?format=json', ["json" => $data]);
            $result = json_decode($response->getBody());
            $code = $response->getStatusCode(); // 200
            $reason = $response->getReasonPhrase(); // OK
            $this->info($code);
            $this->info($reason);
        }


        $this->info(date_format(date_create(), 'Y-m-d H:i:s'));
    }
}
