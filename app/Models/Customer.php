<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $fillable = [
        'debtor_company',
        'internal_case_id',
        'internal_debtor_id',
        'case_number'
    ];

}
