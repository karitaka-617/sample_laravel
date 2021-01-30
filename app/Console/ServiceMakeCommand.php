<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputArgument;

class ServiceMakeCommand extends Command
{
    protected $name = 'make:service';

    protected $description = 'Create a new Service class';  // $descriptionプロパティを書き換える

    protected $type = 'Service';

    /**
     * 生成に使うスタブファイルを取得する
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    /**
     * InputArgumentのコンストラクタへ渡す引数の配列のリストを返します
     *
     * @return array
     */
    protected function getArguments()
    {
        // GeneratorCommandでクラス名を受け取る引数(name)を定義しているのでマージする
        return array_merge(
            parent::getArguments(),
            [
                // InputArgumentのコンストラクタへ渡す引数の配列を追加していく
                // ここに引数を表現する配列を追加していく
                // 左から
                // @param string               $name        引数名
                // @param int|null             $mode        引数のモード(self::REQUIREDとself::OPTIONALはどちらか一つ)
                // @param string               $description 引数の説明
                // @param string|string[]|null $default     引数の初期値(引数のモードにself::OPTIONALを指定している場合のみ)
                ['model', InputArgument::REQUIRED, 'extend model']

            ]
        );
    }

    /**
     * 指定された名前でクラスを構築する
     *
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name)
    {
        // 引数やオプションなどを使い'置換前'=>'置換後'のような配列を作る
        $replace = [
            'DummyModel' => $this->argument('model')
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
