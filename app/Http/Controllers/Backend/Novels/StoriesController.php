<?php

namespace App\Http\Controllers\Backend\Novels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Novel\Story;
use App\Models\Novel\Category;
use App\Models\Novel\Author;
use App\Models\Novel\Tag;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::first();
        //return implode(', ', $story->tags->pluck('name')->toArray());
        $stories = Story::latest()->paginate(20);
        return view('backend.novels.stories.index')
            ->withStories($stories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $story = Story::findOrFail($id);
        $story->authors = $story->showMany('authors');
        
        $tags = Tag::alphabet()->get()->pluck('name', 'id');
        $categories = Category::alphabet()->get()->pluck('name', 'id');
        return view('backend.novels.stories.edit')
            ->withTags($tags)
            ->withCategories($categories)
            ->withStory($story);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Story::$rules);
                
        $story = Story::findOrFail($id);
        
        $story->fill($request->all());
        $story->save();
        $story->categories()->sync($request->get('categories'));
        $story->tags()->sync($request->get('tags'));
        $story->syncAuthors($request->get('authors'));
        
        return redirect()->route('admin.novels.stories.index')->withSuccess('Cập nhật thông tin truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
