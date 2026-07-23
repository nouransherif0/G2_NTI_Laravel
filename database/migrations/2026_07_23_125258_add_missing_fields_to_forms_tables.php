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
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('email')->unique()->after('id');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('email')->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('subject')->after('phone');
            $table->text('message')->after('subject');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->string('full_name')->after('id');
            $table->string('phone_number')->after('full_name');
            $table->string('email_address')->after('phone_number');
            $table->integer('guests')->after('email_address');
            $table->date('reservation_date')->after('guests');
            $table->string('reservation_time')->after('reservation_date');
            $table->text('special_requests')->nullable()->after('reservation_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'subject', 'message']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'full_name', 'phone_number', 'email_address', 
                'guests', 'reservation_date', 'reservation_time', 'special_requests'
            ]);
        });
    }
};
