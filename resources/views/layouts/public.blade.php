<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Akademis Syah Amin Zikri — Teknik Informatika ITS 2024">
    <title>@yield('title', 'ITS Academic Portal — Syah Amin Zikri')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Clash-style: Space Grotesk for display, DM Sans for body -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ══════════════════════════════════════════════════════════
           PALETTE — warm, colorful, editorial
        ══════════════════════════════════════════════════════════ */
        :root {
            /* Backgrounds */
            --cream:        #F2EDE4;   /* warm off-white — page bg */
            --cream-2:      #E8E2D8;   /* slightly deeper cream */
            --white:        #FFFFFF;

            /* Ink */
            --ink:          #1A1A12;   /* near-black */
            --ink-mid:      #3B3B2E;
            --ink-soft:     #6B6B54;
            --ink-light:    #9A9A80;

            /* Vivid accents — hero per page */
            --lime:         #A8C840;   /* MindMarket green */
            --yellow:       #F5D034;   /* primary CTA yellow */
            --coral:        #E8543C;   /* warm red/coral */
            --orange:       #F07830;   /* warm orange */
            --purple:       #8050D8;   /* violet */
            --teal:         #18B89A;   /* teal/mint */
            --pink:         #E878A8;   /* warm pink */
            --sky:          #54B0E8;   /* soft sky blue */

            /* Semantic (keep for back-compat with old calculator.blade.php calls) */
            --color-bg:          var(--cream);
            --color-surface:     var(--white);
            --color-surface-2:   var(--cream-2);
            --color-border:      rgba(26,26,18,0.12);
            --color-border-2:    rgba(26,26,18,0.22);
            --color-text-1:      var(--ink);
            --color-text-2:      var(--ink-mid);
            --color-text-3:      var(--ink-soft);
            --color-primary:     var(--lime);
            --color-primary-bg:  #EDF5C8;
            --color-primary-text:#3A5A08;
            --color-success:     var(--teal);
            --color-success-bg:  #D4F4EE;
            --color-success-text:#0A5044;
            --color-accent:      var(--purple);
            --color-accent-bg:   #EEE4FF;
            --color-accent-text: #4A20A0;
            --color-amber:       var(--orange);
            --color-amber-bg:    #FDEFD4;
            --color-amber-text:  #7A3810;
            --brand-ink:         var(--ink);
            --brand-ink-soft:    var(--ink-mid);

            /* Radii */
            --r-sm:   6px;
            --r-md:   12px;
            --r-lg:   20px;
            --r-xl:   32px;
            --r-2xl:  48px;
            --r-full: 9999px;

            /* Shadows */
            --sh-xs:  0 1px 3px rgba(0,0,0,.06);
            --sh-sm:  0 2px 8px rgba(0,0,0,.08);
            --sh-md:  0 6px 20px rgba(0,0,0,.10);
            --sh-lg:  0 16px 48px rgba(0,0,0,.12);
            --sh-nav: 0 4px 24px rgba(0,0,0,.10);

            /* Spacing */
            --s1:4px; --s2:8px; --s3:12px; --s4:16px; --s5:20px;
            --s6:24px; --s8:32px; --s10:40px; --s12:48px;
            --s16:64px; --s20:80px; --s24:96px;
        }

        /* ══════════════════════════════════════════════════════════
           BASE
        ══════════════════════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--ink);
            background-color: var(--cream);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Space Grotesk', system-ui, sans-serif;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--ink);
            margin-bottom: 0;
        }

        p { margin-bottom: 0; color: var(--ink-mid); }
        a { text-decoration: none; }
        img { max-width: 100%; height: auto; display: block; }

        /* ══════════════════════════════════════════════════════════
           LAYOUT
        ══════════════════════════════════════════════════════════ */
        .wrap {
            width: 100%;
            max-width: 1160px;
            margin: 0 auto;
            padding: 0 var(--s6);
        }
        @media (max-width: 640px) { .wrap { padding: 0 var(--s4); } }

        /* ══════════════════════════════════════════════════════════
           NAVBAR — white floating pill (MindMarket style)
        ══════════════════════════════════════════════════════════ */
        .nav-outer {
            padding: var(--s4) var(--s6);
            position: sticky;
            top: 0;
            z-index: 200;
            background: var(--cream);  /* matches page bg so it blends */
        }

        .nav-inner {
            background: var(--white);
            border-radius: var(--r-full);
            box-shadow: var(--sh-nav);
            display: flex;
            align-items: center;
            padding: 10px 10px 10px 20px;
            gap: var(--s4);
            max-width: 1160px;
            margin: 0 auto;
            border: 1px solid rgba(0,0,0,.06);
        }

        /* Brand */
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-brand-icon {
            width: 36px;
            height: 36px;
            background: var(--lime);
            border-radius: var(--r-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: var(--ink);
            flex-shrink: 0;
            font-weight: 700;
        }

        .nav-brand-text {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--ink);
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .nav-brand-sub {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.65rem;
            font-weight: 400;
            color: var(--ink-soft);
            letter-spacing: 0.01em;
            margin-top: 2px;
        }

        /* Nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            list-style: none;
            margin: 0;
            padding: 0;
            flex: 1;
            justify-content: center;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: var(--r-full);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--ink-mid);
            text-decoration: none;
            transition: background .15s, color .15s;
            white-space: nowrap;
        }

        .nav-links a:hover { background: var(--cream); color: var(--ink); }

        .nav-links a.active {
            background: var(--ink);
            color: var(--white);
        }

        .nav-links a .bi { font-size: 12px; }

        /* Right side */
        .nav-right {
            display: flex;
            align-items: center;
            gap: var(--s2);
            flex-shrink: 0;
        }

        /* Hamburger */
        .nav-toggle {
            display: none;
            background: var(--cream);
            border: 1px solid var(--color-border);
            border-radius: var(--r-full);
            padding: 8px 14px;
            cursor: pointer;
            color: var(--ink);
            font-size: 15px;
            align-items: center;
            gap: 6px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 0.82rem;
        }

        @media (max-width: 899px) {
            .nav-links { display: none; }
            .nav-toggle { display: flex; margin-left: auto; }
            .nav-inner  { padding: 10px 12px; border-radius: var(--r-xl); }

            .nav-links.open {
                display: flex;
                flex-direction: column;
                gap: 2px;
                position: fixed;
                top: 80px;
                left: var(--s4);
                right: var(--s4);
                background: var(--white);
                border-radius: var(--r-xl);
                box-shadow: var(--sh-lg);
                padding: var(--s3) var(--s3) var(--s4);
                z-index: 199;
                border: 1px solid rgba(0,0,0,.06);
            }

            .nav-links.open a {
                width: 100%;
                border-radius: var(--r-md);
                padding: 10px 16px;
            }
        }
        @media (min-width: 900px) { .nav-toggle { display: none !important; } }
        @media (max-width: 480px) {
            .nav-outer { padding-inline: var(--s2); }
            .nav-inner { gap: var(--s2); }
            .nav-toggle { font-size: 0; gap: 0; padding-inline: var(--s3); }
            .nav-toggle .bi { font-size: 1rem; }
            .nav-right .btn { padding-inline: var(--s3); }
        }

        /* ══════════════════════════════════════════════════════════
           MAIN
        ══════════════════════════════════════════════════════════ */
        .site-main {
            flex: 1;
            padding-bottom: var(--s16);
        }

        /* ══════════════════════════════════════════════════════════
           PAGE SHELL — cream bg, content lives inside
        ══════════════════════════════════════════════════════════ */
        .page-shell {
            background: var(--cream);
            overflow: hidden;
        }

        /* ══════════════════════════════════════════════════════════
           HERO — full-bleed vivid color block (changes per page)
        ══════════════════════════════════════════════════════════ */
        .hero-block {
            padding: var(--s20) var(--s6) var(--s16);
            position: relative;
            overflow: hidden;
        }

        .hero-block .wrap { position: relative; z-index: 1; }

        /* Decorative circle accent */
        .hero-block::after {
            content: '';
            position: absolute;
            right: -80px;
            bottom: -80px;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: rgba(255,255,255,0.10);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .hero-block { padding: var(--s12) var(--s4) var(--s10); }
        }
        @media (max-width: 480px) {
            .hero-block { padding: var(--s10) var(--s4) var(--s8); }
        }

        /* ══════════════════════════════════════════════════════════
           CONTENT SECTION (cream background)
        ══════════════════════════════════════════════════════════ */
        .section {
            padding: var(--s16) var(--s6);
        }
        .section-sm { padding: var(--s10) var(--s6); }

        @media (max-width: 768px) {
            .section    { padding: var(--s10) var(--s4); }
            .section-sm { padding: var(--s8)  var(--s4); }
        }

        /* ══════════════════════════════════════════════════════════
           TYPOGRAPHY SCALE
        ══════════════════════════════════════════════════════════ */
        .t-display {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1.0;
        }

        .t-hero {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.05;
        }

        .t-heading {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .t-subhead {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 600;
            letter-spacing: -0.015em;
        }

        .t-body { font-size: 0.95rem; line-height: 1.75; color: var(--ink-mid); }
        .t-body-lg { font-size: 1.05rem; line-height: 1.75; color: var(--ink-mid); }
        .t-small { font-size: 0.82rem; color: var(--ink-soft); }
        .t-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        .t-stat {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3rem, 10vw, 6rem);
            font-weight: 700;
            letter-spacing: -0.05em;
            line-height: 1;
        }

        /* ══════════════════════════════════════════════════════════
           PILL / LABEL TAG
        ══════════════════════════════════════════════════════════ */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: var(--r-full);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            border: 1.5px solid transparent;
        }

        .pill-dark    { background: var(--ink); color: var(--white); }
        .pill-white   { background: rgba(255,255,255,0.25); color: var(--ink); border-color: rgba(0,0,0,0.10); }
        .pill-white-strong { background: var(--white); color: var(--ink); }
        .pill-lime    { background: rgba(255,255,255,0.30); color: var(--ink); border-color: rgba(0,0,0,0.12); }
        .pill-yellow  { background: var(--yellow); color: var(--ink); }
        .pill-cream   { background: var(--cream); color: var(--ink-mid); border-color: var(--color-border); }
        .pill-neutral { background: rgba(26,26,18,0.07); color: var(--ink-mid); border-color: rgba(26,26,18,0.12); }
        .pill-green   { background: #D4F0A8; color: #2A5204; border-color: #AADC60; }
        .pill-teal    { background: #C4F0E8; color: #0A4A3A; border-color: #60D4BC; }
        .pill-purple  { background: #EEE4FF; color: #4A20A0; border-color: #C4A8FF; }
        .pill-coral   { background: #FFE0D8; color: #8C1C0A; border-color: #FFA898; }
        .pill-orange  { background: #FFE8C8; color: #7A3010; border-color: #FFBB70; }

        /* ══════════════════════════════════════════════════════════
           CARD COMPONENTS
        ══════════════════════════════════════════════════════════ */
        .card {
            background: var(--white);
            border-radius: var(--r-xl);
            border: 1px solid rgba(0,0,0,.06);
            box-shadow: var(--sh-sm);
            overflow: hidden;
        }

        .card-p     { padding: var(--s8); }
        .card-p-sm  { padding: var(--s5); }
        .card-p-lg  { padding: var(--s12); }

        .card-cream {
            background: var(--cream-2);
            border-radius: var(--r-xl);
            border: 1px solid rgba(0,0,0,.06);
        }

        .card-hover {
            transition: box-shadow .18s ease, transform .18s ease;
        }
        .card-hover:hover {
            box-shadow: var(--sh-md);
            transform: translateY(-4px);
        }

        /* Feature card — white on cream page */
        .feat-card {
            background: var(--white);
            border-radius: var(--r-xl);
            border: 1px solid rgba(0,0,0,.06);
            padding: var(--s8);
            display: flex;
            flex-direction: column;
            gap: var(--s4);
            height: 100%;
            transition: box-shadow .2s, transform .2s;
        }
        .feat-card:hover { box-shadow: var(--sh-md); transform: translateY(-4px); }

        /* Step card */
        .step-card {
            background: var(--white);
            border-radius: var(--r-xl);
            border: 1px solid rgba(0,0,0,.06);
            padding: var(--s6) var(--s6) var(--s6);
            height: 100%;
        }

        .step-num {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            line-height: 1;
            color: rgba(26,26,18,0.10);
            margin-bottom: var(--s3);
        }

        /* ══════════════════════════════════════════════════════════
           ICON BOX
        ══════════════════════════════════════════════════════════ */
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .icon-box.lime   { background: #E4F5B0; color: #3A6008; }
        .icon-box.yellow { background: #FDF5C0; color: #7A6000; }
        .icon-box.coral  { background: #FFE0D4; color: #882010; }
        .icon-box.purple { background: #EEE4FF; color: #5820B0; }
        .icon-box.teal   { background: #C8F0E8; color: #0A5040; }
        .icon-box.orange { background: #FFE8C0; color: #7A3808; }
        .icon-box.ink    { background: var(--ink); color: var(--white); }
        .icon-box.white  { background: rgba(255,255,255,0.20); color: var(--ink); }

        /* back-compat aliases */
        .icon-box.blue   { background: #DCF0FF; color: #0840A0; }
        .icon-box.green  { background: #D4F0A8; color: #2A5204; }
        .icon-box.gray   { background: var(--cream-2); color: var(--ink-mid); }
        .icon-box.amber  { background: #FFE8C0; color: #7A3808; }

        /* ══════════════════════════════════════════════════════════
           CHIP (inline stat badge)
        ══════════════════════════════════════════════════════════ */
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 13px;
            border-radius: var(--r-full);
            font-size: 0.82rem;
            font-weight: 600;
            border: 1.5px solid transparent;
        }
        .chip.ink    { background: var(--ink); color: var(--white); }
        .chip.lime   { background: #D4F0A8; color: #2A5204; border-color: #AADC60; }
        .chip.yellow { background: var(--yellow); color: var(--ink); }
        .chip.white  { background: rgba(255,255,255,0.22); color: var(--ink); border-color: rgba(0,0,0,.10); }
        .chip.teal   { background: #C4F0E8; color: #0A4A3A; border-color: #60D4BC; }
        .chip.purple { background: #EEE4FF; color: #4A20A0; border-color: #C4A8FF; }
        .chip.coral  { background: #FFE0D8; color: #8C1C0A; border-color: #FFA898; }
        .chip.cream  { background: var(--cream); color: var(--ink-mid); border-color: rgba(0,0,0,.10); }

        /* back-compat */
        .chip.blue  { background: #DCF0FF; color: #0840A0; border-color: #A8D4FF; }
        .chip.green { background: #D4F0A8; color: #2A5204; border-color: #AADC60; }

        /* ══════════════════════════════════════════════════════════
           INFO BLOCK
        ══════════════════════════════════════════════════════════ */
        .info-block {
            background: var(--cream);
            border: 1px solid rgba(0,0,0,.08);
            border-radius: var(--r-md);
            padding: var(--s4) var(--s5);
        }
        .info-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 3px;
        }
        .info-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.4;
        }

        /* ══════════════════════════════════════════════════════════
           AVATAR
        ══════════════════════════════════════════════════════════ */
        .avatar {
            width: 88px;
            height: 88px;
            border-radius: var(--r-xl);
            background: var(--ink);
            color: var(--yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            flex-shrink: 0;
        }
        @media (max-width: 480px) {
            .avatar { width: 64px; height: 64px; font-size: 1.4rem; }
        }

        /* ══════════════════════════════════════════════════════════
           BUTTONS
        ══════════════════════════════════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: var(--r-full);
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .16s ease;
            white-space: nowrap;
            line-height: 1;
            padding: 11px 24px;
            font-size: 0.9rem;
        }

        /* Yellow pill — primary CTA like MindMarket */
        .btn-yellow {
            background: var(--yellow);
            color: var(--ink);
        }
        .btn-yellow:hover {
            background: #E8C420;
            color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(245,208,52,.35);
        }

        .btn-ink {
            background: var(--ink);
            color: var(--white);
        }
        .btn-ink:hover {
            background: var(--ink-mid);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-white {
            background: var(--white);
            color: var(--ink);
            border: 1.5px solid rgba(0,0,0,.10);
        }
        .btn-white:hover {
            background: var(--cream);
            color: var(--ink);
            transform: translateY(-1px);
        }

        .btn-outline-ink {
            background: transparent;
            color: var(--ink);
            border: 1.5px solid rgba(26,26,18,.25);
        }
        .btn-outline-ink:hover {
            background: var(--ink);
            color: var(--white);
        }

        /* Hero context buttons (on colorful bg) */
        .btn-on-color {
            background: var(--white);
            color: var(--ink);
        }
        .btn-on-color:hover {
            background: var(--cream);
            color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,.14);
        }

        .btn-ghost-on-color {
            background: rgba(0,0,0,.10);
            color: var(--ink);
            border: 1.5px solid rgba(0,0,0,.15);
        }
        .btn-ghost-on-color:hover {
            background: rgba(0,0,0,.18);
            color: var(--ink);
        }

        .btn-sm  { padding: 8px 18px; font-size: 0.82rem; }
        .btn-lg  { padding: 14px 30px; font-size: 0.95rem; }
        .btn-full { width: 100%; justify-content: center; }

        /* back-compat */
        .btn-primary { background: var(--yellow); color: var(--ink); }
        .btn-primary:hover { background: #E8C420; color: var(--ink); transform: translateY(-2px); }
        .btn-dark    { background: var(--ink); color: var(--white); }
        .btn-dark:hover { background: var(--ink-mid); color: var(--white); }
        .btn-outline { background: transparent; color: var(--ink); border: 1.5px solid rgba(26,26,18,.2); }
        .btn-outline:hover { background: var(--cream-2); color: var(--ink); }

        /* ══════════════════════════════════════════════════════════
           DIVIDER
        ══════════════════════════════════════════════════════════ */
        .divider {
            border: none;
            border-top: 1px solid rgba(26,26,18,.10);
            margin: var(--s12) 0;
        }

        /* ══════════════════════════════════════════════════════════
           FORM CONTROLS
        ══════════════════════════════════════════════════════════ */
        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--ink-soft);
            margin-bottom: var(--s2);
        }

        .form-input {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid rgba(26,26,18,.18);
            border-radius: var(--r-md);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--ink);
            background: var(--white);
            transition: border-color .15s, box-shadow .15s;
            -webkit-appearance: none;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--lime);
            box-shadow: 0 0 0 3px rgba(168,200,64,.18);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B6B54' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 38px;
        }

        /* ══════════════════════════════════════════════════════════
           PROGRESS BAR
        ══════════════════════════════════════════════════════════ */
        .progress-track {
            height: 10px;
            background: var(--cream-2);
            border: 1px solid rgba(0,0,0,.08);
            border-radius: var(--r-full);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: var(--r-full);
            background: var(--lime);
            transition: width .6s ease;
        }
        .progress-fill.teal   { background: var(--teal); }
        .progress-fill.yellow { background: var(--yellow); }
        /* back-compat */
        .progress-fill.green  { background: var(--lime); }

        /* ══════════════════════════════════════════════════════════
           TAG (matkul chips)
        ══════════════════════════════════════════════════════════ */
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 13px;
            border-radius: var(--r-full);
            font-size: 0.8rem;
            font-weight: 500;
            background: var(--white);
            color: var(--ink-mid);
            border: 1px solid rgba(0,0,0,.10);
        }

        /* ══════════════════════════════════════════════════════════
           CTA BLOCK (dark on cream, with vivid color accent)
        ══════════════════════════════════════════════════════════ */
        .cta-block {
            background: var(--ink);
            border-radius: var(--r-2xl);
            padding: var(--s12) var(--s12);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: var(--s8);
            position: relative;
            overflow: hidden;
        }
        .cta-block::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168,200,64,.25) 0%, transparent 70%);
            pointer-events: none;
        }
        @media (max-width: 640px) {
            .cta-block { padding: var(--s8); flex-direction: column; }
        }

        /* ══════════════════════════════════════════════════════════
           RESULT BOX (calculator)
        ══════════════════════════════════════════════════════════ */
        .result-box {
            background: var(--cream-2);
            border: 1.5px solid rgba(0,0,0,.08);
            border-radius: var(--r-xl);
            padding: var(--s8);
        }
        .result-box.result-error {
            background: #FFF0EE;
            border-color: #FFBBAA;
        }

        /* ══════════════════════════════════════════════════════════
           BACK-COMPAT for calculator.blade.php (old class names)
        ══════════════════════════════════════════════════════════ */
        .inner-paper-grid {
            background: var(--cream-2);
            border: 1px solid rgba(0,0,0,.08);
            border-radius: var(--r-xl);
            padding: var(--s4);
        }
        .nested-white-card {
            background: var(--white);
            border: 1px solid rgba(0,0,0,.07);
            border-radius: var(--r-lg);
            padding: var(--s5);
        }
        .border-danger { border-color: #FFBBAA !important; }
        .highlight-pill-dark {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 16px;
            background: var(--ink);
            color: rgba(255,255,255,.85);
            border-radius: var(--r-full);
            font-size: 0.85rem;
        }

        /* ══════════════════════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════════════════════ */
        .site-footer {
            background: var(--ink);
            padding: var(--s8) 0;
            margin-top: var(--s8);
        }
        .footer-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--s2);
            text-align: center;
        }
        @media (min-width: 576px) {
            .footer-inner { flex-direction: row; justify-content: space-between; text-align: left; }
        }
        .site-footer p   { font-size: 0.82rem; color: rgba(255,255,255,.35); }
        .site-footer strong { color: rgba(255,255,255,.65); }

        /* ══════════════════════════════════════════════════════════
           RESPONSIVE HELPERS
        ══════════════════════════════════════════════════════════ */
        @media (max-width: 576px) { .hide-sm { display: none !important; } }

        /* ══════════════════════════════════════════════════════════
           FOCUS
        ══════════════════════════════════════════════════════════ */
        :focus-visible {
            outline: 2.5px solid var(--lime);
            outline-offset: 3px;
            border-radius: var(--r-sm);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ═══ NAVBAR — white floating pill ═══ -->
    <div class="nav-outer">
        <div class="nav-inner">

            <!-- Brand -->
            <a class="nav-brand" href="{{ route('home') }}">
                <div class="nav-brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div>
                    <div class="nav-brand-text">ITS Academic</div>
                    <span class="nav-brand-sub">Portal Mahasiswa</span>
                </div>
            </a>

            <!-- Mobile hamburger -->
            <button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false">
                <i class="bi bi-list" id="navIcon"></i> Menu
            </button>

            <!-- Nav links -->
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home', 'beranda') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> Home
                </a></li>
                <li><a href="{{ route('profil.mahasiswa') }}"
                       class="{{ request()->routeIs('profil.mahasiswa', 'mahasiswa.detail', 'dashboard.mahasiswa') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Profil
                </a></li>
                <li><a href="{{ route('ide.agent') }}"
                       class="{{ request()->routeIs('ide.agent', 'agent', 'dashboard.agent') ? 'active' : '' }}">
                    <i class="bi bi-cpu"></i> Agentic AI
                </a></li>
                <li><a href="{{ route('hitung.ipk', ['ip1' => 3.85, 'ip2' => 3.90]) }}"
                       class="{{ request()->routeIs('hitung.ipk', 'dashboard.hitung.ipk') ? 'active' : '' }}">
                    <i class="bi bi-calculator"></i> Kalkulator IPK
                </a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}" style="background: var(--purple); color: white;">
                        <i class="bi bi-shield-lock"></i> Dashboard ({{ strtoupper(Auth::user()->role) }})
                    </a></li>
                @endauth
            </ul>

            <div class="nav-right">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ink btn-sm">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-yellow btn-sm">
                        <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Masuk
                    </a>
                @endauth
            </div>

        </div>
    </div>

    <!-- ═══ MAIN ═══ -->
    <main class="site-main">
        <div class="wrap">
            <div class="page-shell">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- ═══ FOOTER ═══ -->
    <footer class="site-footer">
        <div class="wrap">
            <div class="footer-inner">
                <p>&copy; {{ date('Y') }} <strong>Departemen Teknik Informatika ITS</strong></p>
                <p>Dikembangkan oleh <strong>Syah Amin Zikri &middot; 5025241197</strong></p>
            </div>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const navLinks  = document.getElementById('navLinks');
        const navIcon   = document.getElementById('navIcon');

        navToggle.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', isOpen);
            navIcon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
        });

        document.addEventListener('click', (e) => {
            if (!navToggle.contains(e.target) && !navLinks.contains(e.target)) {
                navLinks.classList.remove('open');
                navToggle.setAttribute('aria-expanded', false);
                navIcon.className = 'bi bi-list';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
