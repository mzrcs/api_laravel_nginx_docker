<?php 
namespace App\Services;

use App\Models\RequestResponseLogs;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class NewsApis {

    // protected $client;

    // public function __construct(Client $client)
    // {
    //    $this->$client = $client;
        
    // }

    public function getNewsFeeds($query, $from, $to, $sources, $category, $preferdNewsFeed)
    {
        try{
            $preferdNewsFeed = unserialize($preferdNewsFeed);
            $endpoint = env('NEWSAPI_API_URL', '');
            $key = env('NEWSAPI_KEY', '');
            $query = [
                'q' => $query,
                'searchIn' => 'title,content',
                'from' => $from,
                'to' => $to,
                'language' => 'en',
                'sortBy' => 'relevancy',
                'pageSize' => 100,
                'page' => 1,
                'apiKey' => $key
            ];

            if(!empty($category)){
                $endpoint .= "/top-headlines";
                //two categories are not working in newsapi.org
                // if(isset($preferdNewsFeed['category'])){
                //     $query['category'] = $preferdNewsFeed['category'];
                // }
                $query['category'] = $category;
            }else{
                $endpoint .= "/everything";
                // if(isset($preferdNewsFeed['sources'])){
                //     $query['sources'] = $preferdNewsFeed['sources'];
                // }
                $query['sources'] =  $sources;
            }
            $response = Http::get($endpoint, $query);

            if($response->ok()){
                return [
                    'error' => false,
                    'data' => $response->json()['articles']
                ];
            }
            
            throw new Exception($response->json()['message']);

        }catch(\Exception $e){
            return [
                'error' => true,
                'msg' => $e->getMessage()                 
            ];
        }
    }
}