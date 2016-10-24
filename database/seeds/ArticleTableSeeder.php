<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert(
            array(
                'id' => '1',
                'title' => '测试文章标题',
                'slug' => '测试文章关键词',
                'summary' => '测试文章短描述',
                'body' => '测试文章内容',
                'image' => '',
                'views' => '100',
                'user_id' => '1',
                'cat_id' => '1',
                'created_at' => date('Y-m-d h:i:s',time()),
                'updated_at' => date('Y-m-d h:i:s',time()),
            )
        );
    }
}
