<!DOCTYPE html>
<html>
<head>
    <title>Gamer Reaction Form</title>

    <style>
        body {
            background: linear-gradient(135deg, #6a0dad, #8a2be2);
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: #1a001f;
            padding: 25px;
            width: 350px;
            border-radius: 15px;
            color: white;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.5);
        }

        h2 {
            text-align: center;
            color: #c084fc;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            border: none;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background: #8a2be2;
            color: white;
            border: none;
            border-radius: 8px;
        }

        button:hover {
            background: #a855f7;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #c084fc;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>🎮 Gamer Form</h2>

    <form method="POST" action="/reaction">
        @csrf

        <input type="text" name="name" placeholder="Player Name" required>

        <input type="text" name="game" placeholder="Game (e.g. Valorant, ML, Dota2)" required>

        <select name="reaction" required>
            <option value="">Reaction Type</option>
            <option>Calm</option>
            <option>Angry</option>
            <option>Focused</option>
            <option>Hyped</option>
        </select>

        <select name="play_style" required>
            <option value="">Play Style</option>
            <option>Aggressive</option>
            <option>Defensive</option>
            <option>Strategic</option>
            <option>Support</option>
        </select>

        <button type="submit">Save Reaction</button>
    </form>

    <a href="/dashboard">← Back Dashboard</a>

</div>

</body>
</html>