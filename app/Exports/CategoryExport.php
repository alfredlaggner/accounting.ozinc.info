<?php

namespace App\Exports;

use App\Models\SaleInvoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryExport implements FromView, ShouldAutoSize, WithHeadingRow
{
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $from = substr($this->from, 6, 4) . '-' . substr($this->from, 0, 5) . ' 00:00:00';
        $to = substr($this->to, 6, 4) . '-' . substr($this->to, 0, 5) . ' 23:59:59';


        $all_categories = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
            ->orderby('category_full')->groupBy('category_full')->whereNotNull('category_full')
            ->whereBetween('order_date_stamped', [$from, $to])
            ->get();
        $results = [];
        foreach ($all_categories as $category) {
            /*            echo $category->category_full . '<br>';*/
            $category_array = explode(' /', $category->category_full);
            $count = count($category_array);
            //     if ($count==6)dd($category_array);
            //    dd($category_array);0
            /*            echo 'count =' . $count . '<br>';*/
            $sub_result = [$category->category_full];
            for ($i = 0; $i < $count; $i++) {
                if ($i == 0) {
                    $sum_amount = SaleInvoice::select('*', 'category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        //     ->get();
                        // dd(sum_amount->toarray());
                        ->sum('amount');
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                } elseif ($i == 1) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);

                } elseif
                ($i == 2) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                    //         dd( $sub_result);

                } elseif
                ($i == 3) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->where('cat_sub4', trim($category_array[3]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                } elseif
                ($i == 4) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->where('cat_sub4', trim($category_array[3]))
                        ->where('cat_sub5', trim($category_array[4]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                } elseif
                ($i == 5) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->where('cat_sub4', trim($category_array[3]))
                        ->where('cat_sub5', trim($category_array[4]))
                        ->where('cat_sub6', trim($category_array[5]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                } elseif
                ($i == 6) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->where('cat_sub4', trim($category_array[3]))
                        ->where('cat_sub5', trim($category_array[4]))
                        ->where('cat_sub6', trim($category_array[5]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
                    /*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i], $sum_amount]);
                }
            }
            array_push($results, $sub_result);
            /*  echo "--------<br><br>";*/
        }
        $total_amt_invoiced = SaleInvoice::select('amount')
            ->whereBetween('order_date_stamped', [$from, $to])
            ->sum('amount');

        return view('export.category', ['results' => $results, 'from' => $from, 'to' => $to]);
    }
}
