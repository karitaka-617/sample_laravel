<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;

abstract class AbstractApplicationException extends AbstractException
{
    /**
     * 例外情報を記録する(フレームワークが呼び出す)
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->response_code);
        Log::error($this->getMessageFromLang());
        if ($this->getMessage() !== '') {
            Log::error($this->getMessage());
        }

        //オリジナルの例外情報$eの内容はここで記録し、システム管理者がログをたどる。
        if ($this->original_exception_object != null) {
            Log::error($this->getMessageFromLang());
            Log::error($this->getMessage());
            Log::error($this->getErrorOnLineAsString());
            Log::error($this->getTraceAsString());
        }

        if ($this->custom_message != null) {
            Log::error($this->custom_message);
        }
    }
}
