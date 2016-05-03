@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-danger"></i> Alert!</h4>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@elseif (Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-success"></i> Alert!</h4>
        @if(is_array(json_decode(Session::get('success'), true)))
            {!! implode('', Session::get('success')->all(':message<br/>')) !!}
        @else
            {!! Session::get('success') !!}
        @endif
    </div>
@elseif (Session::get('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        @if(is_array(json_decode(Session::get('warning'), true)))
            {!! implode('', Session::get('warning')->all(':message<br/>')) !!}
        @else
            {!! Session::get('warning') !!}
        @endif
    </div>
@elseif (Session::get('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        @if(is_array(json_decode(Session::get('info'), true)))
            {!! implode('', Session::get('info')->all(':message<br/>')) !!}
        @else
            {!! Session::get('info') !!}
        @endif
    </div>
@elseif (Session::get('danger'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-danger"></i> Alert !</h4>
        @if(is_array(json_decode(Session::get('danger'), true)))
            {!! implode('', Session::get('danger')->all(':message<br/>')) !!}
        @else
            {!! Session::get('danger') !!}
        @endif
    </div>
@elseif (Session::get('message'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        @if(is_array(json_decode(Session::get('message'), true)))
            {!! implode('', Session::get('message')->all(':message<br/>')) !!}
        @else
            {!! Session::get('message') !!}
        @endif
    </div>
@endif