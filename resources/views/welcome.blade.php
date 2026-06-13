<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Happy 50th Birthday — Pastor Funke Oke</title>
    <meta name="description" content="Celebrating the golden jubilee of Pastor Funke Oke. Send wishes, share memories." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dancing+Script:wght@700&family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&family=Yeseva+One&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #0a0015;
            --bg2: #100025;
            --purple: #6e28d9;
            --purple-mid: #9747ff;
            --purple-light:#c084fc;
            --pink: #f472b6;
            --pink-hot: #e91e8c;
            --gold: #fbbf24;
            --gold-bright: #fde68a;
            --cyan: #22d3ee;
            --cream: #fdf4ff;
            --muted: #a78bca;
            --card-bg: rgba(255,255,255,0.04);
            --border: rgba(251,191,36,0.22);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Jost', sans-serif;
            background: var(--bg);
            color: var(--cream);
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1000;
            opacity: 0.35;
        }
        .bg-orbs { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .orb {
            position: absolute; border-radius: 50%; filter: blur(80px);
            animation: orbFloat var(--dur, 20s) ease-in-out infinite alternate var(--delay, 0s);
            opacity: 0.45;
        }
        @keyframes orbFloat {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(var(--tx, 40px), var(--ty, 30px)) scale(var(--sc, 1.1)); }
        }
        .stars-layer { position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
        .star {
            position: absolute; border-radius: 50%;
            animation: twinkle var(--dur, 4s) ease-in-out infinite var(--delay, 0s);
            opacity: 0;
        }
        @keyframes twinkle {
            0%,100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: var(--bright, 0.8); transform: scale(1.2); }
        }
        #confetti-canvas { position: fixed; inset: 0; pointer-events: none; z-index: 999; }
        /* ── Flash Banner ── */
        .flash-banner {
            position: fixed; top: 1.5rem; left: 50%;
            transform: translateX(-50%) translateY(-140%);
            z-index: 9999;
            display: flex; align-items: center; gap: 1rem;
            background: var(--bg2);
            border: 1px solid rgba(251,191,36,0.4);
            border-radius: 16px; padding: 1rem 1.5rem;
            box-shadow: 0 20px 60px rgba(110,40,217,0.5);
            min-width: 300px; max-width: 460px;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .flash-banner.show { transform: translateX(-50%) translateY(0); }
        .flash-banner.success { border-color: rgba(52,199,89,0.5); }
        .flash-banner.error { border-color: rgba(232,124,124,0.5); }
        .flash-icon { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .flash-banner.success .flash-icon { background:rgba(52,199,89,0.15); color:#34c759; }
        .flash-banner.error .flash-icon { background:rgba(232,124,124,0.15); color:#e87c7c; }
        .flash-text strong { display:block; font-size:0.8rem; font-weight:700; color:var(--cream); letter-spacing:0.04em; }
        .flash-text span { font-size:0.95rem; color:var(--muted); }
        /* ── Hero ── */
        .hero {
            position: relative; min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: flex-end;
            text-align: center; padding: 3rem 1.5rem 5rem;
            z-index: 1; overflow: hidden;
        }
        .hero-bg-image {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; object-position: top; z-index: -3;
            animation: heroReveal 2.2s ease both;
            transition: opacity 1.5s ease;
        }
        .hero-bg-image-2 {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; object-position: top center; z-index: -4;
            opacity: 0;
            transition: opacity 1.5s ease;
        }
        @keyframes heroReveal {
            from { opacity:0; transform:scale(1.08); filter:blur(14px) saturate(0.3); }
            to { opacity:1; transform:scale(1); filter:blur(0) saturate(1.1); }
        }
        .hero-overlay {
            position: absolute; inset: 0; z-index: -2;
            background: linear-gradient(to top,
                rgba(10,0,21,1) 0%, rgba(10,0,21,0.92) 28%,
                rgba(10,0,21,0.55) 55%, rgba(10,0,21,0.2) 75%,
                rgba(110,40,217,0.3) 100%
            );
        }
        .hero-glow {
            position: absolute; inset: 0; z-index: -1;
            background: radial-gradient(ellipse 60% 55% at 50% 38%,
                rgba(251,191,36,0.15) 0%, rgba(232,80,180,0.08) 45%, transparent 70%
            );
        }
        .hero-photo-badge {
            position: absolute;
            bottom: 5.5rem; right: 1.5rem;
            z-index: 2;
            background: rgba(10,0,21,0.75);
            border: 1px solid rgba(251,191,36,0.35);
            border-radius: 14px;
            padding: 0.5rem 0.75rem;
            display: flex; align-items: center; gap: 0.6rem;
            font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.06em; color: var(--gold);
            backdrop-filter: blur(8px);
            opacity: 0; animation: fadeInBadge 0.6s ease 3s forwards;
            text-transform: uppercase;
        }
        @keyframes fadeInBadge {
            from { opacity:0; transform:translateY(8px); }
            to { opacity:1; transform:translateY(0); }
        }
        .hero-photo-badge .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--gold);
            animation: twinkle 1.5s ease-in-out infinite;
            --bright: 1;
        }
        .hero-eyebrow {
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.45em; text-transform: uppercase;
            color: var(--pink); animation: fadeInDown 1s ease both;
            text-shadow: 0 0 20px rgba(244,114,182,0.7);
        }
        .hero-fifty {
            font-family: 'Abril Fatface', serif;
            font-size: clamp(7rem, 22vw, 16rem);
            line-height: 0.85;
            background: linear-gradient(135deg, #fde68a 0%, #fbbf24 30%, #f472b6 65%, #c084fc 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: fadeInUp 1s ease 0.2s both;
            filter: drop-shadow(0 0 40px rgba(251,191,36,0.35));
            letter-spacing: -0.02em;
        }
        .hero-name {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2rem, 6vw, 4rem); font-weight: 700;
            background: linear-gradient(90deg, var(--gold-bright), var(--pink), var(--purple-light));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: fadeInUp 1s ease 0.4s both;
            line-height: 1.2;
        }
        .hero-subtitle {
            font-size: clamp(0.95rem, 2.5vw, 1.25rem); font-weight: 300;
            color: rgba(253,244,255,0.7); max-width: 540px;
            line-height: 1.85; animation: fadeInUp 1s ease 0.6s both;
        }
        .hero-date-badge {
            display: inline-flex; align-items: center; gap: 0.75rem;
            background: rgba(251,191,36,0.1);
            border: 1px solid rgba(251,191,36,0.4);
            border-radius: 100px; padding: 0.6rem 1.6rem;
            font-size: 0.75rem; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--gold); animation: fadeInUp 1s ease 0.8s both;
            box-shadow: 0 0 30px rgba(251,191,36,0.15);
        }
        .hero-scroll-cta {
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.3em; text-transform: uppercase;
            color: var(--purple-light); text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.6rem;
            animation: fadeInUp 1s ease 1s both; transition: color 0.2s;
        }
        .hero-scroll-cta:hover { color: var(--pink); }
        .ornament { display:flex; align-items:center; gap:1rem; justify-content:center; margin:1.2rem 0; }
        .ornament-line { flex:1; max-width:100px; height:1px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .ornament-diamond { width:7px; height:7px; background:var(--gold); transform:rotate(45deg); flex-shrink:0; box-shadow: 0 0 8px var(--gold); }
        /* ── Countdown ── */
        .countdown-section {
            position: relative; z-index: 1;
            padding: 5rem 1.5rem; text-align: center;
        }
        .section-eyebrow {
            font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.4em; text-transform: uppercase;
            color: var(--pink); margin-bottom: 0.6rem;
            text-shadow: 0 0 16px rgba(244,114,182,0.5);
        }
        .countdown-grid { display: flex; gap: clamp(0.8rem, 3vw, 2.5rem); justify-content: center; flex-wrap: wrap; }
        .countdown-unit { display:flex; flex-direction:column; align-items:center; gap:0.5rem; }
        .countdown-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px; padding: 1.2rem 1.8rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 40px rgba(251,191,36,0.06), inset 0 1px 0 rgba(255,255,255,0.05);
        }
        .countdown-number {
            font-family: 'Abril Fatface', serif;
            font-size: clamp(3rem, 9vw, 5.5rem); line-height: 1;
            background: linear-gradient(180deg, var(--gold-bright) 0%, var(--gold) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .countdown-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.3em; text-transform: uppercase; color: var(--muted); }
        .countdown-sep {
            font-family: 'Abril Fatface', serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            color: var(--purple-mid); opacity: 0.5;
            align-self: center;
            animation: blink 1s step-end infinite;
        }
        @keyframes blink { 0%,100%{opacity:0.5;} 50%{opacity:0.1;} }
        .birthday-arrived {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 700;
            background: linear-gradient(90deg, var(--gold), var(--pink), var(--purple-light));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.6;} }
        /* ── Memory Gallery / Upload ── */
        .memories-gallery {
            position: relative; z-index: 1;
            padding: 3rem 0 5rem; overflow: hidden;
        }
        .memories-gallery .section-title,
        .memories-gallery .section-sub { padding: 0 1.5rem; }
        .carousel-track-wrapper { position: relative; overflow: hidden; margin-top: 2.5rem; }
        .carousel-track {
            display: flex; gap: 1.25rem;
            animation: scrollLeft 30s linear infinite;
            width: max-content;
        }
        .carousel-track:hover { animation-play-state: paused; }
        @keyframes scrollLeft {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .memory-slide {
            width: 280px; height: 210px; flex-shrink: 0;
            border-radius: 16px; overflow: hidden;
            border: 1px solid rgba(251,191,36,0.2);
            position: relative; transition: transform 0.3s, box-shadow 0.3s; cursor: pointer;
        }
        .memory-slide:hover { transform: scale(1.04); box-shadow: 0 16px 40px rgba(110,40,217,0.4); }
        .memory-slide img, .memory-slide video { width:100%; height:100%; object-fit:cover; }
        .memory-slide-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,0,21,0.8) 0%, transparent 60%);
            opacity: 0; transition: opacity 0.3s;
            display: flex; align-items: flex-end; padding: 1rem;
        }
        .memory-slide:hover .memory-slide-overlay { opacity: 1; }
        .memory-slide-name { font-size: 0.75rem; font-weight: 700; color: var(--gold); letter-spacing: 0.04em; }
        .dissolve-gallery {
            position: relative; width: 100%; max-width: 700px; margin: 0 auto;
            aspect-ratio: 16/9; border-radius: 24px; overflow: hidden;
            margin-top: 2.5rem;
            box-shadow: 0 30px 80px rgba(110,40,217,0.4);
            border: 1px solid rgba(251,191,36,0.2);
        }
        .dissolve-slide {
            position: absolute; inset: 0; opacity: 0; transition: opacity 1.5s ease;
            background: linear-gradient(135deg, rgba(110,40,217,0.3), rgba(232,30,140,0.2));
            display: flex; align-items: center; justify-content: center;
        }
        .dissolve-slide.active { opacity: 1; }
        .dissolve-slide img, .dissolve-slide video { width:100%; height:100%; object-fit:cover; }
        .dissolve-placeholder { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:1rem; height:100%; }
        .dissolve-placeholder .big-emoji { font-size: 4rem; }
        .dissolve-placeholder p { font-size: 1rem; color: var(--muted); font-weight: 300; }
        /* ── Upload Section ── */
        .upload-section {
            position: relative; z-index: 1;
            padding: 5rem 1.5rem; max-width: 900px; margin: 0 auto;
        }
        .upload-zone {
            background: var(--card-bg);
            border: 2px dashed rgba(251,191,36,0.3);
            border-radius: 24px; padding: 3rem 2rem;
            text-align: center; transition: border-color 0.3s, background 0.3s;
            cursor: pointer; position: relative;
        }
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: var(--gold);
            background: rgba(251,191,36,0.04);
            box-shadow: 0 0 40px rgba(251,191,36,0.1);
        }
        .upload-icon { font-size: 3.5rem; margin-bottom: 1rem; animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
        .upload-title { font-family: 'Yeseva One', serif; font-size: 1.6rem; color: var(--cream); margin-bottom: 0.5rem; }
        .upload-sub { font-size: 0.9rem; font-weight: 300; color: var(--muted); margin-bottom: 1.5rem; }
        #media-input { display: none; }
        .upload-btn {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, var(--purple), var(--pink-hot));
            border: none; border-radius: 100px;
            color: white; font-family: 'Jost', sans-serif;
            font-size: 0.8rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 30px rgba(110,40,217,0.4);
        }
        .upload-btn:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(232,30,140,0.5); }
        /* ── Wish Form ── */
        .form-section {
            position: relative; z-index: 1;
            padding: 5rem 1.5rem; max-width: 720px; margin: 0 auto;
        }
        .section-title {
            font-family: 'Yeseva One', serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            text-align: center;
            background: linear-gradient(135deg, var(--gold-bright), var(--pink));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            margin-bottom: 0.5rem;
        }
        .section-sub { text-align: center; font-size: 1.05rem; font-weight: 300; color: var(--muted); margin-bottom: 3rem; }
        .section-heading { text-align: center; margin-bottom: 3rem; }
        .section-heading h2 {
            font-family: 'Yeseva One', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            background: linear-gradient(135deg, var(--gold-bright), var(--pink));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            line-height: 1.2;
        }
        .section-heading p { font-size: 1.05rem; font-weight: 300; color: var(--muted); margin-top: 0.75rem; line-height: 1.7; }
        .wish-form {
            background: var(--card-bg);
            border: 1px solid rgba(251,191,36,0.18);
            border-radius: 28px; padding: clamp(1.75rem, 5vw, 3rem);
            backdrop-filter: blur(16px);
            box-shadow: 0 40px 100px rgba(110,40,217,0.3), inset 0 1px 0 rgba(251,191,36,0.08);
        }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
        .form-grid .full { grid-column: 1 / -1; }
        .field { display:flex; flex-direction:column; gap:0.5rem; }
        .field label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: var(--purple-light); }
        .field input, .field textarea {
            font-family: 'Jost', sans-serif; font-size: 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(192,132,252,0.22);
            border-radius: 12px; padding: 0.9rem 1.1rem;
            color: var(--cream); outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s; width: 100%;
        }
        .field input::placeholder, .field textarea::placeholder { color: rgba(167,139,202,0.5); }
        .field input:focus, .field textarea:focus {
            border-color: var(--gold); background: rgba(251,191,36,0.05);
            box-shadow: 0 0 0 3px rgba(251,191,36,0.12);
        }
        .field input.is-invalid, .field textarea.is-invalid {
            border-color: #e87c7c; box-shadow: 0 0 0 3px rgba(232,124,124,0.12);
        }
        .field textarea { resize: vertical; min-height: 140px; line-height: 1.7; }
        .char-count { font-size: 0.65rem; color: var(--muted); text-align: right; transition: color 0.2s; }
        .char-count.warning { color: #e8a87c; }
        .char-count.danger { color: #e87c7c; }
        .field-error { font-size: 0.65rem; color: #e87c7c; }
        .submit-btn {
            width: 100%; padding: 1.15rem 2rem;
            background: linear-gradient(135deg, var(--purple) 0%, var(--pink-hot) 50%, var(--gold) 100%);
            border: none; border-radius: 14px; color: white;
            font-family: 'Jost', sans-serif; font-size: 0.85rem; font-weight: 700;
            letter-spacing: 0.18em; text-transform: uppercase;
            cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 10px 40px rgba(232,30,140,0.4);
            position: relative; overflow: hidden;
        }
        .submit-btn::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(255,255,255,0.15) 0%,transparent 60%); opacity:0; transition:opacity 0.2s; }
        .submit-btn:hover { transform: translateY(-3px); box-shadow: 0 18px 50px rgba(232,30,140,0.6); }
        .submit-btn:hover::after { opacity: 1; }
        .submit-btn:active { transform: translateY(0); }
        /* ── Song FAB (Now Playing) ── */
        .song-fab {
            position: fixed; bottom: 2rem; right: 2rem;
            width: 60px; height: 60px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple-mid), var(--pink-hot));
            border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 8px 30px rgba(232,30,140,0.5);
            z-index: 500; transition: transform 0.2s, box-shadow 0.2s;
            animation: fabPulse 2s ease-in-out infinite;
        }
        @keyframes fabPulse {
            0%,100% { box-shadow: 0 8px 30px rgba(232,30,140,0.5); }
            50% { box-shadow: 0 8px 50px rgba(232,30,140,0.8), 0 0 0 12px rgba(232,30,140,0.1); }
        }
        .song-fab:hover { transform: scale(1.12); }
        .song-fab.playing { background: linear-gradient(135deg, var(--gold), var(--pink-hot)); }
        /* ── Footer ── */
        .site-footer {
            position: relative; z-index: 1; text-align: center;
            padding: 3.5rem 1.5rem 4rem;
            border-top: 1px solid rgba(251,191,36,0.1);
        }
        .site-footer p { font-size: 0.95rem; color: var(--muted); }
        .footer-hearts { font-size: 1.5rem; margin-bottom: 1rem; animation: heartBeat 1.5s ease-in-out infinite; }
        @keyframes heartBeat { 0%,100%{transform:scale(1);} 50%{transform:scale(1.2);} }
        /* ── Animations ── */
        @keyframes fadeInDown { from{opacity:0;transform:translateY(-24px);} to{opacity:1;transform:translateY(0);} }
        @keyframes fadeInUp { from{opacity:0;transform:translateY(35px);} to{opacity:1;transform:translateY(0);} }
        .reveal { opacity:0; transform:translateY(40px); transition:opacity 0.9s ease,transform 0.9s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }
        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-grid .full { grid-column: 1; }
            .flash-banner { left:1rem; right:1rem; transform:translateX(0) translateY(-140%); min-width:unset; width:calc(100% - 2rem); }
            .flash-banner.show { transform:translateX(0) translateY(0); }
            .hero-photo-badge { display: none; }
        }
    </style>
</head>
<body>

{{-- BG Orbs --}}
<div class="bg-orbs">
    <div class="orb" style="width:600px;height:600px;background:radial-gradient(circle,rgba(110,40,217,0.5),transparent 70%);top:-200px;left:-200px;--dur:22s;--tx:60px;--ty:40px;--sc:1.15;"></div>
    <div class="orb" style="width:500px;height:500px;background:radial-gradient(circle,rgba(232,30,140,0.35),transparent 70%);bottom:-150px;right:-100px;--dur:18s;--delay:-9s;--tx:-50px;--ty:-30px;--sc:1.2;"></div>
    <div class="orb" style="width:350px;height:350px;background:radial-gradient(circle,rgba(251,191,36,0.25),transparent 70%);top:40%;left:60%;--dur:25s;--delay:-5s;--tx:-40px;--ty:50px;"></div>
    <div class="orb" style="width:280px;height:280px;background:radial-gradient(circle,rgba(34,211,238,0.2),transparent 70%);top:25%;left:10%;--dur:20s;--delay:-12s;--tx:30px;--ty:-40px;"></div>
</div>
<div class="stars-layer" id="stars"></div>
<canvas id="confetti-canvas"></canvas>

{{-- Auto-playing Birthday Song --}}
<audio id="birthday-audio" autoplay loop preload="auto">
    <source src="{{ asset('audio/birthday-song.mp3') }}" type="audio/mpeg" />
    <source src="{{ asset('audio/birthday-song.ogg') }}" type="audio/ogg" />
</audio>

{{-- Song FAB (Now Playing) --}}
<div class="song-fab" id="song-fab" title="Now Playing">🎵</div>

{{-- Flash --}}
@if (session('success'))
<div class="flash-banner success" id="flash-banner">
    <div class="flash-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="flash-text"><strong>Wish Sent! 🎉</strong><span>{{ session('success') }}</span></div>
</div>
@endif
@if (session('error'))
<div class="flash-banner error" id="flash-banner">
    <div class="flash-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
    <div class="flash-text"><strong>Something went wrong</strong><span>{{ session('error') }}</span></div>
</div>
@endif

{{-- HERO --}}
<section class="hero">
    <img src="{{ asset('images/pfo.jpeg') }}" alt="Pastor Funke Oke" class="hero-bg-image" id="hero-img-1" loading="eager" decoding="async" onerror="this.style.display='none'" />
    <img src="" alt="Memory shared by a loved one" class="hero-bg-image-2" id="hero-img-2" style="display:none;" />

    @if(isset($mediaItems) && $mediaItems->where('mime_type', 'LIKE', 'image%')->count() > 0)
    <div class="hero-photo-badge" id="hero-photo-badge">
        <span class="dot"></span>
        <span id="hero-photo-credit">Shared by a loved one</span>
    </div>
    @endif

    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="hero-glow" aria-hidden="true"></div>
      <br/>
      <br/>
    <p class="hero-eyebrow">✦ A Golden Jubilee Celebration ✦</p>

    <div class="ornament" style="animation:fadeInUp 1s ease 0.1s both;">
        <div class="ornament-line"></div>
        <div class="ornament-diamond"></div>
        <div class="ornament-line"></div>
    </div>

    <h1 class="hero-fifty">50</h1>
    <h2 class="hero-name">Pastor Funke Oke</h2>

    <div class="ornament" style="animation:fadeInUp 1s ease 0.5s both;">
        <div class="ornament-line"></div>
        <div class="ornament-diamond"></div>
        <div class="ornament-line"></div>
    </div>

    <p class="hero-subtitle" style="animation:fadeInUp 1s ease 0.6s both;">
        Celebrating five glorious decades of grace, faith, and love.<br>
        <em style="color:rgba(251,191,36,0.8)">"The path of the righteous is like the morning sun."</em>
    </p>

    <div style="margin-top:2rem;">
        <span class="hero-date-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            26 May, 2026
        </span>
    </div>

    <div style="margin-top:3rem;">
        <a href="#wishes" class="hero-scroll-cta">
            Send Your Wishes
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14m0 0l-7-7m7 7l7-7"/></svg>
        </a>
    </div>
</section>

{{-- COUNTDOWN --}}
<section class="countdown-section">
    <p class="section-eyebrow reveal">⏳ Counting Down</p>
    <div class="countdown-grid reveal" id="countdown-grid">
        <div class="countdown-unit">
            <div class="countdown-card"><div class="countdown-number" id="cd-days">00</div></div>
            <span class="countdown-label">Days</span>
        </div>
        <span class="countdown-sep">:</span>
        <div class="countdown-unit">
            <div class="countdown-card"><div class="countdown-number" id="cd-hours">00</div></div>
            <span class="countdown-label">Hours</span>
        </div>
        <span class="countdown-sep">:</span>
        <div class="countdown-unit">
            <div class="countdown-card"><div class="countdown-number" id="cd-minutes">00</div></div>
            <span class="countdown-label">Minutes</span>
        </div>
        <span class="countdown-sep">:</span>
        <div class="countdown-unit">
            <div class="countdown-card"><div class="countdown-number" id="cd-seconds">00</div></div>
            <span class="countdown-label">Seconds</span>
        </div>
    </div>
</section>

{{-- MEMORIES - DYNAMIC VERSION --}}
<section class="memories-gallery" id="memories">
    <p class="section-eyebrow reveal" style="padding:0 1.5rem;">💝 Your Memories With Her</p>
    <h2 class="section-title reveal" style="padding:0 1.5rem;">Share a Moment</h2>
    <p class="section-sub reveal" style="padding:0 1.5rem;">Upload a photo or video you have with Pastor Funke and let it shine here</p>

    <div class="dissolve-gallery" style="max-width:700px;margin:2.5rem auto 0;padding:0 1.5rem;" id="dissolve-gallery"></div>
    <p style="text-align:center;margin-top:1rem;font-size:0.75rem;color:var(--muted);" id="dissolve-caption"></p>

    <div class="carousel-track-wrapper" style="margin-top:2rem;">
        <div class="carousel-track" id="carousel-track"></div>
    </div>
</section>

{{-- Upload Section --}}
<section class="upload-section" id="upload">
    <form method="POST" action="{{ route('media.upload') }}" enctype="multipart/form-data" id="upload-form">
        @csrf
        <div class="upload-zone" id="upload-zone"
             onclick="document.getElementById('media-input').click()"
             ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">

            <div class="upload-icon" id="upload-icon">📸</div>
            <h3 class="upload-title">Upload Your Memory</h3>
            <p class="upload-sub">Drop a photo or video here, or click to browse<br>
                <small style="font-size:0.75rem;">JPG, PNG, GIF, MP4, MOV · Max 50MB</small>
            </p>

            <input type="file" id="media-input" name="media_file" accept="image/*,video/*"
                   onchange="handleFileSelect(this)" />

            <div id="file-preview" style="display:none; margin-bottom:1.25rem;">
                <img id="preview-img" style="max-height:200px;border-radius:12px;margin-bottom:0.75rem;display:none;" />
                <video id="preview-vid" style="max-height:200px;border-radius:12px;margin-bottom:0.75rem;display:none;" controls></video>
                <p id="preview-name" style="font-size:0.8rem;color:var(--gold);font-weight:600;"></p>
            </div>

            <button type="button" class="upload-btn" onclick="event.stopPropagation(); document.getElementById('media-input').click()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Choose File
            </button>
        </div>

        <div style="margin-top:1.5rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem;" class="form-grid">
            <div class="field">
                <label for="uploader_name">Your Name <span style="color:#e87c7c">*</span></label>
                <input type="text" id="uploader_name" name="uploader_name" placeholder="Your full name"
                       value="{{ old('uploader_name') }}" maxlength="100" required />
            </div>
            <div class="field">
                <label for="uploader_caption">Caption (optional)</label>
                <input type="text" id="uploader_caption" name="caption" placeholder="A short note about this memory"
                       value="{{ old('caption') }}" maxlength="200" />
            </div>
        </div>

        <div style="margin-top:1.25rem;">
            <button type="submit" class="submit-btn" id="upload-submit-btn">
                💝 &nbsp; Share This Memory
            </button>
        </div>
    </form>
</section>

{{-- WISH FORM --}}
<section class="form-section" id="wishes">
    <div class="section-heading reveal">
        <h2>Leave Your Birthday Wishes</h2>
        <div class="ornament">
            <div class="ornament-line"></div>
            <div class="ornament-diamond"></div>
            <div class="ornament-line"></div>
        </div>
        <p>Your words will mean the world. Share a message of love, gratitude, and celebration.</p>
    </div>

    <div class="wish-form reveal">
        <form method="POST" action="{{ route('wishes.store') }}" id="wish-form">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label for="sender_name">Your Name <span style="color:#e87c7c">*</span></label>
                    <input type="text" id="sender_name" name="sender_name"
                           value="{{ old('sender_name') }}" placeholder="e.g. Adaeze Williams"
                           autocomplete="name" maxlength="100"
                           class="{{ $errors->has('sender_name') ? 'is-invalid' : '' }}" />
                    @error('sender_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="sender_email">Email <span style="color:var(--muted);font-weight:300;text-transform:none;letter-spacing:0;">(optional)</span></label>
                    <input type="email" id="sender_email" name="sender_email"
                           value="{{ old('sender_email') }}" placeholder="your@email.com"
                           autocomplete="email" maxlength="150"
                           class="{{ $errors->has('sender_email') ? 'is-invalid' : '' }}" />
                    @error('sender_email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field full">
                    <label for="relationship">Your Relationship to Pastor Funke <span style="color:#e87c7c">*</span></label>
                    <input type="text" id="relationship" name="relationship"
                           value="{{ old('relationship') }}" placeholder="e.g. Friend, Church Member, Family…"
                           maxlength="100"
                           class="{{ $errors->has('relationship') ? 'is-invalid' : '' }}" />
                    @error('relationship') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field full">
                    <label for="message">Your Birthday Message <span style="color:#e87c7c">*</span></label>
                    <textarea id="message" name="message" placeholder="Write your heartfelt birthday wishes here…"
                              maxlength="1000" class="{{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') }}</textarea>
                    <div class="char-count" id="char-count">{{ strlen(old('message', '')) }} / 1000</div>
                    @error('message') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-top:1.75rem;">
                <button type="submit" class="submit-btn">🎂 &nbsp; Send Birthday Wishes</button>
            </div>
        </form>
    </div>
</section>

{{-- FOOTER --}}
<footer class="site-footer">
    <div class="footer-hearts">🎂 ✨ 🎊</div>
    <div class="ornament" style="margin-bottom:1.5rem;">
        <div class="ornament-line"></div>
        <div class="ornament-diamond"></div>
        <div class="ornament-line"></div>
    </div>
    <p>With love &amp; gratitude &nbsp;·&nbsp; 26 May 2026 &nbsp;·&nbsp; A Celebration of Fifty Years</p>
    <p style="margin-top:0.5rem;font-size:0.8rem;opacity:0.45;">"For I know the plans I have for you" — Jeremiah 29:11</p>
</footer>

<script>
/* ── Stars ── */
(function(){
    const c=document.getElementById('stars');
    const COLORS=['#fde68a','#f472b6','#c084fc','#22d3ee','#ffffff'];
    for(let i=0;i<200;i++){
        const s=document.createElement('span'); s.className='star';
        const sz=Math.random()*2.8+0.4;
        s.style.cssText=`left:${Math.random()*100}%;top:${Math.random()*100}%;
            width:${sz}px;height:${sz}px;
            background:${COLORS[Math.floor(Math.random()*COLORS.length)]};
            --dur:${(Math.random()*5+2).toFixed(1)}s;
            --delay:${(Math.random()*7).toFixed(1)}s;
            --bright:${(Math.random()*0.7+0.3).toFixed(2)};`;
        c.appendChild(s);
    }
})();

/* ── Hero photo crossfade ── */
(function(){
    const uploaded = [
        @if(isset($mediaItems) && $mediaItems->count() > 0)
            @foreach($mediaItems->where('mime_type', 'LIKE', 'image%') as $item)
            { url: "{{ asset('storage/'.$item->path) }}", credit: "{{ addslashes($item->uploader_name) }}" },
            @endforeach
        @endif
    ].filter(Boolean);

    if (!uploaded.length) return;

    const img1 = document.getElementById('hero-img-1');
    const img2 = document.getElementById('hero-img-2');
    const badge = document.getElementById('hero-photo-badge');
    const credit = document.getElementById('hero-photo-credit');

    uploaded.forEach(u => { const i = new Image(); i.src = u.url; });

    const pool = [{ url: img1.src, credit: null }, ...uploaded];
    let idx = 0;

    function crossfade() {
        idx = (idx + 1) % pool.length;
        const next = pool[idx];
        if (next.credit) {
            img2.src = next.url;
            img2.style.display = 'block';
            img2.style.opacity = '1';
            img1.style.opacity = '0';
            if (badge) badge.style.opacity = '1';
            if (credit) credit.textContent = 'Shared by ' + next.credit;
        } else {
            img1.style.opacity = '1';
            img2.style.opacity = '0';
            if (badge) badge.style.opacity = '0';
        }
    }
    setInterval(crossfade, 7000);
})();

/* ── Countdown ── */
(function(){
    const BD = new Date('2026-05-26T00:00:00').getTime();
    function pad(n){return String(n).padStart(2,'0');}
    function tick(){
        const d = BD - Date.now();
        if(d <= 0){
            document.getElementById('countdown-grid').innerHTML = '<p class="birthday-arrived">🎉 Happy Birthday, Pastor Funke! 🎉</p>';
            return;
        }
        document.getElementById('cd-days').textContent = pad(Math.floor(d/86400000));
        document.getElementById('cd-hours').textContent = pad(Math.floor((d%86400000)/3600000));
        document.getElementById('cd-minutes').textContent = pad(Math.floor((d%3600000)/60000));
        document.getElementById('cd-seconds').textContent = pad(Math.floor((d%60000)/1000));
    }
    tick(); setInterval(tick,1000);
})();

/* Auto Play Song on Load */
const audio = document.getElementById('birthday-audio');
function startSong() {
    audio.volume = 0.6;
    audio.play().catch(() => {
        document.body.addEventListener('click', () => audio.play(), { once: true });
    });
}
window.addEventListener('load', startSong);

/* Scroll Reveal */
(function(){
    const obs = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), {threshold:0.12});
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
})();

/* Char counter */
const msgEl = document.getElementById('message');
const ccEl = document.getElementById('char-count');
if(msgEl) msgEl.addEventListener('input', function(){
    const l = this.value.length;
    ccEl.textContent = `${l} / 1000`;
    ccEl.className = 'char-count' + (l>900?' danger':l>750?' warning':'');
});

/* Flash Banner */
(function(){
    const b = document.getElementById('flash-banner');
    if(!b) return;
    requestAnimationFrame(() => requestAnimationFrame(() => b.classList.add('show')));
    setTimeout(() => b.classList.remove('show'), 5500);
    if(b.classList.contains('success')) launchConfetti();
})();

function launchConfetti(){ /* Confetti function can be added later if needed */ }

/* ==================== DYNAMIC GALLERY ==================== */
let mediaItems = @json($mediaItems ?? []);

function renderGalleries() {
    const dissolve = document.getElementById('dissolve-gallery');
    const carousel = document.getElementById('carousel-track');
    dissolve.innerHTML = '';
    carousel.innerHTML = '';

    if (mediaItems.length === 0) {
        dissolve.innerHTML = `
            <div class="dissolve-slide active">
                <div class="dissolve-placeholder">
                    <div class="big-emoji">📷</div>
                    <p>Be the first to share a memory!</p>
                </div>
            </div>`;
        return;
    }

    mediaItems.forEach((item, i) => {
        // Dissolve Slide
        const slide = document.createElement('div');
        slide.className = `dissolve-slide ${i === 0 ? 'active' : ''}`;
        slide.innerHTML = (item.mime_type && item.mime_type.startsWith('video'))
            ? `<video src="${item.url}" muted autoplay loop playsinline></video>`
            : `<img src="${item.url}" alt="${item.uploader_name}" loading="lazy" onerror="this.src='https://via.placeholder.com/700x400?text=Image+Not+Found'" />`;
        dissolve.appendChild(slide);

        // Carousel Slide
        const mem = document.createElement('div');
        mem.className = 'memory-slide';
        mem.innerHTML = `
            ${(item.mime_type && item.mime_type.startsWith('video'))
                ? `<video src="${item.url}" muted autoplay loop playsinline></video>`
                : `<img src="${item.url}" alt="${item.uploader_name}" loading="lazy" onerror="this.src='https://via.placeholder.com/280x210?text=Image+Not+Found'" />`}
            <div class="memory-slide-overlay">
                <div class="memory-slide-name">${item.uploader_name}</div>
            </div>
        `;
        carousel.appendChild(mem);
    });
}

// Initial render
renderGalleries();

/* AJAX Upload Handler */
document.getElementById('upload-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('upload-submit-btn');
    const originalText = btn.innerHTML;
    btn.innerHTML = 'Uploading...';
    btn.disabled = true;

    const formData = new FormData(this);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try {
        const res = await fetch("{{ route('media.upload') }}", { method: 'POST', body: formData });
        const data = await res.json();

        if (res.ok && data.success) {
            mediaItems.unshift({
                url: data.media.url,
                mime_type: data.media.mime_type,
                uploader_name: data.media.uploader_name
            });
            renderGalleries();

            this.reset();
            document.getElementById('file-preview').style.display = 'none';
            showFlash(data.message || 'Memory shared successfully!', 'success');
        } else {
            showFlash(data.message || 'Upload failed', 'error');
        }
    } catch (err) {
        showFlash('Network error. Please try again.', 'error');
    }

    btn.innerHTML = originalText;
    btn.disabled = false;
});

function showFlash(message, type = 'success') {
    let banner = document.getElementById('flash-banner');
    if (!banner) {
        banner = document.createElement('div');
        banner.id = 'flash-banner';
        banner.className = `flash-banner ${type}`;
        document.body.appendChild(banner);
    }
    banner.innerHTML = `
        <div class="flash-icon">${type === 'success' ? '✓' : '✕'}</div>
        <div class="flash-text"><strong>${type === 'success' ? 'Success!' : 'Error'}</strong><span>${message}</span></div>
    `;
    banner.classList.add('show');
    setTimeout(() => banner.classList.remove('show'), 5500);
}

/* Upload Preview Handlers */
function handleDragOver(e){e.preventDefault();document.getElementById('upload-zone').classList.add('drag-over');}
function handleDragLeave(){document.getElementById('upload-zone').classList.remove('drag-over');}
function handleDrop(e){
    e.preventDefault();document.getElementById('upload-zone').classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if(file){ document.getElementById('media-input').files = e.dataTransfer.files; showPreview(file); }
}
function handleFileSelect(input){ if(input.files[0]) showPreview(input.files[0]); }
function showPreview(file){
    const icon = document.getElementById('upload-icon');
    const preview = document.getElementById('file-preview');
    const pImg = document.getElementById('preview-img');
    const pVid = document.getElementById('preview-vid');
    const pName = document.getElementById('preview-name');
    const url = URL.createObjectURL(file);
    preview.style.display = 'block';
    pName.textContent = file.name + ' (' + Math.round(file.size/1024/1024*10)/10 + ' MB)';
    if(file.type.startsWith('video')){
        pVid.src = url; pVid.style.display = 'block'; pImg.style.display = 'none'; icon.textContent = '🎬';
    } else {
        pImg.src = url; pImg.style.display = 'block'; pVid.style.display = 'none'; icon.textContent = '🖼️';
    }
}

/* Scroll to first error */
(function(){
    const e = document.querySelector('.is-invalid');
    if(e) setTimeout(() => e.scrollIntoView({behavior:'smooth', block:'center'}), 300);
})();
</script>
</body>
</html>
