<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PeakFrame Scaffold Rentals') — Scaffolding Rental & Erect</title>
    <meta name="description" content="@yield('meta_description', 'PeakFrame Scaffold Rentals supplies frame, system, and suspended scaffolding with delivery, erection, and dismantle across Denver and the Front Range.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0F1724;
            --crane: #E35B1F;
            --crane-soft: #F07A45;
            --bolt: #1B7A6E;
            --bolt-deep: #13584F;
            --steel: #5A6B7D;
            --fog: #E6EBF0;
            --paper: #F1F4F7;
            --font-display: "Teko", sans-serif;
            --font-body: "Manrope", sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background:
                radial-gradient(1100px 520px at 100% -10%, rgba(227,91,31,.14), transparent 55%),
                radial-gradient(820px 440px at 0% 25%, rgba(27,122,110,.12), transparent 50%),
                linear-gradient(180deg, #f5f7fa 0%, var(--paper) 48%, #dde5ec 100%);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(12px);
            background: rgba(241,244,247,.92);
            border-bottom: 1px solid rgba(15,23,36,.08);
        }
        .nav { display: flex; align-items: center; justify-content: space-between; padding: .95rem 0; gap: 1rem; }
        .brand { font-family: var(--font-display); font-size: 1.7rem; letter-spacing: 0.02em; font-weight: 700; line-height: 1; }
        .brand span { color: var(--crane); }
        .nav-links { display: flex; flex-wrap: wrap; gap: .9rem 1.1rem; align-items: center; }
        .nav-links a { color: var(--steel); font-size: .95rem; font-weight: 500; }
        .nav-links a:hover { color: var(--bolt); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .4rem;
            padding: .8rem 1.25rem; border-radius: .45rem; font-weight: 600; border: 0; cursor: pointer;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: var(--crane); color: #fff; box-shadow: 0 10px 28px rgba(227,91,31,.28); }
        .btn-primary:hover { background: #c94d16; }
        .btn-ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.35); }
        .btn-dark { background: var(--ink); color: #fff; }
        .hero {
            min-height: calc(100vh - 68px); display: grid; align-items: end; position: relative;
            overflow: hidden; color: #fff;
            background:
                linear-gradient(180deg, rgba(15,23,36,.2) 0%, rgba(15,23,36,.85) 100%),
                url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
        }
        .hero-inner { padding: 5rem 0 3.75rem; max-width: 640px; animation: rise .85s ease both; }
        .hero h1 {
            font-family: var(--font-display); font-size: clamp(3rem, 7vw, 5.2rem);
            line-height: .95; margin: 0 0 1rem; letter-spacing: 0.01em; text-transform: uppercase;
        }
        .hero p { font-size: 1.08rem; line-height: 1.6; color: rgba(255,255,255,.9); margin: 0 0 1.5rem; max-width: 36rem; }
        .hero-ctas { display: flex; flex-wrap: wrap; gap: .75rem; }
        .eyebrow { color: var(--bolt); font-weight: 700; letter-spacing: .1em; text-transform: uppercase; font-size: .75rem; }
        .section { padding: 4.5rem 0; }
        .section h2 { font-family: var(--font-display); font-size: clamp(2.2rem, 4vw, 3.2rem); margin: 0 0 .75rem; text-transform: uppercase; letter-spacing: .02em; line-height: 1; }
        .lede { color: var(--steel); max-width: 40rem; line-height: 1.6; margin: 0 0 2rem; }
        .grid-3 { display: grid; gap: 1.25rem; grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-2 { display: grid; gap: 1.5rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .service-tile { position: relative; overflow: hidden; min-height: 280px; color: #fff; isolation: isolate; border-radius: .7rem; }
        .service-tile img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -2; transition: transform .6s ease; }
        .service-tile:hover img { transform: scale(1.06); }
        .service-tile::after { content: ""; position: absolute; inset: 0; z-index: -1; background: linear-gradient(180deg, transparent 25%, rgba(15,23,36,.9)); }
        .service-tile .pad { position: absolute; left: 0; right: 0; bottom: 0; padding: 1.3rem; }
        .service-tile h3 { margin: 0 0 .35rem; font-family: var(--font-display); font-size: 1.65rem; text-transform: uppercase; letter-spacing: .02em; }
        .service-tile p { margin: 0; color: rgba(255,255,255,.85); font-size: .92rem; }
        .panel { background: rgba(255,255,255,.78); border: 1px solid rgba(15,23,36,.06); padding: 1.4rem; border-radius: .7rem; }
        .panel h3 { margin: 0 0 .5rem; font-family: var(--font-display); font-size: 1.45rem; text-transform: uppercase; }
        .dash-preview { display: grid; gap: 1rem; grid-template-columns: 1.2fr .8fr; background: var(--ink); color: #fff; padding: 1.5rem; border-radius: .8rem; overflow: hidden; }
        .metric { padding: 1rem; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); border-radius: .5rem; }
        .metric strong { display: block; font-size: 1.85rem; color: var(--crane); font-family: var(--font-display); line-height: 1; }
        .bars { display: flex; align-items: end; gap: .45rem; height: 140px; margin-top: 1rem; }
        .bars span { flex: 1; border-radius: 3px 3px 0 0; background: linear-gradient(180deg, var(--crane), var(--bolt)); animation: grow .9s ease both; }
        form.stack { display: grid; gap: .85rem; }
        label { font-weight: 600; font-size: .9rem; }
        input, textarea, select { width: 100%; padding: .8rem .9rem; border: 1px solid rgba(15,23,36,.14); background: #fff; font: inherit; border-radius: .5rem; }
        .flash { background: rgba(27,122,110,.12); border: 1px solid rgba(27,122,110,.35); color: #13584f; padding: .9rem 1rem; margin-bottom: 1rem; border-radius: .5rem; }
        .site-footer { background: var(--ink); color: rgba(255,255,255,.78); padding: 2.5rem 0; margin-top: 2rem; }
        .wa-float { position: fixed; right: 1.1rem; bottom: 1.1rem; z-index: 50; width: 56px; height: 56px; border-radius: 999px; display: grid; place-items: center; background: #25d366; color: #fff; font-weight: 800; box-shadow: 0 12px 28px rgba(0,0,0,.25); animation: pulse 2.4s ease infinite; }
        .chat-widget { position: fixed; left: 1.1rem; bottom: 1.1rem; z-index: 50; width: min(360px, calc(100vw - 2rem)); }
        .chat-toggle { background: var(--bolt); color: #fff; border: 0; padding: .8rem 1rem; font-weight: 700; cursor: pointer; width: 100%; border-radius: .5rem; }
        .chat-panel { display: none; background: #fff; border: 1px solid rgba(15,23,36,.1); box-shadow: 0 18px 40px rgba(15,23,36,.18); overflow: hidden; border-radius: .7rem; margin-bottom: .55rem; }
        .chat-panel.open { display: block; animation: rise .25s ease; }
        .chat-log { height: 240px; overflow: auto; padding: .9rem; background: var(--fog); }
        .bubble { margin: .4rem 0; padding: .65rem .75rem; border-radius: .6rem; max-width: 90%; font-size: .9rem; line-height: 1.4; white-space: pre-wrap; }
        .bubble.bot { background: #fff; border: 1px solid rgba(15,23,36,.08); }
        .bubble.user { background: var(--ink); color: #fff; margin-left: auto; }
        .chat-form { display: flex; gap: .4rem; padding: .65rem; }
        .chat-form input { flex: 1; }
        .page-hero { padding: 3.5rem 0 1.5rem; background: linear-gradient(135deg, #cfe8e4, #eef2f6 50%, #fde3d6); }
        @keyframes rise { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
        @keyframes grow { from { transform: scaleY(.2); transform-origin: bottom; } to { transform: scaleY(1); } }
        @keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @media (max-width: 900px) {
            .grid-3, .grid-2, .dash-preview { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero { min-height: 78vh; }
        }
    </style>
    @stack('head')
</head>
<body>
<header class="site-header">
    <div class="wrap nav">
        <a class="brand" href="{{ route('home') }}">Peak<span>Frame</span> Scaffold</a>
        <nav class="nav-links">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('blog') }}">Journal</a>
            <a href="{{ route('knowledge') }}">Knowledge</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a class="btn btn-primary" href="{{ route('contact') }}">Get a quote</a>
        </nav>
    </div>
</header>

<main>@yield('content')</main>

<footer class="site-footer">
    <div class="wrap">
        <div class="brand" style="color:#fff;margin-bottom:.5rem;">Peak<span>Frame</span> Scaffold Rentals</div>
        <p>Denver · Aurora · Boulder · Colorado Springs — scaffolding rental, delivery, erect & dismantle.</p>
        <p style="margin-top:1rem;font-size:.9rem;">(303) 555-0184 · hello@peakframe.example · <a href="/admin" style="color:var(--crane)">Admin ERP</a></p>
    </div>
</footer>

<a class="wa-float" href="https://wa.me/13035550184" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>

<div class="chat-widget" id="pf-chat">
    <div class="chat-panel" id="chat-panel">
        <div class="chat-log" id="chat-log">
            <div class="bubble bot">Hi — ask PeakFrame about scaffold rental rates, frame vs system, delivery, OSHA decking, or booking a Denver erect crew.</div>
        </div>
        <form class="chat-form" id="chat-form">
            <input type="text" id="chat-input" placeholder="Ask about scaffolding…" required maxlength="2000">
            <button class="btn btn-primary" type="submit">Send</button>
        </form>
    </div>
    <button class="chat-toggle" type="button" id="chat-toggle">AI Scaffold Concierge</button>
</div>

<script>
(() => {
    const panel = document.getElementById('chat-panel');
    const toggle = document.getElementById('chat-toggle');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const log = document.getElementById('chat-log');
    const sessionId = 'pf-' + Math.random().toString(36).slice(2);
    toggle.addEventListener('click', () => panel.classList.toggle('open'));
    const add = (text, who) => {
        const el = document.createElement('div');
        el.className = 'bubble ' + who;
        el.textContent = text;
        log.appendChild(el);
        log.scrollTop = log.scrollHeight;
    };
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        add(message, 'user');
        input.value = '';
        try {
            const res = await fetch(@json(route('ai.chat')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message, session_id: sessionId }),
            });
            const data = await res.json();
            add(data.reply || 'Something went wrong.', 'bot');
        } catch (err) {
            add('Network error — please try again or call (303) 555-0184.', 'bot');
        }
    });
})();
</script>
@stack('scripts')
</body>
</html>
