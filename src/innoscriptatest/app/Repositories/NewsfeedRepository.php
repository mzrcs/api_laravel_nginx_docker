<?php 
namespace App\Repositories;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use App\Contracts\INewsfeedRepository;
use App\Models\RequestResponseLogs;
use App\Services\NewsApis;
use Illuminate\Http\JsonResponse;

class NewsfeedRepository implements INewsfeedRepository {

    protected $newsApiService;

    public function __construct(NewsApis $newsApiService)
    {
        $this->newsApiService = $newsApiService; 
    }

    public function getNewsFeed($request) : JsonResponse {
        try{
            $preferred_news_feeds = auth()->user()->preferred_news_feeds;
            $query = $request->q;
            $from = $request->from;
            $to = $request->to;
            $sources = $request->sources;
            $category = $request->category;
            $response = $this->newsApiService->getNewsFeeds($query, $from, $to, $sources, $category, $preferred_news_feeds);
            
            if(!$response['error']){
                RequestResponseLogs::logCustomRequest(200, 'get newsfeed success response', $response);
                return ApiResponseHandler::success(
                    $response['data'], 
                    Language::getMessage('messages.get_newsfeed_success')
                );   
            }
            throw new \Exception($response['msg']);
        }catch(\Exception $e){
            return ApiResponseHandler::exception($e->getMessage(), true);
        }   
    }

}