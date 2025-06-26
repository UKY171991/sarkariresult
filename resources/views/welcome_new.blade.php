@extends('layouts.app')

@section('title', 'Sarkari Result - Government Job Portal - Trusted Portal Since 2025')

@section('content')
<!-- Hero Section with Enhanced Animation -->
<div class="hero-section" style="
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(0,26,26,0.9)), 
                url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"%2300ffff\" stroke-width=\"0.5\" opacity=\"0.3\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');
    background-size: cover, 50px 50px;
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
">
    <div class="container" style="position: relative; z-index: 10;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h1 class="glitch-text" data-text="🚀 SARKARI RESULT PORTAL" style="
                font-size: 3.5rem;
                font-weight: 900;
                margin-bottom: 1rem;
                background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                background-size: 200% 200%;
                animation: gradientShift 3s ease infinite;
                text-shadow: 0 0 30px rgba(0, 255, 255, 0.8);
            ">🚀 SARKARI RESULT PORTAL</h1>
            
            <p style="
                font-size: 1.5rem;
                color: #00ffff;
                margin-bottom: 2rem;
                text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
                animation: fadeInUp 1s ease-out 0.5s backwards;
            ">⚡ Your Ultimate Government Job Destination ⚡</p>
            
            <div style="
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                animation: fadeInUp 1s ease-out 1s backwards;
            ">
                <a href="/jobs" class="liquid-button holo-card" style="
                    background: linear-gradient(45deg, #00ffff, #ff00ff);
                    border: none;
                    padding: 1rem 2rem;
                    border-radius: 50px;
                    color: white;
                    font-size: 1.1rem;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                    text-decoration: none;
                    display: inline-block;
                ">🎯 Explore Latest Jobs</a>
                
                <a href="/results" class="liquid-button holo-card" style="
                    background: linear-gradient(45deg, #ff00ff, #ffff00);
                    border: none;
                    padding: 1rem 2rem;
                    border-radius: 50px;
                    color: white;
                    font-size: 1.1rem;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                    text-decoration: none;
                    display: inline-block;
                ">📊 Check Results</a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Jobs Section -->
<div class="featured-jobs" style="
    background: linear-gradient(135deg, #0a0a0a, #1a1a2e);
    padding: 4rem 0;
">
    <div class="container">
        <h2 style="
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #00ffff;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        " class="glitch-text" data-text="🔥 Hot Government Jobs">🔥 Hot Government Jobs</h2>
        
        <div class="featured-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        ">
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(0,255,255,0.1), rgba(255,0,255,0.1));
                border: 1px solid rgba(0,255,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #00ffff; margin-bottom: 1rem;"><a href="/jobs" style="text-decoration: none; color: inherit;">🌊 Coast Guard Navik Yantrik Apply Online</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Last Date: 15 Aug 2025</p>
                <div style="margin-top: 1rem;">
                    <a href="/jobs" class="liquid-button" style="
                        background: linear-gradient(45deg, #00ffff, #0099cc);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: white;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                    ">Apply Now</a>
                </div>
            </div>
            
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(255,0,255,0.1), rgba(255,255,0,0.1));
                border: 1px solid rgba(255,0,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #ff00ff; margin-bottom: 1rem;"><a href="/jobs" style="text-decoration: none; color: inherit;">✍️ SSC Stenographer 2025 Apply Online</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Last Date: 20 Aug 2025</p>
                <div style="margin-top: 1rem;">
                    <a href="/jobs" class="liquid-button" style="
                        background: linear-gradient(45deg, #ff00ff, #cc0099);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: white;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                    ">Apply Now</a>
                </div>
            </div>
            
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(255,255,0,0.1), rgba(0,255,255,0.1));
                border: 1px solid rgba(255,255,0,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #ffff00; margin-bottom: 1rem;"><a href="/jobs" style="text-decoration: none; color: inherit;">🎯 SSC CGL 2025 Apply Online</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Last Date: 25 Aug 2025</p>
                <div style="margin-top: 1rem;">
                    <a href="/jobs" class="liquid-button" style="
                        background: linear-gradient(45deg, #ffff00, #cccc00);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: #000;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                        font-weight: bold;
                    ">Apply Now</a>
                </div>
            </div>
            
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(0,255,255,0.1), rgba(255,0,255,0.1));
                border: 1px solid rgba(0,255,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #00ffff; margin-bottom: 1rem;"><a href="/jobs" style="text-decoration: none; color: inherit;">📋 BPSC 71 Pre 2025 Apply Online</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Last Date: 28 Aug 2025</p>
                <div style="margin-top: 1rem;">
                    <a href="/jobs" class="liquid-button" style="
                        background: linear-gradient(45deg, #00ffff, #0099cc);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: white;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                    ">Apply Now</a>
                </div>
            </div>
            
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(255,0,255,0.1), rgba(255,255,0,0.1));
                border: 1px solid rgba(255,0,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #ff00ff; margin-bottom: 1rem;"><a href="/admit-cards" style="text-decoration: none; color: inherit;">👮 Bihar Police Constable Exam City</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Check Status Now</p>
                <div style="margin-top: 1rem;">
                    <a href="/admit-cards" class="liquid-button" style="
                        background: linear-gradient(45deg, #ff00ff, #cc0099);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: white;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                    ">Check Status</a>
                </div>
            </div>
            
            <div class="featured-item holo-card hover-glow" style="
                background: linear-gradient(135deg, rgba(255,255,0,0.1), rgba(0,255,255,0.1));
                border: 1px solid rgba(255,255,0,0.3);
                border-radius: 15px;
                padding: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <h3 style="color: #ffff00; margin-bottom: 1rem;"><a href="/admit-cards" style="text-decoration: none; color: inherit;">🎫 RRB NTPC Graduate Admit Card 2025</a></h3>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; opacity: 0.9; color: #ccc;">Download Available</p>
                <div style="margin-top: 1rem;">
                    <a href="/admit-cards" class="liquid-button" style="
                        background: linear-gradient(45deg, #ffff00, #cccc00);
                        padding: 0.5rem 1rem; 
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 25px;
                        color: #000;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                        font-weight: bold;
                    ">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Links Section -->
<div class="social-section" style="
    background: linear-gradient(45deg, #1a1a2e, #16213e);
    padding: 3rem 0;
">
    <div class="container">
        <div class="social-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        ">
            <div class="social-item whatsapp hover-glow" style="
                background: linear-gradient(135deg, rgba(37, 211, 102, 0.1), rgba(37, 211, 102, 0.05));
                border: 1px solid rgba(37, 211, 102, 0.3);
                border-radius: 15px;
                padding: 2rem;
                display: flex;
                align-items: center;
                gap: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <div class="social-icon" style="font-size: 3rem;">📱</div>
                <div>
                    <h4 style="color: #25d366; margin-bottom: 0.5rem; font-size: 1.5rem;">Join WhatsApp Channel</h4>
                    <p style="color: #ccc; margin-bottom: 1rem;">Get instant notifications for all government job updates, results, and admit cards directly on your phone.</p>
                    <a href="#" class="btn-join" style="
                        background: linear-gradient(45deg, #25d366, #128c7e);
                        color: white;
                        padding: 0.75rem 1.5rem;
                        border-radius: 25px;
                        text-decoration: none;
                        font-weight: bold;
                        transition: all 0.3s ease;
                        display: inline-block;
                    ">🚀 Join Now</a>
                </div>
            </div>
            
            <div class="social-item telegram hover-glow" style="
                background: linear-gradient(135deg, rgba(0, 136, 204, 0.1), rgba(0, 136, 204, 0.05));
                border: 1px solid rgba(0, 136, 204, 0.3);
                border-radius: 15px;
                padding: 2rem;
                display: flex;
                align-items: center;
                gap: 2rem;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            ">
                <div class="social-icon" style="font-size: 3rem;">⚡</div>
                <div>
                    <h4 style="color: #0088cc; margin-bottom: 0.5rem; font-size: 1.5rem;">Join Telegram Group</h4>
                    <p style="color: #ccc; margin-bottom: 1rem;">Connect with thousands of job aspirants, share experiences, and get real-time updates in our active community.</p>
                    <a href="#" class="btn-join" style="
                        background: linear-gradient(45deg, #0088cc, #006699);
                        color: white;
                        padding: 0.75rem 1.5rem;
                        border-radius: 25px;
                        text-decoration: none;
                        font-weight: bold;
                        transition: all 0.3s ease;
                        display: inline-block;
                    ">⚡ Join Group</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories Section -->
<div class="categories-section" style="
    background: linear-gradient(135deg, #0a0a0a, #1a1a2e);
    padding: 4rem 0;
">
    <div class="container">
        <h2 style="
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #00ffff;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        ">🌟 Popular Job Categories</h2>
        
        <div class="categories-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        ">
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(0,255,255,0.1), rgba(255,0,255,0.1));
                border: 1px solid rgba(0,255,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">🏛️</span>
                <span style="font-weight: bold; color: #00ffff;">Central Govt Jobs</span>
            </a>
            
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(255,0,255,0.1), rgba(255,255,0,0.1));
                border: 1px solid rgba(255,0,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">🏢</span>
                <span style="font-weight: bold; color: #ff00ff;">State Govt Jobs</span>
            </a>
            
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(255,255,0,0.1), rgba(0,255,255,0.1));
                border: 1px solid rgba(255,255,0,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">🏦</span>
                <span style="font-weight: bold; color: #ffff00;">Banking Jobs</span>
            </a>
            
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(0,255,255,0.1), rgba(255,0,255,0.1));
                border: 1px solid rgba(0,255,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">🚂</span>
                <span style="font-weight: bold; color: #00ffff;">Railway Jobs</span>
            </a>
            
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(255,0,255,0.1), rgba(255,255,0,0.1));
                border: 1px solid rgba(255,0,255,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">👮</span>
                <span style="font-weight: bold; color: #ff00ff;">Police Jobs</span>
            </a>
            
            <a href="/jobs" class="category-card" style="
                background: linear-gradient(135deg, rgba(255,255,0,0.1), rgba(0,255,255,0.1));
                border: 1px solid rgba(255,255,0,0.3);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                text-decoration: none;
                color: white;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: block;
            ">
                <span class="category-icon" style="font-size: 2.5rem; display: block; margin-bottom: 1rem;">🎓</span>
                <span style="font-weight: bold; color: #ffff00;">Teaching Jobs</span>
            </a>
        </div>
    </div>
</div>

<!-- Quick Links Section -->
<div class="quick-links-section" style="
    background: linear-gradient(45deg, #16213e, #1a1a2e);
    padding: 3rem 0;
">
    <div class="container">
        <h2 style="
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #00ffff;
            text-transform: uppercase;
        ">⚡ Quick Access</h2>
        
        <div style="
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        ">
            <a href="/jobs" style="
                background: linear-gradient(45deg, #00ffff, #0099cc);
                color: white;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                transition: all 0.3s ease;
                display: inline-block;
            ">💼 Latest Jobs</a>
            
            <a href="/results" style="
                background: linear-gradient(45deg, #ff00ff, #cc0099);
                color: white;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                transition: all 0.3s ease;
                display: inline-block;
            ">📊 Results</a>
            
            <a href="/admit-cards" style="
                background: linear-gradient(45deg, #ffff00, #cccc00);
                color: #000;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                transition: all 0.3s ease;
                display: inline-block;
            ">🎫 Admit Cards</a>
            
            <a href="/answer-keys" style="
                background: linear-gradient(45deg, #00ff00, #00cc00);
                color: #000;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                transition: all 0.3s ease;
                display: inline-block;
            ">🗝️ Answer Keys</a>
        </div>
    </div>
</div>

<style>
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.holo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.3);
}

.category-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.3);
}

.liquid-button:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 20px rgba(0, 255, 255, 0.5);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2rem !important;
    }
    
    .hero-section p {
        font-size: 1rem !important;
    }
    
    .social-item {
        flex-direction: column !important;
        text-align: center !important;
    }
    
    .categories-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
    }
}
</style>
@endsection
