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
        Schema::create('notification_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Notification::class)->constrained('my_notifications');
            $table->foreignIdFor(\App\Models\User::class)->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_roles');
    }
};
