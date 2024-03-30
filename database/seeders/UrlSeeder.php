<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos_url')->insert(
                [
                    [
                    'url_id' => 1,
                    'url' => 'https://www.youtube.com/embed/7PIji8OubXU',
                    ],
                    [
                    'url_id' => 2,
                    'url'=>'https://www.youtube.com/embed/tgbNymZ7vqY'
                    ]
                ]);
    }
}
