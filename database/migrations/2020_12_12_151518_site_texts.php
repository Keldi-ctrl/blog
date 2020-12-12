<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SiteTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('site_texts', function (Blueprint $table) {
        $table->id();
        $table->string('page');
        $table->string('section');
        $table->string('title');
        $table->string('text');
        $table->timestamp('created_at');
        $table->timestamp('updated_at');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
