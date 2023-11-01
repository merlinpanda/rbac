<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAppTypeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 客户端项目组，也是菜单组
        // 用于单位开通的服务
        Schema::create('app_type_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_id")->constrained();
            $table->string("name");
            $table->string("title");
            $table->enum("status", ['DEV', "RELEASE", "BETA"])->default("DEV");
            $table->string("version");
            $table->integer("version_number")->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_type_id', 'name'], 'app_type_project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_projects');
    }
}
