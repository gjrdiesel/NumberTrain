<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('account_id');
            $table->bigInteger('number');
            $table->longText('name');
            $table->timestamps();
        });


        \App\User::first()->addAccount([
            'username' => 'gjreasoner',
            'type' => \Facades\App\Accounts\Twitter::class
        ]);
        \App\User::first()->addAccount([
            'username' => 'wesbos',
            'type' => \Facades\App\Accounts\Twitter::class
        ]);
        \App\User::first()->addAccount([
            'username' => 'magicalfort',
            'type' => \Facades\App\Accounts\Twitter::class
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
