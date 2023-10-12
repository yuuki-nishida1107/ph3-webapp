<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Records;

class RecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Records::create([
            'record_at'=>'2023-10-01',
            'time'=>'5',
            'language_id'=>'4',
            'content_id'=>'2',
        ]);

        Records::create([
            'record_at'=>'2023-10-02',
            'time'=>'7',
            'language_id'=>'7',
            'content_id'=>'1',
        ]);

        Records::create([
            'record_at'=>'2023-10-03',
            'time'=>'5',
            'language_id'=>'4',
            'content_id'=>'2',
        ]);

        Records::create([
            'record_at'=>'2023-10-04',
            'time'=>'5',
            'language_id'=>'1',
            'content_id'=>'3',
        ]);

        Records::create([
            'record_at'=>'2023-10-05',
            'time'=>'5',
            'language_id'=>'2',
            'content_id'=>'1',
        ]);

        Records::create([
            'record_at'=>'2023-10-06',
            'time'=>'5',
            'language_id'=>'6',
            'content_id'=>'2',
        ]);

        Records::create([
            'record_at'=>'2023-10-07',
            'time'=>'5',
            'language_id'=>'8',
            'content_id'=>'3',
        ]);

        Records::create([
            'record_at'=>'2023-10-08',
            'time'=>'5',
            'language_id'=>'2',
            'content_id'=>'1',
        ]);

        Records::create([
            'record_at'=>'2023-10-09',
            'time'=>'5',
            'language_id'=>'3',
            'content_id'=>'2',
        ]);
    }
}
