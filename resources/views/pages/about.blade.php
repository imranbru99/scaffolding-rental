@extends('layouts.app')

@section('title', 'About')

@section('content')
<section class="page-hero">
    <div class="wrap">
        <div class="eyebrow">About</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.4rem,5vw,3.6rem);margin:.4rem 0 .75rem;text-transform:uppercase;letter-spacing:.02em;line-height:1">Built for Front Range elevation work</h1>
        <p class="lede" style="margin:0">PeakFrame Scaffold Rentals is a Denver scaffolding rental and erect team specializing in frame, system, rolling, and suspended scaffolds — plus shoring support for GCs and specialty contractors.</p>
    </div>
</section>
<section class="section">
    <div class="wrap grid-2" style="align-items:center">
        <img src="https://images.unsplash.com/photo-1590644365607-1c5ac295ecdc?auto=format&fit=crop&w=1200&q=80" alt="Steel construction framing on a Denver jobsite" style="border-radius:.9rem;width:100%">
        <div>
            <h2>Our approach</h2>
            <p class="lede">We start with your elevations and load path — then match frame, system, or suspended gear from a yard that inspects every plank and brace. Front Range wind and freeze-thaw punish weak ties; we document findings before quoting erect labor.</p>
            <p class="lede">Yard staff and erect crews are employed, not gig-matched. That means consistent tagging, delivery counts, and a photo-backed return inspection before invoices close.</p>
        </div>
    </div>
</section>
@endsection
