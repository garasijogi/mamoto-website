<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('contacts');
      // create contact table
      Schema::create('contacts', function (Blueprint $table) {
          $table->id();
          $table->string('name', 64)->unique();
          $table->text('contact');
          $table->text('link');
          $table->string('text', 64);
          $table->string('logo', 64);
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
        Schema::dropIfExists('contacts');
    }
}
