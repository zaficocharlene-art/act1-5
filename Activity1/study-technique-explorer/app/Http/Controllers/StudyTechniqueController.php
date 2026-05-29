<?php

namespace App\Http\Controllers;

class StudyTechniqueController extends Controller
{
    public function index()
    {
        $studyTechniques = [
            ['id'=>1,'name'=>'Pomodoro Technique','duration'=>'25 min sessions','difficulty'=>'Beginner','description'=>'Study 25min, break 5min. 4 cycles = long break','benefits'=>'Boosts focus, prevents burnout','best_for'=>'Exam prep'],
            ['id'=>2,'name'=>'Feynman Technique','duration'=>'30-45 min','difficulty'=>'Intermediate','description'=>'Explain concept like to a child. Fill knowledge gaps','benefits'=>'Deep understanding, reveals gaps','best_for'=>'Complex subjects'],
            ['id'=>3,'name'=>'Active Recall','duration'=>'20-40 min','difficulty'=>'Beginner','description'=>'Test yourself WITHOUT notes or flashcards','benefits'=>'Strengthens memory 3x better than re-reading','best_for'=>'Multiple choice, memorization'],
            ['id'=>4,'name'=>'Spaced Repetition','duration'=>'Daily reviews','difficulty'=>'Intermediate','description'=>'Review: Day 1, 2, 4, 7, 14, 30','benefits'=>'Science-backed long-term retention','best_for'=>'Languages, formulas'],
            ['id'=>5,'name'=>'Mind Mapping','duration'=>'15-30 min','difficulty'=>'Beginner','description'=>'Visual diagrams with colors, images, keywords','benefits'=>'Creative connections, essay planning','best_for'=>'Brainstorming, overviews'],
            ['id'=>6,'name'=>'SQ3R Method','duration'=>'45-60 min','difficulty'=>'Advanced','description'=>'Survey → Question → Read → Recite → Review','benefits'=>'Master textbooks, deep comprehension','best_for'=>'Dense reading material']
        ];

        $html = '<!DOCTYPE html>
        <html>
        <head>
            <title>Study Technique Explorer</title>
            <meta name="viewport" content="width=device-width">
            <style>
                *{margin:0;padding:0;box-sizing:border-box}
                body{font-family:\'Segoe UI\',sans-serif;background:linear-gradient(135deg,#4ade80 0%,#10b981 50%,#059669 100%);min-height:100vh;color:#333;padding:20px}
                .container{max-width:1200px;margin:0 auto;background:rgba(255,255,255,0.95);border-radius:25px;padding:40px;box-shadow:0 25px 60px rgba(0,0,0,0.2);border:4px solid #10b981}
                h1{color:#059669;font-size:2.8rem;text-align:center;margin-bottom:20px;text-shadow:2px 2px 4px rgba(0,0,0,0.1)}
                .subtitle{color:#6b7280;font-size:1.2rem;text-align:center;margin-bottom:40px}
                .technique{background:linear-gradient(135deg,#10b981,#059669);color:white;border-radius:20px;padding:30px;margin-bottom:25px;box-shadow:0 15px 35px rgba(16,185,129,0.4);transition:transform 0.3s}
                .technique:hover{transform:translateY(-8px)}
                .technique h3{font-size:1.9rem;margin-bottom:12px}
                .info{font-size:1.1rem;margin-bottom:15px}
                .difficulty{padding:8px 16px;border-radius:20px;font-weight:bold;font-size:1rem}
                .beginner{background:rgba(34,197,94,0.3);color:#10b981}
                .intermediate{background:rgba(251,191,36,0.3);color:#f59e0b}
                .advanced{background:rgba(239,68,68,0.3);color:#ef4444}
                .btn{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:white;padding:14px 28px;border:none;border-radius:30px;text-decoration:none;font-weight:bold;font-size:1.1rem;display:inline-flex;align-items:center;gap:10px;box-shadow:0 8px 20px rgba(59,130,246,0.4);transition:all 0.3s}
                .btn:hover{transform:translateY(-2px);box-shadow:0 12px 25px rgba(59,130,246,0.5)}
                .footer{text-align:center;padding:30px;color:#059669;font-weight:bold;font-size:1.1rem;background:rgba(255,255,255,0.5);border-radius:20px;margin-top:40px}
                @media(max-width:768px){.container{padding:20px}h1{font-size:2rem}}
            </style>
        </head>
        <body>
            <div class="container">
                <h1>📚 Study Technique Explorer</h1>
                <p class="subtitle">Master 6 proven methods to study smarter and ace your exams!</p>';
        
        foreach($studyTechniques as $technique) {
            $html .= '
                <div class="technique">
                    <div style="display:flex;justify-content:space-between;align-items:start;flex-wrap:wrap;gap:20px">
                        <div style="flex:1">
                            <h3>💡 ' . $technique['name'] . '</h3>
                            <div class="info">⏱️ ' . $technique['duration'] . '</div>
                            <span class="difficulty ' . strtolower($technique['difficulty']) . '">⭐ ' . $technique['difficulty'] . '</span>
                        </div>
                        <a href="/study-techniques/' . $technique['id'] . '" class="btn">👁️ View Details</a>
                    </div>
                </div>';
        }
        
        $html .= '
                <div class="footer">
                    <i>🎯 Practice daily = Perfect grades | Laravel Mini System</i>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }

    public function show($id)
    {
        $techniques = [
            ['id'=>1,'name'=>'Pomodoro Technique','duration'=>'25 min sessions','difficulty'=>'Beginner','description'=>'Study intensely for 25 minutes, then take a 5-minute break. After 4 cycles, take a longer 15-30 minute break. Use a timer!','benefits'=>'Maintains high focus, prevents burnout, scientifically proven','best_for'=>'Long study sessions, exam preparation, concentration'],
            ['id'=>2,'name'=>'Feynman Technique','duration'=>'30-45 minutes','difficulty'=>'Intermediate','description'=>'1. Choose concept 2. Explain like to a child 3. Identify gaps 4. Simplify & use analogies 5. Teach someone','benefits'=>'Reveals true understanding, fills knowledge gaps, improves teaching','best_for'=>'Complex subjects, exam review, deep learning'],
            ['id'=>3,'name'=>'Active Recall','duration'=>'20-40 minutes','difficulty'=>'Beginner','description'=>'Close book. Write/recall everything you remember. Check mistakes. Repeat until 100% recall.','benefits'=>'3x better than highlighting/re-reading, builds strong memory pathways','best_for'=>'Multiple choice exams, memorization, formula practice'],
            ['id'=>4,'name'=>'Spaced Repetition','duration'=>'Daily reviews','difficulty'=>'Intermediate','description'=>'Review material at increasing intervals: Today → Tomorrow → Day 4 → Day 7 → Day 14 → Day 30','benefits'=>'Optimal for long-term retention, science-backed algorithm','best_for'=>'Languages, vocabulary, math formulas, medical terms'],
            ['id'=>5,'name'=>'Mind Mapping','duration'=>'15-30 minutes','difficulty'=>'Beginner','description'=>'Central idea → Main branches → Sub-branches. Use colors, images, keywords (NOT sentences)','benefits'=>'Visual organization, creative connections, faster brainstorming','best_for'=>'Essay planning, subject overviews, presentations'],
            ['id'=>6,'name'=>'SQ3R Method','duration'=>'45-60 minutes','difficulty'=>'Advanced','description'=>'SURVEY chapter → Make QUESTIONS → READ actively → RECITE from memory → REVIEW notes','benefits'=>'Transforms passive reading into active learning, perfect comprehension','best_for'=>'Textbooks, research papers, dense academic material']
        ];

        $technique = null;
        foreach($techniques as $t) {
            if($t['id'] == $id) {
                $technique = $t;
                break;
            }
        }
        
        if(!$technique) {
            return '<h1 style="color:red;text-align:center;padding:50px;font-family:Segoe UI;font-size:3rem">Technique not found! <a href="/study-techniques" style="color:#3b82f6">← Back</a></h1>';
        }

        return '<!DOCTYPE html>
        <html>
        <head>
            <title>' . $technique['name'] . ' - Study Technique Explorer</title>
            <meta name="viewport" content="width=device-width">
            <style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:\'Segoe UI\',sans-serif;background:linear-gradient(135deg,#4ade80 0%,#10b981 50%,#059669 100%);min-height:100vh;color:#333;padding:20px}.container{max-width:900px;margin:0 auto;background:rgba(255,255,255,0.95);border-radius:25px;padding:40px;box-shadow:0 25px 60px rgba(0,0,0,0.2);border:4px solid #10b981}.detail-hero{background:linear-gradient(135deg,#059669,#10b981,#34d399);color:white;padding:60px;border-radius:25px;text-align:center;margin-bottom:40px;box-shadow:0 20px 50px rgba(5,150,105,0.4)}.detail-hero h1{font-size:3.2rem;margin-bottom:20px}.detail-hero .meta{font-size:1.3rem;opacity:0.95}.detail-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:30px;margin-bottom:50px}.detail-card{background:rgba(255,255,255,0.95);padding:35px;border-radius:20px;box-shadow:0 15px 40px rgba(0,0,0,0.1);border-left:6px solid #10b981}.detail-card h3{color:#059669;font-size:1.6rem;margin-bottom:20px}.detail-card p{line-height:1.8;color:#4b5563;font-size:1.1rem}.back-btn{background:linear-gradient(135deg,#6b7280,#4b5563);color:white;padding:18px 35px;border:none;border-radius:30px;text-decoration:none;font-weight:bold;font-size:1.1rem;display:inline-block;box-shadow:0 10px 25px rgba(107,114,128,0.4);transition:all 0.3s;margin:20px auto;display:block;width:fit-content}.back-btn:hover{transform:translateY(-2px);box-shadow:0 15px 30px rgba(107,114,128,0.5)}@media(max-width:768px){.container{padding:20px}}</style>
        </head>
        <body>
            <div class="container">
                <div class="detail-hero">
                    <h1>🧠 ' . $technique['name'] . '</h1>
                    <div class="meta">⏱️ ' . $technique['duration'] . ' | ⭐ ' . $technique['difficulty'] . '</div>
                </div>
                
                <div class="detail-grid">
                    <div class="detail-card">
                        <h3>📖 How It Works</h3>
                        <p>' . $technique['description'] . '</p>
                    </div>
                    <div class="detail-card">
                        <h3>✅ Key Benefits</h3>
                        <p>' . $technique['benefits'] . '</p>
                    </div>
                    <div class="detail-card">
                        <h3>🎯 Perfect For</h3>
                        <p style="font-size:1.2rem;font-weight:600;color:#059669">' . $technique['best_for'] . '</p>
                    </div>
                </div>
                
                <a href="/study-techniques" class="back-btn">← Back to All Techniques</a>
            </div>
        </body>
        </html>';
    }
}