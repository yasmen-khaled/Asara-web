<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    @php
        use Illuminate\Support\Str;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $cottage['name'] }} - {{ __('messages.asara_beach_cottages') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --primary-color: #259ceb;
            --secondary-color: #2C5F7F;
            --accent-color: #f59e0b;
            --success-color: #34d685;
            --text-color: #334155;
            --text-light: #64748b;
            --bg-color: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .nav-back:hover {
            background: var(--bg-color);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .nav-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .nav-price {
            padding: 8px 16px;
            background: var(--accent-color);
            color: var(--white);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 1.125rem;
        }

        /* Hero Section */
        .hero-section {
            margin-top: 70px;
            padding: 30px 0;
            background: var(--bg-color);
            text-align: center;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            color: var(--text-light);
            margin: 0 auto;
        }

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 48px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        /* Image Gallery */
        .gallery-section {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
        }

        .swiper {
            width: 100%;
            height: 500px;
            position: relative;
        }

        .swiper-slide {
            position: relative;
            overflow: hidden;
        }

        .swiper-slide img,
        .swiper-slide video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .swiper-slide video {
            background: #000;
        }

        /* Media Type Indicator */
        .media-type-indicator {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(0, 0, 0, 0.7);
            color: var(--white);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Video Play Button */
        .video-play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            z-index: 10;
            border: none;
        }

        .video-play-button:hover {
            background: var(--white);
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-play-button i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-left: 4px;
        }

        /* Video Controls */
        .video-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 24px 16px 16px;
            z-index: 10;
            opacity: 0;
            transition: var(--transition);
        }

        .swiper-slide:hover .video-controls {
            opacity: 1;
        }

        .video-progress {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .video-progress-bar {
            height: 100%;
            background: var(--primary-color);
            width: 0%;
            transition: width 0.1s ease;
        }

        .video-control-buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .video-control-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .video-control-btn {
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.125rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: var(--transition);
        }

        .video-control-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .video-time {
            color: var(--white);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Swiper Navigation */
        .swiper-button-next,
        .swiper-button-prev {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-color);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--white);
            transform: scale(1.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px;
            font-weight: 700;
        }

        /* Swiper Pagination */
        .swiper-pagination {
            bottom: 20px !important;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.7);
            opacity: 1;
            width: 12px;
            height: 12px;
            margin: 0 6px !important;
            transition: var(--transition);
        }

        .swiper-pagination-bullet-active {
            background: var(--primary-color);
            transform: scale(1.2);
        }

        /* Gallery Thumbnails */
        .gallery-thumbnails {
            display: flex;
            gap: 8px;
            padding: 16px;
            background: var(--bg-color);
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .gallery-thumbnails::-webkit-scrollbar {
            height: 4px;
        }

        .gallery-thumbnails::-webkit-scrollbar-track {
            background: var(--border-color);
        }

        .gallery-thumbnails::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 2px;
        }

        .thumbnail-item {
            flex-shrink: 0;
            width: 80px;
            height: 60px;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .thumbnail-item:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .thumbnail-item.active {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-md);
        }

        .thumbnail-item img,
        .thumbnail-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--white);
            font-size: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Info Panel */
        .info-panel {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .info-card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card h2 i {
            color: var(--primary-color);
        }

        .description {
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--bg-color);
            border-radius: var(--radius);
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .feature-item:hover {
            background: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-color);
            color: var(--white);
            border-radius: var(--radius);
            font-size: 1.125rem;
        }

        .feature-text {
            font-weight: 500;
            color: var(--text-color);
        }

        /* Booking Card */
        .booking-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .booking-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 24px;
        }

        .booking-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--success-color);
            color: var(--white);
        }

        .btn-secondary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Reviews Section */
        .reviews-section {
            background: var(--white);
            border-radius: var(--radius);
            padding: 48px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .rating-stars {
            color: var(--accent-color);
            font-size: 1.25rem;
        }

        .rating-number {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .reviews-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        .reviews-list {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 16px;
        }

        .reviews-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .review-card {
            background: var(--bg-color);
            border-radius: var(--radius);
            padding: 24px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .review-card:hover {
            background: var(--white);
            box-shadow: var(--shadow-md);
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .reviewer-avatar {
            width: 48px;
            height: 48px;
            background: var(--primary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .reviewer-info h4 {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 4px;
        }

        .review-date {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .review-rating {
            color: var(--accent-color);
            margin-bottom: 12px;
        }

        .review-content {
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Review Form */
        .review-form-section {
            background: var(--bg-color);
            border-radius: var(--radius);
            padding: 32px;
            border: 1px solid var(--border-color);
            position: sticky;
            top: 90px;
            height: fit-content;
        }

        .review-form-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition);
            background: var(--white);
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            min-height: 80px;
            resize: vertical;
        }

        .rating-input {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--border-color);
            transition: var(--transition);
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: var(--accent-color);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 14px;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Custom Scrollbar */
        .reviews-list::-webkit-scrollbar {
            width: 6px;
        }

        .reviews-list::-webkit-scrollbar-track {
            background: var(--bg-color);
            border-radius: 3px;
        }

        .reviews-list::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        .reviews-list::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }

        /* Footer */
        .footer {
            background: var(--secondary-color);
            color: var(--white);
            padding: 48px 0 24px;
            margin-top: 48px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-bottom: 32px;
        }

        .footer-section h4 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .footer-section p {
            color: #cbd5e1;
            line-height: 1.6;
        }

        .footer-contact {
            list-style: none;
        }

        .footer-contact li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            color: #cbd5e1;
        }

        .footer-contact li i {
            color: var(--primary-color);
            width: 20px;
        }

        .social-links {
            display: flex;
            gap: 16px;
            margin-top: 16px;
        }

        .social-links a {
            color: #cbd5e1;
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid #334155;
            color: #94a3b8;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .reviews-container {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .review-form-section {
                position: static;
                order: -1;
            }

            .reviews-list {
                max-height: 400px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                height: 60px;
            }

            .nav-container {
                padding: 0 16px;
                height: 60px;
            }

            .nav-title {
                display: none;
            }

            .nav-back {
                padding: 6px 12px;
                font-size: 0.9rem;
            }

            .nav-back span {
                display: none;
            }

            .nav-price {
                padding: 6px 12px;
                font-size: 1rem;
            }

            .hero-section {
                margin-top: 60px;
                padding: 20px 0;
            }

            .hero-title {
                font-size: 1.75rem;
                margin-bottom: 6px;
            }

            .hero-subtitle {
                font-size: 0.95rem;
            }

            .main-container {
                padding: 20px 16px;
            }

            .reviews-section {
                padding: 32px 24px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-contact li {
                justify-content: center;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                margin-top: 70px;
                padding: 20px 0;
                min-height: auto;
            }

            .hero-title {
                font-size: 1.5rem;
                margin-bottom: 4px;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .swiper {
                height: 350px;
            }

            .gallery-thumbnails {
                padding: 12px;
                gap: 6px;
            }

            .thumbnail-item {
                width: 60px;
                height: 45px;
            }

            .media-type-indicator {
                top: 8px;
                right: 8px;
                padding: 6px 10px;
                font-size: 0.75rem;
            }

            .video-play-button {
                width: 60px;
                height: 60px;
            }

            .video-play-button i {
                font-size: 1.5rem;
            }

            .video-controls {
                padding: 16px 12px 12px;
            }

            .video-control-btn {
                padding: 6px;
                font-size: 1rem;
            }

            .video-time {
                font-size: 0.75rem;
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 40px;
                height: 40px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 16px;
            }

            .info-card,
            .booking-card {
                padding: 24px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .reviews-section {
                padding: 24px 16px;
            }

            .review-form-section {
                padding: 20px;
            }

            .nav-back i {
                font-size: 1rem;
            }

            .hero-content {
                padding: 0 16px;
            }
        }

        @media (max-width: 360px) {
            .hero-section {
                padding: 15px 0;
            }

            .hero-title {
                font-size: 1.25rem;
            }

            .hero-subtitle {
                font-size: 0.85rem;
            }

            .nav-container {
                padding: 0 12px;
            }

            .nav-back {
                padding: 4px 8px;
            }

            .nav-price {
                padding: 4px 8px;
                font-size: 0.9rem;
            }
        }

        /* RTL Support */
        [dir="rtl"] .nav-back {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .feature-item {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .review-header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .rating-input {
            flex-direction: row-reverse;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="{{ url('/') }}" class="nav-back">
                    <i class="fas fa-arrow-right"></i>
                    <span>الرجوع للرئيسية</span>
                </a>
                <div class="nav-title">{{ $cottage['name'] }}</div>
            </div>
            <div class="nav-price">{{ $cottage['price'] }} د.ل</div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">{{ $cottage['name'] }}</h1>
            <p class="hero-subtitle">استمتع بإقامة فاخرة مع إطلالة خلابة على البحر</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="main-container">
        <div class="content-grid">
            <!-- Media Gallery -->
            <div class="gallery-section">
                <div class="swiper" id="mainSwiper">
                    <div class="swiper-wrapper">
                        @php
                            $images = $cottage['images'] ?? [];
                            $videos = $cottage['videos'] ?? [];
                            $coverImage = $cottage['cover_image'] ?? null;
                            
                            // Start with cover image if it exists
                            $mediaToShow = [];
                            if ($coverImage) {
                                $mediaToShow[] = $coverImage;
                            }
                            
                            // Add other images and videos
                            $mediaToShow = array_merge($mediaToShow, $images, $videos);
                            
                            if (empty($mediaToShow)) {
                                $mediaToShow = [
                                    'images/room/475774184_122188214324144216_3845495663466731214_n.jpg',
                                    'images/room/515195567_2058047808018959_1067869568982786970_n.jpg',
                                    'images/room/514059348_2058049704685436_815350986146240186_n.jpg',
                                    'images/room/514056616_2058049784685428_4012989444296196184_n.jpg',
                                    'images/room/514095385_747940514421491_8404583104127938158_n.jpg',
                                    'images/room/506065056_747942447754631_8143157268218391998_n.jpg',
                                    'images/room/515282500_747940727754803_5536485592567294142_n.jpg',
                                    'images/room/515009824_747943354421207_7423953692824752684_n.jpg',
                                    'images/room/514280045_747941371088072_8780175055089885739_n.jpg',
                                    'images/room/514246706_747941417754734_5046162566782486708_n.jpg',
                                    'images/room/513568444_747941567754719_4577330903222531359_n.jpg'
                                ];
                            }
                        @endphp

                        @foreach($mediaToShow as $index => $media)
                            @php
                                $ext = pathinfo($media, PATHINFO_EXTENSION);
                                $isVideo = in_array($ext, ['mp4', 'webm', 'avi', 'mov']);
                                
                                // Handle different types of media paths
                                if (Str::startsWith($media, 'room/')) {
                                    $mediaPath = asset('images/' . $media);
                                } elseif (Str::startsWith($media, 'cottage')) {
                                    $mediaPath = asset('videos/' . $media);
                                } elseif (Str::startsWith($media, 'r') && !Str::contains($media, '/')) {
                                    // Cover image (starts with 'r' and no slashes)
                                    $mediaPath = asset('images/' . $media);
                                } else {
                                    $mediaPath = asset($media);
                                }
                            @endphp
                            
                            <div class="swiper-slide" data-media-type="{{ $isVideo ? 'video' : 'image' }}" data-index="{{ $index }}">
                                @if($isVideo)
                                    <video 
                                        preload="metadata" 
                                        muted
                                        onloadedmetadata="updateVideoDuration(this)"
                                        data-src="{{ $mediaPath }}"
                                        poster="{{ asset('images/video-poster.jpg') }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <source src="{{ $mediaPath }}" type="video/mp4">
                                        المتصفح لا يدعم تشغيل الفيديو
                                    </video>
                                    
                                    <div class="media-type-indicator">
                                        <i class="fas fa-play"></i>
                                        <span>فيديو</span>
                                    </div>
                                    
                                    <button class="video-play-button" onclick="toggleVideoPlay(this)">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    
                                    <div class="video-controls">
                                        <div class="video-progress">
                                            <div class="video-progress-bar"></div>
                                        </div>
                                        <div class="video-control-buttons">
                                            <div class="video-control-group">
                                                <button class="video-control-btn" onclick="toggleVideoPlay(this)">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                                <button class="video-control-btn" onclick="toggleVideoMute(this)">
                                                    <i class="fas fa-volume-up"></i>
                                                </button>
                                            </div>
                                            <div class="video-time">
                                                <span class="current-time">0:00</span> / <span class="total-time">0:00</span>
                                            </div>
                                            <div class="video-control-group">
                                                <button class="video-control-btn" onclick="toggleVideoFullscreen(this)">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Fallback image for video errors -->
                                    <img src="{{ asset('images/r1.jpg') }}" 
                                         alt="{{ $cottage['name'] }} - فيديو {{ $index + 1 }}" 
                                         style="display: none;">
                                @else
                                    <img src="{{ $mediaPath }}" 
                                         alt="{{ $cottage['name'] }} - صورة {{ $index + 1 }}" 
                                         loading="lazy"
                                         onerror="this.src='{{ asset('images/r1.jpg') }}'">
                                    
                                    <div class="media-type-indicator">
                                        <i class="fas fa-image"></i>
                                        <span>صورة</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                
                <!-- Thumbnails -->
                <div class="gallery-thumbnails" id="galleryThumbnails">
                    @foreach($mediaToShow as $index => $media)
                        @php
                            $ext = pathinfo($media, PATHINFO_EXTENSION);
                            $isVideo = in_array($ext, ['mp4', 'webm', 'avi', 'mov']);
                            
                            // Handle different types of media paths
                            if (Str::startsWith($media, 'room/')) {
                                $mediaPath = asset('images/' . $media);
                            } elseif (Str::startsWith($media, 'cottage')) {
                                $mediaPath = asset('videos/' . $media);
                            } elseif (Str::startsWith($media, 'r') && !Str::contains($media, '/')) {
                                // Cover image (starts with 'r' and no slashes)
                                $mediaPath = asset('images/' . $media);
                            } else {
                                $mediaPath = asset($media);
                            }
                        @endphp
                        
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                             onclick="goToSlide({{ $index }})" 
                             data-index="{{ $index }}">
                            @if($isVideo)
                                <video muted preload="metadata">
                                    <source src="{{ $mediaPath }}" type="video/mp4">
                                </video>
                                <div class="thumbnail-play-icon">
                                    <i class="fas fa-play"></i>
                                </div>
                            @else
                                <img src="{{ $mediaPath }}" 
                                     alt="صورة مصغرة {{ $index + 1 }}"
                                     onerror="this.src='{{ asset('images/r1.jpg') }}'">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Info Panel -->
            <div class="info-panel">
                <!-- About Section -->
                <div class="info-card">
                    <h2><i class="fas fa-info-circle"></i> عن الشاليه</h2>
                    <p class="description">{{ $cottage['description'] }}</p>
                </div>

                <!-- Features Section -->
                <div class="info-card">
                    <h2><i class="fas fa-star"></i> المميزات</h2>
                    <div class="features-grid">
                        @php
                            $featureIcons = [
                                'luxury_bedroom' => ['icon' => 'fas fa-bed', 'name' => 'غرفة نوم فاخرة'],
                                'central_ac' => ['icon' => 'fas fa-wind', 'name' => 'تكييف مركزي'],
                                'high_speed_wifi' => ['icon' => 'fas fa-wifi', 'name' => 'إنترنت فائق السرعة'],
                                'smart_tv' => ['icon' => 'fas fa-tv', 'name' => 'تلفاز ذكي'],
                                'luxury_bathroom' => ['icon' => 'fas fa-shower', 'name' => 'حمام فاخر'],
                                'sea_view_balcony' => ['icon' => 'fas fa-umbrella-beach', 'name' => 'شرفة مطلة على البحر'],
                                'private_pool' => ['icon' => 'fas fa-swimming-pool', 'name' => 'مسبح خاص'],
                                'equipped_kitchen' => ['icon' => 'fas fa-utensils', 'name' => 'مطبخ مجهز'],
                                'parking' => ['icon' => 'fas fa-car', 'name' => 'موقف سيارات'],
                                'security_system' => ['icon' => 'fas fa-shield-alt', 'name' => 'نظام أمان 24/7'],
                                'daily_cleaning' => ['icon' => 'fas fa-broom', 'name' => 'خدمة تنظيف يومية'],
                                'concierge_service' => ['icon' => 'fas fa-concierge-bell', 'name' => 'خدمة كونسيرج'],
                                'gym' => ['icon' => 'fas fa-dumbbell', 'name' => 'صالة رياضية'],
                                'spa_massage' => ['icon' => 'fas fa-spa', 'name' => 'سبا ومساج'],
                                'child_friendly' => ['icon' => 'fas fa-baby-carriage', 'name' => 'مناسب للأطفال'],
                                'accessible' => ['icon' => 'fas fa-wheelchair', 'name' => 'مناسب لذوي الاحتياجات'],
                                'non_smoking' => ['icon' => 'fas fa-smoking-ban', 'name' => 'منطقة غير مدخنة'],
                                'pet_friendly' => ['icon' => 'fas fa-paw', 'name' => 'يسمح بالحيوانات الأليفة']
                            ];
                            
                            $cottageFeatures = $cottage['features'] ?? [];
                        @endphp
                        
                        @foreach($cottageFeatures as $featureKey)
                            @if(isset($featureIcons[$featureKey]))
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="{{ $featureIcons[$featureKey]['icon'] }}"></i>
                                    </div>
                                    <span class="feature-text">{{ $featureIcons[$featureKey]['name'] }}</span>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(empty($cottageFeatures))
                            <!-- Default features if none are set -->
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <span class="feature-text">غرفة نوم فاخرة</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-wind"></i>
                                </div>
                                <span class="feature-text">تكييف مركزي</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <span class="feature-text">إنترنت فائق السرعة</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-tv"></i>
                                </div>
                                <span class="feature-text">تلفاز ذكي</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shower"></i>
                                </div>
                                <span class="feature-text">حمام فاخر</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-umbrella-beach"></i>
                                </div>
                                <span class="feature-text">شرفة مطلة على البحر</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Booking Card -->
                <div class="booking-card">
                    <h3>احجز إقامتك الآن</h3>
                    <div class="booking-buttons">
                        <button class="btn btn-primary" onclick="openBookingModal('{{ $cottage['name'] }}', 'r{{ $cottage['id'] }}')">
                            <i class="fas fa-calendar-alt"></i>
                            {{ __('messages.book_now') }}
                        </button>
                        <a href="tel:+218918868883" class="btn btn-secondary">
                            <i class="fas fa-phone"></i>
                            اتصل بنا
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section">
            <div class="section-header">
                <h2 class="section-title">تجارب ضيوفنا الكرام</h2>
                <div class="rating-summary">
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-number">٤.٥ من ٥</span>
                </div>
            </div>

            <div class="reviews-container">
                <!-- Reviews List -->
                <div class="reviews-list">
                    <div class="reviews-grid">
                        @forelse($reviews ?? [] as $review)
                            @php
                                $arabicDate = \Carbon\Carbon::parse($review->created_at)->format('d/m/Y');
                                $arabicDate = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'], $arabicDate);
                            @endphp
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="reviewer-info">
                                        <h4>{{ $review->guest_name }}</h4>
                                        <div class="review-date">{{ $arabicDate }}</div>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="review-content">{{ $review->review_text }}</p>
                            </div>
                        @empty
                            <div class="review-card" style="text-align: center; color: var(--text-light);">
                                <i class="fas fa-comments" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                <p>لا توجد تقييمات بعد. كن أول من يشارك تجربته!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Review Form -->
                <div class="review-form-section">
                    <h3>شاركنا تجربتك</h3>
                    <form class="review-form" id="reviewForm" onsubmit="return submitReview(event)">
                        @csrf
                        <input type="hidden" name="cottage_id" value="{{ $cottage['id'] }}">
                        
                        <div class="form-group">
                            <label class="form-label">الاسم الكريم</label>
                            <input type="text" name="guest_name" class="form-input" placeholder="أدخل اسمك" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="guest_email" class="form-input" placeholder="أدخل بريدك الإلكتروني" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">تقييمك للإقامة</label>
                            <div class="rating-input">
                                @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
                                <label for="star{{ $i }}" title="{{ $i }} نجوم"><i class="fas fa-star"></i></label>
                                @endfor
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">تجربتك معنا</label>
                            <textarea name="review_text" class="form-textarea" placeholder="شاركنا تجربتك في الإقامة معنا..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            إرسال التقييم
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Booking Modal -->
    @include('components.booking-modal')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>كمباوند إغرماون</h4>
                    <p>استمتع بإقامة مميزة في أجمل شاليهات كمباوند إغرماون على شاطئ البحر. نوفر لكم تجربة إقامة لا تُنسى مع خدمات راقية وإطلالات خلابة.</p>
                    <div class="social-links">
                        <a href="#" aria-label="فيسبوك"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="انستغرام"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="واتساب"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>تواصل معنا</h4>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+218 91-886-8883</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>عصارة، طرابلس، ليبيا</span>
                        </li>
                        <li>
                            <i class="far fa-clock"></i>
                            <span>خدمة متاحة على مدار الساعة</span>
                        </li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>احجز إقامتك</h4>
                    <p>نسعد بخدمتكم في أي وقت. للحجز والاستفسار يمكنكم التواصل معنا عبر:</p>
                    <ul class="footer-contact">
                        <li>
                            <i class="fab fa-whatsapp"></i>
                            <span>واتساب: 91-886-8883</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>اتصال: 91-886-8883</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>راسلنا عبر الموقع</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2024 كمباوند إغرماون - جميع الحقوق محفوظة</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        let mainSwiper;
        let currentVideo = null;

        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function() {
            mainSwiper = new Swiper('#mainSwiper', {
                loop: false,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'slide',
                speed: 600,
                grabCursor: true,
                keyboard: {
                    enabled: true,
                },
                mousewheel: {
                    thresholdDelta: 50,
                },
                on: {
                    slideChange: function() {
                        pauseAllVideos();
                        updateThumbnailActive(this.activeIndex);
                        
                        // Auto-pause videos when changing slides
                        const currentSlide = this.slides[this.activeIndex];
                        if (currentSlide) {
                            const video = currentSlide.querySelector('video');
                            if (video) {
                                video.pause();
                                updateVideoPlayButton(currentSlide, false);
                            }
                        }
                    },
                    init: function() {
                        // Load first video if exists
                        const firstSlide = this.slides[0];
                        if (firstSlide) {
                            const video = firstSlide.querySelector('video');
                            if (video && video.dataset.src) {
                                video.src = video.dataset.src;
                            }
                        }
                    }
                }
            });

            // Pause autoplay when user interacts with videos
            document.querySelectorAll('video').forEach(video => {
                video.addEventListener('play', () => {
                    mainSwiper.autoplay.stop();
                });
                video.addEventListener('pause', () => {
                    mainSwiper.autoplay.start();
                });
            });
        });

        // Video Controls
        function toggleVideoPlay(button) {
            const slide = button.closest('.swiper-slide');
            const video = slide.querySelector('video');
            
            if (!video) return;

            // Load video source if not loaded
            if (!video.src && video.dataset.src) {
                video.src = video.dataset.src;
            }

            if (video.paused) {
                pauseAllVideos();
                video.play();
                currentVideo = video;
                updateVideoPlayButton(slide, true);
                mainSwiper.autoplay.stop();
            } else {
                video.pause();
                currentVideo = null;
                updateVideoPlayButton(slide, false);
                mainSwiper.autoplay.start();
            }
        }

        function toggleVideoMute(button) {
            const slide = button.closest('.swiper-slide');
            const video = slide.querySelector('video');
            const muteIcon = button.querySelector('i');
            
            if (!video) return;

            video.muted = !video.muted;
            muteIcon.className = video.muted ? 'fas fa-volume-mute' : 'fas fa-volume-up';
        }

        function toggleVideoFullscreen(button) {
            const slide = button.closest('.swiper-slide');
            const video = slide.querySelector('video');
            
            if (!video) return;

            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) {
                video.msRequestFullscreen();
            }
        }

        function updateVideoPlayButton(slide, isPlaying) {
            const playButton = slide.querySelector('.video-play-button i');
            const controlButton = slide.querySelector('.video-control-btn i');
            
            if (playButton) {
                playButton.className = isPlaying ? 'fas fa-pause' : 'fas fa-play';
            }
            if (controlButton) {
                controlButton.className = isPlaying ? 'fas fa-pause' : 'fas fa-play';
            }
        }

        function pauseAllVideos() {
            document.querySelectorAll('video').forEach(video => {
                if (!video.paused) {
                    video.pause();
                    const slide = video.closest('.swiper-slide');
                    if (slide) {
                        updateVideoPlayButton(slide, false);
                    }
                }
            });
            currentVideo = null;
            mainSwiper.autoplay.start();
        }

        function updateVideoDuration(video) {
            const slide = video.closest('.swiper-slide');
            const totalTimeElement = slide.querySelector('.total-time');
            
            if (totalTimeElement && video.duration) {
                totalTimeElement.textContent = formatTime(video.duration);
            }

            // Update progress
            video.addEventListener('timeupdate', function() {
                const progressBar = slide.querySelector('.video-progress-bar');
                const currentTimeElement = slide.querySelector('.current-time');
                
                if (progressBar && this.duration) {
                    const progress = (this.currentTime / this.duration) * 100;
                    progressBar.style.width = progress + '%';
                }
                
                if (currentTimeElement) {
                    currentTimeElement.textContent = formatTime(this.currentTime);
                }
            });
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs.toString().padStart(2, '0')}`;
        }

        // Thumbnail Gallery
        function goToSlide(index) {
            if (mainSwiper) {
                mainSwiper.slideTo(index);
            }
        }

        function updateThumbnailActive(activeIndex) {
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            thumbnails.forEach((thumb, index) => {
                thumb.classList.toggle('active', index === activeIndex);
            });

            // Scroll thumbnail into view
            const activeThumbnail = document.querySelector(`.thumbnail-item[data-index="${activeIndex}"]`);
            if (activeThumbnail) {
                activeThumbnail.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        // Keyboard controls
        document.addEventListener('keydown', function(e) {
            if (currentVideo) {
                switch(e.code) {
                    case 'Space':
                        e.preventDefault();
                        const slide = currentVideo.closest('.swiper-slide');
                        const playButton = slide.querySelector('.video-play-button');
                        if (playButton) toggleVideoPlay(playButton);
                        break;
                    case 'KeyM':
                        e.preventDefault();
                        const slide2 = currentVideo.closest('.swiper-slide');
                        const muteButton = slide2.querySelector('.video-control-btn:nth-child(2)');
                        if (muteButton) toggleVideoMute(muteButton);
                        break;
                    case 'KeyF':
                        e.preventDefault();
                        const slide3 = currentVideo.closest('.swiper-slide');
                        const fullscreenButton = slide3.querySelector('.video-control-btn:last-child');
                        if (fullscreenButton) toggleVideoFullscreen(fullscreenButton);
                        break;
                }
            }
        });

        // Booking Modal Functions
        function openBookingModal(cottageName, cottageId) {
            const modal = document.getElementById('bookingModal');
            const cottageTitleElement = modal.querySelector('.cottage-name');
            
            cottageTitleElement.textContent = cottageName;
            modal.dataset.cottageId = cottageId;
            modal.style.display = 'block';
            
            const closeBtn = modal.querySelector('.modal-close');
            const overlay = modal.querySelector('.modal-overlay');
            
            closeBtn.onclick = () => modal.style.display = 'none';
            overlay.onclick = () => modal.style.display = 'none';
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') modal.style.display = 'none';
            });
        }

        function submitBooking() {
            const modal = document.getElementById('bookingModal');
            const checkin = document.getElementById('modalCheckIn').value;
            const checkout = document.getElementById('modalCheckOut').value;
            const guests = document.getElementById('modalGuests').value;
            const notes = document.getElementById('modalNotes').value;
            const name = document.getElementById('modalName').value;
            const phone = document.getElementById('modalPhone').value;
            
            if (!checkin || !checkout || !name || !phone) {
                alert('الرجاء ملء جميع الحقول المطلوبة');
                return;
            }
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!csrfToken) {
                alert('خطأ في الأمان. يرجى تحديث الصفحة والمحاولة مرة أخرى.');
                return;
            }
            
            // Show loading state
            const submitBtn = modal.querySelector('.submit-booking');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
            submitBtn.disabled = true;
            
            // Send booking data to backend first
            fetch('/bookings', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    phone: phone,
                    checkin: checkin,
                    checkout: checkout,
                    guests: parseInt(guests),
                    notes: notes
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Booking saved successfully, now open WhatsApp
                    const checkinDate = new Date(checkin);
                    const checkoutDate = new Date(checkout);
                    const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                    
                    const dateFormatter = new Intl.DateTimeFormat('ar-LY', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    const checkinFormatted = dateFormatter.format(checkinDate);
                    const checkoutFormatted = dateFormatter.format(checkoutDate);
                    const cottageName = modal.querySelector('.cottage-name').textContent;
                    
                    const message = `السلام عليكم،
أود حجز ${cottageName}

موعد الوصول: ${checkinFormatted}
موعد المغادرة: ${checkoutFormatted}
عدد الليالي: ${nights}
عدد الضيوف: ${guests}
${notes ? `ملاحظات: ${notes}` : ''}

أرجو إخباري بالتوفر والأسعار.
شكراً لكم!`;
                    
                    window.open(`https://wa.me/218918868883?text=${encodeURIComponent(message)}`, '_blank');
                    modal.style.display = 'none';
                    alert('تم حفظ بيانات الحجز بنجاح! سيتم التواصل معكم قريباً.');
                } else {
                    alert('حدث خطأ أثناء حفظ بيانات الحجز: ' + (data.message || 'خطأ غير معروف'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء حفظ بيانات الحجز. تأكد من اتصالك بالإنترنت وحاول مرة أخرى.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }

        // Reviews handling
        function submitReview(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            
            // Get CSRF token safely
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value;
            
            if (!csrfToken) {
                alert('خطأ في الأمان. يرجى تحديث الصفحة والمحاولة مرة أخرى.');
                return false;
            }
            
            // Show loading state
            const submitBtn = form.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
            submitBtn.disabled = true;
            
            // Validate form data
            const cottageId = formData.get('cottage_id');
            const guestName = formData.get('guest_name');
            const guestEmail = formData.get('guest_email');
            const rating = formData.get('rating');
            const reviewText = formData.get('review_text');
            
            if (!cottageId || !guestName || !guestEmail || !rating || !reviewText) {
                alert('يرجى ملء جميع الحقول المطلوبة');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                return false;
            }
            
            fetch('/reviews', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    cottage_id: cottageId,
                    guest_name: guestName,
                    guest_email: guestEmail,
                    rating: parseInt(rating),
                    review_text: reviewText
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Create and add the review card
                    const reviewCard = document.createElement('div');
                    reviewCard.className = 'review-card';
                    
                    const date = new Date();
                    const arabicDate = new Intl.DateTimeFormat('ar-LY', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    }).format(date);
                    
                    const starsHtml = Array(5).fill()
                        .map((_, index) => `<i class="fa${index < rating ? 's' : 'r'} fa-star"></i>`)
                        .join('');
                    
                    reviewCard.innerHTML = `
                        <div class="review-header">
                            <div class="reviewer-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="reviewer-info">
                                <h4>${guestName}</h4>
                                <div class="review-date">${arabicDate}</div>
                            </div>
                        </div>
                        <div class="review-rating">
                            ${starsHtml}
                        </div>
                        <p class="review-content">${reviewText}</p>
                    `;
                    
                    const reviewsGrid = document.querySelector('.reviews-grid');
                    if (reviewsGrid) {
                        // Remove the "no reviews" message if it exists
                        const noReviewsMsg = reviewsGrid.querySelector('.review-card[style*="text-align: center"]');
                        if (noReviewsMsg) {
                            noReviewsMsg.remove();
                        }
                        reviewsGrid.insertBefore(reviewCard, reviewsGrid.firstChild);
                    }
                    
                    form.reset();
                    alert('تم إضافة تقييمك بنجاح!');
                } else {
                    alert('حدث خطأ أثناء إرسال التقييم: ' + (data.message || 'خطأ غير معروف'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء إرسال التقييم. تأكد من اتصالك بالإنترنت وحاول مرة أخرى.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
            
            return false;
        }
    </script>
</body>
</html> 