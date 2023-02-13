<?php

namespace App\Http\Controllers\Api;

use App\Contracts\INewsfeedRepository;
use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsfeedRequest;
use App\Models\RequestResponseLogs;

class NewsfeedController extends Controller
{
    
    protected $newsFeedRepository;

    public function __construct(INewsfeedRepository $newsFeedRepository)
    {
        $this->newsFeedRepository = $newsFeedRepository; 
    }

    public function getNewsfeeds(NewsfeedRequest $request)
    {
        try{
            return $this->newsFeedRepository->getNewsFeed($request);
        }catch (\Exception $e) {
            RequestResponseLogs::logCustomRequest(500, $e->getMessage(), []);
            return ApiResponseHandler::exception($e->getMessage(), true);
        }
    }
}
