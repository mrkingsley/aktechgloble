<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product');
            $table->integer('qty');
            $table->decimal('unit_price', 12);
            $table->decimal('unit_price_total', 12);
            $table->enum('status', ['waiting', 'in_process', 'completed']);
            $table->string('engineer_note');
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
        Schema::drop('repair_invoice_items');
    }
}
