<?php
// <!-- usersテーブルの初期レコード設定ファイル -->
namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usersテーブルの初期レコード
        DB::table('users')->insert([
            ['name'=>'A','email'=>'a@a','password'=>bcrypt('aaaaaaaa')],
            ['name'=>'B','email'=>'b@b','password'=>bcrypt('bbbbbbbb')]
        ]);
    }
}
