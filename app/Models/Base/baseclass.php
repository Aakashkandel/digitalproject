<?php

namespace App\Models\Base;

use Illuminate\Database\Schema\Blueprint;

trait baseclass
{
    public function addBaseColumns(Blueprint $table)
    {
        $table->string('created_by')->default('admin');
        $table->string('updated_by')->default('admin')->nullable();
    }
}