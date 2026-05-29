cat > resources/views/layouts/app.blade.php << 'EOF'
<!DOCTYPE html>
<html>
<head>
    <title>Study Technique Explorer</title>
    <meta name="viewport" content="width=device-width">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#4ade80 0%,#10b981 50%,#059669 100%);min-height:100vh;color:#333;padding:20px}
        .container{max-width:1200px;margin:0 auto;background:rgba(255,255,255,0.95);border-radius:25px;padding:40px;box-shadow:0 25px 60px rgba(0,0,0,0.2);border:4px solid #10b981}
        h1{color:#059669;font-size:2.8rem;text-align:center;margin-bottom:20px;text-shadow:2px 2px 4px rgba(0,0,0,0.1)}
        .subtitle{color:#6b7280;font-size:1.2rem;text-align:center;margin-bottom:40px}
        .technique{background:linear-gradient(135deg,#10b981,#059669);color:white;border-radius:20px;padding:30px;margin-bottom:25px;box-shadow:0 15px 35px rgba(16,185,129,0.4);transition:transform 0.3s ease;}
        .technique:hover{transform:translateY(-8px)}
        .btn{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:white;padding:14px 28px;border:none;border-radius:30px;text-decoration:none;font-weight:bold;font-size:1.1rem;display:inline-flex;align-items:center;gap:10px;box-shadow:0 8px 20px rgba(59,130,246,0.4);transition:all 0.3s;}
        .btn:hover{transform:translateY(-2px);box-shadow:0 12px 25px rgba(59,130,246,0.5)}
        .footer{text-align:center;padding:30px;color:#059669;font-weight:bold;font-size:1.1rem;background:rgba(255,255,255,0.5);border-radius:20px;margin-top:40px}
        .difficulty{padding:8px 16px;border-radius:20px;font-weight:bold;font-size:1rem;display:inline-block;}
        .beginner{background:rgba(34,197,94,0.3);color:#10b981}
        .intermediate{background:rgba(251,191,36,0.3);color:#f59e0b}
        .advanced{background:rgba(239,68,68,0.3);color:#ef4444}
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
EOF