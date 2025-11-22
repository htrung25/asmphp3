<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Chỉ thêm 2 cột còn thiếu, bỏ price vì đã có rồi
            if (!Schema::hasColumn('books', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('books', 'image')) {
                $table->string('image')->nullable()->after('price');
            }
        });
    }
};
