<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTypeRbacRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_type_rbac_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_id")->constrained();
            $table->integer("role_value")->unsigned();
            $table->string("name");
            $table->string("title");

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_type_id', 'role_value'], 'app_type_role_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_rbac_roles');
    }
}
