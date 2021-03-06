<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Movie;
use \App\Models\Category;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'ホラー'],
            ['name' => 'ラブコメ'],
            ['name' => 'ミステリー'],
            ['name' => 'サスペンス'],
            ['name'=>'コメディー']
        ];

        $movies = [
            [
            'name' => 'THE BATMAN ザ・バットマン',
            'description' => '【現時点で今年一番の“衝撃”】「ジョーカー」鑑賞者は全員観に行くべき“傑作”',
            'minutes' => 120,
            'published_year' => 2022,
            'image_path' => 'badman.jpeg',
            ],
            [
            'name' => 'HOMESTAY（ホームステイ）',
            'description' => '僕はこれから、死んだ高校生の身体にホームステイする――人生が愛おしくなる感動作',
            'minutes' => 120,
            'published_year' => 2022,
            'image_path' => 'homestay.jpeg',
            ],
            [
            'name' => '余命10年',
            'description' => 'SNSを中心に反響を呼んだ小坂流加の同名恋愛小説を、小松菜奈と坂口健太郎の主演、「新聞記者」の藤井道人監督がメガホンで映画化。',
            'minutes' => 110,
            'published_year' => 2022,
            'image_path' => 'yomei.jpeg',
             ],
            [
            'name' => 'ナイル殺人事件',
            'description' => 'ミステリーの女王アガサ・クリスティによる名作「ナイルに死す」を、同じくクリスティ原作の「オリエント急行殺人事件」を手がけたケネス・ブラ..',
            'minutes' => 110,
            'published_year' => 2022,
            'image_path' => 'nail.jpeg',
            ],
            [
            'name' => 'アンチャーテッド',
            'description' => 'トレジャーハンターのネイサン・ドレイクが伝説の秘宝や古代都市の謎に挑む人気アクションアドベンチャーゲーム「アンチャーテッド」シリーズを...',
            'minutes' => 110,
            'published_year' => 2022,
            'image_path' => 'tedd.jpeg',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        foreach ($movies as $movie) {
            // 登録したカテゴリーデータを全抽出
            $categoryIds = Category::all()->random(2)->pluck('id');

            Movie::create($movie)->categories()->sync($categoryIds);
        }
    }
}
