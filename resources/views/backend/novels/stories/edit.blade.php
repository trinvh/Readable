@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Truyện <strong>{{ $story->name }}</strong></h3>
            </div>
            {!! BootForm::open()->action(route('admin.novels.stories.update', $story))->put() !!}
            {!! BootForm::bind($story) !!}
            <div class="box-body">
                @include('backend.novels.stories.forms')
            </div>
            <div class="box-footer clearfix">
                <a href="{{ route('admin.novels.stories.index') }}" class="btn btn-default pull-right">Quay lại</a>
                <button type="submit" class="btn btn-info">Lưu truyện</button>
            </div>
            {!! BootForm::close() !!}
        </div>
     </div>
</div>
@stop