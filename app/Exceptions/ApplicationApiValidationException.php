<?php

namespace App\Exceptions;

use App\Libs\JsonResponseBuilder;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationApiValidationException extends Exception
{
    protected $errors;

    /**
     * CoterieApplicationWebValidationException constructor.
     * @param $errors
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    /**
     * 例外情報を記録する(フレームワークが呼び出す)
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->errors->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * @param $request
     * @return String
     */
    public function render(Request $request)
    {
        // TODO createApiValidationErrorが無いので実装
//        return JsonResponseBuilder::createApiValidationError($this->errors);
    }
}
