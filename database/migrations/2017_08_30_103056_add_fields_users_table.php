<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('id', 'uid');
        $table->dropColumn('name');
        $table->integer('server_id')->unsigned()->unique();
        $table->double('flow', 4, 2);
        $table->enum('plan', ['monthly', 'querterly', 'semiannually', 'annually']);
        $table->dateTime('start_at');
        $table->dateTime('end_at');
        $table->foreign('server_id')->references('server_id')->on('server');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('users');
    }
}
