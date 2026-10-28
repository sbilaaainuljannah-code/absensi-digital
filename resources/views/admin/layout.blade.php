<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>{{ $title ?? 'Admin' }} · Absensi Digital</title>

<!-- FONT AESTHETIC -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

:root{
    --bg:#050c18;
    --bg2:#081426;
    --panel:#0b182a;
    --panel2:#0f2035;

    --line:#193653;
    --line2:#214966;

    --text:#edf7ff;
    --muted:#8da6bc;

    --blue:#69c5ff;
    --blue2:#397fdb;
    --cyan:#82e3ff;

    --green:#68d5a1;
    --gold:#dec47e;
    --red:#e08c9d;
    --purple:#9c9cf4;

    --shadow:0 24px 70px rgba(0,0,0,.24);
}


/* =========================
   GLOBAL
========================= */

*{
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    margin:0;

    background:
        radial-gradient(
            circle at 90% 0,
            rgba(73,163,235,.13),
            transparent 25%
        ),
        radial-gradient(
            circle at 10% 100%,
            rgba(117,104,220,.08),
            transparent 28%
        ),
        var(--bg);

    color:var(--text);

    font-family:'Outfit',sans-serif;

    font-weight:400;

    letter-spacing:.01em;
}

a{
    text-decoration:none;
    color:inherit;
}

button,
input,
select,
textarea{
    font-family:'Outfit',sans-serif;
}

button{
    font-weight:400;
}

.app{
    min-height:100vh;
}


/* =========================
   SIDEBAR
========================= */

.sidebar{
    position:fixed;

    inset:0 auto 0 0;

    width:254px;

    padding:22px 14px;

    background:
        linear-gradient(
            180deg,
            #071323,
            #050d18 75%
        );

    border-right:1px solid #17324c;

    z-index:30;

    box-shadow:
        18px 0 60px rgba(0,0,0,.18);

    overflow:auto;
}


/* BRAND */

.brand{
    display:flex;

    align-items:center;

    gap:12px;

    padding:3px 10px 25px;
}

.brand-mark{
    width:45px;
    height:45px;

    border-radius:15px;

    display:grid;

    place-items:center;

    background:
        linear-gradient(
            145deg,
            #8bdcff,
            #397fdc
        );

    color:#04101e;

    font-family:'Outfit',sans-serif;

    font-size:20px;

    font-weight:500;

    box-shadow:
        0 0 30px rgba(75,169,237,.18);
}

.brand-name{
    font-family:'Outfit',sans-serif;

    font-size:17px;

    font-weight:500;

    letter-spacing:.2px;
}

.brand-sub{
    font-size:9px;

    color:#607b94;

    letter-spacing:1.4px;

    margin-top:3px;
}


/* MENU TITLE */

.menu-title{
    margin:12px 12px 8px;

    color:#55718a;

    font-size:9px;

    letter-spacing:1.7px;

    text-transform:uppercase;

    font-weight:400;
}


/* MENU */

.menu{
    display:flex;

    flex-direction:column;

    gap:4px;
}

.menu a{
    display:flex;

    align-items:center;

    gap:11px;

    padding:11px 12px;

    border:1px solid transparent;

    border-radius:12px;

    color:#8299ad;

    font-size:12px;

    font-weight:400;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease,
        border .2s ease;
}

.menu a:hover{
    color:#e5f5ff;

    background:
        rgba(72,149,212,.09);

    transform:translateX(2px);
}

.menu a.active{
    color:#e8f7ff;

    background:
        linear-gradient(
            90deg,
            rgba(67,147,215,.23),
            rgba(30,74,115,.10)
        );

    border-color:#24547a;

    box-shadow:
        inset 3px 0 0 #67c4ff;
}

.ico{
    width:22px;

    text-align:center;

    color:#72c8ff;

    font-size:15px;

    font-weight:400;
}


/* LOGOUT */

.logout{
    margin:24px 0 5px;
}

.logout button{
    width:100%;

    background:
        rgba(213,105,126,.04);

    border:1px solid #3c2931;

    border-radius:11px;

    color:#dba0ad;

    text-align:left;

    padding:11px 12px;

    cursor:pointer;

    font-size:12px;

    transition:.2s;
}

.logout button:hover{
    background:
        rgba(213,105,126,.08);
}


/* =========================
   MAIN
========================= */

.main{
    margin-left:254px;

    min-height:100vh;
}


/* TOPBAR */

.topbar{
    height:74px;

    position:sticky;

    top:0;

    z-index:20;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 34px;

    background:
        rgba(5,13,24,.78);

    backdrop-filter:blur(16px);

    border-bottom:
        1px solid rgba(28,58,84,.8);
}

.top-title{
    font-family:'Outfit',sans-serif;

    font-size:17px;

    font-weight:400;

    letter-spacing:.1px;
}

.top-sub{
    font-size:10px;

    color:#66839b;

    margin-top:2px;

    font-weight:300;
}


/* ADMIN */

.admin{
    display:flex;

    align-items:center;

    gap:10px;
}

.avatar{
    width:39px;

    height:39px;

    border-radius:50%;

    display:grid;

    place-items:center;

    background:
        linear-gradient(
            145deg,
            #d9f0ff,
            #6dbdff
        );

    color:#07182b;

    font-weight:500;
}

.admin strong{
    display:block;

    font-size:11px;

    font-weight:500;
}

.admin small{
    display:block;

    color:#698299;

    font-size:9px;

    margin-top:2px;

    font-weight:300;
}


/* =========================
   CONTENT
========================= */

.content{
    padding:34px;

    max-width:1500px;

    margin:auto;
}

.page-head{
    display:flex;

    justify-content:space-between;

    align-items:end;

    gap:20px;

    margin-bottom:24px;
}

.eyebrow{
    font-size:9px;

    letter-spacing:1.7px;

    text-transform:uppercase;

    color:#6689a5;

    margin-bottom:7px;

    font-weight:400;
}

.page-head h1{
    font-family:'Outfit',sans-serif;

    font-size:30px;

    font-weight:400;

    margin:0 0 5px;

    letter-spacing:-.5px;
}

.page-head p{
    margin:0;

    color:#8ba3b8;

    font-size:12px;

    font-weight:300;
}


/* =========================
   BUTTON
========================= */

.btn{
    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:7px;

    border:1px solid #2d6590;

    border-radius:11px;

    padding:11px 15px;

    background:
        linear-gradient(
            145deg,
            #74ccff,
            #397fd9
        );

    color:#061321;

    font-weight:500;

    font-size:11px;

    cursor:pointer;

    box-shadow:
        0 12px 28px rgba(50,132,207,.14);

    transition:.2s;
}

.btn:hover{
    transform:translateY(-1px);
}

.btn.ghost{
    background:#10243a;

    color:#bfe4fb;

    border-color:#214a69;

    box-shadow:none;
}

.btn.danger{
    background:
        rgba(211,91,113,.09);

    border-color:#613743;

    color:#e2a1ad;

    box-shadow:none;
}


/* =========================
   GRID
========================= */

.grid{
    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:15px;
}


/* =========================
   STAT CARD
========================= */

.stat{
    position:relative;

    overflow:hidden;

    background:
        linear-gradient(
            145deg,
            rgba(13,29,48,.97),
            rgba(8,21,36,.97)
        );

    border:1px solid var(--line);

    border-radius:17px;

    padding:19px;

    box-shadow:var(--shadow);

    transition:.2s;
}

.stat:hover{
    transform:translateY(-2px);

    border-color:#245274;
}

.stat:after{
    content:"";

    position:absolute;

    width:90px;

    height:90px;

    right:-35px;

    bottom:-45px;

    border-radius:50%;

    background:
        rgba(95,190,255,.06);
}

.stat-top{
    display:flex;

    align-items:center;

    justify-content:space-between;

    color:#8da7bd;

    font-size:10px;

    font-weight:300;
}

.stat-icon{
    width:34px;

    height:34px;

    border-radius:11px;

    display:grid;

    place-items:center;

    background:
        rgba(102,193,251,.10);

    color:#7bd0ff;

    font-weight:400;
}

.stat-num{
    font-family:'Outfit',sans-serif;

    font-size:28px;

    font-weight:400;

    margin-top:13px;
}

.stat-foot{
    font-size:9px;

    color:#607990;

    margin-top:4px;

    font-weight:300;
}


/* =========================
   CARD
========================= */

.card{
    background:
        rgba(10,24,40,.92);

    border:1px solid var(--line);

    border-radius:17px;

    box-shadow:var(--shadow);

    overflow:hidden;
}

.card-head{
    padding:19px 21px;

    border-bottom:
        1px solid #17334d;

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:10px;
}

.card-head h3{
    margin:0;

    font-family:'Outfit',sans-serif;

    font-size:14px;

    font-weight:400;
}

.card-head span{
    font-size:9px;

    color:#67829a;

    font-weight:300;
}


/* =========================
   TABLE
========================= */

.table-wrap{
    overflow:auto;
}

table{
    width:100%;

    border-collapse:collapse;
}

th{
    padding:12px 16px;

    background:#09192b;

    color:#66839c;

    text-align:left;

    font-size:9px;

    letter-spacing:.8px;

    text-transform:uppercase;

    white-space:nowrap;

    font-weight:400;
}

td{
    padding:14px 16px;

    border-top:
        1px solid #132d45;

    color:#c9d9e6;

    font-size:11px;

    vertical-align:middle;

    font-weight:300;
}

tr:hover td{
    background:
        rgba(69,140,198,.035);
}


/* =========================
   BADGE
========================= */

.badge{
    display:inline-flex;

    align-items:center;

    padding:5px 9px;

    border-radius:999px;

    font-size:9px;

    font-weight:400;
}

.blue{
    background:
        rgba(94,177,240,.12);

    color:#8ed2ff;
}

.green{
    background:
        rgba(95,203,151,.12);

    color:#8be0b8;
}

.gold{
    background:
        rgba(218,191,115,.12);

    color:#e0cb8d;
}

.red{
    background:
        rgba(219,117,139,.12);

    color:#e5a3b0;
}

.purple{
    background:
        rgba(143,137,240,.12);

    color:#b9b6ff;
}


/* =========================
   ACTION
========================= */

.actions{
    display:flex;

    gap:6px;

    flex-wrap:wrap;
}

.mini{
    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:7px 10px;

    border-radius:8px;

    font-size:9px;

    border:1px solid #264e6e;

    background:#0f253d;

    color:#a6d8f8;

    cursor:pointer;

    font-weight:400;
}

.mini.delete{
    background:
        rgba(205,91,111,.08);

    border-color:#59353f;

    color:#dfa0aa;
}


/* =========================
   ALERT
========================= */

.alert{
    padding:12px 14px;

    border-radius:11px;

    margin-bottom:16px;

    font-size:11px;

    background:
        rgba(87,193,143,.09);

    border:
        1px solid rgba(87,193,143,.22);

    color:#98dcbc;

    font-weight:300;
}

.alert.error{
    background:
        rgba(220,109,130,.09);

    border-color:
        rgba(220,109,130,.23);

    color:#e6a4af;
}


/* =========================
   FILTER
========================= */

.filters{
    display:flex;

    gap:10px;

    align-items:end;

    padding:18px;

    border-bottom:
        1px solid #17334d;

    flex-wrap:wrap;
}

.field{
    display:flex;

    flex-direction:column;

    gap:6px;
}

.field label,
.form-card label{
    font-size:9px;

    color:#7590a6;

    text-transform:uppercase;

    letter-spacing:.7px;

    font-weight:400;
}

.field input,
.field select,
.form-card input,
.form-card select,
.form-card textarea{
    height:41px;

    min-width:170px;

    background:#081a2d;

    color:#e5f2fb;

    border:1px solid #1d405d;

    border-radius:9px;

    padding:0 11px;

    outline:none;

    font-family:'Outfit',sans-serif;

    font-size:11px;

    font-weight:300;
}

.form-card textarea{
    height:90px;

    padding:11px;
}


/* =========================
   EMPTY
========================= */

.empty{
    text-align:center;

    padding:55px 20px;

    color:#71899f;
}

.empty strong{
    display:block;

    color:#a1b6c8;

    font-family:'Outfit',sans-serif;

    font-size:17px;

    font-weight:400;

    margin-bottom:5px;
}

.empty span{
    font-size:10px;

    font-weight:300;
}


/* =========================
   TWO COLUMN
========================= */

.two{
    display:grid;

    grid-template-columns:
        1.15fr .85fr;

    gap:16px;
}


/* =========================
   QUICK
========================= */

.quick{
    display:grid;

    grid-template-columns:
        1fr 1fr;

    gap:10px;

    padding:18px;
}

.quick a{
    padding:16px;

    border:1px solid #1b3b57;

    border-radius:12px;

    background:
        linear-gradient(
            145deg,
            #0d2339,
            #0a1a2d
        );

    transition:.2s;
}

.quick a:hover{
    transform:translateY(-2px);

    border-color:#3979a7;
}

.quick strong{
    display:block;

    font-size:11px;

    margin-bottom:4px;

    font-weight:400;
}

.quick small{
    font-size:9px;

    color:#6e899f;

    font-weight:300;
}


/* =========================
   FORM
========================= */

.form-card{
    max-width:820px;

    padding:23px;
}

.form-grid{
    display:grid;

    grid-template-columns:
        1fr 1fr;

    gap:16px;
}

.full{
    grid-column:1/-1;
}

.form-actions{
    display:flex;

    gap:8px;

    margin-top:20px;
}


/* =========================
   DASHBOARD
========================= */

.dashboard-grid{
    display:grid;

    grid-template-columns:
        1.3fr .7fr;

    gap:16px;

    margin-top:16px;
}


/* =========================
   RING
========================= */

.ring-wrap{
    display:flex;

    align-items:center;

    gap:24px;

    padding:22px;
}

.ring{
    width:150px;

    height:150px;

    border-radius:50%;

    display:grid;

    place-items:center;

    background:
        conic-gradient(
            var(--green) var(--pct),
            #284057 0
        );

    position:relative;

    flex:none;
}

.ring:after{
    content:"";

    width:112px;

    height:112px;

    border-radius:50%;

    background:#0a1a2d;

    position:absolute;
}

.ring-center{
    position:relative;

    z-index:1;

    text-align:center;
}

.ring-center strong{
    display:block;

    font-family:'Outfit',sans-serif;

    font-size:26px;

    font-weight:400;
}

.ring-center span{
    font-size:9px;

    color:#7892a8;

    font-weight:300;
}


/* =========================
   LEGEND
========================= */

.legend{
    display:flex;

    flex-direction:column;

    gap:11px;
}

.legend-item{
    display:flex;

    align-items:center;

    gap:9px;

    font-size:10px;

    color:#9bb0c1;

    font-weight:300;
}

.dot{
    width:9px;

    height:9px;

    border-radius:50%;
}

.dot.green{
    background:#68d5a1;
}

.dot.red{
    background:#e08c9d;
}

.dot.gold{
    background:#dec47e;
}


/* =========================
   QUICK GRID
========================= */

.quick-grid{
    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:10px;

    padding:18px;
}

.quick-tile{
    padding:15px;

    border:1px solid #1b3b57;

    border-radius:12px;

    background:#0b2035;

    transition:.2s;
}

.quick-tile:hover{
    border-color:#3678a6;

    transform:translateY(-2px);
}

.quick-tile b{
    display:block;

    font-size:11px;

    margin:8px 0 3px;

    font-weight:400;
}

.quick-tile span{
    font-size:9px;

    color:#6d879e;

    font-weight:300;
}


/* =========================
   QR
========================= */

.qr-show{
    display:flex;

    gap:18px;

    align-items:center;

    padding:20px;
}

.qr-image{
    width:150px;

    height:150px;

    object-fit:contain;

    background:#fff;

    border-radius:12px;

    padding:9px;
}


/* =========================
   SCANNER
========================= */

.scanner-box{
    max-width:620px;

    margin:0 auto;

    padding:18px;
}

.scanner{
    border-radius:14px;

    overflow:hidden;

    border:1px solid #214b69;

    background:#06121f;
}

.scanner-result{
    margin-top:12px;

    padding:13px;

    border-radius:11px;

    background:#0c2035;

    border:1px solid #1c405e;

    font-size:11px;

    min-height:42px;

    font-weight:300;
}


/* =========================
   MAP
========================= */

.map-note{
    padding:15px 18px;

    color:#7f99ae;

    font-size:10px;

    border-top:1px solid #17334d;

    font-weight:300;
}


/* =========================
   CHECK
========================= */

.check{
    display:flex;

    align-items:center;

    gap:8px;

    color:#a7bdce;

    font-size:11px;

    font-weight:300;
}

.check input{
    min-width:auto;

    width:17px;

    height:17px;
}

.muted{
    color:#6f889e;

    font-weight:300;
}

.code{
    font-family:
        ui-monospace,
        Consolas,
        monospace;

    font-size:10px;

    color:#9fd7f7;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:1050px){

    .grid{
        grid-template-columns:
            1fr 1fr;
    }

    .dashboard-grid,
    .two{
        grid-template-columns:1fr;
    }

    .quick-grid{
        grid-template-columns:
            1fr 1fr;
    }
}


@media(max-width:760px){

    .sidebar{
        position:static;

        width:100%;

        height:auto;

        max-height:none;
    }

    .main{
        margin-left:0;
    }

    .topbar{
        padding:0 18px;
    }

    .content{
        padding:22px;
    }

    .grid{
        grid-template-columns:1fr;
    }

    .page-head{
        flex-direction:column;

        align-items:flex-start;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .full{
        grid-column:auto;
    }

    .quick-grid,
    .quick{
        grid-template-columns:1fr;
    }

    .ring-wrap{
        flex-direction:column;

        align-items:flex-start;
    }
}

</style>

@yield('head')

</head>


<body>

<div class="app">


<!-- =========================
     SIDEBAR
========================= -->

<aside class="sidebar">

<div class="brand">

<div class="brand-mark">
A
</div>

<div>

<div class="brand-name">
Absensi Digital
</div>

<div class="brand-sub">
SMART ATTENDANCE
</div>

</div>

</div>


<div class="menu-title">
Menu Utama
</div>


<nav class="menu">


<a
class="{{ request()->routeIs('admin.dashboard')?'active':'' }}"
href="{{ route('admin.dashboard') }}"
>

<span class="ico">⌂</span>

Dashboard

</a>


<a
class="{{ request()->routeIs('admin.students.*')?'active':'' }}"
href="{{ route('admin.students.index') }}"
>

<span class="ico">♙</span>

Data Siswa

</a>


<a
class="{{ request()->routeIs('admin.classes.*')?'active':'' }}"
href="{{ route('admin.classes.index') }}"
>

<span class="ico">▤</span>

Data Kelas

</a>


<a
class="{{ request()->routeIs('admin.teachers.*')?'active':'' }}"
href="{{ route('admin.teachers.index') }}"
>

<span class="ico">♙</span>

Data Guru

</a>


<a
class="{{ request()->routeIs('admin.schedules.*')?'active':'' }}"
href="{{ route('admin.schedules.index') }}"
>

<span class="ico">◫</span>

Jadwal

</a>


<a
class="{{ request()->routeIs('admin.attendances.*')?'active':'' }}"
href="{{ route('admin.attendances.index') }}"
>

<span class="ico">◷</span>

Data Absensi

</a>


<a
class="{{ request()->routeIs('admin.qr.*')?'active':'' }}"
href="{{ route('admin.qr.index') }}"
>

<span class="ico">▦</span>

QR Code

</a>


<a
class="{{ request()->routeIs('admin.locations.*')?'active':'' }}"
href="{{ route('admin.locations.index') }}"
>

<span class="ico">⌖</span>

Lokasi QR

</a>


<a
class="{{ request()->routeIs('admin.scan.*')?'active':'' }}"
href="{{ route('admin.scan.index') }}"
>

<span class="ico">⌗</span>

Scan QR

</a>


</nav>


<div
class="menu-title"
style="margin-top:24px"
>

Laporan & Sistem

</div>


<nav class="menu">


<a
class="{{ request()->routeIs('admin.reports.*')?'active':'' }}"
href="{{ route('admin.reports.index') }}"
>

<span class="ico">▥</span>

Rekap Absensi

</a>


<a
class="{{ request()->routeIs('admin.settings.*')?'active':'' }}"
href="{{ route('admin.settings.index') }}"
>

<span class="ico">⚙</span>

Pengaturan

</a>


</nav>


<div class="logout">

<form
action="{{ route('admin.logout') }}"
method="POST"
>

@csrf

<button type="submit">

↪ &nbsp; Keluar dari sistem

</button>

</form>

</div>


</aside>


<!-- =========================
     MAIN
========================= -->

<main class="main">


<header class="topbar">


<div>

<div class="top-title">

{{ $headerTitle ?? $title ?? 'Dashboard' }}

</div>

<div class="top-sub">

Laravel 10 · REST API · MySQL

</div>

</div>


<div class="admin">


<div class="avatar">

A

</div>


<div>

<strong>

{{ auth()->user()->name ?? 'Administrator' }}

</strong>

<small>

Administrator

</small>

</div>


</div>


</header>


<section class="content">


@if($errors->any())

<div class="alert error">

{{ $errors->first() }}

</div>

@endif


@yield('content')


</section>


</main>


</div>


@yield('scripts')


</body>
</html>