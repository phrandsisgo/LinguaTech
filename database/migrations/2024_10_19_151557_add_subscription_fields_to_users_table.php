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
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_id')->nullable(); // Stripe-Customer-ID
            $table->string('stripe_subscription_id')->nullable(); // Stripe-Subscription-ID
            $table->string('subscription_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stripe_id');
            $table->dropColumn('stripe_subscription_id');
            $table->dropColumn('subscription_status');
        });
    }
};
