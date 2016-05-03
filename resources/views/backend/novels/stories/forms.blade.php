<div class="row">
    <div class="col-md-8 col-xs-12">
        {!! BootForm::text('Tên truyện', 'name') !!}
        {!! BootForm::text('Ảnh', 'photo') !!}
        {!! BootForm::textarea('Giới thiệu', 'description') !!}
        {!! BootForm::text('Lượt xem', 'viewed') !!}
    </div>
    <div class="col-md-4 col-xs-12">
        {!! BootForm::select('Thể loại', 'categories[]', $categories)
            ->attribute('multiple', true)
            ->addClass('select2')
            ->select(old('categories', $story->categories->lists('id')->toArray()))
        !!}
        {!! BootForm::select('Nhãn Tags', 'tags[]', $tags)
            ->attribute('multiple', true)
            ->addClass('select2')
            ->select(old('tags', $story->tags->lists('id')->toArray()))
        !!}
        {!! BootForm::text('Tác giả', 'authors') !!}
    </div>
</div>
