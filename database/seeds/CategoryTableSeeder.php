<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            array(
                'id' => '1',
                'title' => '文章杂谈',
                'created_at' => date('Y-m-d h:i:s',time()),
                'updated_at' => date('Y-m-d h:i:s',time()),
            )
        );
    }
}
