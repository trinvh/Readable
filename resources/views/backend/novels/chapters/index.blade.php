@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách chương</h3>

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
                        <th>Tên chap</th>
                        <th>Thứ tự</th>
                        <th>Đã xem</th>
                        <th>Cập nhật</th>
                    </tr>
                    @foreach($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->id }}</td>
                        <td>{{ $chapter->name }}</td>
                        <td>{{ $chapter->sort_order }}</td>
                        <td>{{ $chapter->viewed }}</td>
                        <td>{{ $chapter->updated_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                    @if($chapters->count() <= 0)
                    <tr>
                        <td colspan="5" class="warning">Không có chương nào</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="box-footer clearfix">
              <div class="pull-right">
                {!! $chapters->links() !!}
              </div>
              Hiển thị {{ $chapters->count() }} / {{ $chapters->total() }}
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@stop