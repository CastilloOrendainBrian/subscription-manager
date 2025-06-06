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
        Schema::create('subscription_platform', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type');
        $table->integer('members');
        $table->decimal('price', 12, 2);
        $table->boolean('active')->default(true);

        $table->unsignedBigInteger('cat_currency_id');
        $table->foreign('cat_currency_id')->references('id')->on('cat_currency')->onDelete('restrict')->onUpdate('restrict');

        $table->unsignedBigInteger('recurrence_id');
        $table->foreign('recurrence_id')->references('id')->on('recurrence')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('subscription_platform');
    }
};
