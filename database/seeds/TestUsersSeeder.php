<?php

use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // モデルファクトリーで定義したテストユーザーを 20 作成
        factory(App\User::class, 20)->create();
    }
}
