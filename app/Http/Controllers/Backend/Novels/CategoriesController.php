<?php

namespace App\Http\Controllers\Backend\Novels;

use App\Http\Controllers\Controller;
use App\Models\Novel\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('backend.novels.categories.index')
            ->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        return view('backend.novels.categories.create')
            ->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Category::$rules);
        
        $category = Category::create($request->all());
        
        return redirect()->route('admin.novels.categories.index')
            ->withSuccess('Tạo mới thể loại <strong>'.$category->name.'</strong> thành công');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.novels.categories.edit')
            ->withCategory($category);
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
        $this->validate($request, Category::$rules);
        
        $category = Category::findOrFail($id);
        $category->fill($request->all());
        $category->save();
        
        return redirect()->route('admin.novels.categories.index')
            ->withSuccess('Cập nhật thể loại <strong>'.$category->name.'</strong> thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->withSuccess("Xóa thể loại ".$category->name." thành công");
    }
}
