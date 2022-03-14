<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên cấu hình');
            $table->text('value')->nullable()->comment('Giá trị');
            $table->unsignedTinyInteger('status')->default(1)->comment('Trang thai cua config. 1: enable;0: disable. Default 1');
            $table->string('display_name')->nullable()->comment('Tên hiển thị');
            $table->string('group_name')->nullable()->comment('Tên nhóm');
            $table->enum('type', ['text', 'number', 'boolean', 'datetime', 'textarea', 'file'])->default('text')->comment('Loại tham số');
            $table->timestamps();
            $table->unique(['name', 'group_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_configs');
    }
}
