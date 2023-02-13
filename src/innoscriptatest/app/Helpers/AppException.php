<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Sentry\State\Scope;

class AppException
{
    /**
     * @Author: MiesamJafry
     * @Date: 08June2020
     */
    public static function log( \Exception $exception )
    {
        $msg = [
            'error_message' => $exception->getMessage(),
            'in_file' => $exception->getFile(),
            'on_line' => $exception->getLine(),
        ];
        Log::channel('customlog')->debug(json_encode($msg));
    }
}

