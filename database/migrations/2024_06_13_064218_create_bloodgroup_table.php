<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Base\baseclass;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use baseclass;
    public function up()
    {
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $this->addBaseColumns($table);
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
        Schema::dropIfExists('bloodgroup');
    }
};
