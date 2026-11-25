@extends('layouts.app')

@section('title', 'PeakFrame Scaffold Rentals')
@section('meta_description', 'Denver scaffolding rental: frame, system, rolling towers, swing stage, shoring — plus delivery, erect, and dismantle for Front Range contractors.')

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <div class="eyebrow" style="color:var(--crane);margin-bottom:.6rem;">Denver · Front Range</div>
        <h1>PeakFrame Scaffold Rentals</h1>
        <p>OSHA-minded scaffold fleets, on-time yard pulls, and certified erect crews — the Front Range rental partner that keeps your elevation work moving.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Request a quote</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">Browse equipment</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>What we rent & erect</h2>
        <p class="lede">From baker scaffolds on interior paint jobs to multi-bay system towers on mid-rise façades — every rental is tracked in our ERP with inspection tags.</p>
        <div class="grid-3">
            @foreach([
                ['frame-scaffolding','Frame Scaffolding','Tube & coupler frames for façades, masonry, and exterior access.','https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80'],
                ['system-scaffolding','System Scaffolding','Modular ring-lock and cup-lock systems for complex geometry.','https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80'],
                ['rolling-towers','Rolling Towers','Baker and rolling towers for interiors and light exterior work.','https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>{{ $blurb }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why PeakFrame</h2>
        <p class="lede">A Denver yard that treats load charts, wind exposure, and plank condition as one safety system — not three vendor hand-offs.</p>
        <div class="grid-3">
            <div class="panel">
                <h3>Inspected inventory</h3>
                <p>Frames, braces, and planks leave the yard with serialized inspection tags. Damaged decking is quarantined, not rented.</p>
            </div>
            <div class="panel">
                <h3>Certified erect crews</h3>
                <p>Competent-person led erection and dismantle for frame, system, and suspended scaffolds across the metro.</p>
            </div>
            <div class="panel">
                <h3>ERP-run logistics</h3>
                <p>Jobs, fleet SKUs, appointments, and invoices live in one stack — fewer missed deliveries and change orders.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the PeakFrame ERP used to schedule deliveries, track scaffold SKUs, and close rental invoices.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>38</strong> Active rentals</div>
                    <div class="metric"><strong>$214k</strong> Pipeline</div>
                    <div class="metric"><strong>12</strong> Erect crews</div>
                </div>
                <div class="bars">
                    <span style="height:40%"></span><span style="height:65%"></span><span style="height:50%"></span>
                    <span style="height:80%"></span><span style="height:55%"></span><span style="height:90%"></span>
                    <span style="height:70%"></span>
                </div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0;font-size:1.6rem;text-transform:uppercase">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>Contractors & contact inbox</li>
                    <li>Jobs / rental projects</li>
                    <li>Scaffold fleet inventory</li>
                    <li>Invoices & payments</li>
                    <li>AI Studio content tools</li>
                </ul>
                <a class="btn btn-primary" href="/admin" style="margin-top:1rem">Open admin login</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>From the journal</h2>
        <p class="lede">Practical notes on safer elevated work and Front Range scaffolding.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}" style="display:block;overflow:hidden;padding:0">
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="width:100%;aspect-ratio:16/10;object-fit:cover">
                    <div style="padding:1.1rem 1.2rem 1.3rem">
                        <h3 style="margin:0 0 .4rem;font-family:var(--font-display);font-size:1.35rem;text-transform:uppercase">{{ $post->title }}</h3>
                        <p style="margin:0;color:var(--steel);font-size:.95rem">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @empty
                <p>Journal posts appear after seeding.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap panel" style="text-align:center;background:linear-gradient(145deg,#cfe8e4,#eef2f6 45%,#fde3d6)">
        <h2 style="margin-top:0">Need scaffold on site next week?</h2>
        <p class="lede" style="margin-inline:auto">Send drawings or photos — we’ll quote frames, decks, and erect labor for your Denver elevation scope.</p>
        <a class="btn btn-primary" href="{{ route('contact') }}">Contact PeakFrame</a>
    </div>
</section>
@endsection
