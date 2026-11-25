@extends('layouts.app')

@section('title', 'Services')

@section('content')
<section class="page-hero">
    <div class="wrap">
        <div class="eyebrow">Services</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.4rem,5vw,3.6rem);margin:.4rem 0 0;text-transform:uppercase;letter-spacing:.02em;line-height:1">Scaffolding we rent & erect</h1>
    </div>
</section>
<section class="section">
    <div class="wrap grid-3">
        @foreach($services as $slug => $service)
            <a class="service-tile" href="{{ route('services.show', $slug) }}">
                <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
                <div class="pad">
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['summary'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
