<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDueReminder;
use Illuminate\Http\Request;

class InvoiceDueController extends Controller
{
    public function index(){
        $dues = InvoiceDueReminder::with('invoice')
            ->where('comments','!=', '')
            ->orderBy('days_due')
            ->get();
     //   dd($dues);
        return view('due.due', compact('dues'));
    }
}
