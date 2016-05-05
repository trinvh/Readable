@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Bộ sưu tập <strong>{{ $collection->name }}</strong></h3>
            </div>
            {!! BootForm::open()->action(route('admin.novels.collections.update', $collection))->put() !!}
            {!! BootForm::bind($collection) !!}
            <div class="box-body">
                @include('backend.novels.collections.forms')
            </div>
            <div class="box-footer clearfix">
                <a href="{{ route('admin.novels.collections.index') }}" class="btn btn-default pull-right">Quay lại</a>
                <button type="submit" class="btn btn-info">Lưu thể loại</button>
            </div>
            {!! BootForm::close() !!}
        </div>
     </div>
</div>
@stop