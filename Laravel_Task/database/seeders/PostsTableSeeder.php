<?php
// <!-- postsテーブルの初期レコード設定ファイル -->
namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // postsテーブルの初期レコード
        DB::table('posts')->insert([
            ['user_name'=>'A','contents'=>'Hello'],
            ['user_name'=>'B','contents'=>'Thank you']
        ]);
    }
}
