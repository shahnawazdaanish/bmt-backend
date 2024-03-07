<?php

namespace App\Http\Controllers;

use App\Http\Requests\MLRecommendationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class MLDataController extends Controller
{
    public function getRecommendations(MLRecommendationRequest $recommendationRequest): \Illuminate\Http\Response
    {
        $url = 'https://nethmifonseka97--bmt-flask-app.modal.run/ml';

        $mlResponse = Http::withoutVerifying()->post($url, $recommendationRequest->all());
        return Response::make($mlResponse, 200);
        return Response::make('
        {
    "1_msg": "",
    "2_best_combination": {
        "accommodation": {
            "name": "Sunset Terrace Apartments",
            "price": {
                "deluxe": 310,
                "standard": 280,
                "suite": 350
            }
        },
        "interest": {
            "name": "Historical",
            "price": 40,
            "type": "The Old Town Heritage"
        },
        "restaurant": {
            "name": "Daegu Dining",
            "price": 55,
            "type": "Korean"
        },
        "total_budget": 375
    },
    "3_second_best_combination": {
        "accommodation": {
            "name": "CosmoComfort Stay",
            "price": {
                "deluxe": 290,
                "standard": 260,
                "suite": 330
            }
        },
        "interest": {
            "name": "Historical",
            "price": 40,
            "type": "The Old Town Heritage"
        },
        "restaurant": {
            "name": "Karē Corner",
            "price": 70,
            "type": "Japanese"
        },
        "total_budget": 370
    },
    "4_third_best_combination": {
        "accommodation": {
            "name": "Forest Edge Retreat",
            "price": {
                "deluxe": 280,
                "standard": 250,
                "suite": 320
            }
        },
        "interest": {
            "name": "Historical",
            "price": 40,
            "type": "The Old Town Heritage"
        },
        "restaurant": {
            "name": "The Northern Story",
            "price": 75,
            "type": "Indian"
        },
        "total_budget": 365
    },
    "5_interest_for_days": [
        {
            "interest": {
                "name": "Rhapsody",
                "price": 15,
                "type": "Lakeside"
            }
        },
        {
            "interest": {
                "name": "Alpine Adobe",
                "price": 10,
                "type": "Lakeside"
            }
        },
        {
            "interest": {
                "name": "Canvas Cove",
                "price": 35,
                "type": "Music"
            }
        },
        {
            "interest": {
                "name": "Senerity Springs",
                "price": 25,
                "type": "Historical"
            }
        },
        {
            "interest": {
                "name": "Fern Forest",
                "price": 40,
                "type": "Lakeside"
            }
        },
        {
            "interest": {
                "name": "Battalion Base",
                "price": 10,
                "type": "Music"
            }
        },
        {
            "interest": {
                "name": "Legacy Lands",
                "price": 45,
                "type": "Music"
            }
        },
        {
            "interest": {
                "name": "Neon Nexus",
                "price": 25,
                "type": "Music"
            }
        }
    ],
    "6_restaurant_for_days": [
        {
            "restaurant": {
                "name": "Busan Bistro",
                "price": 30,
                "type": "Korean"
            }
        },
        {
            "restaurant": {
                "name": "Refreshing North",
                "price": 45,
                "type": "Indian"
            }
        },
        {
            "restaurant": {
                "name": "Yangyang Yummies",
                "price": 85,
                "type": "Korean"
            }
        },
        {
            "restaurant": {
                "name": "Nigiri Nirvana",
                "price": 40,
                "type": "Japanese"
            }
        },
        {
            "restaurant": {
                "name": "Home Of Mughlai Cuisine",
                "price": 55,
                "type": "Indian"
            }
        },
        {
            "restaurant": {
                "name": "Yuzu Yard",
                "price": 35,
                "type": "Japanese"
            }
        },
        {
            "restaurant": {
                "name": "Art of Spices",
                "price": 40,
                "type": "Indian"
            }
        },
        {
            "restaurant": {
                "name": "Gyudon Grove",
                "price": 50,
                "type": "Japanese"
            }
        }
    ]
}
        ');
    }
}
