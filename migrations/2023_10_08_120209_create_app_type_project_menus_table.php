<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTypeProjectMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_type_project_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_project_id")->constrained();
            $table->string("icon")->nullable()->default(null);
            $table->string("path");
            $table->string("route_name");
            $table->string("title");
            $table->boolean("is_menu")->default(true)->comment("是否是菜单");
            $table->boolean("active")->default(true);
            $table->foreignId("pid")->default(0);
            $table->integer("sort")->default(0)->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_type_project_id', 'route_name'], 'app_type_project_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_project_menus');
    }
}
