<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');

            $table->date('date');
            $table->string('name');
            $table->string('identification');
            $table->string('email');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')->on('services');

        });

        Schema::create('sale_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->string('description')->nullable();
            $table->float('total', 12, 3)->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('sale_id')
                ->references('id')->on('sales')
                ->onDelete('set null');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_user');
        Schema::dropIfExists('sales');
    }
}
