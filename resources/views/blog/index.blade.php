@extends('layouts.app')
@section('title', 'Journal')
@section('content')
<section class="page-hero">
    <div class="wrap">
        <div class="eyebrow">Journal</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);margin:.4rem 0 0">Fabric notes and install tips</h1>
    </div>
</section>
<section class="section">
    <div class="wrap">
        <div class="grid-3">
            @foreach($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}" style="display:block;overflow:hidden;padding:0">
                    @if($post->cover_image)
                        <img src="{{ $post->cover_image }}" alt="" style="width:100%;height:160px;object-fit:cover;">
                    @endif
                    <div style="padding:1.1rem">
                        <h3 style="font-family:var(--font-display);margin:0 0 .4rem">{{ $post->title }}</h3>
                        <p style="margin:0;color:var(--slate)">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div style="margin-top:2rem">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
