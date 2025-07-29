// DOM Elements
const navbar = document.querySelector('.navbar');
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');

// Hero Image Slider
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero .slide');
    let currentSlide = 0;

    function showNextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Change slide every 5 seconds
    if (slides.length > 1) {
        setInterval(showNextSlide, 5000);
    }
});

// Set minimum dates for booking form
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    if (checkinInput && checkoutInput) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        checkinInput.min = today;
        checkoutInput.min = today;
        
        // Update checkout minimum when checkin changes
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1); // Next day minimum
            checkoutInput.min = checkinDate.toISOString().split('T')[0];
            
            // Clear checkout if it's now invalid
            if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
                checkoutInput.value = '';
            }
        });
    }
});

// Navbar scroll effect
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile menu toggle
navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    navToggle.classList.toggle('active');
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
    });
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});



// Booking form functionality
function submitBookingForm() {
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const guests = document.getElementById('guests').value;
    
    if (!checkin || !checkout || !guests) {
        alert('Please fill in all booking fields (check-in date, check-out date, and number of guests)');
        return;
    }
    
    // Validate that checkout is after checkin
    const checkinDate = new Date(checkin);
    const checkoutDate = new Date(checkout);
    
    if (checkoutDate <= checkinDate) {
        alert('Check-out date must be after check-in date');
        return;
    }
    
    // Calculate number of nights
    const timeDiff = checkoutDate.getTime() - checkinDate.getTime();
    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
    
    // Format dates for display
    const checkinFormatted = new Date(checkin).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    const checkoutFormatted = new Date(checkout).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    // Create WhatsApp message
    const whatsappMessage = `Hi! I would like to make a booking at Asara Beach Cottages.

📅 Check-in: ${checkinFormatted}
📅 Check-out: ${checkoutFormatted}
🏠 Duration: ${nights} night${nights > 1 ? 's' : ''}
👥 Guests: ${guests}

Please let me know about availability and pricing for these dates. Thank you!`;
    
    // WhatsApp number (you can change this to your actual WhatsApp number)
    const whatsappNumber = '+218918868883';
    
    // Create WhatsApp URL
    const whatsappURL = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`;
    
    // Open WhatsApp
    window.open(whatsappURL, '_blank');
    
    // Show success message
    showSuccessMessage('Redirecting to WhatsApp for booking...');
}

// Show search results
function showSearchResults(checkin, checkout, guests) {
    const cottagesSection = document.getElementById('cottages');
    const existingAlert = cottagesSection.querySelector('.search-alert');
    
    if (existingAlert) {
        existingAlert.remove();
    }
    
    const searchAlert = document.createElement('div');
    searchAlert.className = 'search-alert';
    searchAlert.innerHTML = `
        <div style="background: linear-gradient(45deg, #2C5F7F, #64B5F6); color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center;">
            <h3>Search Results</h3>
            <p>Showing available cottages for ${guests} guests from ${checkin} to ${checkout}</p>
        </div>
    `;
    
    cottagesSection.querySelector('.container').insertBefore(searchAlert, cottagesSection.querySelector('.cottages-grid'));
    
    // Remove alert after 5 seconds
    setTimeout(() => {
        searchAlert.remove();
    }, 5000);
}





// Show success message
function showSuccessMessage(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'success-message';
    successDiv.innerHTML = `
        <div style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            z-index: 3000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: slideInRight 0.5s ease-out;
        ">
            <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
            ${message}
        </div>
    `;
    
    document.body.appendChild(successDiv);
    
    // Remove message after 5 seconds
    setTimeout(() => {
        successDiv.remove();
    }, 5000);
}



// Gallery slider functionality
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.gallery-slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
    const track = document.querySelector('.gallery-track');
    
    // Check if elements exist before proceeding
    if (!track || slides.length === 0) {
        console.warn('Gallery slider elements not found');
        return;
    }
    
    const slideWidth = slides[0].clientWidth;
    
    // Remove active class from all dots
    dots.forEach(dot => dot.classList.remove('active'));
    
    // Add active class to current dot
    if (dots[index]) {
        dots[index].classList.add('active');
    }
    
    // Move to the slide
    track.style.transform = `translateX(-${index * slideWidth}px)`;
    currentSlideIndex = index;
}

function moveSlide(direction) {
    const newIndex = currentSlideIndex + direction;
    
    if (newIndex >= 0 && newIndex < slides.length) {
        showSlide(newIndex);
    } else if (newIndex < 0) {
        showSlide(slides.length - 1);
    } else {
        showSlide(0);
    }
}

function currentSlide(index) {
    showSlide(index - 1);
}

// Auto-slide functionality
if (slides.length > 0) {
    setInterval(() => {
        const nextIndex = (currentSlideIndex + 1) % slides.length;
        showSlide(nextIndex);
    }, 5000);
}

// Gallery photos lightbox
const gallerySlides = document.querySelectorAll('.gallery-slide img');
if (gallerySlides.length > 0) {
    gallerySlides.forEach(img => {
        img.addEventListener('click', () => {
            openLightbox(img.src, img.alt);
        });
    });
}

// Open lightbox for images
function openLightbox(src, alt) {
    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    lightbox.innerHTML = `
        <div style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 4000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        ">
            <img src="${src}" alt="${alt}" style="
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            ">
            <button style="
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                font-size: 1.5rem;
                cursor: pointer;
                transition: all 0.3s ease;
            " onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(lightbox);
    
    // Close lightbox when clicking outside image
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox.firstElementChild) {
            lightbox.remove();
        }
    });
    
    // Close lightbox with Escape key
    document.addEventListener('keydown', function escapeHandler(e) {
        if (e.key === 'Escape') {
            lightbox.remove();
            document.removeEventListener('keydown', escapeHandler);
        }
    });
}

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('loading');
        }
    });
}, observerOptions);

// Observe elements for animation
const animatedElements = document.querySelectorAll('.cottage-card, .review-card, .attraction-card');
if (animatedElements.length > 0) {
    animatedElements.forEach(el => {
        observer.observe(el);
    });
}

// Set minimum date for date inputs
const today = new Date().toISOString().split('T')[0];
const dateInputs = document.querySelectorAll('input[type="date"]');
if (dateInputs.length > 0) {
    dateInputs.forEach(input => {
        input.min = today;
    });
}

// Date input validation
if (dateInputs.length > 0) {
    dateInputs.forEach((input, index) => {
        input.addEventListener('change', (e) => {
            const checkinInputs = document.querySelectorAll('input[type="date"]');
            
            // If this is a check-in date, update check-out minimum
            if (index % 2 === 0 && checkinInputs[index + 1]) {
                const checkinDate = new Date(e.target.value);
                const nextDay = new Date(checkinDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkinInputs[index + 1].min = nextDay.toISOString().split('T')[0];
            }
        });
    });
}

// Cottage card hover effects
const cottageCards = document.querySelectorAll('.cottage-card');
if (cottageCards.length > 0) {
    cottageCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
}

// Dynamic pricing calculation (demo)
function calculatePrice(cottage, nights, guests) {
    const basePrices = {
        'sunset-villa': 299,
        'ocean-breeze': 249,
        'tropical-paradise': 399
    };
    
    const basePrice = basePrices[cottage] || 250;
    const guestSurcharge = guests > 2 ? (guests - 2) * 25 : 0;
    const total = (basePrice + guestSurcharge) * nights;
    
    return {
        basePrice,
        guestSurcharge,
        nights,
        total
    };
}

// Add loading states for forms
const forms = document.querySelectorAll('form');
if (forms.length > 0) {
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.textContent;
                
                submitBtn.textContent = 'Processing...';
                submitBtn.disabled = true;
                
                // Re-enable button after 2 seconds (for demo)
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            }
        });
    });
}

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroBackground = document.querySelector('.hero-background');
    
    if (heroBackground) {
        heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Add CSS animations dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .nav-menu.active {
        display: flex;
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        background: white;
        flex-direction: column;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }
    
    .nav-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .nav-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .nav-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
`;
document.head.appendChild(style);

// Initialize page
document.addEventListener('DOMContentLoaded', () => {
    // Add loading class to animate elements
    setTimeout(() => {
        document.querySelectorAll('.cottage-card, .review-card').forEach(el => {
            el.classList.add('loading');
        });
    }, 500);
    
    // Set current year in footer
    const currentYear = new Date().getFullYear();
    const footerYear = document.querySelector('.footer-bottom p');
    if (footerYear) {
        footerYear.textContent = footerYear.textContent.replace('2024', currentYear);
    }
});

// Add some placeholder images for demo
const placeholderImages = {
    cottage1: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
    cottage2: 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
    cottage3: 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
    guest1: 'https://images.unsplash.com/photo-1494790108755-2616b612b9fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80',
    guest2: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80',
    guest3: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'
};

// Update image sources
document.addEventListener('DOMContentLoaded', () => {
    Object.keys(placeholderImages).forEach(key => {
        const img = document.querySelector(`img[src*="${key}"]`);
        if (img) {
            img.src = placeholderImages[key];
        }
    });
}); 

// Gallery Animation Fix for RTL/Mobile
document.addEventListener('DOMContentLoaded', function() {
    // Fix gallery animations on mobile and RTL
    const galleryRows = document.querySelectorAll('.gallery-row');
    
    function reinitializeGalleryAnimations() {
        galleryRows.forEach((row, index) => {
            // Remove existing animation to reset
            row.style.animation = 'none';
            
            // Force reflow
            row.offsetHeight;
            
            // Re-apply animation based on RTL state
            const isRTL = document.documentElement.dir === 'rtl';
            const animationName = isRTL ? 'scrollHorizontalRTL' : 'scrollHorizontal';
            const duration = index === 1 ? '35s' : '40s'; // gallery-row-2 has different duration
            const direction = index === 1 ? 'reverse' : 'normal';
            
            // Apply animation with proper parameters
            row.style.animationName = animationName;
            row.style.animationDuration = duration;
            row.style.animationDirection = direction;
            row.style.animationTimingFunction = 'linear';
            row.style.animationIterationCount = 'infinite';
        });
    }

    // Initialize gallery animations
    reinitializeGalleryAnimations();

    // Handle window resize and orientation changes for mobile
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            reinitializeGalleryAnimations();
        }, 250);
    });

    // Handle orientation change on mobile
    window.addEventListener('orientationchange', function() {
        setTimeout(function() {
            reinitializeGalleryAnimations();
        }, 500);
    });

    // Touch handling for mobile gallery
    let startX = 0;
    let scrollLeft = 0;
    let isScrolling = false;

    galleryRows.forEach(row => {
        // Pause animation on touch start
        row.addEventListener('touchstart', function(e) {
            startX = e.touches[0].pageX;
            isScrolling = true;
            row.style.animationPlayState = 'paused';
        }, { passive: true });

        // Resume animation on touch end
        row.addEventListener('touchend', function() {
            isScrolling = false;
            setTimeout(() => {
                if (!isScrolling) {
                    row.style.animationPlayState = 'running';
                }
            }, 100);
        }, { passive: true });

        // Handle touch move for better mobile experience
        row.addEventListener('touchmove', function(e) {
            if (!isScrolling) return;
            
            const currentX = e.touches[0].pageX;
            const diffX = startX - currentX;
            
            // Temporarily adjust transform based on touch
            const currentTransform = getComputedStyle(row).transform;
            if (currentTransform !== 'none') {
                const matrix = new DOMMatrix(currentTransform);
                const newX = matrix.m41 - (diffX * 0.5);
                row.style.transform = `translateX(${newX}px)`;
            }
        }, { passive: true });
    });
});

// Hero Slider functionality
document.addEventListener('DOMContentLoaded', function() {
    const heroSlides = document.querySelectorAll('.hero .slide');
    let currentSlide = 0;
    const slideInterval = 6000; // 6 seconds per slide

    if (heroSlides.length > 0) {
        function nextSlide() {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }

        // Start the slideshow
        setInterval(nextSlide, slideInterval);
    }
});

// Booking Modal Functions
window.openBookingModal = function(cottageName, cottageId, cottagePrice) {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;

    const cottageTitleElement = modal.querySelector('.cottage-name');
    if (cottageTitleElement) {
        cottageTitleElement.textContent = cottageName;
    }
    
    // Store cottage data for later use
    modal.dataset.cottageId = cottageId;
    modal.dataset.cottagePrice = cottagePrice || 0;

    // Fetch special prices for this cottage
    window._specialPricesMap = {};
    fetch(`/api/cottages/${cottageId}/special-prices`)
        .then(res => res.json())
        .then(prices => {
            prices.forEach(item => {
                window._specialPricesMap[item.date] = parseFloat(item.price);
            });
            // After fetching special prices, update calendar and cost
            if (typeof window._refreshFlatpickrSpecials === 'function') window._refreshFlatpickrSpecials();
            calculateBookingCost();
        });
    
    // Update price per night display
    const pricePerNightElement = document.getElementById('pricePerNight');
    if (pricePerNightElement) {
        pricePerNightElement.textContent = `${cottagePrice || 0} د.ل`;
    }
    
    // Calculate initial cost
    calculateBookingCost();
    
    // Show modal
    modal.style.display = 'block';
    
    // Add close handlers
    const closeBtn = modal.querySelector('.modal-close');
    const overlay = modal.querySelector('.modal-overlay');
    
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
    }
    
    if (overlay) {
        overlay.onclick = function() {
            modal.style.display = 'none';
        }
    }
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modal.style.display = 'none';
        }
    });

    // --- New: Render flatpickr inline calendar in modalCalendar ---
    const calendarDiv = document.getElementById('modalCalendar');
    if (calendarDiv && cottageId && window.flatpickr) {
        // Remove any previous flatpickr instance
        if (calendarDiv._flatpickr) {
            calendarDiv._flatpickr.destroy();
        }
        fetch(`/api/cottages/${cottageId}/unavailable-dates`)
            .then(res => res.json())
            .then(unavailableDates => {
                const unavailableSet = new Set(unavailableDates);
                window._selectedRange = null;
                window._refreshFlatpickrSpecials = function() {
                    if (!calendarDiv._flatpickr) return;
                    // Redraw calendar to update special price highlights
                    calendarDiv._flatpickr.redraw();
                };
                flatpickr(calendarDiv, {
                    mode: 'range',
                    minDate: 'today',
                    inline: true,
                    disable: [function(date) {
                        const d = formatDateLocal(date);
                        return unavailableSet.has(d);
                    }],
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        const d = formatDateLocal(dayElem.dateObj);
                        if (unavailableSet.has(d)) {
                            dayElem.classList.add('blocked-day');
                        } else {
                            dayElem.classList.add('available-day');
                        }
                        // Highlight special price days
                        if (window._specialPricesMap && window._specialPricesMap[d] !== undefined) {
                            dayElem.classList.add('special-price-day');
                            dayElem.title = 'سعر خاص: ' + window._specialPricesMap[d] + ' د.ل';
                        }
                    },
                    onChange: function(selectedDates, dateStr, instance) {
                        console.log('Selected dates:', selectedDates); // Debug
                        window._selectedRange = selectedDates;
                        calculateBookingCost();
                    }
                });
            });
    }
}

// Calculate booking cost based on dates (with special prices)
function calculateBookingCost() {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;
    const numberOfNightsElement = document.getElementById('numberOfNights');
    const totalCostElement = document.getElementById('totalCost');
    const cottagePrice = parseInt(modal.dataset.cottagePrice) || 0;
    let nights = 0;
    let totalCost = 0;
    
    if (window._selectedRange && window._selectedRange.length > 0) {
        if (window._selectedRange.length === 1) {
            // Single day selection - charge for 1 night
            nights = 1;
            const selectedDate = window._selectedRange[0];
            const d = formatDateLocal(selectedDate);
            if (window._specialPricesMap && window._specialPricesMap[d] !== undefined) {
                totalCost = window._specialPricesMap[d];
            } else {
                totalCost = cottagePrice;
            }
        } else if (window._selectedRange.length === 2) {
            // Range selection - calculate for the range
            const checkinDate = window._selectedRange[0];
            const checkoutDate = window._selectedRange[1];
            nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
            if (nights > 0) {
                let current = new Date(checkinDate);
                for (let i = 0; i < nights; i++) {
                    const d = formatDateLocal(current);
                    if (window._specialPricesMap && window._specialPricesMap[d] !== undefined) {
                        totalCost += window._specialPricesMap[d];
                    } else {
                        totalCost += cottagePrice;
                    }
                    current.setDate(current.getDate() + 1);
                }
            }
        }
    }
    
    if (nights > 0) {
        numberOfNightsElement.textContent = `${nights} ليلة`;
        totalCostElement.textContent = `${totalCost} د.ل`;
    } else {
        numberOfNightsElement.textContent = '--';
        totalCostElement.textContent = '-- د.ل';
    }
}

// Submit Booking Function
function submitBooking() {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;

    const name = document.getElementById('modalName')?.value;
    const phone = document.getElementById('modalPhone')?.value;
    let checkin = '', checkout = '';
    
    if (window._selectedRange && window._selectedRange.length > 0) {
        if (window._selectedRange.length === 1) {
            // Single day selection - use same date for checkin and checkout
            const selectedDate = window._selectedRange[0];
            checkin = selectedDate.toISOString().split('T')[0];
            checkout = selectedDate.toISOString().split('T')[0];
        } else if (window._selectedRange.length === 2) {
            // Range selection - use the range as is
            checkin = window._selectedRange[0].toISOString().split('T')[0];
            checkout = window._selectedRange[1].toISOString().split('T')[0];
        }
    }
    
    const guests = document.getElementById('modalGuests')?.value;
    const notes = document.getElementById('modalNotes')?.value;
    const cottageId = modal.dataset.cottageId; // Get the cottage id
    
    if (!checkin || !checkout || !phone || !name) {
        alert('الرجاء إدخال جميع البيانات المطلوبة');
        return;
    }
    
    // Calculate number of nights
    const checkinDate = new Date(checkin);
    const checkoutDate = new Date(checkout);
    const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
    
    // Format dates in Arabic
    const dateFormatter = new Intl.DateTimeFormat('ar-LY', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    const checkinFormatted = dateFormatter.format(checkinDate);
    const checkoutFormatted = dateFormatter.format(checkoutDate);
    
    // Get cottage name from modal
    const cottageName = modal.querySelector('.cottage-name')?.textContent || '';
    
    // 1. Store booking in backend
    fetch('/api/bookings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            cottage_id: cottageId, // Include cottage_id
            name: name,
            phone: phone,
            checkin: checkin,
            checkout: checkout,
            guests: guests,
            notes: notes
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 2. Open WhatsApp with the message
            const totalCostText = document.getElementById('totalCost')?.textContent || '-- د.ل';
            const message = `السلام عليكم،\nأود حجز ${cottageName}\n\nالاسم: ${name}\nرقم الهاتف: ${phone}\nموعد الوصول: ${checkinFormatted}\nموعد المغادرة: ${checkoutFormatted}\nعدد الليالي: ${nights}\nعدد الضيوف: ${guests}\n${notes ? `ملاحظات: ${notes}` : ''}\n\nالتكلفة الإجمالية: ${totalCostText}\n\nارجو تأكيد حجزي.\nشكراً لكم!`;
            window.open(`https://wa.me/218918868883?text=${encodeURIComponent(message)}`, '_blank');
            modal.style.display = 'none';
            
            // Show success message
            alert('تم حفظ بيانات الحجز بنجاح! سيتم فتح واتساب لإرسال الطلب.');
        } else {
            alert('حدث خطأ أثناء حفظ البيانات: ' + (data.message || 'خطأ غير معروف'));
        }
    })
    .catch(() => alert('حدث خطأ أثناء إرسال الحجز. حاول مرة أخرى.'));
}

// Initialize date inputs when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum dates for booking form
    const checkinInput = document.getElementById('modalCheckIn');
    const checkoutInput = document.getElementById('modalCheckOut');

    if (checkinInput && checkoutInput) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        checkinInput.min = today;
        checkoutInput.min = today;
        
        // Set default values
        checkinInput.value = today;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        checkoutInput.value = tomorrow.toISOString().split('T')[0];

        // Update checkout minimum when checkin changes
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1); // Next day minimum
            checkoutInput.min = checkinDate.toISOString().split('T')[0];
            
            // Clear checkout if it's now invalid
            if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
                checkoutInput.value = '';
            }
            
            // Recalculate cost
            calculateBookingCost();
        });
        
        // Update cost when checkout date changes
        checkoutInput.addEventListener('change', function() {
            calculateBookingCost();
        });
    }
});

function initializeCalendar() {
    // Initialize FullCalendar here if you're using it
    // This is a placeholder for calendar initialization
} 

// Add CSS for available-day and blocked-day highlight
if (typeof window !== 'undefined') {
    const style = document.createElement('style');
    style.innerHTML = `.flatpickr-day.available-day { background: #d4f7d4 !important; border-radius: 50% !important; color: #1a7f1a !important; font-weight: bold; }
.flatpickr-day.blocked-day { background: #f8d7da !important; color: #a71d2a !important; border-radius: 50% !important; font-weight: bold; }`;
    document.head.appendChild(style);
} 

// Add CSS for special price highlight
if (typeof window !== 'undefined') {
    const style = document.createElement('style');
    style.innerHTML += `.special-price-day { background: #ffe082 !important; color: #b26a00 !important; border-radius: 50% !important; font-weight: bold; position: relative; }
.special-price-day::after { content: '\\2605'; position: absolute; top: 2px; right: 2px; font-size: 0.8em; color: #b26a00; }`;
    document.head.appendChild(style);
} 

// Helper to format date as YYYY-MM-DD in local time
function formatDateLocal(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
} 

// Debug: Verify openBookingModal is available globally
console.log('Script loaded. openBookingModal available:', typeof window.openBookingModal); 