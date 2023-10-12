<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Studying_languages;

class Studying_languagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Studying_languages::create([
            'language'=>'HTML',
            'chart_bgcolor'=>'#0345ec',
        ]);

        Studying_languages::create([
            'language'=>'CSS',
            'chart_bgcolor'=>'#0f71bd',
        ]);

        Studying_languages::create([
            'language'=>'JavaScript',
            'chart_bgcolor'=>'#20bdde',
        ]);

        Studying_languages::create([
            'language'=>'PHP',
            'chart_bgcolor'=>'#3ccefe',
        ]);

        Studying_languages::create([
            'language'=>'Laravel',
            'chart_bgcolor'=>'#b29ef3',
        ]);

        Studying_languages::create([
            'language'=>'SQL',
            'chart_bgcolor'=>'#6d46ec',
        ]);

        Studying_languages::create([
            'language'=>'SHELL',
            'chart_bgcolor'=>'#4a17ef',
        ]);

        Studying_languages::create([
            'language'=>'情報システム基礎知識（その他）',
            'chart_bgcolor'=>'#3105c0',
        ]);
    }
}
