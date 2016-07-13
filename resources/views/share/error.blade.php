@if($seccessMsgs = Session::get("SUCCESS_MESSAGE"))
    <div class="alert alert-success">
        <ul>
            @foreach ($seccessMsgs as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif