<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Sarkari Result - Government Job Portal')</title>
    <meta name="description" content="@yield('description', 'Get latest Sarkari Result, Government Jobs, Admit Cards, Results, and Online Forms. Your trusted portal for government job notifications since 2014.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #8b5cf6;
            --secondary-color: #06b6d4;
            --accent-color: #f59e0b;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-purple: #8b5cf6;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-light: #9ca3af;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg-gradient-2: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            --bg-gradient-3: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            --bg-gradient-hero: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #667eea 50%, #764ba2 75%, #667eea 100%);
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
            --hover-color: #f3f4f6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 20px rgba(102, 126, 234, 0.4);
            --shadow-colored: 0 10px 25px -5px rgba(102, 126, 234, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: #000;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            padding-top: 0; /* Will be set dynamically by JavaScript */
        }
        
        /* Ensure smooth scrolling and proper content offset */
        html {
            scroll-behavior: smooth;
        }
        
        /* Add class for body offset when header is fixed */
        body.header-fixed {
            padding-top: var(--header-height, 160px);
        }
        
        /* Fallback for fixed header spacing */
        main {
            margin-top: 0;
            position: relative;
            z-index: 1;
        }
        
        /* Responsive adjustments for fixed header */
        @media (max-width: 768px) {
            body.header-fixed {
                padding-top: var(--header-height, 140px);
            }
            
            .header.scrolled .header-top {
                transform: translateY(-100%);
                opacity: 0;
                height: 0;
                padding: 0;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            
            .header-top {
                transition: all 0.3s ease;
            }
            
            .mobile-menu {
                /* Ensure mobile menu is properly positioned on smaller screens */
                max-height: calc(100vh - var(--header-height, 140px));
            }
        }
        
        @media (max-width: 480px) {
            body.header-fixed {
                padding-top: var(--header-height, 120px);
            }
            
            .header-main {
                padding: 1rem 0;
            }
            
            .logo h1 {
                font-size: 1.8rem !important;
            }
            
            .search-box {
                min-width: 250px;
            }
        }
        
        /* High DPI display optimizations */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .header {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }
        
        /* Reduced motion preferences */
        @media (prefers-reduced-motion: reduce) {
            .header {
                animation: none;
                transition: none;
            }
            
            .header.scrolled {
                transition: background-color 0.1s ease, box-shadow 0.1s ease;
            }
            
            .mobile-menu {
                animation: none;
                transition: transform 0.1s ease;
            }
        }
        
        /* Neural Network Background */
        .neural-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(ellipse at center, #0f1419 0%, #000 70%);
        }
        
        .neural-nodes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .neural-node {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00ffff;
            border-radius: 50%;
            box-shadow: 0 0 10px #00ffff;
            animation: neuralPulse 3s infinite alternate;
        }
        
        .neural-connection {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            animation: dataFlow 2s infinite linear;
            box-shadow: 0 0 3px #00ffff;
        }
        
        @keyframes neuralPulse {
            0% { 
                opacity: 0.3; 
                transform: scale(1);
                box-shadow: 0 0 10px #00ffff;
            }
            100% { 
                opacity: 1; 
                transform: scale(1.5);
                box-shadow: 0 0 20px #00ffff;
            }
        }
        
        @keyframes dataFlow {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        
        /* Quantum Particle System */
        .quantum-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .quantum-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #ff00ff;
            border-radius: 50%;
            animation: quantumFloat 8s infinite linear;
            box-shadow: 0 0 6px #ff00ff;
        }
        
        @keyframes quantumFloat {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: scale(1);
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) translateX(100px) scale(0);
                opacity: 0;
            }
        }
        
        /* Holographic Cards */
        .holo-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .holo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                rgba(0, 255, 255, 0.1),
                rgba(255, 0, 255, 0.1),
                transparent
            );
            transition: left 0.5s ease;
        }
        
        .holo-card:hover::before {
            left: 100%;
        }
        
        .holo-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 
                0 20px 40px rgba(0, 255, 255, 0.3),
                0 0 50px rgba(255, 0, 255, 0.2),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
        }
        
        /* Cyberpunk Glitch Text */
        .glitch-text {
            position: relative;
            color: #00ffff;
            font-weight: bold;
            text-shadow: 0 0 10px #00ffff;
            animation: glitch 2s infinite;
        }
        
        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.8;
        }
        
        .glitch-text::before {
            animation: glitchTop 1s infinite;
            clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
            color: #ff00ff;
        }
        
        .glitch-text::after {
            animation: glitchBottom 1.5s infinite;
            clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
            color: #ffff00;
        }
        
        @keyframes glitch {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
        }
        
        @keyframes glitchTop {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, -2px); }
            40% { transform: translate(-2px, 2px); }
            60% { transform: translate(2px, -2px); }
            80% { transform: translate(2px, 2px); }
        }
        
        @keyframes glitchBottom {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, 2px); }
            60% { transform: translate(-2px, -2px); }
            80% { transform: translate(2px, -2px); }
        }
        
        /* Liquid Metal Buttons */
        .liquid-button {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            color: white;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .liquid-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent
            );
            transition: left 0.5s ease;
        }
        
        .liquid-button:hover::before {
            left: 100%;
        }
        
        .liquid-button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 
                0 20px 40px rgba(102, 126, 234, 0.4),
                0 0 30px rgba(118, 75, 162, 0.3);
        }
        
        .liquid-button:active {
            transform: translateY(-1px) scale(1.02);
        }
        
        /* Data Stream Effect */
        .data-stream {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.3;
        }
        
        .data-line {
            position: absolute;
            width: 1px;
            height: 100vh;
            background: linear-gradient(
                to bottom,
                transparent,
                #00ff00,
                transparent
            );
            animation: dataStreamFlow 3s infinite linear;
        }
        
        @keyframes dataStreamFlow {
            0% { transform: translateY(-100vh); }
            100% { transform: translateY(100vh); }
        }
        
        /* Constellation Background */
        .constellation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }
        
        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: twinkle 4s infinite alternate;
        }
        
        @keyframes twinkle {
            0% { opacity: 0.3; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.5); }
        }
        
        /* Content Overlay */
        .content-overlay {
            position: relative;
            z-index: 10;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
        }
        
        /* Enhanced Animations */
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
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translateY(0);
            }
            40%, 43% {
                transform: translateY(-10px);
            }
            70% {
                transform: translateY(-5px);
            }
            90% {
                transform: translateY(-2px);
            }
        }
        
        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes slideInUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
            }
        }
        
        @keyframes rotateIn {
            from {
                transform-origin: center;
                transform: rotate3d(0, 0, 1, -200deg);
                opacity: 0;
            }
            to {
                transform-origin: center;
                transform: translate3d(0, 0, 0);
                opacity: 1;
            }
        }
        
        @keyframes heartbeat {
            0% {
                transform: scale(1);
            }
            14% {
                transform: scale(1.1);
            }
            28% {
                transform: scale(1);
            }
            42% {
                transform: scale(1.1);
            }
            70% {
                transform: scale(1);
            }
        }
        
        /* Animation Classes */
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animate-fadeInLeft {
            animation: fadeInLeft 0.8s ease-out;
        }
        
        .animate-fadeInRight {
            animation: fadeInRight 0.8s ease-out;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-bounce {
            animation: bounce 2s infinite;
        }
        
        .animate-slideInDown {
            animation: slideInDown 0.8s ease-out;
        }
        
        .animate-slideInUp {
            animation: slideInUp 0.8s ease-out;
        }
        
        .animate-zoomIn {
            animation: zoomIn 0.6s ease-out;
        }
        
        .animate-rotateIn {
            animation: rotateIn 0.8s ease-out;
        }
        
        .animate-heartbeat {
            animation: heartbeat 1.5s ease-in-out infinite;
        }
        
        /* Hover Effects */
        .hover-glow:hover {
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
        
        .hover-rotate:hover {
            transform: rotate(5deg);
            transition: transform 0.3s ease;
        }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-fadeInLeft {
            animation: fadeInLeft 0.6s ease-out;
        }
        
        .animate-fadeInRight {
            animation: fadeInRight 0.6s ease-out;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* Header Styles */
        .header {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px); /* Safari support */
            border-bottom: 1px solid rgba(0, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 255, 255, 0.2);
            position: fixed;
            -webkit-position: fixed; /* Older webkit support */
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 10000; /* Higher z-index to ensure it stays on top */
            animation: slideInDown 0.8s ease-out;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, background-color, box-shadow; /* Performance optimization */
        }
        
        /* Enhanced header when scrolled */
        .header.scrolled {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            box-shadow: 0 12px 40px rgba(0, 255, 255, 0.3);
            border-bottom: 1px solid rgba(0, 255, 255, 0.5);
            transform: translateY(0); /* Ensure no transform issues */
        }
        
        /* Loading state styles */
        .header-loading {
            opacity: 0;
            transform: translateY(-100%);
            transition: all 0.3s ease;
        }
        
        .header-loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Ensure content is not visible until header is positioned */
        body:not(.header-fixed) main {
            opacity: 0;
        }
        
        body.header-fixed main {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        .header-top {
            background: linear-gradient(90deg, #000, #001a1a, #000);
            color: #00ffff;
            padding: 0.75rem 0;
            font-size: 0.875rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
        }
        
        .header-top::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0,255,255,0.3), transparent);
            animation: shimmer 3s infinite;
        }
        
        .header-main {
            padding: 1.5rem 0;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        
        .logo {
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .logo::before {
            content: '🚀';
            position: absolute;
            left: -2.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 0 10px #00ffff);
        }
        
        .logo h1 {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite, fadeInLeft 0.8s ease-out;
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        
        .logo .tagline {
            font-size: 0.875rem;
            color: #00ffff;
            font-weight: 500;
            font-style: italic;
            animation: fadeInLeft 0.8s ease-out 0.2s backwards;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(0, 255, 255, 0.3);
            border-radius: 50px;
            padding: 0.75rem 1rem;
            margin: 1rem 0;
            box-shadow: 
                0 0 20px rgba(0, 255, 255, 0.3),
                inset 0 0 20px rgba(0, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .search-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .search-box:hover::before {
            left: 100%;
        }
        
        .search-box:focus-within {
            border-color: #00ffff;
            box-shadow: 
                0 0 30px rgba(0, 255, 255, 0.5),
                inset 0 0 20px rgba(0, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            flex: 1;
            padding: 0.5rem;
            font-size: 0.875rem;
            color: #ffffff;
            font-weight: 500;
        }
        
        .search-box input::placeholder {
            color: #666;
        }
        
        .search-box button {
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .search-box button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.3s ease;
        }
        
        .search-box button:hover::before {
            left: 100%;
        }
        
        .search-box button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        
        /* Navigation */
        .navigation {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.95), rgba(0, 26, 26, 0.9));
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 255, 255, 0.3);
            padding: 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.1);
        }
        
        .navigation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.05), transparent);
            opacity: 0.7;
            pointer-events: none;
            animation: shimmer 3s infinite linear;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }
        
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 0;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .nav-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-brand .brand-icon {
            font-size: 1.5rem;
            animation: pulse 2s infinite;
            filter: drop-shadow(0 0 10px #00ffff);
        }
        
        .nav-brand .brand-text {
            font-size: 1.2rem;
            font-weight: 700;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientMove 3s ease infinite;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .nav-links {
            display: flex;
            gap: 0.75rem;
            list-style: none;
            margin: 0;
            padding: 1rem 0;
        }
        
        .nav-links li {
            position: relative;
        }
        
        .nav-links a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.75rem 1.25rem;
            border-radius: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(0, 255, 255, 0.2);
            background: rgba(0, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            text-shadow: 0 0 8px rgba(0, 255, 255, 0.3);
            white-space: nowrap;
        }
        
        .nav-links a .nav-icon {
            font-size: 1rem;
            transition: all 0.3s ease;
            filter: drop-shadow(0 0 5px currentColor);
        }
        
        .nav-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
            transition: left 0.4s ease;
            z-index: -1;
        }
        
        .nav-links a:hover::before {
            left: 0;
        }
        
        .nav-links a:hover {
            color: white;
            transform: translateY(-2px) scale(1.02);
            box-shadow: 
                0 8px 25px rgba(0, 255, 255, 0.4),
                0 0 20px rgba(255, 0, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 0, 255, 0.5);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
        
        .nav-links a:hover .nav-icon {
            transform: scale(1.2) rotate(10deg);
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.8));
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00ffff, #ff00ff, #ffff00);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 1px;
            box-shadow: 0 0 8px rgba(0, 255, 255, 0.5);
        }
        
        .nav-links a:hover::after {
            width: 90%;
        }
        
        /* Active Link Styling */
        .nav-links a.active {
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.1), rgba(255, 0, 255, 0.1));
            border-color: rgba(0, 255, 255, 0.5);
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .nav-links a.active::after {
            width: 90%;
            background: linear-gradient(90deg, #00ffff, #ff00ff);
        }
        
        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(0, 255, 255, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .mobile-menu-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.1), rgba(255, 0, 255, 0.1));
            transition: left 0.3s ease;
            z-index: -1;
        }
        
        .mobile-menu-toggle:hover::before {
            left: 0;
        }
        
        .mobile-menu-toggle:hover {
            background: rgba(0, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            transform: scale(1.05);
        }
        
        .hamburger-line {
            width: 24px;
            height: 2px;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border-radius: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
        }
        
        .mobile-menu-toggle.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
            box-shadow: 0 0 10px rgba(255, 0, 255, 0.8);
        }
        
        .mobile-menu-toggle.active .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }
        
        .mobile-menu-toggle.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
            box-shadow: 0 0 10px rgba(255, 0, 255, 0.8);
        }
        
        .mobile-menu {
            display: none;
            position: fixed; /* Changed to fixed for better positioning with fixed header */
            top: var(--header-height, 160px); /* Position below the fixed header */
            left: 0;
            right: 0;
            width: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.98), rgba(0, 26, 26, 0.95));
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0, 255, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: slideDown 0.3s ease;
            max-height: calc(100vh - var(--header-height, 160px));
            overflow-y: auto;
            z-index: 9999; /* Just below the header */
            transform: translateY(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .mobile-menu.active {
            display: block;
            transform: translateY(0);
        }
        
        .mobile-nav-links {
            list-style: none;
            padding: 1rem;
            margin: 0;
        }
        
        .mobile-nav-links li {
            margin-bottom: 0.5rem;
        }
        
        .mobile-nav-links a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 255, 255, 0.1);
            background: rgba(0, 255, 255, 0.02);
            position: relative;
            overflow: hidden;
        }
        
        .mobile-nav-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 255, 255, 0.1), rgba(255, 0, 255, 0.1));
            transition: left 0.3s ease;
            z-index: -1;
        }
        
        .mobile-nav-links a:hover::before {
            left: 0;
        }
        
        .mobile-nav-links a:hover {
            background: rgba(0, 255, 255, 0.1);
            border-color: rgba(0, 255, 255, 0.3);
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0, 255, 255, 0.2);
            color: #fff;
        }
        
        .mobile-nav-links a .nav-icon {
            font-size: 1.25rem;
            min-width: 24px;
            transition: all 0.3s ease;
            filter: drop-shadow(0 0 5px currentColor);
        }
        
        .mobile-nav-links a:hover .nav-icon {
            transform: scale(1.2) rotate(10deg);
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.8));
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .nav-brand .brand-text {
                font-size: 1rem;
            }
            
            .nav-brand .brand-icon {
                font-size: 1.25rem;
            }
        }
        
        @media (max-width: 1024px) {
            .nav-links {
                gap: 0.5rem;
            }
            
            .nav-links a {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
            
            .nav-links a span:not(.nav-icon) {
                display: none;
            }
            
            .nav-links a .nav-icon {
                font-size: 1.1rem;
            }
        }
        
        @media (min-width: 1025px) {
            .nav-links a span:not(.nav-icon) {
                display: inline;
            }
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% { 
                opacity: 1; 
                transform: scale(1);
            }
            50% { 
                opacity: 0.7; 
                transform: scale(1.05);
            }
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Featured Jobs */
        .featured-jobs {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .featured-jobs::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 20%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .featured-item {
            background: var(--bg-gradient);
            padding: 2rem;
            border-radius: 20px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .featured-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .featured-item:hover::before {
            left: 100%;
        }
        
        .featured-item::after {
            content: '✨';
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            opacity: 0.7;
            animation: float 3s ease-in-out infinite;
        }
        
        .featured-item h3 {
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .featured-item h3 a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.4;
            display: block;
        }
        
        .featured-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-2xl);
        }
        
        .featured-item:nth-child(odd) {
            animation: fadeInLeft 0.8s ease-out;
        }
        
        .featured-item:nth-child(even) {
            animation: fadeInRight 0.8s ease-out;
        }
        
        /* Social Section */
        .social-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .social-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .social-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .social-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .social-item:hover::before {
            transform: translateX(100%);
        }
        
        .social-item.whatsapp {
            border-left: 4px solid #25d366;
        }
        
        .social-item.whatsapp:hover {
            background: linear-gradient(135deg, rgba(37, 211, 102, 0.1), rgba(255, 255, 255, 0.9));
        }
        
        .social-item.telegram {
            border-left: 4px solid #0088cc;
        }
        
        .social-item.telegram:hover {
            background: linear-gradient(135deg, rgba(0, 136, 204, 0.1), rgba(255, 255, 255, 0.9));
        }
        
        .social-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }
        
        .social-icon {
            font-size: 2.5rem;
            animation: pulse 2s infinite;
        }
        
        .social-item h4 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .social-item p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        
        .btn-join {
            background: var(--bg-gradient);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .btn-join::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.3s ease;
        }
        
        .btn-join:hover::before {
            left: 100%;
        }
        
        .btn-join:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        .social-item.telegram {
            border-color: #0088cc;
        }
        
        .social-icon {
            font-size: 2rem;
        }
        
        .btn-join {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Popular Jobs */
        .popular-jobs {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .popular-jobs::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 30%, rgba(102, 126, 234, 0.05) 0%, transparent 70%),
                        radial-gradient(circle at 70% 70%, rgba(139, 92, 246, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--bg-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 100px;
            height: 4px;
            background: var(--bg-gradient);
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .popular-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .popular-item {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        
        .popular-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--bg-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .popular-item:hover::before {
            opacity: 0.05;
        }
        
        .popular-item::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.6s ease;
        }
        
        .popular-item:hover::after {
            transform: scale(1);
        }
        
        .popular-item:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-2xl);
            border-color: var(--primary-color);
        }
        
        .popular-item:nth-child(1) { animation: fadeInUp 0.8s ease-out 0.1s backwards; }
        .popular-item:nth-child(2) { animation: fadeInUp 0.8s ease-out 0.2s backwards; }
        .popular-item:nth-child(3) { animation: fadeInUp 0.8s ease-out 0.3s backwards; }
        .popular-item:nth-child(4) { animation: fadeInUp 0.8s ease-out 0.4s backwards; }
        
        /* Main Content */
        .main-content {
            background: rgba(248, 250, 252, 0.9);
            backdrop-filter: blur(10px);
            padding: 3rem 0;
            position: relative;
        }
        
        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 0%, rgba(102, 126, 234, 0.02) 25%, transparent 50%, rgba(139, 92, 246, 0.02) 75%, transparent 100%);
            pointer-events: none;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            position: relative;
            z-index: 1;
        }
        
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--bg-gradient);
        }
        
        .content-section:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }
        
        .content-section .section-title {
            background: var(--bg-gradient);
            color: white;
            padding: 1.5rem;
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            text-align: left;
            border: none;
            position: relative;
            overflow: hidden;
        }
        
        .content-section .section-title::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 3s infinite;
        }
        
        .content-section .section-title::after {
            content: '📋';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }
        
        .job-list {
            padding: 0;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .job-list::-webkit-scrollbar {
            width: 4px;
        }
        
        .job-list::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }
        
        .job-list::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 2px;
        }
        
        .job-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .job-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-color);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .job-item:hover::before {
            transform: scaleY(1);
        }
        
        .job-item:last-child {
            border-bottom: none;
        }
        
        .job-item h4 {
            margin-bottom: 0.5rem;
        }
        
        .job-item h4 a {
            color: var(--text-primary);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
            display: block;
        }
        
        .job-item .job-meta {
            font-size: 0.8rem;
            color: var(--text-light);
            display: flex;
            gap: 1rem;
            margin-top: 0.25rem;
        }
        
        .job-item:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(255, 255, 255, 0.9));
            transform: translateX(5px);
        }
        
        .job-item:hover h4 a {
            color: var(--primary-color);
        }
        
        .view-more {
            padding: 1.5rem;
            text-align: center;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .btn-view-more {
            background: var(--bg-gradient);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
        }
        
        .btn-view-more::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.3s ease;
        }
        
        .btn-view-more:hover::before {
            left: 100%;
        }
        
        .btn-view-more:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #000 0%, #001a1a 50%, #000 100%);
            color: #00ffff;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
            border-top: 2px solid rgba(0, 255, 255, 0.3);
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 0, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #00ffff, #ff00ff, #ffff00, #00ffff);
            background-size: 200% 100%;
            animation: gradientShift 3s linear infinite;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .footer-section {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .footer-section h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #00ffff;
            position: relative;
            padding-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }
        
        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #00ffff, #ff00ff);
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.75rem;
            transition: transform 0.3s ease;
        }
        
        .footer-section ul li:hover {
            transform: translateX(5px);
        }
        
        .footer-section ul li a {
            color: #66ffff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            text-shadow: 0 0 5px rgba(102, 255, 255, 0.3);
        }
        
        .footer-section ul li a::before {
            content: '▶';
            opacity: 0;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
            transform: translateX(-10px);
            color: #ff00ff;
        }
        
        .footer-section ul li a:hover::before {
            opacity: 1;
            transform: translateX(0);
        }
        
        .footer-section ul li a:hover {
            color: #ffffff;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
            transform: scale(1.05);
        }
        
        .footer-section p {
            color: #66ffff;
            font-size: 0.9rem;
            line-height: 1.6;
            text-align: justify;
            text-shadow: 0 0 5px rgba(102, 255, 255, 0.3);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(0, 255, 255, 0.3);
            padding-top: 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .footer-bottom p {
            font-size: 0.875rem;
            color: #66ffff;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 5px rgba(102, 255, 255, 0.3);
        }
        
        .footer-bottom p:first-child {
            font-weight: 600;
            color: #d1d5db;
        }
        
        /* ULTRA FANCY FEATURES */
        
        /* 3D Holographic Cards */
        .holographic-card {
            position: relative;
            background: linear-gradient(45deg, 
                rgba(255,0,150,0.1) 0%, 
                rgba(0,255,255,0.1) 25%, 
                rgba(255,255,0,0.1) 50%, 
                rgba(255,0,150,0.1) 75%, 
                rgba(0,255,255,0.1) 100%);
            background-size: 400% 400%;
            animation: holographic 3s ease infinite;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(20px);
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        
        @keyframes holographic {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .holographic-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff0096, #00ffff, #ffff00, #ff0096);
            background-size: 400% 400%;
            animation: holographic 3s ease infinite;
            z-index: -1;
            border-radius: inherit;
            filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .holographic-card:hover::before {
            opacity: 0.7;
        }
        
        /* Cyberpunk Neon Effects */
        .cyber-glow {
            position: relative;
            color: #00ffff;
            text-shadow: 
                0 0 5px #00ffff,
                0 0 10px #00ffff,
                0 0 15px #00ffff,
                0 0 20px #00ffff,
                0 0 35px #00ffff,
                0 0 40px #00ffff;
            animation: cyber-flicker 0.15s infinite linear;
        }
        
        @keyframes cyber-flicker {
            0%, 19.999%, 22%, 62.999%, 64%, 64.999%, 70%, 100% {
                text-shadow: 
                    0 0 5px #00ffff,
                    0 0 10px #00ffff,
                    0 0 15px #00ffff,
                    0 0 20px #00ffff,
                    0 0 35px #00ffff,
                    0 0 40px #00ffff;
            }
            20%, 21.999%, 63%, 63.999%, 65%, 69.999% {
                text-shadow: none;
            }
        }
        
        /* Matrix Rain Effect */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -2;
            opacity: 0.1;
        }
        
        .matrix-column {
            position: absolute;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            font-size: 18px;
            animation: matrix-fall linear infinite;
        }
        
        @keyframes matrix-fall {
            to {
                transform: translateY(100vh);
            }
        }
        
        /* Liquid Morphing Buttons */
        .liquid-button {
            position: relative;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            color: white;
            font-weight: 600;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .liquid-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            border-radius: 50%;
            transition: all 0.6s ease;
            transform: translate(-50%, -50%);
        }
        
        .liquid-button:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .liquid-button:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }
        
        /* Particle Explosion Effect */
        .particle-explosion {
            position: relative;
            overflow: hidden;
        }
        
        .particle-explosion::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: radial-gradient(circle, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #dda0dd);
            opacity: 0;
            transform: translate(-50%, -50%) scale(0);
            animation: particle-burst 0.8s ease-out;
        }
        
        @keyframes particle-burst {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(0);
            }
            50% {
                opacity: 0.8;
                transform: translate(-50%, -50%) scale(5);
            }
            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(10);
            }
        }
        
        /* 3D Floating Elements */
        .floating-3d {
            transform-style: preserve-3d;
            animation: float-3d 6s ease-in-out infinite;
        }
        
        @keyframes float-3d {
            0%, 100% {
                transform: translateY(0px) rotateX(0deg) rotateY(0deg);
            }
            33% {
                transform: translateY(-20px) rotateX(10deg) rotateY(5deg);
            }
            66% {
                transform: translateY(-10px) rotateX(-5deg) rotateY(-10deg);
            }
        }
        
        /* Aurora Borealis Background */
        .aurora-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(ellipse at top, rgba(0, 255, 150, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at bottom left, rgba(255, 0, 150, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at bottom right, rgba(0, 150, 255, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at center, rgba(255, 255, 0, 0.05) 0%, transparent 50%);
            animation: aurora-dance 20s ease infinite;
            pointer-events: none;
            z-index: -3;
        }
        
        @keyframes aurora-dance {
            0%, 100% { opacity: 0.3; transform: scale(1) rotate(0deg); }
            25% { opacity: 0.6; transform: scale(1.1) rotate(90deg); }
            50% { opacity: 0.4; transform: scale(0.9) rotate(180deg); }
            75% { opacity: 0.7; transform: scale(1.2) rotate(270deg); }
        }
        
        /* Prismatic Text Effect */
        .prismatic-text {
            background: linear-gradient(45deg, 
                #ff0000 0%, #ff8000 14%, #ffff00 28%, 
                #80ff00 42%, #00ff00 57%, #00ff80 71%, 
                #00ffff 85%, #0080ff 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: prismatic 3s ease infinite;
            font-weight: 800;
            text-shadow: 0 0 30px rgba(255,255,255,0.5);
        }
        
        @keyframes prismatic {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Quantum Glitch Effect */
        .glitch-text {
            position: relative;
            font-weight: 700;
            animation: glitch-skew 1s ease infinite;
        }
        
        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch-text::before {
            animation: glitch-anim-1 0.6s infinite linear alternate-reverse;
            color: #ff0000;
            z-index: -1;
        }
        
        .glitch-text::after {
            animation: glitch-anim-2 0.6s infinite linear alternate-reverse;
            color: #00ffff;
            z-index: -2;
        }
        
        @keyframes glitch-anim-1 {
            0% { clip: rect(36px, 9999px, 54px, 0); }
            25% { clip: rect(25px, 9999px, 99px, 0); }
            50% { clip: rect(50px, 9999px, 36px, 0); }
            75% { clip: rect(70px, 9999px, 85px, 0); }
            100% { clip: rect(28px, 9999px, 91px, 0); }
        }
        
        @keyframes glitch-anim-2 {
            0% { clip: rect(65px, 9999px, 119px, 0); }
            25% { clip: rect(90px, 9999px, 78px, 0); }
            50% { clip: rect(40px, 9999px, 105px, 0); }
            75% { clip: rect(80px, 9999px, 15px, 0); }
            100% { clip: rect(60px, 9999px, 35px, 0); }
        }
        
        @keyframes glitch-skew {
            0% { transform: skew(0deg); }
            10% { transform: skew(-2deg); }
            20% { transform: skew(1deg); }
            30% { transform: skew(-1deg); }
            40% { transform: skew(2deg); }
            50% { transform: skew(-1deg); }
            60% { transform: skew(0deg); }
            70% { transform: skew(1deg); }
            80% { transform: skew(-2deg); }
            90% { transform: skew(1deg); }
            100% { transform: skew(0deg); }
        }
        
        /* Geometric Morphing Shapes */
        .morphing-shape {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #ff6b6b);
            background-size: 400% 400%;
            animation: morph-shape 8s ease infinite, morph-bg 3s ease infinite;
            position: absolute;
            opacity: 0.3;
        }
        
        @keyframes morph-shape {
            0%, 100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(0deg);
            }
            25% {
                border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
                transform: rotate(90deg);
            }
            50% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
                transform: rotate(180deg);
            }
            75% {
                border-radius: 20% 80% 80% 20% / 20% 20% 80% 80%;
                transform: rotate(270deg);
            }
        }
        
        @keyframes morph-bg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Crystalline Effect */
        .crystal-effect {
            position: relative;
            background: linear-gradient(45deg, 
                rgba(255,255,255,0.1) 0%, 
                rgba(255,255,255,0.3) 50%, 
                rgba(255,255,255,0.1) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 
                0 8px 32px rgba(0,0,0,0.1),
                inset 0 1px 0 rgba(255,255,255,0.2),
                inset 0 -1px 0 rgba(0,0,0,0.1);
        }
        
        .crystal-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255,255,255,0.4), 
                transparent);
            animation: crystal-shine 3s infinite;
        }
        
        @keyframes crystal-shine {
            0% { left: -100%; }
            50% { left: 100%; }
            100% { left: 100%; }
        }
        
        /* Magnetic Field Effect */
        .magnetic-field {
            position: relative;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }
        
        .magnetic-field:hover {
            transform: scale(1.05);
        }
        
        .magnetic-field::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, 
                rgba(102, 126, 234, 0.1) 0%, 
                rgba(102, 126, 234, 0.05) 30%, 
                transparent 70%);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.320, 1);
            pointer-events: none;
        }
        
        .magnetic-field:hover::after {
            transform: scale(1);
        }
        
        /* Fallback for no-js scenarios */
        .no-js .header {
            position: relative;
        }
        
        .no-js body {
            padding-top: 0 !important;
        }
        
        .no-js main {
            opacity: 1 !important;
        }
    </style>
</head>
<body>
    <!-- Neural Network Background -->
    <div class="neural-background">
        <div class="neural-nodes" id="neural-nodes"></div>
        <div class="constellation" id="constellation"></div>
    </div>
    
    <!-- Quantum Particle System -->
    <div class="quantum-particles" id="quantum-particles"></div>
    
    <!-- Data Stream -->
    <div class="data-stream" id="data-stream"></div>
    
    <!-- Content Overlay -->
    <div class="content-overlay">
    
    <!-- Aurora Borealis Background -->
    <div class="aurora-bg"></div>
    
    <!-- Matrix Rain Background -->
    <div class="matrix-bg" id="matrix-bg"></div>
    
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator"></div>
    
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape morphing-shape" style="top: 10%; left: 10%;"></div>
        <div class="shape morphing-shape" style="top: 20%; right: 10%; animation-delay: 2s;"></div>
        <div class="shape morphing-shape" style="bottom: 10%; left: 20%; animation-delay: 4s;"></div>
        <div class="shape morphing-shape" style="bottom: 20%; right: 20%; animation-delay: 6s;"></div>
    </div>
    <!-- Header -->
    <header class="header animate-slideInDown">
        <div class="header-top">
            <div class="container">
                <div style="text-align: center; position: relative; z-index: 1;">
                    🌟 WhatsApp Channel | � Telegram Group | 📢 Follow us for latest updates
                </div>
            </div>
        </div>
        
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <h1 class="animate-fadeInLeft">Sarkari Result</h1>
                        <span class="tagline animate-fadeInLeft">✨ Trusted Portal Since 2014 ✨</span>
                    </div>
                    
                    <div style="flex: 1; max-width: 450px;">
                        <div class="search-box animate-zoomIn">
                            <input type="text" placeholder="🔍 Search Jobs, Results, Admit Cards...">
                            <button type="submit">🚀 Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navigation">
            <div class="nav-container">
                <div class="nav-brand">
                    <span class="brand-icon">🚀</span>
                    <span class="brand-text">Sarkari Result</span>
                </div>
                
                <ul class="nav-links">
                    <li><a href="/" class="animate-fadeInUp">
                        <span class="nav-icon">🏠</span>
                        <span>Home</span>
                    </a></li>
                    <li><a href="/jobs" class="animate-fadeInUp">
                        <span class="nav-icon">💼</span>
                        <span>Latest Jobs</span>
                    </a></li>
                    <li><a href="/results" class="animate-fadeInUp">
                        <span class="nav-icon">📊</span>
                        <span>Results</span>
                    </a></li>
                    <li><a href="/admit-cards" class="animate-fadeInUp">
                        <span class="nav-icon">🎫</span>
                        <span>Admit Cards</span>
                    </a></li>
                    <li><a href="/admissions" class="animate-fadeInUp">
                        <span class="nav-icon">🎓</span>
                        <span>Admissions</span>
                    </a></li>
                    <li><a href="/answer-keys" class="animate-fadeInUp">
                        <span class="nav-icon">🔑</span>
                        <span>Answer Keys</span>
                    </a></li>
                    <li><a href="/syllabus" class="animate-fadeInUp">
                        <span class="nav-icon">📚</span>
                        <span>Syllabus</span>
                    </a></li>
                    <li><a href="/sarkari-yojana" class="animate-fadeInUp">
                        <span class="nav-icon">🏛️</span>
                        <span>Sarkari Yojana</span>
                    </a></li>
                </ul>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                </button>
                
                <div class="mobile-menu" id="mobileMenu">
                    <ul class="mobile-nav-links">
                        <li><a href="/">
                            <span class="nav-icon">🏠</span>
                            <span>Home</span>
                        </a></li>
                        <li><a href="/jobs">
                            <span class="nav-icon">💼</span>
                            <span>Latest Jobs</span>
                        </a></li>
                        <li><a href="/results">
                            <span class="nav-icon">📊</span>
                            <span>Results</span>
                        </a></li>
                        <li><a href="/admit-cards">
                            <span class="nav-icon">🎫</span>
                            <span>Admit Cards</span>
                        </a></li>
                        <li><a href="/admissions">
                            <span class="nav-icon">�</span>
                            <span>Admissions</span>
                        </a></li>
                        <li><a href="/answer-keys">
                            <span class="nav-icon">🔑</span>
                            <span>Answer Keys</span>
                        </a></li>
                        <li><a href="/syllabus">
                            <span class="nav-icon">📚</span>
                            <span>Syllabus</span>
                        </a></li>
                        <li><a href="/sarkari-yojana">
                            <span class="nav-icon">�🏛️</span>
                            <span>Sarkari Yojana</span>
                        </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="/results">Latest Result</a></li>
                        <li><a href="/jobs">Latest Jobs</a></li>
                        <li><a href="/admit-cards">Admit Card</a></li>
                        <li><a href="/regular-form">Regular Form</a></li>
                        <li><a href="/admissions">Admission</a></li>
                        <li><a href="/answer-keys">Answer Key</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact Us</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/disclaimer">Disclaimer</a></li>
                        <li><a href="/terms">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#">WhatsApp Channel</a></li>
                        <li><a href="#">Telegram Group</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>About Sarkari Result</h4>
                    <p style="color: #d1d5db; font-size: 0.875rem; line-height: 1.6;">
                        Sarkari Result provides all the latest government job notifications, 
                        results, admit cards, and exam updates. Your trusted portal for 
                        government job information since 2014.
                    </p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SarkariResult.com | All rights reserved</p>
                <p>Disclaimer: This is not a government website. We only provide information about government jobs.</p>
            </div>
        </div>
    </footer>

    </div> <!-- End content overlay -->

    <script>
        // Neural Network Background System
        class NeuralNetwork {
            constructor() {
                this.container = document.getElementById('neural-nodes');
                this.nodes = [];
                this.connections = [];
                this.init();
            }
            
            init() {
                this.createNodes();
                this.createConnections();
                this.animate();
            }
            
            createNodes() {
                const nodeCount = 50;
                for (let i = 0; i < nodeCount; i++) {
                    const node = document.createElement('div');
                    node.className = 'neural-node';
                    node.style.left = Math.random() * 100 + '%';
                    node.style.top = Math.random() * 100 + '%';
                    node.style.animationDelay = Math.random() * 3 + 's';
                    this.container.appendChild(node);
                    this.nodes.push({
                        element: node,
                        x: parseFloat(node.style.left),
                        y: parseFloat(node.style.top)
                    });
                }
            }
            
            createConnections() {
                for (let i = 0; i < this.nodes.length; i++) {
                    for (let j = i + 1; j < this.nodes.length; j++) {
                        const distance = Math.sqrt(
                            Math.pow(this.nodes[i].x - this.nodes[j].x, 2) +
                            Math.pow(this.nodes[i].y - this.nodes[j].y, 2)
                        );
                        
                        if (distance < 20) {
                            const connection = document.createElement('div');
                            connection.className = 'neural-connection';
                            const angle = Math.atan2(
                                this.nodes[j].y - this.nodes[i].y,
                                this.nodes[j].x - this.nodes[i].x
                            ) * 180 / Math.PI;
                            
                            connection.style.left = this.nodes[i].x + '%';
                            connection.style.top = this.nodes[i].y + '%';
                            connection.style.width = distance + 'vw';
                            connection.style.transform = `rotate(${angle}deg)`;
                            connection.style.animationDelay = Math.random() * 2 + 's';
                            
                            this.container.appendChild(connection);
                        }
                    }
                }
            }
            
            animate() {
                // Continuous neural network animation
                setInterval(() => {
                    this.nodes.forEach(node => {
                        const pulse = document.createElement('div');
                        pulse.style.cssText = `
                            position: absolute;
                            width: 10px;
                            height: 10px;
                            background: radial-gradient(circle, #00ffff, transparent);
                            border-radius: 50%;
                            left: ${node.x}%;
                            top: ${node.y}%;
                            animation: neuralPulse 2s ease-out forwards;
                            pointer-events: none;
                        `;
                        this.container.appendChild(pulse);
                        
                        setTimeout(() => pulse.remove(), 2000);
                    });
                }, 5000);
            }
        }
        
        // Quantum Particle System
        class QuantumParticleSystem {
            constructor() {
                this.container = document.getElementById('quantum-particles');
                this.particleCount = 30;
                this.init();
            }
            
            init() {
                this.createParticles();
            }
            
            createParticles() {
                setInterval(() => {
                    for (let i = 0; i < 3; i++) {
                        this.createParticle();
                    }
                }, 1000);
            }
            
            createParticle() {
                const particle = document.createElement('div');
                particle.className = 'quantum-particle';
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.animationDuration = (Math.random() * 5 + 5) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                
                // Random colors for quantum effect
                const colors = ['#ff00ff', '#00ffff', '#ffff00', '#ff0080', '#0080ff'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                particle.style.background = color;
                particle.style.boxShadow = `0 0 6px ${color}`;
                
                this.container.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.remove();
                    }
                }, 10000);
            }
        }
        
        // Data Stream Effect
        class DataStream {
            constructor() {
                this.container = document.getElementById('data-stream');
                this.streamCount = 15;
                this.init();
            }
            
            init() {
                this.createStreams();
            }
            
            createStreams() {
                for (let i = 0; i < this.streamCount; i++) {
                    const stream = document.createElement('div');
                    stream.className = 'data-line';
                    stream.style.left = (Math.random() * 100) + '%';
                    stream.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    stream.style.animationDelay = Math.random() * 3 + 's';
                    stream.style.opacity = Math.random() * 0.5 + 0.2;
                    this.container.appendChild(stream);
                }
            }
        }
        
        // Constellation Background
        class Constellation {
            constructor() {
                this.container = document.getElementById('constellation');
                this.starCount = 100;
                this.init();
            }
            
            init() {
                this.createStars();
            }
            
            createStars() {
                for (let i = 0; i < this.starCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.style.left = Math.random() * 100 + '%';
                    star.style.top = Math.random() * 100 + '%';
                    star.style.animationDelay = Math.random() * 4 + 's';
                    star.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    
                    // Vary star sizes
                    const size = Math.random() * 3 + 1;
                    star.style.width = size + 'px';
                    star.style.height = size + 'px';
                    
                    this.container.appendChild(star);
                }
            }
        }
        
        // Enhanced Holographic Card Effects
        function enhanceCards() {
            const cards = document.querySelectorAll('.holo-card, .content-section, .popular-item, .featured-item');
            
            cards.forEach(card => {
                // Add holographic class
                card.classList.add('holo-card');
                
                // Mouse tracking for 3D effect
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 8;
                    const rotateY = (centerX - x) / 8;
                    
                    card.style.transform = `
                        perspective(1000px) 
                        rotateX(${rotateX}deg) 
                        rotateY(${rotateY}deg) 
                        translateZ(20px)
                        scale3d(1.02, 1.02, 1.02)
                    `;
                    
                    // Add dynamic glow based on mouse position
                    const glowX = (x / rect.width) * 100;
                    const glowY = (y / rect.height) * 100;
                    card.style.background = `
                        radial-gradient(circle at ${glowX}% ${glowY}%, 
                        rgba(255,255,255,0.15) 0%, 
                        rgba(255,255,255,0.05) 50%, 
                        transparent 100%),
                        rgba(255, 255, 255, 0.1)
                    `;
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                    card.style.background = '';
                });
            });
        }
        
        // Enhanced Button Effects
        function enhanceButtons() {
            const buttons = document.querySelectorAll('.liquid-button, .btn-join, .btn-view-more, .search-box button');
            
            buttons.forEach(button => {
                button.classList.add('liquid-button');
                
                // Ripple effect
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
            
            // Add ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        // Glitch Text Effect
        function addGlitchEffect() {
            const titles = document.querySelectorAll('h1, h2, .logo h1');
            
            titles.forEach(title => {
                title.classList.add('glitch-text');
                title.setAttribute('data-text', title.textContent);
                
                // Random glitch activation
                setInterval(() => {
                    if (Math.random() < 0.1) {
                        title.style.animation = 'glitch 0.3s ease-in-out';
                        setTimeout(() => {
                            title.style.animation = '';
                        }, 300);
                    }
                }, 3000);
            });
        }
        
        // Initialize all effects
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize background systems
            new NeuralNetwork();
            new QuantumParticleSystem();
            new DataStream();
            new Constellation();
            
            // Enhanced effects
            enhanceCards();
            enhanceButtons();
            addGlitchEffect();
            
            // Performance optimization
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            if (reduceMotion.matches) {
                document.body.style.animation = 'none';
                document.querySelectorAll('*').forEach(el => {
                    el.style.animation = 'none';
                    el.style.transition = 'none';
                });
            }
        });
        // Scroll Progress Indicator
        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
            const clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
            const scrolled = (scrollTop / (scrollHeight - clientHeight)) * 100;
            
            const indicator = document.querySelector('.scroll-indicator');
            if (indicator) {
                indicator.style.transform = `scaleX(${scrolled / 100})`;
            }
        });
        
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Observe all content sections
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.content-section, .popular-item, .featured-item, .social-item');
            animatedElements.forEach(el => {
                el.classList.add('slide-in-on-scroll');
                observer.observe(el);
            });
        });
        
        // Add sparkle effect to buttons
        function createSparkle(e) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: white;
                border-radius: 50%;
                pointer-events: none;
                left: ${e.offsetX}px;
                top: ${e.offsetY}px;
                animation: sparkle-animation 0.6s ease-out forwards;
            `;
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes sparkle-animation {
                    0% { opacity: 1; transform: scale(0); }
                    50% { opacity: 1; transform: scale(1); }
                    100% { opacity: 0; transform: scale(0) translateY(-20px); }
                }
            `;
            document.head.appendChild(style);
            
            e.target.style.position = 'relative';
            e.target.appendChild(sparkle);
            
            setTimeout(() => {
                sparkle.remove();
            }, 600);
        }
        
        // Add sparkle effect to all buttons
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.btn-join, .btn-view-more, .search-box button');
            buttons.forEach(button => {
                button.addEventListener('click', createSparkle);
            });
        });
        
        // Magnetic button effect
        document.addEventListener('DOMContentLoaded', () => {
            const magneticElements = document.querySelectorAll('.btn-join, .btn-view-more');
            
            magneticElements.forEach(element => {
                element.classList.add('magnetic-button');
                
                element.addEventListener('mousemove', (e) => {
                    const rect = element.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    
                    element.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
                });
                
                element.addEventListener('mouseleave', () => {
                    element.style.transform = '';
                });
            });
        });
        
        // Add tilt effect to cards
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.content-section, .popular-item, .featured-item');
            
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;
                    
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                });
            });
        });
        
        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('a[href^="#"]');
            const header = document.querySelector('.header');
            
            links.forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    if (href === '#') return;
                    
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const headerHeight = header ? header.offsetHeight : 0;
                        const targetPosition = target.offsetTop - headerHeight - 20; // 20px extra padding
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
        
        // Mobile Menu Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const body = document.body;
            
            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    const isActive = mobileMenuToggle.classList.contains('active');
                    
                    if (isActive) {
                        // Close menu
                        mobileMenuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        body.style.overflow = '';
                    } else {
                        // Open menu
                        mobileMenuToggle.classList.add('active');
                        mobileMenu.classList.add('active');
                        body.style.overflow = 'hidden';
                    }
                });
                
                // Close menu when clicking on a link
                const mobileNavLinks = mobileMenu.querySelectorAll('a');
                mobileNavLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        body.style.overflow = '';
                    });
                });
                
                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                        mobileMenuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        body.style.overflow = '';
                    }
                });
                
                // Close menu on window resize if mobile menu is open
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 768) {
                        mobileMenuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        body.style.overflow = '';
                    }
                });
            }
        });
        
        // Enhanced Navigation Effects
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-links a, .mobile-nav-links a');
            
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    // Add ripple effect on hover
                    const ripple = document.createElement('div');
                    ripple.style.cssText = `
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 0;
                        height: 0;
                        background: radial-gradient(circle, rgba(0,255,255,0.3) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: translate(-50%, -50%);
                        animation: rippleEffect 0.6s ease-out;
                        pointer-events: none;
                        z-index: -1;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                });
            });
            
            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes rippleEffect {
                    to {
                        width: 200px;
                        height: 200px;
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
        
        // Fixed Header Management with Performance Optimizations
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.header');
            const body = document.body;
            const mobileMenu = document.getElementById('mobileMenu');
            
            // Remove no-js class and add loading state
            document.documentElement.classList.remove('no-js');
            if (header) {
                header.classList.add('header-loading');
            }
            
            function setHeaderOffset() {
                if (header) {
                    const headerHeight = header.offsetHeight;
                    body.style.setProperty('--header-height', headerHeight + 'px');
                    body.classList.add('header-fixed');
                    body.style.paddingTop = headerHeight + 'px';
                    
                    // Update mobile menu position if it exists
                    if (mobileMenu) {
                        mobileMenu.style.top = headerHeight + 'px';
                        mobileMenu.style.maxHeight = `calc(100vh - ${headerHeight}px)`;
                    }
                    
                    // Remove loading state and show header
                    setTimeout(() => {
                        header.classList.remove('header-loading');
                        header.classList.add('header-loaded');
                    }, 100);
                }
            }
            
            // Set initial offset
            setHeaderOffset();
            
            // Throttled resize handler for better performance
            let resizeTimeout;
            let isResizing = false;
            
            window.addEventListener('resize', function() {
                if (!isResizing) {
                    isResizing = true;
                    requestAnimationFrame(function() {
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(function() {
                            setHeaderOffset();
                            isResizing = false;
                        }, 100);
                    });
                }
            });
            
            // Enhanced scroll behavior with throttling
            let lastScrollTop = 0;
            let isScrolling = false;
            let scrollTimer = null;
            
            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Add/remove scroll class for enhanced effects
                if (scrollTop > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                
                // Close mobile menu on scroll if open
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
                    if (mobileMenuToggle) {
                        mobileMenuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        body.style.overflow = '';
                    }
                }
                
                lastScrollTop = scrollTop;
                isScrolling = false;
            }
            
            window.addEventListener('scroll', function() {
                if (!isScrolling) {
                    requestAnimationFrame(handleScroll);
                    isScrolling = true;
                }
            }, { passive: true }); // Passive listener for better performance
            
            // Handle orientation change on mobile devices
            window.addEventListener('orientationchange', function() {
                setTimeout(setHeaderOffset, 100);
            });
            
            // Fallback for older browsers
            if (!window.requestAnimationFrame) {
                window.requestAnimationFrame = function(callback) {
                    return setTimeout(callback, 16);
                };
            }
            
            // Additional safety check for header visibility
            setTimeout(() => {
                if (header && !header.classList.contains('header-loaded')) {
                    header.classList.remove('header-loading');
                    header.classList.add('header-loaded');
                }
            }, 1000);
        });
    </script>
</body>
</html>
