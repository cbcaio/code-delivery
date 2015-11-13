<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupoms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->decimal('value');
            $table->boolean('used')->default(0);
            $table->timestamps();
        });

        Schema::table('orders',function (Blueprint $table) {

            $table->integer('cupom_id')->unsigned()->nullable();
            $table->foreign('cupom_id')->references('id')->on('cupoms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function(Blueprint $table) {
            $table->dropForeign('orders_cupom_id_foreign');
            $table->dropColumn('cupom_id');
        });
        Schema::drop('cupoms');
    }
}
