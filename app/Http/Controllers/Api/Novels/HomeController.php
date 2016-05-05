<?php

namespace App\Http\Controllers\Api\Novels;

use App\Http\Controllers\Controller;
use App\Models\Novel\Category;
use App\Models\Novel\Collection;
use App\Models\Novel\Story;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getIndex(Request $request)
    {
        $collections = Collection::latest()->get();
        $categories  = Category::where('active', true)->alphabet()->get();
        $top_week    = Story::limit(5)->get();
        return compact('categories', 'collections', 'top_week');
    }
}
