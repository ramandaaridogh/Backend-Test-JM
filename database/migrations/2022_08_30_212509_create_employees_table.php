<?php

use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->foreignIdFor(Unit::class)->index()->constrained('units')->onDelete("CASCADE");
            $table->string('position_name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->foreignIdFor(App\Models\User::class, 'created_by')->nullable()->index()->constrained('users')->onDelete("CASCADE");
            $table->foreignIdFor(App\Models\User::class, 'updated_by')->nullable()->index()->constrained('users')->onDelete("CASCADE");
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
        Schema::dropIfExists('employees');
    }
};
