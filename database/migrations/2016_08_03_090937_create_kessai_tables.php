<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKessaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->default(1)->comment('shuftiの場合は：1');
            $table->integer('user_id');
            $table->string('bank_code');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_code');
            $table->integer('account_type');
            $table->string('account_no');
            $table->string('account_name');
            $table->integer('bank_type');
            $table->string('japanpost_code_no');
            $table->string('japanpost_account_no');
            $table->timestamps();
        });

        Schema::create('credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->default(1)->comment('shuftiの場合は：1');
            $table->integer('user_id');
            $table->string('card_control_id');
            $table->string('four_lower_digit');
            $table->integer('brand');
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('smbc_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->default(1)->comment('shuftiの場合は：1');
            $table->integer('account_number')->comment('SMBC口座番号');
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('smbc_account_id')->unsigned()->comment('口座番号ID');
            $table->integer('user_id');
            $table->integer('amount')->comment('請求額');
            $table->date('payment_date')->comment('支払日');
            $table->string('model')->comment('PointLog');
            $table->integer('model_id')->comment('point_log_id');
            $table->boolean('status')->default(false)->comment('支払ステータス'); // 0:入金待ち、1:入金済み
            $table->timestamps();
            $table->foreign('smbc_account_id')
                  ->references('id')
                  ->on('smbc_accounts');
        });

        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('amount');
            $table->date('received_at');
            $table->timestamps();
            $table->foreign('invoice_id')
                  ->references('id')
                  ->on('invoices');
        });


        Schema::create('holidays', function (Blueprint $table) {
            $table->date('holiday');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('credit_card_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credit_card_id')->unsigned();
            $table->string('purchase_control_id'); // ビリングシステム用のID
            $table->integer('amount'); // point
            $table->string('status');
            $table->string('model')->comment('PointLog');
            $table->integer('model_id')->comment('point_log_id');
            $table->timestamps();

            $table->foreign('credit_card_id')
                  ->references('id')
                  ->on('credit_cards');
        });


        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->default(1)->comment('shuftiの場合は：1');
            $table->string('model')->comment('PointLog');
            $table->integer('model_id')->comment('point_log_id');
            $table->integer('user_bank_id')->unsigned(); // 誰に
            $table->integer('amount'); // いくら
            $table->date('pay_at'); // 出勤日
            $table->string('status'); // 0:出金待ち、1:出金済み
            $table->string('error_code');
            $table->timestamps();
            $table->foreign('user_bank_id')
                  ->references('id')
                  ->on('user_banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('credit_card_purchases');
        Schema::drop('credit_cards');
        Schema::drop('withdrawals');
        Schema::drop('holidays');
        Schema::drop('deposits');
        Schema::drop('invoices');
        Schema::drop('user_banks');
        Schema::drop('smbc_accounts');
    }
}
