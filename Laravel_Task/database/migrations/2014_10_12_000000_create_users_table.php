<!-- usersテーブル作成用ファイル -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // usersテーブル設定
    Schema::create('users', function (Blueprint $table) {
    $table->integer('id')->autoIncrement();
    $table->string('name',255)->unique();
    $table->string('email',255);
    $table->string('password',255);
    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // usersテーブル削除命令
        Schema::dropIfExists('users');
    }
}
