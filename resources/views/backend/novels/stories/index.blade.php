@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách truyện</h3>

                <div class="box-tools">
                    <div class="input-group" style="width: 150px; float: left; margin-right: 10px">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    <a href="{{ route('admin.novels.stories.create') }}" class="btn btn-success btn-sm">Thêm truyện mới <i class="fa fa-plus"></i></a>

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Tên truyện</th>
                        <th class="hidden-sm">Slug</th>
                        <th>Số chương</th>
                        <th class="hidden-sm">Tags</th>
                        <th class="hidden-sm">Nguồn</th>
                        <th class="hidden-sm">Cập nhật</th>
                        <th width="200"></th>
                    </tr>
                    @foreach($stories as $story)
                    <tr>
                        <td>{{ $story->id }}</td>
                        <td>{{ $story->name }}</td>
                        <td class="hidden-sm">{{ $story->slug }}</td>
                        <td>
                            @if($story->chapters->count() > 0)
                                {{ $story->chapters->count() }}
                            @else 
                                <span class="label label-danger">0</span>
                            @endif
                        </td>
                        <td class="hidden-sm">{!! $story->showMany('tags') !!}</td>
                        <td class="hidden-sm">
                            @foreach($story->sources as $source)
                                {{ $source->name }} <a href="{!! $source->pivot->url !!}" target="_blank"><i class="fa fa-feed"></i></a><br/>
                            @endforeach
                        </td>
                        <td class="hidden-sm">{{ $story->updated_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="{{ route('admin.novels.stories.exports.show', [$story->id, 'epub']) }}">EPUB</a>
                            <a class="btn btn-success btn-xs" href="{{ route('admin.novels.stories.chapters.index', $story->id) }}">Chương</a>
                            <a class="btn btn-info btn-xs" href="{{ route('admin.novels.stories.edit', $story->id) }}">Sửa</a>
                            <a class="btn btn-danger btn-xs"
                                href="{{ route('admin.novels.stories.destroy', $story) }}"
                                data-method="delete">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer clearfix">
              <div class="pull-right">
                {!! $stories->links() !!}
              </div>
              Hiển thị {{ $stories->count() }} / {{ $stories->total() }}
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@stop