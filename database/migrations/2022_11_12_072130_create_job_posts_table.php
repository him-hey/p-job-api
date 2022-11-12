<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string("job_title");
            $table->string("job_description");
            $table->integer("salary");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign("company_id")->references('id')->on('companies')->onDelete('cascade');
            $table->integer("status")->default(0); //0 mean open job, 1 job closed.
            $table->date("expire_date");
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
        Schema::dropIfExists('job_posts');
    }
};
