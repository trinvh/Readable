<?php

namespace App\Http\Controllers\Backend\Novels;

use App\Http\Controllers\Controller;
use App\Models\Novel\Category;
use App\Models\Novel\Story;
use App\Models\Novel\Tag;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $query = Story::search($request->get('q'));
        } else {
            $query = Story::orderBy('updated_at', 'desc');
        }
        $stories = $query->paginate(20);
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
        $story          = new Story;
        $story->authors = "";

        $tags       = Tag::alphabet()->get()->pluck('name', 'id');
        $categories = Category::alphabet()->get()->pluck('name', 'id');

        return view('backend.novels.stories.create')
            ->withTags($tags)
            ->withCategories($categories)
            ->withStory($story);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Story::$rules);

        $story = Story::create($request->all());

        $story->categories()->sync($request->get('categories'));
        $story->tags()->sync($request->get('tags'));
        $story->syncAuthors($request->get('authors'));

        return redirect()->route('admin.novels.stories.index')
            ->withSuccess('Cập nhật thông tin truyện thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $story          = Story::findOrFail($id);
        $story->authors = $story->showMany('authors');

        $tags       = Tag::alphabet()->get()->pluck('name', 'id');
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
        Story::destroy($id);
        return redirect()->back()
            ->withSuccess("Xóa thành công");
    }
}
