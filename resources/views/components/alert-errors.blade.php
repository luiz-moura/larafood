@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('alert'))
    <div class="alert alert-{{ session('alert')['type'] }}">
        <p>{{ session('alert')['message'] }}</p>
    </div>
@endisset
