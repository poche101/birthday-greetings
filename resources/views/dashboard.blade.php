<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard — Birthday Wishes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dancing+Script:wght@700&family=Jost:wght@300;400;500;600;700&family=Yeseva+One&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        /* ============================================================
           Tokens
        ============================================================ */
        :root {
            --bg:           #07001a;
            --bg2:          #0d0022;
            --sidebar-bg:   #0a0020;
            --sidebar-w:    270px;
            --purple:       #6e28d9;
            --purple-mid:   #9747ff;
            --purple-light: #c084fc;
            --pink:         #f472b6;
            --pink-hot:     #e91e8c;
            --gold:         #fbbf24;
            --gold-bright:  #fde68a;
            --cyan:         #22d3ee;
            --cream:        #fdf4ff;
            --muted:        #9880c0;
            --body-text:    #c4b8e8;
            --card-bg:      rgba(255,255,255,0.04);
            --border:       rgba(151,71,255,0.18);
            --border-hover: rgba(251,191,36,0.4);
            --danger:       #e87c7c;
            --success:      #34c759;
        }

        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

        body {
            font-family: 'Jost', sans-serif;
            background: var(--bg);
            color: var(--cream);
            min-height: 100vh;
            display: flex;
        }

        /* Noise grain */
        body::before {
            content:''; position:fixed; inset:0;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events:none; z-index:1000; opacity:0.3;
        }

        /* BG Orbs */
        .bg-orbs { position:fixed; inset:0; pointer-events:none; z-index:0; overflow:hidden; }
        .orb {
            position:absolute; border-radius:50%; filter:blur(80px);
            animation:orbFloat var(--dur,20s) ease-in-out infinite alternate var(--delay,0s);
        }
        @keyframes orbFloat {
            from { transform:translate(0,0); }
            to   { transform:translate(var(--tx,40px),var(--ty,30px)); }
        }

        a { text-decoration:none; color:inherit; }
        button { cursor:pointer; font-family:inherit; }

        /* ============================================================
           Sidebar
        ============================================================ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top:0; left:0; bottom:0;
            z-index: 100;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.75rem 1.5rem 1.25rem;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, rgba(110,40,217,0.12), transparent);
        }

        .sidebar-eyebrow {
            font-size: 0.6rem; font-weight: 700;
            letter-spacing: 0.35em; text-transform: uppercase;
            color: var(--pink); margin-bottom: 0.4rem;
            text-shadow: 0 0 12px rgba(244,114,182,0.6);
        }

        .sidebar-title {
            font-family: 'Dancing Script', cursive;
            font-size: 1.45rem; font-weight: 700;
            background: linear-gradient(135deg, var(--gold-bright), var(--pink));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
            line-height: 1.3;
        }

        .sidebar-sub {
            font-size: 0.7rem; color: var(--muted);
            margin-top: 0.2rem; font-weight: 400;
        }

        /* ── Stats Grid ── */
        .sidebar-stats {
            padding: 1.25rem;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .stat-pill {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px; padding: 1rem 0.75rem;
            text-align: center;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative; overflow: hidden;
        }

        .stat-pill::before {
            content:''; position:absolute; top:0; left:0; right:0; height:2px;
            background:linear-gradient(90deg, transparent, var(--purple-mid), transparent);
            opacity:0; transition:opacity 0.2s;
        }

        .stat-pill:hover { border-color: var(--border-hover); }
        .stat-pill:hover::before { opacity:1; }

        .stat-value {
            font-family: 'Abril Fatface', serif;
            font-size: 2rem; line-height: 1;
            background: linear-gradient(180deg, var(--gold-bright), var(--gold));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }

        .stat-label {
            font-size: 0.58rem; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--muted); margin-top: 0.3rem;
        }

        .stat-pill.pink .stat-value { background:linear-gradient(180deg, #fde4f6, var(--pink)); -webkit-background-clip:text; background-clip:text; }
        .stat-pill.cyan  .stat-value { background:linear-gradient(180deg, #cffafe, var(--cyan));  -webkit-background-clip:text; background-clip:text; }
        .stat-pill.purple .stat-value{ background:linear-gradient(180deg, #ede9fe, var(--purple-mid)); -webkit-background-clip:text; background-clip:text; }

        /* ── Nav ── */
        .divider { height:1px; background:linear-gradient(90deg,transparent,var(--border),transparent); margin:0; }

        .sidebar-nav { padding: 0.75rem; flex:1; }

        .nav-section-label {
            font-size: 0.55rem; font-weight: 800;
            letter-spacing: 0.3em; text-transform: uppercase;
            color: var(--muted); padding: 0.75rem 0.75rem 0.4rem;
        }

        .nav-link {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.7rem 0.85rem;
            border-radius: 12px;
            font-size: 0.78rem; font-weight: 500;
            color: var(--body-text);
            transition: background 0.15s, color 0.15s, transform 0.15s;
            margin-bottom: 0.2rem;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: rgba(151,71,255,0.1);
            color: var(--purple-light);
            transform: translateX(3px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(110,40,217,0.25), rgba(232,30,140,0.1));
            border-color: rgba(151,71,255,0.3);
            color: var(--gold-bright);
        }

        .nav-link svg { flex-shrink:0; opacity:0.75; }
        .nav-link.active svg { opacity:1; }

        .nav-count {
            margin-left:auto;
            background: rgba(251,191,36,0.15);
            color: var(--gold);
            font-size:0.6rem; font-weight:800;
            padding:0.15rem 0.5rem; border-radius:20px;
        }

        .nav-link.active .nav-count { background:rgba(251,191,36,0.25); }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            display: flex; align-items: center; gap: 0.6rem;
            width: 100%; padding: 0.75rem 1rem;
            background: rgba(232,124,124,0.06);
            border: 1px solid rgba(232,124,124,0.2);
            border-radius: 12px;
            color: var(--danger); font-size: 0.75rem; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase;
            transition: background 0.15s, border-color 0.15s;
        }

        .logout-btn:hover { background:rgba(232,124,124,0.14); border-color:rgba(232,124,124,0.4); }

        /* ============================================================
           Main
        ============================================================ */
        .main {
            margin-left: var(--sidebar-w);
            flex:1; display:flex; flex-direction:column; min-height:100vh;
        }

        /* Topbar */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid var(--border);
            background: rgba(13,0,34,0.7);
            backdrop-filter: blur(12px);
            position: sticky; top:0; z-index:50; gap:1rem;
        }

        .topbar-title {
            font-family: 'Yeseva One', serif;
            font-size: 1.4rem;
            background: linear-gradient(135deg, var(--gold-bright), var(--pink));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }

        .topbar-sub {
            font-size: 0.8rem; color: var(--muted); margin-top: 0.1rem;
        }

        .filter-pills { display:flex; gap:0.4rem; flex-wrap:wrap; }

        .filter-pill {
            display:inline-flex; align-items:center; gap:0.35rem;
            padding:0.4rem 1rem;
            border-radius:100px; font-size:0.68rem; font-weight:700;
            letter-spacing:0.06em; text-transform:uppercase;
            border:1px solid var(--border); color:var(--muted);
            background:transparent; transition:all 0.2s;
        }

        .filter-pill:hover { border-color:var(--purple-mid); color:var(--purple-light); }
        .filter-pill.active {
            background: linear-gradient(135deg, rgba(110,40,217,0.2), rgba(232,30,140,0.1));
            border-color: rgba(151,71,255,0.4);
            color: var(--gold-bright);
        }

        /* ── Content ── */
        .content { flex:1; padding:2rem; position:relative; z-index:1; }

        /* Flash */
        .flash {
            display:flex; align-items:center; gap:0.75rem;
            padding:0.9rem 1.2rem; border-radius:14px; margin-bottom:2rem;
            font-size:0.78rem; font-weight:600;
            animation:slideDown 0.4s ease both;
        }
        @keyframes slideDown { from{opacity:0;transform:translateY(-12px);} to{opacity:1;transform:translateY(0);} }
        .flash.success { background:rgba(52,199,89,0.08); border:1px solid rgba(52,199,89,0.3); color:var(--success); }
        .flash.error   { background:rgba(232,124,124,0.08); border:1px solid rgba(232,124,124,0.3); color:var(--danger); }

        /* Empty state */
        .empty-state {
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            gap:1rem; padding:6rem 2rem; text-align:center;
        }
        .empty-state h3 { font-family:'Yeseva One',serif; font-size:1.5rem; color:var(--purple-light); }
        .empty-state p  { color:var(--muted); font-size:1rem; font-weight:300; }

        /* ============================================================
           Cards Grid
        ============================================================ */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 1.5rem;
        }

        /* ── Wish Card ── */
        .wish-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px; padding: 1.5rem;
            display: flex; flex-direction: column; gap: 1rem;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
            position: relative; overflow: hidden;
        }

        .wish-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:2px;
            background: linear-gradient(90deg, transparent, rgba(151,71,255,0.5), transparent);
            opacity:0; transition:opacity 0.25s;
        }

        .wish-card:hover {
            border-color: rgba(151,71,255,0.35);
            box-shadow: 0 20px 60px rgba(110,40,217,0.25);
            transform: translateY(-3px);
        }

        .wish-card:hover::before { opacity:1; }

        .wish-card.is-featured {
            background: linear-gradient(160deg, rgba(251,191,36,0.05) 0%, var(--card-bg) 55%);
            border-color: rgba(251,191,36,0.35);
        }

        .wish-card.is-featured::before {
            opacity:1;
            background:linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        /* Card Header */
        .card-header { display:flex; align-items:flex-start; gap:0.9rem; }

        .card-avatar {
            width: 46px; height: 46px; border-radius: 50%; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            font-family:'Yeseva One',serif; font-size:1.1rem;
            background: linear-gradient(135deg, rgba(110,40,217,0.4), rgba(232,30,140,0.3));
            border: 1px solid rgba(151,71,255,0.35);
            color: var(--gold-bright);
        }

        .card-meta { flex:1; min-width:0; }

        .card-name {
            font-family:'Yeseva One',serif; font-size:1rem;
            color:var(--cream); white-space:nowrap;
            overflow:hidden; text-overflow:ellipsis; line-height:1.3;
        }

        .card-email { font-size:0.67rem; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:0.15rem; }

        /* Relationship badges */
        .relationship-badge {
            display:inline-flex; align-items:center; gap:0.3rem;
            padding:0.22rem 0.7rem; border-radius:100px;
            font-size:0.58rem; font-weight:800; letter-spacing:0.1em; text-transform:uppercase;
            flex-shrink:0; margin-top:0.1rem;
        }

        .badge-family       { background:rgba(168,120,255,0.15); color:#c084fc; }
        .badge-friend       { background:rgba(52,199,89,0.12);   color:#34c759; }
        .badge-colleague    { background:rgba(34,211,238,0.12);  color:#22d3ee; }
        .badge-church_member{ background:rgba(251,191,36,0.12);  color:var(--gold); }
        .badge-well_wisher  { background:rgba(244,114,182,0.12); color:var(--pink); }

        /* Message */
        .card-message {
            font-size:1rem; font-weight:300;
            color:var(--body-text); line-height:1.8;
            display:-webkit-box; -webkit-line-clamp:5; -webkit-box-orient:vertical; overflow:hidden; flex:1;
        }
        .card-message.expanded { display:block; -webkit-line-clamp:unset; }

        .read-more-btn {
            font-size:0.65rem; font-weight:700; color:var(--purple-light);
            background:none; border:none; padding:0; letter-spacing:0.06em;
            cursor:pointer; margin-top:0.25rem; transition:color 0.15s;
        }
        .read-more-btn:hover { color:var(--pink); }

        /* Card Footer */
        .card-footer {
            display:flex; align-items:center; justify-content:space-between;
            padding-top:0.75rem;
            border-top:1px solid rgba(255,255,255,0.05); gap:0.5rem;
        }

        .card-date { display:flex; align-items:center; gap:0.4rem; font-size:0.63rem; color:var(--muted); }

        .card-actions { display:flex; align-items:center; gap:0.4rem; }

        .action-btn {
            display:inline-flex; align-items:center; justify-content:center;
            width:32px; height:32px; border-radius:10px;
            border:1px solid transparent; background:transparent;
            color:var(--muted); transition:all 0.15s;
        }
        .action-btn:hover { border-color:var(--border-hover); color:var(--cream); background:rgba(255,255,255,0.05); }

        .action-btn.feature-on { color:var(--gold); border-color:rgba(251,191,36,0.35); background:rgba(251,191,36,0.08); }
        .action-btn.delete-btn { color:var(--danger); border-color:rgba(232,124,124,0.25); }
        .action-btn.delete-btn:hover { background:rgba(232,124,124,0.1); border-color:rgba(232,124,124,0.5); }

        .featured-label {
            font-size:0.58rem; font-weight:800; letter-spacing:0.15em; text-transform:uppercase;
            color:var(--gold);
            display:flex; align-items:center; gap:0.3rem;
        }

        /* ============================================================
           Pagination
        ============================================================ */
        .pagination-wrap { margin-top:2.5rem; display:flex; justify-content:center; }
        .pagination-wrap nav { display:flex; align-items:center; gap:0.4rem; }
        .pagination-wrap nav a,
        .pagination-wrap nav span {
            display:inline-flex; align-items:center; justify-content:center;
            min-width:38px; height:38px; padding:0 0.65rem;
            border-radius:10px; font-size:0.75rem; font-weight:700;
            border:1px solid var(--border); color:var(--muted);
            background:transparent; transition:all 0.15s;
        }
        .pagination-wrap nav a:hover { border-color:var(--purple-mid); color:var(--purple-light); background:rgba(151,71,255,0.08); }
        .pagination-wrap nav span[aria-current="page"] {
            background:linear-gradient(135deg, rgba(110,40,217,0.25), rgba(232,30,140,0.1));
            border-color:rgba(151,71,255,0.45); color:var(--gold-bright);
        }

        /* ============================================================
           Responsive
        ============================================================ */
        @media (max-width:900px){
            .sidebar { transform:translateX(-100%); }
            .sidebar.open { transform:translateX(0); }
            .main { margin-left:0; }
            .cards-grid { grid-template-columns:1fr; }
            .topbar { padding:1rem 1.25rem; }
            .content { padding:1.25rem; }
        }

        .menu-toggle {
            display:none; background:none;
            border:1px solid var(--border); color:var(--cream);
            padding:0.45rem; border-radius:10px;
            align-items:center; justify-content:center;
        }
        @media (max-width:900px){ .menu-toggle { display:flex; } }

        .delete-form { display:inline; }
    </style>
</head>
<body>

<div class="bg-orbs">
    <div class="orb" style="width:500px;height:500px;background:radial-gradient(circle,rgba(110,40,217,0.3),transparent 70%);top:-200px;left:-100px;--dur:20s;--tx:50px;--ty:30px;opacity:0.5;"></div>
    <div class="orb" style="width:400px;height:400px;background:radial-gradient(circle,rgba(232,30,140,0.2),transparent 70%);bottom:-150px;right:100px;--dur:17s;--delay:-8s;--tx:-40px;--ty:-20px;opacity:0.4;"></div>
</div>

{{-- ================================================================
     SIDEBAR
================================================================ --}}
<aside class="sidebar" id="sidebar">

    <div class="sidebar-header">
        <p class="sidebar-eyebrow">✦ Admin Panel</p>
        <div class="sidebar-title">Pastor Funke's<br>50th Birthday</div>
        <div class="sidebar-sub">Wishes Dashboard</div>
    </div>

    <div class="sidebar-stats">
        <div class="stat-pill">
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-pill pink">
            <div class="stat-value">{{ $stats['pending'] }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-pill">
            <div class="stat-value">{{ $stats['featured'] }}</div>
            <div class="stat-label">Featured</div>
        </div>
        <div class="stat-pill cyan">
            <div class="stat-value">{{ $stats['approved'] }}</div>
            <div class="stat-label">Approved</div>
        </div>
    </div>

    <div class="divider"></div>

    <nav class="sidebar-nav">
        <p class="nav-section-label">Filters</p>

        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $filter==='all'?'active':'' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            All Wishes
            <span class="nav-count">{{ $stats['total'] }}</span>
        </a>

        <a href="{{ route('admin.dashboard',['filter'=>'pending']) }}" class="nav-link {{ $filter==='pending'?'active':'' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Pending Review
            <span class="nav-count">{{ $stats['pending'] }}</span>
        </a>

        <a href="{{ route('admin.dashboard',['filter'=>'featured']) }}" class="nav-link {{ $filter==='featured'?'active':'' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            Featured
            <span class="nav-count">{{ $stats['featured'] }}</span>
        </a>

        <a href="{{ route('admin.dashboard',['filter'=>'approved']) }}" class="nav-link {{ $filter==='approved'?'active':'' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            Approved
            <span class="nav-count">{{ $stats['approved'] }}</span>
        </a>

        <p class="nav-section-label" style="margin-top:0.5rem;">Quick Links</p>

        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Birthday Page
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:auto;opacity:0.4"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Sign Out
            </button>
        </form>
    </div>
</aside>

{{-- ================================================================
     MAIN
================================================================ --}}
<div class="main">

    <header class="topbar">
        <div style="display:flex;align-items:center;gap:0.75rem;">
            <button class="menu-toggle" id="menu-toggle" aria-label="Toggle menu">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <div>
                <div class="topbar-title">Birthday Wishes 🎂</div>
                <div class="topbar-sub">
                    {{ $wishes->total() }} message{{ $wishes->total()!==1?'s':'' }} received
                    @if($filter!=='all') · <span style="color:var(--gold-bright)">{{ ucfirst(str_replace('_',' ',$filter)) }}</span>@endif
                </div>
            </div>
        </div>

        <div class="filter-pills">
            <a href="{{ route('admin.dashboard') }}" class="filter-pill {{ $filter==='all'?'active':'' }}">All</a>
            <a href="{{ route('admin.dashboard',['filter'=>'pending']) }}" class="filter-pill {{ $filter==='pending'?'active':'' }}">Pending</a>
            <a href="{{ route('admin.dashboard',['filter'=>'featured']) }}" class="filter-pill {{ $filter==='featured'?'active':'' }}">Featured</a>
            <a href="{{ route('admin.dashboard',['filter'=>'approved']) }}" class="filter-pill {{ $filter==='approved'?'active':'' }}">Approved</a>
        </div>
    </header>

    <div class="content">

        @if(session('success'))
        <div class="flash success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="flash error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ session('error') }}
        </div>
        @endif

        @if($wishes->isEmpty())
        <div class="empty-state">
            <div style="font-size:3.5rem;">💌</div>
            <h3>No wishes yet</h3>
            <p>Birthday messages will appear here as they're submitted.</p>
        </div>

        @else
        <div class="cards-grid">
            @foreach($wishes as $wish)
            @php
                $words    = explode(' ', trim($wish->sender_name));
                $initials = implode('', array_map(fn($w)=>strtoupper(substr($w,0,1)), array_slice($words,0,2)));
                $labels   = ['family'=>'Family','friend'=>'Friend','colleague'=>'Colleague','church_member'=>'Church Member','well_wisher'=>'Well-Wisher'];
            @endphp

            <article class="wish-card {{ $wish->is_featured ? 'is-featured' : '' }}">

                <div class="card-header">
                    <div class="card-avatar">{{ $initials }}</div>
                    <div class="card-meta">
                        <div class="card-name" title="{{ $wish->sender_name }}">{{ $wish->sender_name }}</div>
                        @if($wish->sender_email)
                        <div class="card-email">{{ $wish->sender_email }}</div>
                        @endif
                    </div>
                    <span class="relationship-badge badge-{{ $wish->relationship }}">
                        {{ $labels[$wish->relationship] ?? $wish->relationship }}
                    </span>
                </div>

                <p class="card-message" id="msg-{{ $wish->id }}">{{ $wish->message }}</p>
                @if(strlen($wish->message)>280)
                <button class="read-more-btn" onclick="toggleMessage({{ $wish->id }},this)">Read more →</button>
                @endif

                <div class="card-footer">
                    <div class="card-date">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $wish->created_at->format('d M Y · g:i A') }}
                    </div>

                    <div class="card-actions">
                        @if($wish->is_featured)
                        <span class="featured-label">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            Featured
                        </span>
                        @endif

                        <form method="POST" action="{{ route('admin.wishes.feature',$wish) }}" class="delete-form">
                            @csrf @method('PATCH')
                            <button type="submit" class="action-btn {{ $wish->is_featured?'feature-on':'' }}"
                                title="{{ $wish->is_featured?'Remove from Featured':'Mark as Featured' }}">
                                <svg width="13" height="13" viewBox="0 0 24 24"
                                     fill="{{ $wish->is_featured?'currentColor':'none' }}" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.wishes.destroy',$wish) }}" class="delete-form"
                              onsubmit="return confirm('Delete this wish from {{ addslashes($wish->sender_name) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" title="Delete wish">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                    <path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        @if($wishes->hasPages())
        <div class="pagination-wrap">{{ $wishes->links() }}</div>
        @endif
        @endif

    </div>
</div>

<script>
const sidebar    = document.getElementById('sidebar');
const menuToggle = document.getElementById('menu-toggle');
menuToggle.addEventListener('click', ()=>sidebar.classList.toggle('open'));
document.addEventListener('click', e=>{
    if(!sidebar.contains(e.target) && !menuToggle.contains(e.target)) sidebar.classList.remove('open');
});

function toggleMessage(id,btn){
    const el=document.getElementById('msg-'+id);
    const exp=el.classList.toggle('expanded');
    btn.textContent=exp?'← Read less':'Read more →';
}

document.querySelectorAll('.flash').forEach(el=>{
    setTimeout(()=>{
        el.style.transition='opacity 0.4s'; el.style.opacity='0';
        setTimeout(()=>el.remove(),400);
    },5000);
});
</script>
</body>
</html>
