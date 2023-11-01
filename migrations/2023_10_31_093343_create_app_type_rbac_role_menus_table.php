<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTypeRbacRoleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_type_rbac_role_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_rbac_role_id")->constrained();
            $table->foreignId("app_type_project_menu_id")->constrained();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_type_rbac_role_id', 'app_type_project_menu_id'], 'app_type_rbac_role_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_rbac_role_menus');
    }
}
