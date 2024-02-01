<?php

namespace App\Http\Controllers;

use App\Models\GenericInterest;
use App\Models\Museum;
use App\Models\PreviousHistory;
use Illuminate\Http\Request;

class DummyDataController extends Controller
{
    public function museums()
    {
        return Museum::factory()->count(10)->make();
    }

    public function previousHistory()
    {
        return PreviousHistory::factory()->count(20)->make();
    }

    public function populateGenericInterests()
    {
        return GenericInterest::factory()->count(10)->make();
    }
}
