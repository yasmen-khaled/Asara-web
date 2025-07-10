<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.asara_beach_cottages') }} - {{ __('messages.perfect_getaway') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>{{ __('messages.asara') }}</h2>
                <span>{{ __('messages.beach_cottages') }}</span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">{{ __('messages.home') }}</a></li>
                <li><a href="#cottages">{{ __('messages.cottages') }}</a></li>
                <li><a href="#gallery">{{ __('messages.gallery') }}</a></li>
                <li><a href="#videos">{{ __('messages.videos') }}</a></li>
                <li><a href="#area">{{ __('messages.location') }}</a></li>
                <li class="nav-lang">
                    @if(app()->getLocale() === 'en')
                        <a href="{{ route('language.switch', 'ar') }}" class="lang-link">
                            <i class="fas fa-globe"></i>
                            العربية
                        </a>
                    @else
                        <a href="{{ route('language.switch', 'en') }}" class="lang-link">
                            <i class="fas fa-globe"></i>
                            English
                        </a>
                    @endif
                </li>
            </ul>
            <div class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image Slider -->
    <section id="home" class="hero">
        <div class="hero-slider">
            @php
                // Get hero images from the images directory
                $heroImages = glob(public_path('images/cover*.jpg'));
                // If no hero images found, use default images
                if (empty($heroImages)) {
                    $heroImages = [
                        public_path('images/cover.jpg'),
                        public_path('images/cover3.jpg'),
                        public_path('images/cover4.jpg')
                    ];
                }
                

            @endphp
            
            @foreach($heroImages as $index => $image)
                @php
                    $imageName = basename($image);
                    $isActive = $index === 0 ? 'active' : '';
                @endphp
                <div class="slide {{ $isActive }}">
                    <img src="{{ asset('images/' . $imageName) }}" alt="Hero Image {{ $index + 1 }}">
                </div>
            @endforeach
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">{{ __('messages.escape_to_paradise') }}</h1>
            <p class="hero-subtitle">{{ __('messages.experience_getaway') }}</p>
        </div>

        <style>
            .hero {
                position: relative;
                height: 100vh;
                min-height: 600px;
                overflow: hidden;
            }

            .hero-slider {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            .slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }

            .slide.active {
                opacity: 1;
            }

            .slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .hero-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 2;
            }

            .hero-content {
                position: relative;
                z-index: 3;
                text-align: center;
                padding: 0 20px;
                max-width: 800px;
                margin: 0 auto;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                color: white;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }

            .hero-title {
                font-size: 4rem;
                font-weight: 700;
                margin-bottom: 20px;
                font-family: 'Tajawal', sans-serif;
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards;
            }

            .hero-subtitle {
                font-size: 1.8rem;
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease 0.3s forwards;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .hero {
                    min-height: 500px;
                }

                .hero-title {
                    font-size: 2.5rem;
                }

                .hero-subtitle {
                    font-size: 1.2rem;
                }
            }
        </style>
    </section>

    <!-- Featured Cottages Section -->
    <section id="cottages" class="cottages-section">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('messages.our_beautiful_cottages') }}</h2>
                <p>{{ __('messages.discover_perfect_escape') }}</p>
                                </div>

            <div class="cottages-grid">
                @foreach($cottages as $cottage)
                <div class="cottage-card">
                    <a href="{{ route('cottage.show', $cottage['id']) }}" class="cottage-link">
                        <div class="cottage-image">
                            @if($cottage['cover_image'])
                                <img src="{{ asset('images/' . $cottage['cover_image']) }}" 
                                     alt="{{ $cottage['name'] }}" 
                                     class="cottage-img"
                                     onerror="this.src='{{ asset('images/r1.jpg') }}'">
                            @else
                                <img src="{{ asset('images/r1.jpg') }}" 
                                     alt="{{ $cottage['name'] }}" 
                                     class="cottage-img">
                            @endif
                            @if($cottage['featured'])
                                <div class="cottage-badge">
                                    <i class="fas fa-star"></i>
                                    {{ __('messages.featured') }}
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="cottage-content">
                        <div class="cottage-header">
                            <h3 class="cottage-title">{{ $cottage['name'] }}</h3>
                            <div class="cottage-price">{{ $cottage['price'] }} د.ل<span>/{{ __('messages.night') }}</span></div>
                        </div>
                        <button onclick="openBookingModal('{{ $cottage['name'] }}', 'r{{ $cottage['id'] }}')" class="book-btn">
                            {{ __('messages.book_now') }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Include booking modal once, outside the loop -->
            @include('components.booking-modal')
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('messages.beautiful_moments') }}</h2>
                <p>{{ __('messages.experience_magic_beachfront') }}</p>
                                </div>

            <div class="gallery-container">
                <div class="gallery-row gallery-row-1">
                    @php
                        $momentImages = glob(public_path('images/moments/*.jpg'));
                        $firstRowImages = array_slice($momentImages, 0, 5);
                    @endphp
                    
                    @foreach($firstRowImages as $image)
                        @php
                            $imageName = basename($image);
                            $imageNumber = pathinfo($imageName, PATHINFO_FILENAME);
                        @endphp
                        <div class="gallery-card">
                            <img src="{{ asset('images/moments/' . $imageName) }}" alt="{{ __('messages.moment') }} {{ $imageNumber }}" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4>{{ __('messages.beautiful_moment') }} {{ $imageNumber }}</h4>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Duplicate cards for infinite scroll -->
                    @foreach($firstRowImages as $image)
                        @php
                            $imageName = basename($image);
                            $imageNumber = pathinfo($imageName, PATHINFO_FILENAME);
                        @endphp
                        <div class="gallery-card">
                            <img src="{{ asset('images/moments/' . $imageName) }}" alt="{{ __('messages.moment') }} {{ $imageNumber }}" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4>{{ __('messages.beautiful_moment') }} {{ $imageNumber }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="gallery-row gallery-row-2">
                    @php
                        $secondRowImages = array_slice($momentImages, 5, 4);
                    @endphp
                    
                    @foreach($secondRowImages as $image)
                        @php
                            $imageName = basename($image);
                            $imageNumber = pathinfo($imageName, PATHINFO_FILENAME);
                        @endphp
                        <div class="gallery-card">
                            <img src="{{ asset('images/moments/' . $imageName) }}" alt="{{ __('messages.moment') }} {{ $imageNumber }}" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4>{{ __('messages.beautiful_moment') }} {{ $imageNumber }}</h4>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Duplicate cards for infinite scroll -->
                    @foreach($secondRowImages as $image)
                        @php
                            $imageName = basename($image);
                            $imageNumber = pathinfo($imageName, PATHINFO_FILENAME);
                        @endphp
                        <div class="gallery-card">
                            <img src="{{ asset('images/moments/' . $imageName) }}" alt="{{ __('messages.moment') }} {{ $imageNumber }}" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4>{{ __('messages.beautiful_moment') }} {{ $imageNumber }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience-section">
        <div class="container">
            <div class="section-title">
                <h2>فخامة وراحة لا مثيل لها</h2>
                <div class="title-divider"></div>
            </div>

            <div class="video-container">
                <video autoplay muted loop playsinline class="experience-video">
                    <source src="{{ asset('images/video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="video-overlay">
                    <h3>تصميم عصري وديكور فاخر</h3>
                    <p>استمتع بإقامة مميزة في أجنحة مصممة بعناية لتوفر لك الراحة والرفاهية</p>
                </div>
            </div>
        </div>

        <style>
            .experience-section {
                padding: 100px 0;
                background: var(--light-bg);
            }

            .section-title {
                text-align: center;
                margin-bottom: 60px;
            }

            .section-title h2 {
                font-size: 3rem;
                color: #2c3e50;
                margin-bottom: 20px;
                font-family: 'Tajawal', sans-serif;
                font-weight: 700;
            }

            .title-divider {
                width: 100px;
                height: 4px;
                background: linear-gradient(to right, #3498db, #2ecc71);
                margin: 0 auto;
                border-radius: 2px;
            }

            .video-container {
                position: relative;
                width: 100%;
                height: 700px;
                overflow: hidden;
                border-radius: 30px;
                box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            }

            .experience-video {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .video-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2));
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 60px;
                color: white;
                text-align: center;
            }

            .video-overlay h3 {
                font-size: 3rem;
                margin-bottom: 20px;
                font-family: 'Tajawal', sans-serif;
                font-weight: 700;
            }

            .video-overlay p {
                font-size: 1.4rem;
                opacity: 0.9;
                max-width: 700px;
                margin: 0 auto;
                line-height: 1.8;
            }

            @media (max-width: 992px) {
                .video-container {
                    height: 600px;
                }

                .video-overlay h3 {
                    font-size: 2.5rem;
                }

                .video-overlay p {
                    font-size: 1.2rem;
                }
            }

            @media (max-width: 768px) {
                .section-title h2 {
                    font-size: 2.5rem;
                }

                .video-container {
                    height: 500px;
                    border-radius: 20px;
                }

                .video-overlay {
                    padding: 40px;
                }

                .video-overlay h3 {
                    font-size: 2rem;
                }

                .video-overlay p {
                    font-size: 1.1rem;
                }
            }

            @media (max-width: 480px) {
                .section-title h2 {
                    font-size: 2rem;
                }

                .video-container {
                    height: 400px;
                    border-radius: 15px;
                }

                .video-overlay {
                    padding: 30px;
                }

                .video-overlay h3 {
                    font-size: 1.8rem;
                }

                .video-overlay p {
                    font-size: 1rem;
                }
            }
        </style>
    </section>

    <!-- Area Information Section -->
    <section id="area" class="area-section">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('messages.perfect_location') }}</h2>
                <p>{{ __('messages.everything_you_need_is_just_steps_away') }}</p>
            </div>
            
            <div class="area-simple">
                <div class="location-item">
                    <i class="fas fa-umbrella-beach"></i>
                    <span>{{ __('messages.private_beach_access') }}</span>
                </div>
                <div class="location-item">
                    <i class="fas fa-motorcycle"></i>
                    <span>{{ __('messages.food_delivery') }}</span>
                </div>
                <div class="location-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ __('messages.local_markets') }}</span>
                </div>
                <div class="location-item">
                    <i class="fas fa-water"></i>
                    <span>{{ __('messages.water_sports') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>{{ __('messages.asara_beach_cottages') }}</h3>
                    <p>{{ __('messages.your_perfect_beach_getaway_awaits') }}</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>{{ __('messages.quick_links') }}</h4>
                    <ul>
                        <li><a href="#cottages">{{ __('messages.our_cottages') }}</a></li>
                        <li><a href="#gallery">{{ __('messages.gallery') }}</a></li>
                        <li><a href="#videos">{{ __('messages.videos') }}</a></li>
                        <li><a href="#area">{{ __('messages.location') }}</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>{{ __('messages.policies') }}</h4>
                    <ul>
                        <li><a href="#">{{ __('messages.privacy_policy') }}</a></li>
                        <li><a href="#">{{ __('messages.terms_of_service') }}</a></li>
                        <li><a href="#">{{ __('messages.cancellation_policy') }}</a></li>
                        <li><a href="#">{{ __('messages.house_rules') }}</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 {{ __('messages.asara_beach_cottages') }}. {{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
