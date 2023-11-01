<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTypeRbacRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_type_rbac_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("role_id")->references("id")->on("app_type_rbac_roles")->cascadeOnDelete();
            $table->foreignId("project_permission_id")->references("id")->on("app_type_project_permissions")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['role_id', 'project_permission_id'], 'app_type_rbac_role_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_rbac_role_permissions');
    }
}
