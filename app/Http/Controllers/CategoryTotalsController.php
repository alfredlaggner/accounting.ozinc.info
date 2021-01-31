<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CategoryTotalsController extends Controller
{
    public  function index1(){
        $now = Carbon::now();
        $start = new Carbon('first day of this month');
        $end = new Carbon('last day of this month');

        $start = $start->format("Y-m-d");
        $end = $end->format("Y-m-d");
        return view('category.start',compact('start','end'));
    }
    public function index2(Request $request)
    {
      //  dd($request);
        $from = $request->get('start') . ' 00:00:00';
        $to = $request->get('end') . ' 23:59:59';
        $all_categories = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
            ->orderby('category_full')->groupBy('category_full')->whereNotNull('category_full')
            ->whereBetween('order_date_stamped', [$from, $to])
            ->get();
        $results = [];
        foreach ($all_categories as $category) {
/*            echo $category->category_full . '<br>';*/
            $category_array = explode('/', $category->category_full);
            $count = count($category_array);
            //    dd($category_array);0
/*            echo 'count =' . $count . '<br>';*/
            $sub_result = [$category->category_full];
            for ($i = 0; $i < $count; $i++) {
                if ($i == 0) {
                    $sum_amount = SaleInvoice::select('*','category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                   //     ->get();
                   // dd(sum_amount->toarray());
                        ->sum('amount');
                    array_push($sub_result, [$category_array[$i] , $sum_amount]);
                } elseif ($i == 1) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
/*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i] , $sum_amount]);

                } elseif
                ($i == 2) {
                    $sum_amount = SaleInvoice::select('category_full', 'cat_sub1', 'cat_sub2', 'cat_sub3', 'cat_sub4', 'amt_invoiced')
                        ->where('cat_sub1', trim($category_array[0]))
                        ->where('cat_sub2', trim($category_array[1]))
                        ->where('cat_sub3', trim($category_array[2]))
                        ->whereBetween('order_date_stamped', [$from, $to])
                        ->sum('amount');
/*                    echo $category_array[$i] . "= " . sum_amount . '<br>';*/
                    array_push($sub_result, [$category_array[$i] , $sum_amount]);
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
                    array_push($sub_result, [$category_array[$i] , $sum_amount]);
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
                    array_push($sub_result, [$category_array[$i] , $sum_amount]);
                }
            }
                       array_push($results, $sub_result);
        /*  echo "--------<br><br>";*/
        }
        $total_amt_invoiced = SaleInvoice::select( 'amount')
            ->whereBetween('order_date_stamped', [$from, $to])
            ->sum('amount');

      //  dd($total_amt_invoiced);
        //    dd($results);
        return view('category.totals',compact('results','from','to'));
    }
}
