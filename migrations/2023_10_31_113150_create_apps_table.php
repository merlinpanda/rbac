<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // target: organization, conference
        // 客户端-> acss          conference
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_id")->constrained();
            $table->string("app_key", 16)->unique();
            $table->string("app_secret", 64);
            $table->foreignId("pid")->default(0);
            $table->morphs("target");
            $table->enum("status", ['PENDING', "NORMAL", "DISABLED"])->default("PENDING");

            $table->softDeletes();
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
        Schema::dropIfExists('apps');
    }
}
