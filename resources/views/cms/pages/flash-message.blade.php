@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <a type="button" class="close" data-dismiss="alert">×</a>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <a type="button" class="close" data-dismiss="alert">×</a>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <a type="button" class="close" data-dismiss="alert">×</a>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <a type="button" class="close" data-dismiss="alert">×</a>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <a type="button" class="close" data-dismiss="alert">×</a>
        @foreach ($errors->all() as $error)
            <li style="padding: 5px;">{{ $error }}</li>
        @endforeach
    </div>
@endif
