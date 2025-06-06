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
        Schema::create('recurrence', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->integer('quantity')->default(1);

            $table->unsignedBigInteger('cat_time_unit_id');
            $table->foreign('cat_time_unit_id')->references('id')->on('cat_time_unit')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedBigInteger('cat_day_id')->nullable();
            $table->foreign('cat_day_id')->references('id')->on('cat_day')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedBigInteger('cat_month_id')->nullable();
            $table->foreign('cat_month_id')->references('id')->on('cat_month')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('date_month')->nullable();

            $table->unsignedBigInteger('cat_week_month_id')->nullable();
            $table->foreign('cat_week_month_id')->references('id')->on('cat_week_month')->onDelete('restrict')->onUpdate('restrict');

            $table->boolean('active')->default(true);

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurrence');
    }
};
