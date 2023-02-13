<?php 
namespace App\Contracts;

use App\Http\Requests\NewsfeedRequest;
use Illuminate\Http\JsonResponse;

interface INewsfeedRepository {

    public function getNewsFeed(NewsfeedRequest $request) : JsonResponse;

}