<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use Illuminate\Http\Request;

class DummyDataController extends Controller
{
    public function museums()
    {
        return Museum::factory()->count(10)->make();
    }
}
