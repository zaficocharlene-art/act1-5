@extends('layouts.app')
@section('title', $technique['name'])
@section('content')
<div class="detail-hero">
    <h1><i class="fas fa-brain"></i> {{ $technique['name'] }}</h1>
    <div style="font-size:1.4rem;opacity:0.95;margin-top:10px">
        <span><i class="fas fa-clock"></i> {{ $technique['duration'] }}</span> | 
        <span class="difficulty difficulty-{{ strtolower($technique['difficulty']) }}"><i class="fas fa-star"></i> {{ $technique['difficulty'] }}</span>
    </div>
</div>
<div class="detail-grid">
    <div class="detail-card">
        <h3><i class="fas fa-play-circle"></i> How It Works</h3>
        <p>{{ $technique['description'] }}</p>
    @extends('layouts.app')

@section('content')
<div class="detail-hero" style="background:linear-gradient(135deg,#059669,#10b981,#34d399);color:white;padding:60px;border-radius:25px;text-align:center;margin-bottom:40px;box-shadow:0 20px 50px rgba(5,150,105,0.4)">
    <h1>🧠 {{ $technique['name'] }}</h1>
    <div class="meta" style="font-size:1.3rem;opacity:0.95">⏱️ {{ $technique['duration'] }} | ⭐ {{ $technique['difficulty'] }}</div>
</div>

<div class="detail-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:30px;margin-bottom:50px">
    <div class="detail-card" style="background:rgba(255,255,255,0.95);padding:35px;border-radius:20px;box-shadow:0 15px 40px rgba(0,0,0,0.1);border-left:6px solid #10b981">
        <h3 style="color:#059669;font-size:1.6rem;margin-bottom:20px">📖 How It Works</h3>
        <p style="line-height:1.8;color:#4b5563;font-size:1.1rem">{{ $technique['description'] }}</p>
    </div>
    <div class="detail-card" style="background:rgba(255,255,255,0.95);padding:35px;border-radius:20px;box-shadow:0 15px 40px rgba(0,0,0,0.1);border-left:6px solid #10b981">
        <h3 style="color:#059669;font-size:1.6rem;margin-bottom:20px">✅ Key Benefits</h3>
        <p style="line-height:1.8;color:#4b5563;font-size:1.1rem">{{ $technique['benefits'] }}</p>
    </div>
    <div class="detail-card" style="background:rgba(255,255,255,0.95);padding:35px;border-radius:20px;box-shadow:0 15px 40px rgba(0,0,0,0.1);border-left:6px solid #10b981">
        <h3 style="color:#059669;font-size:1.6rem;margin-bottom:20px">🎯 Perfect For</h3>
        <p style="font-size:1.2rem;font-weight:600;color:#059669">{{ $technique['best_for'] }}</p>
    </div>
</div>

<a href="{{ route('study-techniques.index') }}" class="back-btn" style="background:linear-gradient(135deg,#6b7280,#4b5563);color:white;padding:18px 35px;border:none;border-radius:30px;text-decoration:none;font-weight:bold;font-size:1.1rem;display:inline-block;box-shadow:0 10px 25px rgba(107,114,128,0.4);transition:all 0.3s;margin:20px auto;display:block;width:fit-content">
    ← Back to All Techniques
</a>
@endsection</div>
    <div class="detail-card">
        <h3><i class="fas fa-chart-line"></i> Benefits</h3>
        <p>{{ $technique['benefits'] }}</p>
    </div>
    <div class="detail-card">
        <h3><i class="fas fa-bullseye"></i> Best For</h3>
        <p style="font-size:1.2rem;font-weight:600;color:#059669">{{ $technique['best_for'] }}</p>
    </div>
</div>
<div style="text-align:center">
    <a href="{{ route('study-techniques.index') }}" class="btn back-btn"><i class="fas fa-arrow-left"></i> All Techniques</a>
</div>
@endsection