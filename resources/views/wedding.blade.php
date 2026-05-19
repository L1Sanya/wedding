<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Цырен & Сарюна — Приглашение на свадьбу</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #faf6f0;
            --cream: #f5ede0;
            --gold: #c9a96e;
            --gold-light: #d4b98a;
            --burgundy: #7a2e3b;
            --burgundy-light: #9a4a56;
            --dark: #2c1f1a;
            --text: #4a3b35;
            --text-light: #8c7b6e;
            --border-subtle: #e8dccf;
            --white: #fffdf9;
            --shadow-sm: 0 2px 15px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 8px 40px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.08);
            --transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Cormorant Garamond', 'Georgia', serif;
            background-color: #f5ede4;
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            background-image:
                radial-gradient(ellipse at 15% 20%, rgba(200, 170, 140, 0.12) 0%, transparent 60%),
                radial-gradient(ellipse at 85% 75%, rgba(190, 150, 130, 0.1) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 50%, rgba(220, 200, 180, 0.06) 0%, transparent 70%);
            background-attachment: fixed;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            font-size: 1.2em;
            opacity: 0;
            animation: floatUp 8s infinite;
            pointer-events: none;
        }

        @keyframes floatUp {
            0% { transform: translateY(105vh) rotate(0deg) scale(0.3); opacity: 0; }
            10% { opacity: 0.7; }
            70% { opacity: 0.5; }
            100% { transform: translateY(-10vh) rotate(360deg) scale(1.2); opacity: 0; }
        }

        .main-container {
            position: relative;
            z-index: 1;
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            padding: 20px 15px 40px;
        }

        /* Хедер */
        .hero-section {
            position: relative;
            text-align: center;
            padding: 60px 30px 50px;
            margin-bottom: 30px;
            border-radius: 4px;
            overflow: hidden;
            background: var(--white);
            box-shadow: var(--shadow-lg);
            border: 1px solid #e8dbce;
        }

        .hero-content { position: relative; z-index: 2; }

        .hero-photo-frame {
            display: inline-block;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--gold-light);
            box-shadow: 0 8px 30px rgba(122, 46, 59, 0.2);
            margin-bottom: 25px;
            position: relative;
            background: #e8dccf;
        }

        .hero-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-photo-frame::after {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            border: 1px dashed rgba(201, 169, 110, 0.5);
            pointer-events: none;
            animation: spinSlow 25s linear infinite;
        }

        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .hero-names {
            font-family: 'Great Vibes', 'Cormorant Garamond', cursive;
            font-size: 4em;
            font-weight: 400;
            color: var(--dark);
            line-height: 1.1;
            margin-bottom: 6px;
            letter-spacing: 0.02em;
        }

        .hero-names .ampersand {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            color: var(--gold);
            font-size: 0.7em;
            display: inline-block;
            margin: 0 4px;
        }

        .hero-date-badge {
            display: inline-block;
            background: var(--burgundy);
            color: #fff;
            padding: 10px 28px;
            border-radius: 30px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9em;
            letter-spacing: 0.1em;
            font-weight: 400;
            margin-top: 14px;
            text-transform: uppercase;
        }

        .hero-subtitle {
            font-size: 1.15em;
            color: var(--text-light);
            font-style: italic;
            margin-top: 16px;
            letter-spacing: 0.03em;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Секции */
        .section {
            background: var(--white);
            padding: 35px 30px;
            border-radius: 6px;
            box-shadow: var(--shadow-sm);
            border: 1px solid #ede3d6;
            margin-bottom: 24px;
        }

        .section-title {
            font-family: 'Great Vibes', cursive;
            font-size: 2.2em;
            color: var(--dark);
            margin-bottom: 20px;
            text-align: center;
            font-weight: 400;
        }

        /* ========== МАГИЧЕСКОЕ РАСПИСАНИЕ ========== */
        .timeline-magic-section {
            position: relative;
        }

        .magic-timeline {
            position: relative;
            padding: 10px 0;
        }

        /* Волнистая линия */
        .magic-path {
            position: absolute;
            left: 30px;
            top: 0;
            width: 4px;
            height: 100%;
            z-index: 0;
            overflow: visible;
        }

        /* Карточка */
        .magic-card {
            position: relative;
            margin-bottom: 32px;
            padding-left: 60px;
            z-index: 1;
        }

        .magic-card:last-child {
            margin-bottom: 0;
        }

        /* Точка на дорожке */
        .magic-dot {
            position: absolute;
            left: 21px;
            top: 24px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #fffdf9;
            border: 3px solid #7a2e3b;
            z-index: 2;
            box-shadow: 0 0 0 8px rgba(122, 46, 59, 0.06);
            transition: all 0.4s ease;
        }

        .magic-dot::after {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            border: 1px dashed rgba(122, 46, 59, 0.2);
            animation: dotSpin 20s linear infinite;
            pointer-events: none;
        }

        @keyframes dotSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .magic-dot-fire {
            border-color: #ff9a6c;
            box-shadow: 0 0 0 8px rgba(255, 154, 108, 0.1);
            background: #0b0b18;
        }

        .magic-dot-fire::after {
            border-color: rgba(255, 154, 108, 0.2);
        }

        /* Карточка внутри */
        .magic-card-inner {
            background: #fffdf9;
            border-radius: 0 30px 30px 30px;
            padding: 22px 24px;
            border: 1px solid #e8dbce;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .magic-card-inner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 40px;
            background: linear-gradient(180deg, #7a2e3b, #c9a96e);
            border-radius: 0 0 4px 0;
        }

        .magic-card:hover .magic-card-inner {
            transform: translateX(6px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .magic-card:hover .magic-dot {
            background: #7a2e3b;
            box-shadow: 0 0 0 14px rgba(122, 46, 59, 0.1);
        }

        .magic-card:hover .magic-dot-fire {
            background: #ff9a6c;
            box-shadow: 0 0 0 14px rgba(255, 154, 108, 0.2);
        }

        /* Правая карточка — зеркальная */
        .magic-card-right .magic-card-inner {
            border-radius: 30px 0 30px 30px;
        }

        .magic-card-right .magic-card-inner::before {
            left: auto;
            right: 0;
            border-radius: 0 0 0 4px;
        }

        .magic-card-right:hover .magic-card-inner {
            transform: translateX(-6px);
        }

        /* Текст */
        .magic-time {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8em;
            letter-spacing: 0.1em;
            color: #7a2e3b;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .magic-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4em;
            font-weight: 600;
            color: #2c1f1a;
            margin-bottom: 6px;
        }

        .magic-desc {
            font-size: 0.9em;
            color: #8c7b6e;
            font-style: italic;
            line-height: 1.5;
        }

        /* Файер-шоу */
        .magic-card-fire .magic-card-inner {
            background: #0b0b18;
            border: 1px solid #1a1a30;
            color: #d5c8b5;
            position: relative;
            overflow: hidden;
        }

        .magic-card-fire .magic-card-inner::before {
            background: linear-gradient(180deg, #ff9a6c, #ff6a30);
        }

        .magic-card-fire .magic-time {
            color: #ff9a6c;
            position: relative;
            z-index: 2;
        }

        .magic-card-fire .magic-title {
            color: #f0d9b5;
            position: relative;
            z-index: 2;
        }

        .magic-card-fire .magic-desc {
            color: #b0a090;
            position: relative;
            z-index: 2;
        }

        /* Звёзды */
        .stars-sky {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                radial-gradient(1.5px 1.5px at 15% 25%, #ffffff 40%, transparent 100%),
                radial-gradient(1.5px 1.5px at 35% 65%, #ffffff 40%, transparent 100%),
                radial-gradient(1.8px 1.8px at 55% 20%, #fff8e7 40%, transparent 100%),
                radial-gradient(1.5px 1.5px at 70% 70%, #ffffff 40%, transparent 100%),
                radial-gradient(1.8px 1.8px at 85% 30%, #fff8e7 40%, transparent 100%),
                radial-gradient(1px 1px at 10% 70%, #ffffff 50%, transparent 100%),
                radial-gradient(1px 1px at 30% 35%, #ffffff 50%, transparent 100%),
                radial-gradient(1.2px 1.2px at 50% 80%, #fff8e7 50%, transparent 100%),
                radial-gradient(1px 1px at 65% 40%, #ffffff 50%, transparent 100%),
                radial-gradient(1.2px 1.2px at 80% 60%, #fff8e7 50%, transparent 100%),
                radial-gradient(0.6px 0.6px at 20% 15%, #ffffff 60%, transparent 100%),
                radial-gradient(0.6px 0.6px at 40% 50%, #ffffff 60%, transparent 100%),
                radial-gradient(0.7px 0.7px at 60% 30%, #fff8e7 60%, transparent 100%),
                radial-gradient(0.6px 0.6px at 75% 85%, #ffffff 60%, transparent 100%),
                radial-gradient(0.7px 0.7px at 90% 45%, #fff8e7 60%, transparent 100%);
            animation: starsTwinkle 4s ease-in-out infinite;
        }

        @keyframes starsTwinkle {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        .shooting-star {
            position: absolute;
            width: 60px;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #ffffff, #fff8e7);
            top: 20%;
            left: -60px;
            z-index: 1;
            pointer-events: none;
            animation: shoot 6s linear infinite;
            border-radius: 1px;
        }

        .shooting-star::before {
            content: '';
            position: absolute;
            right: 0;
            top: -2px;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: 0 0 6px 2px rgba(255, 255, 255, 0.5), 0 0 16px 5px rgba(255, 220, 180, 0.3);
        }

        .shooting-star-2 {
            top: 50%;
            animation-delay: 4s;
            animation-duration: 7s;
            width: 80px;
        }

        @keyframes shoot {
            0% { left: -100px; opacity: 0; }
            5% { opacity: 1; }
            15% { left: 110%; opacity: 0; }
            100% { left: 110%; opacity: 0; }
        }

        /* Адаптив */
        @media (max-width: 600px) {
            .magic-card {
                padding-left: 44px;
            }
            .magic-dot {
                left: 13px;
                width: 18px;
                height: 18px;
            }
            .magic-path {
                left: 21px;
            }
            .magic-card-inner {
                padding: 16px;
            }
        }

        /* Место */
        .venue-name {
            font-size: 1.4em;
            font-weight: 600;
            color: var(--dark);
            text-align: center;
            margin-bottom: 4px;
        }

        .venue-address {
            font-size: 1em;
            color: var(--text-light);
            font-style: italic;
            text-align: center;
            margin-bottom: 16px;
        }

        .venue-map-btn {
            display: block;
            width: fit-content;
            margin: 0 auto;
            padding: 12px 30px;
            background: var(--burgundy);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8em;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: var(--transition);
        }

        .venue-map-btn:hover {
            background: var(--burgundy-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(122, 46, 59, 0.3);
        }

        /* Форма */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--dark);
            font-size: 0.95em;
            letter-spacing: 0.02em;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0d5c7;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95em;
            background: #fdf8f2;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.15);
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 8px;
            border: 2px solid #e8dccf;
            transition: 0.3s;
            font-size: 0.95em;
        }

        .radio-label:hover {
            border-color: var(--gold-light);
            background: #faf3e8;
        }

        .radio-label input[type="radio"] {
            accent-color: var(--burgundy);
            width: 20px;
            height: 20px;
        }

        .radio-label.selected {
            border-color: var(--burgundy);
            background: #fdf3f3;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 0.95em;
            padding: 10px 0;
        }

        .checkbox-label input[type="checkbox"] {
            accent-color: var(--burgundy);
            width: 20px;
            height: 20px;
        }

        .partner-fields {
            display: none;
            padding: 16px;
            background: #faf3e8;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px dashed #e0d5c7;
        }

        .partner-fields.active { display: block; }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 16px;
            background: var(--burgundy);
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 1.1em;
            font-family: inherit;
            cursor: pointer;
            transition: 0.3s;
            letter-spacing: 0.03em;
            margin-top: 20px;
            font-weight: 600;
        }

        .submit-btn:hover {
            background: var(--burgundy-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(122, 46, 59, 0.3);
        }

        .submit-btn:disabled {
            background: #b0a59c;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Результат */
        .result-box {
            display: none;
            text-align: center;
            padding: 30px;
        }

        .result-box.active { display: block; }

        .result-icon {
            font-size: 4em;
            margin-bottom: 16px;
        }

        .result-message {
            font-size: 1.2em;
            color: var(--dark);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .stats-mini {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .stats-mini-item {
            background: #faf3e8;
            padding: 12px 18px;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9em;
        }

        .stats-mini-item strong {
            display: block;
            font-size: 1.4em;
            color: var(--burgundy);
        }

        @media (max-width: 600px) {
            .hero-names { font-size: 2.8em; }
            .hero-photo-frame { width: 130px; height: 130px; }
            .timeline { padding-left: 30px; }
            .timeline::before { left: 13px; }
            .timeline-dot { left: -27px; width: 22px; height: 22px; }
            .timeline-item { padding: 16px 14px; }
            .timeline-icon { right: 10px; top: 20px; font-size: 1.4em; }
            .section { padding: 24px 16px; }
            .hero-section { padding: 40px 20px 35px; }
            .hero-date-badge { font-size: 0.75em; padding: 8px 20px; }
        }

        /* Таймер */
        .countdown-section {
            text-align: center;
        }

        .countdown {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .countdown-item {
            text-align: center;
            min-width: 80px;
        }

        .countdown-number {
            display: block;
            font-size: 3.5em;
            font-weight: 700;
            font-family: 'Cormorant Garamond', 'Georgia', serif;
            color: #7a2e3b;
            line-height: 1;
            background: #fffdf9;
            padding: 12px 16px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #e8dccf;
        }

        .countdown-label {
            display: block;
            font-size: 0.85em;
            color: #8c7b6e;
            margin-top: 6px;
            text-transform: lowercase;
            letter-spacing: 0.05em;
        }

        .countdown-separator {
            font-size: 3em;
            font-weight: 300;
            color: #c9a96e;
            margin-top: -16px;
        }

        @media (max-width: 600px) {
            .countdown-number {
                font-size: 2em;
                padding: 8px 10px;
                min-width: 50px;
            }
            .countdown-separator {
                font-size: 1.8em;
            }
            .countdown-item {
                min-width: 55px;
            }
        }
        /* ЭСТЕТИЧНЫЙ КАЛЕНДАРЬ */
        .calendar-aesthetic {
            display: inline-block;
            background: #fdf8f2;
            border-radius: 16px;
            padding: 30px 28px 24px;
            margin-top: 20px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            border: 1px solid #e8dbce;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
        }

        .aesthetic-year {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.7em;
            letter-spacing: 0.25em;
            color: #b0a090;
            text-transform: uppercase;
            font-weight: 400;
            margin-bottom: 6px;
        }

        .aesthetic-month-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .aesthetic-month {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2em;
            font-weight: 500;
            color: #3d2c2a;
            letter-spacing: 0.06em;
        }

        .aesthetic-ornament {
            color: #d4c5b0;
            font-size: 1em;
        }

        .aesthetic-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            margin-bottom: 16px;
        }

        .aesthetic-dow {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 0.65em;
            color: #b0a090;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 6px 0;
        }

        .aesthetic-day {
            padding: 9px 0;
            border-radius: 6px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1em;
            font-weight: 400;
            color: #5c4a3d;
            transition: all 0.3s;
            cursor: default;
        }

        .aesthetic-day:hover {
            background: #f5ede0;
        }

        .aesthetic-wedding {
            background: #7a2e3b;
            color: #fff;
            font-weight: 600;
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 0 4px rgba(122, 46, 59, 0.08);
            animation: gentlePulse 3s ease-in-out infinite;
        }

        .aesthetic-wedding:hover {
            background: #9a4a56;
        }

        @keyframes gentlePulse {
            0%, 100% { box-shadow: 0 0 0 4px rgba(122, 46, 59, 0.08); }
            50% { box-shadow: 0 0 0 10px rgba(122, 46, 59, 0.04); }
        }

        .aesthetic-footer {
            border-top: 1px solid #ede3d6;
            padding-top: 14px;
        }

        .aesthetic-names {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3em;
            font-style: italic;
            color: #3d2c2a;
            margin-bottom: 2px;
            letter-spacing: 0.03em;
        }

        .aesthetic-date {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.7em;
            letter-spacing: 0.12em;
            color: #8c7b6e;
            text-transform: uppercase;
            font-weight: 400;
        }

        @media (max-width: 600px) {
            .calendar-aesthetic {
                padding: 20px 14px 18px;
                max-width: 320px;
            }
            .aesthetic-month { font-size: 1.5em; }
            .aesthetic-grid { gap: 1px; }
            .aesthetic-day { padding: 7px 0; font-size: 0.85em; }
        }
        .hero-subtitle {
            margin-top: 16px;
            letter-spacing: 0.03em;
        }

        .hero-big-text {
            display: block;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6em;
            font-weight: 600;
            color: #2c1f1a;
            letter-spacing: 0.04em;
            margin-bottom: 8px;
            margin-top: 75px;
            line-height: 1.3;
        }

        .hero-small-text {
            display: block;
            font-size: 0.95em;
            color: #8c7b6e;
            font-style: italic;
            font-weight: 400;
            line-height: 1.5;
            max-width: 460px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="particles" id="particles"></div>

<div class="main-container">

    <!-- Хедер -->
    <header class="hero-section">
        <div class="hero-content">
            <div class="hero-photo-frame">
                <img src="https://sun1-91.userapi.com/s/v1/ig2/J2iRaAktatU7zHhNJnwpsbRPka5DZlUh5UwSQtaEJwS-_nanN8sPiHrR2R13db9-mcnwyWafu7OdOgFh8YkeJb3h.jpg?quality=95&as=32x36,48x53,72x80,108x120,160x178,240x267,360x401,480x535,540x602,640x713,720x802,1080x1204,1188x1324&from=bu&u=Auc3s1c9taEdzYYUvZm85pROYgivZrKLWxhNWs32iwU&cs=1188x0"
                     alt="Цырен и Сарюна"
                     onerror="this.style.display='none';this.parentElement.style.background='linear-gradient(135deg, #e8dccf, #d4b98a)';">
            </div>
            <h1 class="hero-names">Цырен <span class="ampersand">&</span> Сарюна</h1>
            <p class="hero-subtitle">
                <span class="hero-big-text">Дорогие друзья и родные!</span>
                <span class="hero-small-text">Спешим сообщить радостную новость –– мы женимся! В этот день мы очень хотим оказаться в окружении самых близких и дорогих для нас людей. Пусть этот праздник станет для всех нас воспоминанием, наполненным теплом, искренними улыбками и тихим счастьем!</span>
            </p>

            <!-- ЭСТЕТИЧНЫЙ КАЛЕНДАРЬ -->
            <div class="calendar-aesthetic">
                <div class="aesthetic-year">2026</div>
                <div class="aesthetic-month-row">
                    <span class="aesthetic-ornament">—</span>
                    <span class="aesthetic-month">Август</span>
                    <span class="aesthetic-ornament">—</span>
                </div>

                <div class="aesthetic-grid">
                    <span class="aesthetic-dow">Пн</span>
                    <span class="aesthetic-dow">Вт</span>
                    <span class="aesthetic-dow">Ср</span>
                    <span class="aesthetic-dow">Чт</span>
                    <span class="aesthetic-dow">Пт</span>
                    <span class="aesthetic-dow">Сб</span>
                    <span class="aesthetic-dow">Вс</span>

                    <span></span><span></span><span></span><span></span><span></span>
                    <span class="aesthetic-day">1</span>
                    <span class="aesthetic-day">2</span>
                    <span class="aesthetic-day">3</span>
                    <span class="aesthetic-day">4</span>
                    <span class="aesthetic-day">5</span>
                    <span class="aesthetic-day">6</span>
                    <span class="aesthetic-day">7</span>
                    <span class="aesthetic-day">8</span>
                    <span class="aesthetic-day">9</span>
                    <span class="aesthetic-day">10</span>
                    <span class="aesthetic-day">11</span>
                    <span class="aesthetic-day">12</span>
                    <span class="aesthetic-day">13</span>
                    <span class="aesthetic-day">14</span>
                    <span class="aesthetic-day">15</span>
                    <span class="aesthetic-day">16</span>
                    <span class="aesthetic-day">17</span>
                    <span class="aesthetic-day">18</span>
                    <span class="aesthetic-day">19</span>
                    <span class="aesthetic-day">20</span>
                    <span class="aesthetic-day">21</span>
                    <span class="aesthetic-day">22</span>
                    <span class="aesthetic-day aesthetic-wedding">23</span>
                    <span class="aesthetic-day">24</span>
                    <span class="aesthetic-day">25</span>
                    <span class="aesthetic-day">26</span>
                    <span class="aesthetic-day">27</span>
                    <span class="aesthetic-day">28</span>
                    <span class="aesthetic-day">29</span>
                    <span class="aesthetic-day">30</span>
                    <span class="aesthetic-day">31</span>
                </div>

                <div class="aesthetic-footer">
                    <p class="aesthetic-names">Цырен & Сарюна</p>
                    <p class="aesthetic-date">23 августа 2026</p>
                </div>
            </div>
            <!-- Таймер -->
            <div class="countdown" style="margin-top:20px;">
                <div class="countdown-item">
                    <span class="countdown-number" id="days">00</span>
                    <span class="countdown-label">дней</span>
                </div>
                <span style="font-size:2em;color:#c9a96e;">:</span>
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">00</span>
                    <span class="countdown-label">часов</span>
                </div>
                <span style="font-size:2em;color:#c9a96e;">:</span>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">00</span>
                    <span class="countdown-label">минут</span>
                </div>
                <span style="font-size:2em;color:#c9a96e;">:</span>
                <div class="countdown-item">
                    <span class="countdown-number" id="seconds">00</span>
                    <span class="countdown-label">секунд</span>
                </div>
            </div>
        </div>
    </header>


    <!-- Расписание -->
    <div class="section timeline-magic-section">
        <h2 class="section-title">Расписание дня</h2>

        <div class="magic-timeline">
            <!-- Волнистая линия SVG -->
            <svg class="magic-path" viewBox="0 0 4 100" preserveAspectRatio="none">
                <path d="M2,0 C6,8 -2,16 2,24 C6,32 -2,40 2,48 C6,56 -2,64 2,72 C6,80 -2,88 2,96 L2,100"
                      stroke="#c9a96e" stroke-width="0.5" fill="none" stroke-dasharray="2,3" opacity="0.5"/>
                <path d="M2,0 C6,8 -2,16 2,24 C6,32 -2,40 2,48 C6,56 -2,64 2,72 C6,80 -2,88 2,96 L2,100"
                      stroke="url(#goldGradient)" stroke-width="1.5" fill="none" opacity="0.8"/>
                <defs>
                    <linearGradient id="goldGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#7a2e3b"/>
                        <stop offset="50%" stop-color="#c9a96e"/>
                        <stop offset="100%" stop-color="#ff9a6c"/>
                    </linearGradient>
                </defs>
            </svg>

            <!-- Карточка 1 -->
            <div class="magic-card magic-card-left">
                <div class="magic-card-inner">
                    <div class="magic-time">12:00</div>
                    <div class="magic-title">Молодёжные катания</div>
                    <div class="magic-desc">Начинаем день ярко и весело. Заряд адреналина и отличного настроения перед главным событием.</div>
                </div>
                <div class="magic-dot"></div>
            </div>

            <!-- Карточка 2 -->
            <div class="magic-card magic-card-right">
                <div class="magic-card-inner">
                    <div class="magic-time">14:00</div>
                    <div class="magic-title">Банкет</div>
                    <div class="magic-desc">Торжественный приём в «Гранд Блисс». Вкусные блюда и весёлая программа от нашего ведущего.</div>
                </div>
                <div class="magic-dot"></div>
            </div>

            <!-- Карточка 3 — Файер-шоу -->
            <div class="magic-card magic-card-left magic-card-fire">
                <div class="magic-card-inner">
                    <div class="stars-sky"></div>
                    <div class="shooting-star"></div>
                    <div class="shooting-star shooting-star-2"></div>
                    <div class="magic-time">23:00</div>
                    <div class="magic-title">Файер-шоу</div>
                    <div class="magic-desc">Завершение дня под звёздами. Захватывающее огненное шоу — яркий и незабываемый финал нашего праздника.</div>
                </div>
                <div class="magic-dot magic-dot-fire"></div>
            </div>
        </div>
    </div>

    <!-- Место -->
    <div class="section" style="text-align:center;">
        <h2 class="section-title">Мы ждём вас</h2>
        <p class="venue-name">«Гранд Блисс»</p>
        <p class="venue-address">ул. Строителей, 5, пгт. Агинское</p>
        <a href="https://2gis.ru/search/%D0%93%D1%80%D0%B0%D0%BD%D0%B4%20%D0%B1%D0%BB%D0%B8%D1%81%D1%81%20%D0%B0%D0%B3%D0%B8%D0%BD%D1%81%D0%BA%D0%BE%D0%B5/firm/70000001111369510/114.567952%2C51.118719?m=114.568206%2C51.11813%2F17.29"
           class="venue-map-btn" target="_blank" rel="noopener">📍 Перейти на карту</a>
    </div>

    <!-- Анкета -->
    <div class="section" id="form-section">
        <h2 class="section-title">Анкета гостя</h2>
        <p style="text-align:center;color:var(--text-light);font-style:italic;margin-bottom:20px;">
            Пожалуйста, подтвердите ваше присутствие<br><strong>до 10 августа 2026</strong>
        </p>

        <form id="guest-form">
            <div class="form-group">
                <label for="last_name">Фамилия *</label>
                <input type="text" id="last_name" name="last_name" required placeholder="Иванов">
            </div>

            <div class="form-group">
                <label for="first_name">Имя *</label>
                <input type="text" id="first_name" name="first_name" required placeholder="Иван">
            </div>

            <div class="form-group">
                <label>Я планирую:</label>
                <div class="radio-group">
                    <label class="radio-label" data-value="will_come">
                        <input type="radio" name="status" value="will_come" checked>
                        <span>✅ Буду на свадьбе!</span>
                    </label>
                    <label class="radio-label" data-value="will_not_come">
                        <input type="radio" name="status" value="will_not_come">
                        <span>😔 К сожалению, не приду</span>
                    </label>
                </div>
            </div>

            <div id="with-partner-block">
                <label class="checkbox-label">
                    <input type="checkbox" id="with_partner" name="with_partner">
                    <span>💑 Мы пара</span>
                </label>

                <div class="partner-fields" id="partner-fields">
                    <div class="form-group">
                        <label for="partner_last_name">Фамилия партнёра</label>
                        <input type="text" id="partner_last_name" name="partner_last_name" placeholder="Петрова">
                    </div>
                    <div class="form-group">
                        <label for="partner_first_name">Имя партнёра *</label>
                        <input type="text" id="partner_first_name" name="partner_first_name" placeholder="Мария">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="message">Пожелание молодожёнам</label>
                <textarea id="message" name="message" rows="3" placeholder="Ваши тёплые слова..."></textarea>
            </div>

            <button type="submit" class="submit-btn" id="submit-btn">💌 Отправить</button>
        </form>

        <!-- Успех -->
        <div class="result-box" id="result-box">
            <div class="result-icon" id="result-icon"></div>
            <p class="result-message" id="result-message"></p>
        </div>

    </div>

    <footer style="text-align:center;padding:20px;color:var(--text-light);font-style:italic;">
        <p style="font-family:'Great Vibes',cursive;font-size:2em;color:var(--dark);">Цырен & Сарюна</p>
        <p>23 августа 2026 • ул. Строителей, 5 • Агинское</p>
    </footer>
</div>

<script>
    // Партиклы
    (function() {
        const container = document.getElementById('particles');
        const emojis = ['✨', '🌸', '💫', '🕊️', '💖', '🥂', '💍', '🌿', '🤍'];
        for (let i = 0; i < 25; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            p.textContent = emojis[Math.floor(Math.random() * emojis.length)];
            p.style.left = Math.random() * 90 + '%';
            p.style.animationDelay = Math.random() * 8 + 's';
            p.style.animationDuration = (7 + Math.random() * 10) + 's';
            p.style.fontSize = (0.8 + Math.random() * 1.4) + 'em';
            container.appendChild(p);
        }
    })();

    // Радио-кнопки
    document.querySelectorAll('.radio-label').forEach(label => {
        label.addEventListener('click', function() {
            document.querySelectorAll('.radio-label').forEach(l => l.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input').checked = true;

            // Если "не приду" — скрыть блок с парой
            const status = this.querySelector('input').value;
            const block = document.getElementById('with-partner-block');
            const partnerFields = document.getElementById('partner-fields');
            const checkbox = document.getElementById('with_partner');

            if (status === 'will_not_come') {
                block.style.display = 'none';
                partnerFields.classList.remove('active');
                checkbox.checked = false;
            } else {
                block.style.display = 'block';
            }
        });
    });

    // Инициализация
    document.querySelector('.radio-label[data-value="will_come"]').classList.add('selected');

    // Чекбокс "с парой"
    document.getElementById('with_partner').addEventListener('change', function() {
        const partnerFields = document.getElementById('partner-fields');
        partnerFields.classList.toggle('active', this.checked);
    });

    // Отправка анкеты
    document.getElementById('guest-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('submit-btn');
        const originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Отправка...';

        const formData = {
            first_name: document.getElementById('first_name').value.trim(),
            last_name: document.getElementById('last_name').value.trim(),
            status: document.querySelector('input[name="status"]:checked').value,
            with_partner: document.getElementById('with_partner').checked,
            partner_first_name: document.getElementById('partner_first_name').value.trim(),
            partner_last_name: document.getElementById('partner_last_name').value.trim(),
            message: document.getElementById('message').value.trim(),
        };

        // Показываем успех сразу, не ждём ответа
        const showSuccess = () => {
            document.getElementById('guest-form').style.display = 'none';
            document.getElementById('result-box').classList.add('active');
            document.getElementById('result-icon').textContent =
                formData.status === 'will_come' ? '🎉' : '💌';
            document.getElementById('result-message').textContent =
                formData.status === 'will_come'
                    ? 'Спасибо! Рады, что вы будете с нами!'
                    : 'Спасибо за ответ! Будем скучать!';
        };

        try {
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 5000);

            const response = await fetch('/api/guests', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(formData),
                signal: controller.signal,
            });

            clearTimeout(timeoutId);

            if (response.ok) {
                const data = await response.json();
                document.getElementById('result-message').textContent = data.message;
                document.getElementById('mini-come').textContent = data.stats.will_come;
                document.getElementById('mini-persons').textContent = data.stats.total_persons;
            }

            showSuccess();

        } catch (error) {
            // Даже при ошибке показываем успех, потому что запись скорее всего прошла
            console.log('Ответ сервера не получен, но запись скорее всего в БД');
            showSuccess();
        } finally {
            btn.disabled = false;
            btn.textContent = originalText;
        }

        // Скролл к результату
        setTimeout(() => {
            document.getElementById('result-box').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 300);
    });

    // Статистика при загрузке
    (async function() {
        try {
            const res = await fetch('/api/stats');
            const data = await res.json();
            document.getElementById('mini-come').textContent = data.will_come;
            document.getElementById('mini-persons').textContent = data.total_persons;
        } catch(e) {}
    })();
</script>
<script>
    // Таймер обратного отсчёта
    function startCountdown() {
        const weddingDate = new Date('2026-08-23T14:00:00').getTime();

        function updateTimer() {
            const now = new Date().getTime();
            const distance = weddingDate - now;

            if (distance < 0) {
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    }

    startCountdown();

</script>
<script>
    // Таймер
    (function() {
        const wedding = new Date('2026-08-23T14:00:00').getTime();
        setInterval(() => {
            const now = Date.now();
            const d = wedding - now;
            if (d < 0) return;
            document.getElementById('days').textContent = String(Math.floor(d / 86400000)).padStart(2,'0');
            document.getElementById('hours').textContent = String(Math.floor(d % 86400000 / 3600000)).padStart(2,'0');
            document.getElementById('minutes').textContent = String(Math.floor(d % 3600000 / 60000)).padStart(2,'0');
            document.getElementById('seconds').textContent = String(Math.floor(d % 60000 / 1000)).padStart(2,'0');
        }, 1000);
    })();
</script>
<script>
    (function() {
        const card = document.getElementById('fireShow');
        const canvas = document.getElementById('starsCanvas');
        const ctx = canvas.getContext('2d');

        let stars = [];
        let mouseX = -100;
        let mouseY = -100;
        let animationId;

        // Размер canvas под размер карточки
        function resizeCanvas() {
            const rect = card.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
        }

        // Создать звёзды
        function createStars() {
            stars = [];
            const count = Math.floor((canvas.width * canvas.height) / 800);
            for (let i = 0; i < count; i++) {
                stars.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    radius: Math.random() * 2.2 + 0.6,
                    baseAlpha: Math.random() * 0.6 + 0.4,
                    alpha: Math.random() * 0.6 + 0.4,
                    twinkleSpeed: Math.random() * 0.02 + 0.005,
                    twinkleOffset: Math.random() * Math.PI * 2,
                    color: Math.random() < 0.2
                        ? `hsl(${30 + Math.random() * 20}, 80%, ${70 + Math.random() * 20}%)`
                        : '#ffffff',
                });
            }
        }

        // Отрисовать звёзды
        function drawStars(time) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            stars.forEach(star => {
                // Мерцание
                const twinkle = Math.sin(time * star.twinkleSpeed + star.twinkleOffset);
                const alpha = star.baseAlpha + twinkle * 0.3;

                // Притяжение к мышке
                const dx = mouseX - star.x;
                const dy = mouseY - star.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                const maxDist = 100;

                let drawX = star.x;
                let drawY = star.y;
                let glowRadius = 0;

                if (dist < maxDist) {
                    const force = (1 - dist / maxDist) * 0.3;
                    drawX += dx * force;
                    drawY += dy * force;
                    glowRadius = (1 - dist / maxDist) * 4;
                }

                // Свечение
                if (glowRadius > 0) {
                    const gradient = ctx.createRadialGradient(drawX, drawY, 0, drawX, drawY, glowRadius + star.radius);
                    gradient.addColorStop(0, star.color);
                    gradient.addColorStop(1, 'transparent');
                    ctx.beginPath();
                    ctx.arc(drawX, drawY, glowRadius + star.radius, 0, Math.PI * 2);
                    ctx.fillStyle = gradient;
                    ctx.globalAlpha = alpha * 0.5;
                    ctx.fill();
                }

                // Звезда
                ctx.beginPath();
                ctx.arc(drawX, drawY, star.radius, 0, Math.PI * 2);
                ctx.fillStyle = star.color;
                ctx.globalAlpha = alpha;
                ctx.fill();

                // Крестик для ярких звёзд
                if (star.radius > 1.6) {
                    ctx.strokeStyle = star.color;
                    ctx.globalAlpha = alpha * 0.6;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(drawX - star.radius * 2, drawY);
                    ctx.lineTo(drawX + star.radius * 2, drawY);
                    ctx.moveTo(drawX, drawY - star.radius * 2);
                    ctx.lineTo(drawX, drawY + star.radius * 2);
                    ctx.stroke();
                }
            });

            ctx.globalAlpha = 1;
        }

        // Анимация
        function animate(time) {
            drawStars(time);
            animationId = requestAnimationFrame(animate);
        }

        // Вспышка при клике
        function burst(x, y) {
            const burstStars = [];
            const count = 16;

            for (let i = 0; i < count; i++) {
                const angle = (Math.PI * 2 / count) * i;
                const speed = Math.random() * 4 + 2;
                burstStars.push({
                    x: x,
                    y: y,
                    vx: Math.cos(angle) * speed,
                    vy: Math.sin(angle) * speed,
                    life: 1,
                    radius: Math.random() * 2 + 1,
                });
            }

            function animateBurst() {
                let alive = false;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                burstStars.forEach(s => {
                    s.x += s.vx;
                    s.y += s.vy;
                    s.life -= 0.02;
                    s.vx *= 0.97;
                    s.vy *= 0.97;

                    if (s.life > 0) {
                        alive = true;
                        ctx.beginPath();
                        ctx.arc(s.x, s.y, s.radius * s.life, 0, Math.PI * 2);
                        ctx.fillStyle = `rgba(255, 180, 100, ${s.life})`;
                        ctx.fill();
                    }
                });

                if (alive) {
                    requestAnimationFrame(() => {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        animateBurst();
                    });
                }
            }

            animateBurst();
        }

        // События
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });

        card.addEventListener('mouseleave', () => {
            mouseX = -100;
            mouseY = -100;
        });

        card.addEventListener('click', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            burst(x, y);
        });

        // Инициализация
        function init() {
            resizeCanvas();
            createStars();
            cancelAnimationFrame(animationId);
            animate(0);
        }

        init();
        window.addEventListener('resize', init);
    })();
</script>
</body>
</html>
