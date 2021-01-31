<?php

namespace App\Http\Controllers;

use App\Models\Salesline;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $q=Salesline::orderby('category_full')->groupBy('category_full')->whereNotNull('category_full')->get();
        dd($q);
    }}
