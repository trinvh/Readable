<div class="row">
    <div class="col-md-8 col-xs-12">
        {!! BootForm::text('Tên', 'name') !!}
        {!! BootForm::textarea('Giới thiệu', 'description') !!}
        {!! Form::fileImage('photo', $collection->photo) !!}
    </div>
    <div class="col-md-4 col-xs-12">
        
    </div>
</div>
