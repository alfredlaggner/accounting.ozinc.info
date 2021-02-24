<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimplicity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simplicity', function (Blueprint $table) {
            $table->id();
            $table->integer('internal_case_id')->nullable();
            $table->integer('internal_debtor_id')->nullable();
            $table->string('debtor_company_name')->unique();
            $table->integer('case_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simplicity');
    }
}
