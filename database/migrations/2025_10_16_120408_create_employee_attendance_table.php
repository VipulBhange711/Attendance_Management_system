<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('employee_attendance', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->decimal('payperday', 10, 2);
        $table->decimal('ot_amount', 10, 2)->nullable();
        $table->decimal('ot_hours', 10, 2)->nullable();
        $table->decimal('total_amount', 10, 2);
        $table->string('attendance_status');
        $table->date('attendance_date');
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendance');
    }
};
