<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTypeProjectPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_type_project_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_type_project_id")->constrained();
            $table->string("name");
            $table->string("title");
            $table->foreignId("pid")->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_type_project_id', 'name'], 'app_type_project_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_type_project_permissions');
    }
}
