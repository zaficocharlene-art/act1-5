<!DOCTYPE html>
<html>
<head>
    <title>Gamer Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #140018;
            color: white;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;   /* BIGGER TAB AREA */
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #6a0dad, #3b0066);
            padding: 25px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 28px;   /* BIG TITLE */
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 18px;     /* BIG BUTTON */
            margin-top: 15px;
            border-radius: 12px;
            font-size: 18px;   /* BIG TEXT */
            background: rgba(255,255,255,0.08);
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #8a2be2;
            transform: scale(1.05);
        }

        /* MAIN */
        .main {
            margin-left: 280px;
            padding: 30px;
        }

        /* TOP BAR */
        .topbar {
            background: #2a0033;
            padding: 25px;
            border-radius: 15px;
        }

        .topbar h2 {
            font-size: 32px;   /* BIG TITLE */
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            background: #8a2be2;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
        }

        /* CARDS */
        .card {
            background: #2a0033;
            padding: 20px;
            margin-top: 15px;
            border-left: 6px solid #8a2be2;
            border-radius: 12px;
            font-size: 18px;   /* BIG TEXT INSIDE CARD */
        }

        .card b {
            font-size: 20px;
        }

        .delete {
            background: red;
            margin-top: 10px;
            display: inline-block;
        }

        h3 {
            font-size: 26px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🎮 GAMER</h2>

    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/reaction/create">➕ Add Reaction</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>🎮 Gamer Reaction Dashboard</h2>
        <p style="font-size:18px;">Track player reactions & play styles</p>
        <a class="btn" href="/reaction/create">+ New Entry</a>
    </div>

    @if(session('success'))
        <p style="color:#00ff99; font-size:18px;">{{ session('success') }}</p>
    @endif

    <h3>🔥 Player Reactions</h3>

    @foreach($reactions as $r)
        <div class="card">
            <b>Name:</b> {{ $r['name'] }} <br>
            <b>Game:</b> {{ $r['game'] }} <br>
            <b>Reaction:</b> {{ $r['reaction'] }} <br>
            <b>Play Style:</b> {{ $r['play_style'] }} <br>

            <a class="btn delete" href="/reaction/delete/{{ $r['id'] }}">
                Delete
            </a>
        </div>
    @endforeach

    @if(empty($reactions))
        <p style="font-size:18px;">No gamer data yet.</p>
    @endif

</div>

</body>
</html>