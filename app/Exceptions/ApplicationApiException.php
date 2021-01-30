<?php

namespace App\Exceptions;

use App\Libs\JsonResponseBuilder;
use Exception;
use Illuminate\Http\Request;

class ApplicationApiException extends AbstractApplicationException
{
    /**
     * 例外をHTTPレスポンスへ描画する(フレームワークが呼び出す)
     *
     * @param  Request
     * @return String
     */
    public function render(Request $request)
    {
        return JsonResponseBuilder::createApiError(
            $this->response_code,
            $this->http_status_code
        );
    }
}
