<?php

namespace App\Http\Controllers\Api\Novels;

use App\Http\Controllers\Controller;
use App\Models\Novel\Story;
use App\Transformers\StoryTransformer;
use Illuminate\Http\Request;

class StoriesController extends Controller
{

    public function index(Request $request, $limit = 20)
    {
        if ($request->has('keyword')) {
            $query = Story::search($request->get('keyword'), ['name', 'authors.name']);
        } else {
            $query = Story::latest();
        }
        if ($request->has('sort')) {
            $direction = $request->has('reverse') ? 'asc' : 'desc';
            $query->orderBy($request->get('sort'), $direction);
        }
        if ($request->has('limit')) {
            if ($request->get('limit') > 0 && $request->get('limit') < 100) {
                $limit = $request->get('limit');
            }
        }
        $paginator = $query->paginate($limit);

        $stories = $paginator->getCollection();

        $data = fractal()->collection($stories, new StoryTransformer)
            ->paginateWith(new \PaginatorAdapter($paginator))
            ->toArray();

        return response()->json($data);
    }

    public function show($slug)
    {
        $story = Story::with('chapters', 'authors', 'tags', 'categories')
            ->whereSlug($slug)->first();

        return response()->json($story);
    }
}
