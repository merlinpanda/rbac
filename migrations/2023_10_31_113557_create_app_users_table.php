<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->integer("role_value")->unsigned()->default(0);
            $table->enum("status", ['NORMAL', 'DISABLED'])->default("NORMAL");
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['app_id', 'user_id'], 'app_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
