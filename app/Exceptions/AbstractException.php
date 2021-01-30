<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

/**
 * このプロジェクトにおける、バリデーション例外を除く全ユーザ例外の基底クラス
 */
abstract class AbstractException extends Exception
{
    protected $response_code;
    protected $original_exception_object;

    /** レスポンスコードに紐付かない追加のメッセージ */
    protected $custom_message = null;

    /** メッセージに埋め込む変数の連想配列 */
    protected $injectionMessage = null;

    protected $http_status_code = 500;

    /**
     * 例外情報を記録する(フレームワークが呼び出す)
     *
     * @return void
     */
    abstract public function report();

    /**
     * 例外情報を格納する
     *
     * @param [type] $response_code レスポンスコード/これをキーにMessageから表示文言を取得する
     * @param Exception $e キャッチした例外
     */
    public function __construct($response_code, Exception $e = null)
    {
        $this->response_code = $response_code;
        $this->original_exception_object = $e;
    }

    /**
     * 例外をHTTPレスポンスへ描画する(フレームワークが呼び出す)
     *
     * @param  Request
     * @return Response
     */
    abstract public function render(Request $request);

    /**
     * 例外の発生箇所を特定する文字列を返却する
     *
     * @return String 例外の発生箇所を特定する文字列
     */
    protected function getErrorOnLineAsString()
    {
        return 'Error on line ' . $this->original_exception_object->getLine() . ' in ' . $this->original_exception_object->getFile();
    }

    protected function getMessageFromLang()
    {
        if ($this->injectionMessage != null) {
            return Lang::get($this->response_code, $this->injectionMessage);
        } else {
            return Lang::get($this->response_code);
        }
    }

    /**
     * メッセージ内に変数埋め込み部分がある場合、連想配列で置き換えるメッセージを設定する
     *
     * @param array 埋め込む対象 ['key'=>'value',...]
     * @return void
     */
    public function setInjectionMessage($dict)
    {
        $this->injectionMessage = $dict;
    }

    /**
     * try-catch節でcatchした例外の元の例外オブジェクトを格納する
     *
     * @param Exception $e
     * @return void
     */
    public function setOriginalExceptionObject($e)
    {
        $this->original_exception_object = $e;
    }

    /**
     * レスポンスコードに紐付かない追加のログ出力メッセージを追加する
     *
     * @param String $custom_message
     * @return void
     */
    public function setCustomMessage($custom_message)
    {
        $this->custom_message = $custom_message;
    }

    /**
     * レスポンスコードを返却する
     *
     * @return string レスポンスコード
     */
    public function getResponseCode()
    {
        return $this->response_code;
    }

    public function setHttpStatusCode($http_status_code)
    {
        $this->http_status_code = $http_status_code;
    }

}
