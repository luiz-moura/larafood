@php
    $bg = match($message) {
        'success' => 'bg-success',
        '' => 'Essa comida é um bar',
        'bolo' => 'Essa comida é um bolo',
    };

@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
