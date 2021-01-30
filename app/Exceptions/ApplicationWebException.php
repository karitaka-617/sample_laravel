<?php

namespace App\Exceptions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * このプロジェクトにおけるアプリケーション例外
 */
class ApplicationWebException extends AbstractApplicationException
{

    protected $redirect_to = null;
    protected $redirect_params = [];

    /**
     * 例外をHTTPレスポンスへ描画する(フレームワークが呼び出す)
     *
     * @param  Request
     * @return RedirectResponse
     */
    public function render(Request $request)
    {
        if ($this->redirect_to === null) {
            return back()
                ->withInput()
                ->withErrors($this->getMessageFromLang());
        } else {
            return redirect()
                ->route($this->redirect_to, $this->redirect_params)
                ->withInput()
                ->withErrors($this->getMessageFromLang());
        }
    }

    /**
     * リダイレクト先を明示的に指定する
     * (指定しない場合のデフォルトはredirect()->back())
     *
     * @param string $redirect_to リダイレクト先ルート名
     * @param array $redirect_params ルートに使用するパラメータ配列
     */
    public function setRedirectTo($redirect_to, $redirect_params = [])
    {
        $this->redirect_to = $redirect_to;
        $this->redirect_params = $redirect_params;
    }

}
