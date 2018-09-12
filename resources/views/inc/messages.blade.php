@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-error">
            <button class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong>
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Success!</strong>
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Error!</strong>
        {{session('error')}}
    </div>
@endif
