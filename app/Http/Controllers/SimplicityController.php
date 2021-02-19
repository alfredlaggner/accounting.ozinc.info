<?php

namespace App\Http\Controllers;

use App\Imports\MetrcTagsCollection;
use App\MetrcTag;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        Excel::import(new MetrcTagsCollection, $path);

        return redirect('/')->with('status', 'Tags imported!');
    }
}
