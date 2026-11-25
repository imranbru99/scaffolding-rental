@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="page-hero">
    <div class="wrap">
        <div class="eyebrow">Contact</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.4rem,5vw,3.6rem);margin:.4rem 0 .75rem;text-transform:uppercase;letter-spacing:.02em;line-height:1">Request a scaffold quote</h1>
        <p class="lede" style="margin:0">Tell us about your elevation scope — we will confirm delivery and erect options across Denver, Aurora, Boulder, and Colorado Springs.</p>
    </div>
</section>
<section class="section">
    <div class="wrap" style="max-width:720px">
        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('contact.store') }}" class="stack panel">
            @csrf
            <label>Name
                <input name="name" value="{{ old('name') }}" required>
                @error('name') <small style="color:#b42318">{{ $message }}</small> @enderror
            </label>
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <small style="color:#b42318">{{ $message }}</small> @enderror
            </label>
            <label>Phone
                <input name="phone" value="{{ old('phone') }}">
            </label>
            <label>Subject
                <input name="subject" value="{{ old('subject') }}" placeholder="e.g. Frame package + erect for 4-story façade">
            </label>
            <label>Message
                <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
                @error('message') <small style="color:#b42318">{{ $message }}</small> @enderror
            </label>
            <button class="btn btn-primary" type="submit">Send message</button>
        </form>
    </div>
</section>
@endsection
