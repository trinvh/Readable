<?php

namespace App\Http\Controllers\Backend\Novels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Novel\Collection;

class CollectionController extends Controller
{
    public function index() {
        $collections = Collection::latest()->paginate(20);
        return view('backend.novels.collections.index')
            ->withCollections($collections);
    }
    
    public function create(Request $request) {
        $collection = new Collection;
        return view('backend.novels.collections.create')
            ->withCollection($collection);
    }
    
    public function store(Request $request) {
        $this->validate($request, Collection::$rules);
        
        $collection = auth()->user()->collections()->save(
            new Collection($request->all())
        );
        return redirect()->route('admin.novels.collections.index')
            ->withSuccess("Tạo bộ sưu tập thành công");
    }
    
    public function edit(Request $request, $id) {
        $collection = Collection::findOrFail($id);
        
        return view('backend.novels.collections.edit')
            ->withCollection($collection);
    }
    
    public function update(Request $request, $id) {
        $collection = Collection::findOrFail($id);
        
        $this->validate($request, Collection::$rules);
        
        $collection->fill($request->all());
        $collection->save();
        
        return redirect()->route('admin.novels.collections.index')
            ->withSuccess("Cập nhật thành công");
    }
    
    public function destroy($id) {
        Collection::destroy($id);
        return redirect()->back()
            ->withSuccess("Xóa bộ sưu tập thành công");
    }
}
