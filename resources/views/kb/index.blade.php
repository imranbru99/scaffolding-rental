@extends('layouts.app')
@section('title', 'Knowledge Base')
@section('content')
<section class="page-hero">
    <div class="wrap">
        <div class="eyebrow">Knowledge</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);margin:.4rem 0 0">Guides, issues and admin manual</h1>
    </div>
</section>
<section class="section">
    <div class="wrap">
        @foreach($articles as $category => $items)
            <h3 style="font-family:var(--font-display);margin:2rem 0 .8rem">{{ str_replace('_',' ', ucfirst($category)) }}</h3>
            <div class="grid-2">
                @foreach($items as $article)
                    <a class="panel" href="{{ route('knowledge.show', $article->slug) }}">
                        <h3 style="font-family:var(--font-display);margin:0">{{ $article->title }}</h3>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
