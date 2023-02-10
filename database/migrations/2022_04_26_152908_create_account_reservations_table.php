<?php

use App\Models\Account;
use App\Models\Restaurant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)->constrained();
            $table->foreignIdFor(Restaurant::class)->constrained();
            $table->dateTime('reservation_datetime', $precision = 0);
            $table->string('reservation_count');
            $table->string('representative_family_name');
            $table->string('representative_last_name');
            $table->string('representative_tel');
            $table->string('representative_mail');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_reservations');
    }
};
