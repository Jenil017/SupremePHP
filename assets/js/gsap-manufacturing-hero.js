// GSAP animation for manufacturing hero section
// This file is loaded only on manufacturing.php

document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
        gsap.from('.animate-hero-title', { y: 60, opacity: 0, duration: 1.1, ease: 'power3.out' });
        gsap.from('.animate-hero-subtitle', { y: 40, opacity: 0, duration: 1, delay: 0.5, ease: 'power3.out' });
        gsap.from('.animate-hero-tags span', { y: 30, opacity: 0, duration: 0.8, delay: 1, stagger: 0.18, ease: 'power3.out' });
    }
});
