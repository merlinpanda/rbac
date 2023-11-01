<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_id")->constrained();
            $table->foreignId("app_type_project_id")->constrained();
            $table->boolean("enable")->default(false);
            $table->timestamp("expired_at")->nullable()->default(null);

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
        Schema::dropIfExists('app_projects');
    }
}
