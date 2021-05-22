<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
    
            // The voucher code
            $table->string( 'code' )->nullable( );

            // The human readable voucher code name
            $table->string( 'name' );

            // The description of the voucher - Not necessary 
            $table->text( 'description' )->nullable( );

            // How many times a user can use this voucher.
            $table->integer( 'max_uses_user' )->unsigned( )->nullable( );
            
            $table->integer( 'used_user' )->default(0);

            // The amount to discount by (in pennies) in this example.
            $table->integer( 'discount_amount' );

            $table->integer( 'type' );

            // When the voucher begins
            $table->date( 'starts_at' );

            // When the voucher ends
            $table->date( 'expires_at' );

            // You know what this is...
            $table->timestamps( );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
}
