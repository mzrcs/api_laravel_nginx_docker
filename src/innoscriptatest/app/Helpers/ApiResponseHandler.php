<?php

namespace App\Helpers;

use App\Models\OtpBlocklist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApiResponseHandler
{

    public static function success( $body = [], $message ="general.success" ){
        return  self::send(
            Constant::Codes['SUCCESS'],
            is_array($message) ? $message : Language::getMessage( $message ),
            $body,
            null
        );
    }

    public static function validationError( $validationErrors, $message = "general.validation", $body = [] ){

        $errorMessages = [];

        if( is_array( $validationErrors ) ){
            $errorMessages = array_values( $validationErrors );
        }
        else
        {
            foreach( $validationErrors->getMessages() as $key => $errors )
            {
                $errorMessages = array_merge( $errorMessages, $errors );
            }
        }

        return self::send(
            Constant::Codes['INPROCESSABLE'],
            $errorMessages,
            $body,
            null
        );
    }

    public static function validationFailureError( $validationErrors, $message = "general.validation", $body = [] ){

        $errorMessages = [];

        if( is_array( $validationErrors ) ){
            $errorMessages = array_values( $validationErrors );
        }
        else
        {
            foreach( $validationErrors->getMessages() as $key => $errors )
            {
                $errorMessages = array_merge( $errorMessages, $errors );
            }
        }

        return self::send(
            Constant::Codes['BAD_REQUEST'],
            $errorMessages,
            $body,
            null
        );
    }

    public static function authenticationError(){

        return self::send(
            Constant::Codes['UNAUTHORISED'],
            [Language::getMessage( "general.unauthenticated" )],
            [],
            null
        );
    }

    public static function underMaintenance(){

        return self::send(
            Constant::Codes['MAINTENANCE'],
            [Language::getMessage( "general.maintenance" )],
            [],
            null
        );
    }

    public static function failure( $message = 'general.error', $exception=null, $body = [] ){

        return self::send(
            Constant::Codes['BAD_REQUEST'],
            is_array($message) ? $message : [ Language::getMessage( $message ) ],
            $body,
            $exception
        );
    }

    public static function exception($message, $exception=null ){
        return self::send(
            Constant::Codes['EXCEPTION'],
            [$message],
            [],
            $exception
        );
    }

    private static function send( $status, $message, $body, $exception ){

        return response()->json([
            'status'    =>  $status,
            'message'   =>  $message,
            'body'      =>  $body,
            'exception' =>  $exception
        ], $status, [], JSON_UNESCAPED_UNICODE );
    }
}
