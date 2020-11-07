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
        DB::table('employment_status')->insert([
            //ゲーム
            ['job_title' => 'ゲームプロデューサー'],
            ['job_title' => 'ゲームディレクター'],
            ['job_title' => 'ゲームアプリプログラマ'],
            ['job_title' => 'ゲームシステムプログラマ'],
            ['job_title' => 'キャラクター/背景モデラー'],
            ['job_title' => 'ゲームモーションデザイナー'],
            ['job_title' => 'エフェクトデザイナー'],
            ['job_title' => 'コンセプトアーティスト/キャラクターデザイナー'],
            ['job_title' => '2Dアニメーター/UIデザイナー'],
            ['job_title' => 'ゲームプランナー'],
            ['job_title' => 'ゲームシナリオライター'],
            ['job_title' => 'レベルデザイナー'],
            //IT
            ['job_title' => 'プロジェクトマネージャー'],
            ['job_title' => 'システムエンジニア'],
            ['job_title' => 'システム/アプリ開発プログラマ'],
            ['job_title' => 'データベースエンジニア'],
            ['job_title' => 'ネットワーク/セキュリティエンジニア'],
            ['job_title' => '組み込み制御エンジニア'],
            //Web
            ['job_title' => 'Webデザイナー'],
            ['job_title' => 'UI/UXデザイナー'],
            ['job_title' => 'Webディレクター'],
            ['job_title' => 'マークアップエンジニア'],
            ['job_title' => 'フロントエンドエンジニア'],
            ['job_title' => 'バックエンドエンジニア'],
            //留学生対象のところだけにあったやつ
            ['job_title' => 'CAD技術者'],
        ]);
    }
}
