<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('img_link')->nullable()->comment('avatar người dùng');
            $table->string('job', 100)->nullable()->comment('Công việc');
            $table->string('bio')->nullable()->comment('Tiểu sử');
            $table->string('skills')->nullable()->comment('Kỹ năng');
            $table->string('experience')->nullable()->comment('Kinh nghiệm');
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
        Schema::dropIfExists('user_profiles');
    }
}
