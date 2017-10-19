@if(Session::has('success'))
    <div class="alert-bg alert-success" role="alert">
        <strong>请求成功:</strong> {{ Session::get('success') }}
    </div>
@endif


@if(count($errors) > 0)
    <div class="alert-bg alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif