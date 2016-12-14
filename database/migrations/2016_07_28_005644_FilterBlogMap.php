<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilterBlogMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('map_filter', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('blog_id')->unsigned();
            $table->integer('filter_id')->unsigned();
            $table->timestamps();
            $table->foreign('blog_id')->references('id')->on('fc_blogs')->onDelete('cascade');
            $table->foreign('filter_id')->references('id')->on('fc_filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('map_filter');
    }
}
