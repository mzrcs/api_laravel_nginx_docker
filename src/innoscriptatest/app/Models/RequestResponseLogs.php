<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RequestResponseLogs extends Model
{
    static $requestStartTime = null;

    protected $fillable = [
        'url',
        'user_id',
        'status',
        "description",
        "request_headers",
        "response_data",
        "time_in",
        "time_out",
    ];

    public static function logCustomRequest($status, $desc, $response)
    {
        self::create([
            'url' => Route::current()->uri(),
            'user_id'    =>  Auth::check() ? auth()->user()->id : null,
            'status'   =>  $status,
            'description' => $desc,
            'request_header' => serialize(Request()->header()),
            'response_data' => serialize( $response ),
            'time_in'   =>  self::$requestStartTime,
            'time_out'   =>  microtime(false)
        ]);
    }
}
