@extends('site.layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        @forelse ($plans as $plan)
            <div class="col">
                <div class="card rounded-3 border-primary mb-4 shadow-sm">
                    <div class="card-header bg-primary border-primary py-3 text-white">
                        <h4 class="fw-normal my-0">{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            R$ {{ number_format($plan->price, 2, ',', '.') }}
                            <small class="text-muted fw-light">/mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            @if ($plan->details)
                                @foreach ($plan->details as $detail)
                                    <li>{{ $detail->name }}</li>
                                @endforeach
                            @endif
                        </ul>
                        <a href="{{ route('site.choose_plan', $plan->url) }}" class="w-100 btn btn-lg btn-outline-primary">
                            {{ __('site.subscribe') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
