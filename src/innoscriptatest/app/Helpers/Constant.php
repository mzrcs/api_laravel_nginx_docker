<?php

namespace App\Helpers;

class Constant
{
    const Codes = [
        'SUCCESS'           => 200,
        'CREATED'           => 201,
        'BAD_REQUEST'       => 400,
        'UNAUTHORISED'      => 401,
        //in case of validation failure
        'INPROCESSABLE'     => 422,
        //in case of authentication failure, trying to access any protected route with expired or no API token
        'MAINTENANCE'       => 503,
        'EXCEPTION'         => 500
    ];

    const NewsFeedCategories = [
        'General' => 'general', 
        'Business' => 'business', 
        'Entertainment' => 'entertainment', 
        'Health' => 'health', 
        'Science' => 'science', 
        'Sports' => 'sports', 
        'Technology' => 'technology', 
    ];

    const NewsFeedSources = [
        [
            'id' => 'abc-news',
            'name' => 'ABC News',
            'category' => self::NewsFeedCategories['General']
        ],
        [
            'id' => 'argaam',
            'name' => 'Argaam',
            'category' => self::NewsFeedCategories['Business'] 
        ],
        [
            'id' => 'medical-news-today',
            'name' => 'Medical News Today',
            'category' => self::NewsFeedCategories['Health'] 
        ],
        [
            'id' => 'al-jazeera-english',
            'name' => 'Al Jazeera English',
            'category' => self::NewsFeedCategories['General']
        ],
        [
            'id' => 'ars-technica',
            'name' => 'Ars Technica',
            'category' => self::NewsFeedCategories['Technology'] 
        ],
        [
            'id' => 'ary-news',
            'name' => 'Ary News',
            'category' => self::NewsFeedCategories['General']
        ],
        [
            'id' => 'bbc-news',
            'name' => 'BBC News',
            'category' => self::NewsFeedCategories['General'] 
        ],
        [
            'id' => 'bbc-sport',
            'name' => 'BBC Sport',
            'category' => self::NewsFeedCategories['Sports']
        ],
        [
            'id' => 'buzzfeed',
            'name' => 'Buzzfeed',
            'category' => self::NewsFeedCategories['Entertainment'] 
        ],
        [
            'id' => 'cnn',
            'name' => 'CNN',
            'category' => self::NewsFeedCategories['General']
        ],
        [
            'id' => 'crypto-coins-news',
            'name' => 'Crypto Coins News',
            'category' => self::NewsFeedCategories['Technology'] 
        ],
        [
            'id' => 'entertainment-weekly',
            'name' => 'Entertainment Weekly',
            'category' => self::NewsFeedCategories['Entertainment'] 
        ],
        [
            'id' => 'national-geographic',
            'name' => 'National Geographic',
            'category' => self::NewsFeedCategories['Science'] 
        ]
    ];
}
