@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách thể loại</h3>

                <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Thể loại</th>
                        <th>Slug</th>
                        <th>Số truyện</th>
                        <th>Cập nhật</th>
                        <th width="140"></th>
                    </tr>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->stories->count() }}</td>
                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-info btn-xs" href="{{ route('admin.novels.categories.edit', $category->id) }}">Sửa</a>
                            <a class="btn btn-danger btn-xs"
                                href="{{ route('admin.novels.categories.destroy', $category) }}"
                                data-method="delete">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer clearfix">
              <div class="pull-right">
                {!! $categories->links() !!}
              </div>
              Hiển thị {{ $categories->count() }} / {{ $categories->total() }}
            </div>
        </div>
    </div>
</div>
@stop