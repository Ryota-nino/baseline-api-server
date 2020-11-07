<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationalCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupational_categories')->insert([
            //ゲーム
            ['name' => 'ゲームプロデューサー'],
            ['name' => 'ゲームディレクター'],
            ['name' => 'ゲームアプリプログラマ'],
            ['name' => 'ゲームシステムプログラマ'],
            ['name' => 'キャラクター/背景モデラー'],
            ['name' => 'ゲームモーションデザイナー'],
            ['name' => 'エフェクトデザイナー'],
            ['name' => 'コンセプトアーティスト/キャラクターデザイナー'],
            ['name' => '2Dアニメーター/UIデザイナー'],
            ['name' => 'ゲームプランナー'],
            ['name' => 'ゲームシナリオライター'],
            ['name' => 'レベルデザイナー'],
            //IT
            ['name' => 'プロジェクトマネージャー'],
            ['name' => 'システムエンジニア'],
            ['name' => 'システム/アプリ開発プログラマ'],
            ['name' => 'データベースエンジニア'],
            ['name' => 'ネットワーク/セキュリティエンジニア'],
            ['name' => '組み込み制御エンジニア'],
            //Web
            ['name' => 'Webデザイナー'],
            ['name' => 'UI/UXデザイナー'],
            ['name' => 'Webディレクター'],
            ['name' => 'マークアップエンジニア'],
            ['name' => 'フロントエンドエンジニア'],
            ['name' => 'バックエンドエンジニア'],
            //留学生対象のところだけにあったやつ
            ['name' => 'CAD技術者'],
        ]);
    }
}
