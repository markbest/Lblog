<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert(
            array(
                array(
                    'id' => '1',
                    'name' => '网站标题',
                    'path' => 'web_title',
                    'value' => '网站标题',
                    'created_at' => date('Y-m-d h:i:s',time()),
                    'updated_at' => date('Y-m-d h:i:s',time()),
                ),
                array(
                    'id' => '2',
                    'name' => '网站底部',
                    'path' => 'web_copyright',
                    'value' => 'Copyright © 2016 All Rights Reserved.',
                    'created_at' => date('Y-m-d h:i:s',time()),
                    'updated_at' => date('Y-m-d h:i:s',time()),
                ),
                array(
                    'id' => '3',
                    'name' => '缓存时间（秒）',
                    'path' => 'web_cache_time',
                    'value' => '86400',
                    'created_at' => date('Y-m-d h:i:s',time()),
                    'updated_at' => date('Y-m-d h:i:s',time()),
                ),
                array(
                    'id' => '4',
                    'name' => '分页显示',
                    'path' => 'web_perpage',
                    'value' => '8',
                    'created_at' => date('Y-m-d h:i:s',time()),
                    'updated_at' => date('Y-m-d h:i:s',time()),
                )
            )
        );
    }
}
