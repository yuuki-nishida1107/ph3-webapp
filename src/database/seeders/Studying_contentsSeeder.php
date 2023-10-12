<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Studying_contents;

class Studying_contentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Studying_contents::create([
            'content'=>'udemy',
            'chart_bgcolor'=>'#0345ec',
        ]);

        Studying_contents::create([
            'content'=>'参考書',
            'chart_bgcolor'=>'#0f71bd',
        ]);

        Studying_contents::create([
            'content'=>'POSSE課題',
            'chart_bgcolor'=>'#20bdde',
        ]);
    }
}
