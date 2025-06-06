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
        Schema::create('subscription', function (Blueprint $table) {
        $table->id();;
        $table->integer('number_members_paying');
        $table->boolean('active')->default(true);

        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

        $table->unsignedBigInteger('subscription_platform_id');
        $table->foreign('subscription_platform_id')->references('id')->on('subscription_platform')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('subscription');
    }
};
