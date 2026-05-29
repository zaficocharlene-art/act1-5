cat > resources/views/study-techniques/index.blade.php << 'EOF'
@extends('layouts.app')

@section('content')
<h1>📚 Study Technique Explorer</h1>
<p class="subtitle">Master 6 proven methods to study smarter and ace your exams!</p>

@foreach($studyTechniques as $technique)
<div class="technique">
    <div style="display:flex;justify-content:space-between;align-items:start;flex-wrap:wrap;gap:20px">
        <div style="flex:1">
            <h3>💡 {{ $technique['name'] }}</h3>
            <div style="font-size:1.1rem;margin-bottom:15px">⏱️ {{ $technique['duration'] }}</div>
            <span class="difficulty {{ strtolower($technique['difficulty']) }}">⭐ {{ $technique['difficulty'] }}</span>
        </div>
        <a href="{{ route('study-techniques.show', $technique['id']) }}" class="btn">👁️ View Details</a>
    </div>
</div>
@endforeach

<div class="footer">
    <i>🎯 Practice daily = Perfect grades | Laravel Mini System</i>
</div>
@endsection
EOF