<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPortfolioIdAndPfTypeIdToDisplayedPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('displayed_portfolios', function (Blueprint $table) {
            $table->string('pfType_id')->after('id');
            $table->foreignId('portfolio_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('displayed_portfolios', function (Blueprint $table) {
            $table->dropColumn('pfType_id');
            $table->dropColumn('portfolio_id');
        });
    }
}
