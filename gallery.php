<?php include 'assets/includes/header.php'; ?>

<!-- Inline styles for hero, gallery grid, CTA, and responsive (from HTML) -->
<style>
:root {
    --primary: #1A3C40;
    --secondary: #3b82f6;
    --text-primary: #333;
    --text-secondary: #666;
    --background: #f8f9fa;
    --common-radius: 1.2rem;
    --btn-radius: 2rem;
    --underline-height: 0.35em;
    --primary-color: #1A3C40;
    --secondary-color: #3b82f6;
}
.section-heading {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    color: var(--primary);
    text-decoration: underline;
    text-decoration-color: var(--primary);
    text-underline-offset: var(--underline-height);
    margin-bottom: 2rem;
    margin-top: 1em;
}
.section-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
    text-align: center;
    margin-bottom: 2.5rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
.hero-section-gallery {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.hero-overlay-gallery {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, rgba(26, 60, 64, 0.4) 0%, rgba(29, 92, 99, 0.75) 100%);
    z-index: 1;
}
.hero-content-gallery {
    position: relative;
    z-index: 2;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 84px 20px 60px;
    box-sizing: border-box;
    max-height: 100vh;
    overflow: visible;
}
.hero-heading-gallery {
    font-size: 4rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 4px 24px rgba(26, 60, 64, 0.22), 0 1px 2px rgba(0, 0, 0, 0.12);
    margin-bottom: 1rem;
    visibility: visible !important;
    opacity: 1 !important;
}
.hero-subtext-gallery {
    font-size: 1.4rem;
    color: #fff;
    text-shadow: 0 4px 24px rgba(26, 60, 64, 0.22), 0 1px 2px rgba(0, 0, 0, 0.12);
    max-width: 800px;
    text-align: center;
    margin-bottom: 1.5rem;
    visibility: visible !important;
    opacity: 1 !important;
}
.hero-tags-gallery {
    display: flex !important;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.8rem;
    margin-top: 1.5rem;
    margin-bottom: 2rem;
    width: 100%;
    z-index: 10 !important;
    position: relative;
    visibility: visible !important;
    opacity: 1 !important;
}
.hero-tag-gallery {
    display: inline-block !important;
    background: rgba(255, 255, 255, 0.85);
    color: #1A3C40;
    font-weight: 600;
    border-radius: 2rem;
    padding: 0.5rem 1.2rem;
    font-size: 1.1rem;
    box-shadow: 0 2px 10px 0 rgba(26, 60, 64, 0.15);
    letter-spacing: 0.01em;
    transition: all 0.3s ease;
    position: relative;
    visibility: visible !important;
    opacity: 1 !important;
}
.hero-tag-gallery:hover {
    background: #e0e7ff;
    color: #0a225c;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px 0 rgba(26, 60, 64, 0.12);
}
.modern-gallery-section {
  padding: 3.5rem 0 2.5rem 0;
  background: #f8f9fa;
}
.gallery-container {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 1.2rem;
  text-align: center;
}
.modern-gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 1.3rem;
  justify-items: stretch;
  align-items: stretch;
}
.modern-gallery-item {
  width: 100%;
  aspect-ratio: 4/3;
  background: #fff;
  border-radius: var(--common-radius);
  box-shadow: 0 4px 24px rgba(0,0,0,0.09);
  overflow: hidden;
  transition: box-shadow 0.22s, transform 0.22s;
  display: flex;
  align-items: stretch;
  justify-content: stretch;
  cursor: pointer;
  position: relative;
  min-width: 0;
}
.modern-gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.35s cubic-bezier(.61,-0.11,.44,1.13), box-shadow 0.28s;
  min-width: 0;
  min-height: 0;
}
.modern-gallery-item:hover,
.modern-gallery-item:focus-within {
  box-shadow: 0 8px 32px rgba(0,0,0,0.17), 0 2px 16px rgba(0,0,0,0.09);
  transform: scale(1.04) translateY(-6px);
  z-index: 2;
}
.modern-gallery-item:hover img,
.modern-gallery-item:focus-within img {
  transform: scale(1.12) rotate(-1.5deg);
  box-shadow: 0 12px 32px rgba(0,0,0,0.12);
}
.modern-gallery-item:active {
  transform: scale(0.99) translateY(2px);
}
@media (max-width: 900px) {
  .gallery-container { max-width: 98vw; }
  .modern-gallery-grid { gap: 1rem; }
}
@media (max-width: 700px) {
  .modern-gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
  .modern-gallery-item { aspect-ratio: 4/3; }
}
@media (max-width: 480px) {
  .modern-gallery-grid { grid-template-columns: 1fr; gap: 1rem; }
}
</style>

<!-- Full Screen Hero Section for Gallery -->
<section class="hero-section-gallery" style="background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1200&q=80') center center/cover no-repeat; position:relative; height:100vh; margin-top:0; padding:0; box-sizing:border-box;">
  <div class="hero-overlay-gallery"></div>
  <div class="container hero-content-gallery text-center flex flex-col items-center justify-center" style="height:100vh; position:relative; z-index:2; margin:0; padding:0 20px; box-sizing:border-box;">
    <h1 class="hero-heading-gallery animate-hero-title">Our Gallery Showcase</h1>
    <p class="hero-subtext-gallery animate-hero-subtitle">Visual journey through our premium thread collection, manufacturing process, and quality assurance</p>
    <div class="hero-tags-gallery flex flex-wrap justify-center gap-3 mt-6 animate-hero-tags">
      <span class="hero-tag-gallery">Thread Collection</span>
      <span class="hero-tag-gallery">Manufacturing</span>
      <span class="hero-tag-gallery">Quality Control</span>
      <span class="hero-tag-gallery">Product Showcase</span>
    </div>
  </div>
</section>

<!-- GSAP Animation for Hero Section Text -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof gsap !== 'undefined') {
    gsap.set('.animate-hero-title, .animate-hero-subtitle, .hero-tags-gallery, .hero-tag-gallery', {
      autoAlpha: 1,
      willChange: 'transform, opacity'
    });
    gsap.from('.animate-hero-title', { y: 60, opacity: 0, duration: 1.1, ease: 'power3.out', onComplete: function() { gsap.set('.animate-hero-title', {clearProps: 'all'}); } });
    gsap.from('.animate-hero-subtitle', { y: 40, opacity: 0, duration: 1, delay: 0.4, ease: 'power3.out', onComplete: function() { gsap.set('.animate-hero-subtitle', {clearProps: 'all'}); } });
    gsap.from('.hero-tags-gallery', { y: 30, opacity: 0, duration: 0.5, delay: 0.8, ease: 'power3.out', onComplete: function() { gsap.set('.hero-tags-gallery', {clearProps: 'all'}); } });
    gsap.from('.hero-tag-gallery', { y: 15, opacity: 0, duration: 0.5, delay: 1, stagger: 0.12, ease: 'power3.out', onComplete: function() {
      gsap.set('.hero-tag-gallery', {clearProps: 'all'});
      setTimeout(function() {
        document.querySelectorAll('.hero-tag-gallery').forEach(function(tag) {
          tag.style.opacity = '1';
          tag.style.visibility = 'visible';
          tag.style.display = 'inline-block';
        });
        const tagsContainer = document.querySelector('.hero-tags-gallery');
        if (tagsContainer) {
          tagsContainer.style.opacity = '1';
          tagsContainer.style.visibility = 'visible';
          tagsContainer.style.display = 'flex';
        }
      }, 100);
    }});
  }
});
</script>

<!-- Modern Professional Gallery Showcase -->
<section class="modern-gallery-section">
    <div class="gallery-container">
        <h2 class="section-heading" data-aos="fade-up">Supreme Thread Company Gallery</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">A visual journey through our world-class facilities, vibrant events, and premium products</p>
        <div class="modern-gallery-grid">
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="120">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Modern Factory"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="140">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" alt="Production Line"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="160">
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80" alt="Eco-Friendly Threads"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="180">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80" alt="Spools of Thread"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Quality Control"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="220">
                <img src="https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=600&q=80" alt="Yarn Spools"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="240">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Textile Exhibition"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="260">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Research & Development"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="280">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80" alt="Thread Samples"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80" alt="Industrial Spools"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="320">
                <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=600&q=80" alt="Winding Process"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="340">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Product Launch"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="360">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=800&q=80" alt="Colorful Sewing Threads" style="background:#eee;object-fit:cover;min-height:100px;"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="380">
                <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80" alt="Closeup of Sewing Threads"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="400">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80" alt="Thread Bobbins"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="420">
                <img src="https://images.unsplash.com/photo-1475189778702-5ec9941484ae?auto=format&fit=crop&w=600&q=80" alt="Industrial Thread Spools"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="440">
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80" alt="Thread Factory Machine"/>
            </div>
            <div class="modern-gallery-item" data-aos="zoom-in-up" data-aos-delay="460">
                <img src="https://images.unsplash.com/photo-1468421870903-4df1664ac249?auto=format&fit=crop&w=600&q=80" alt="Multicolor Threads"/>
            </div>
        </div>
    </div>
</section>

<!-- Unified Modern CTA Section -->
<section class="modern-cta-section" style="margin-bottom:0 !important;">
  <div class="modern-cta-container">
    <div class="modern-cta-card">
      <div class="modern-cta-content">
        <div class="modern-cta-icon" aria-hidden="true">
          <img src="assets/images/logo-ai.svg" alt="Supreme Thread Logo" style="width:70px;height:70px;border-radius:50%;object-fit:cover;background:#fff;padding:8px;box-shadow:0 2px 10px rgba(26,60,64,0.10);">
        </div>
        <div class="modern-cta-text">
          <h3>Ready to Experience Supreme Quality?</h3>
          <p>Our experts can help you find the perfect thread for your unique manufacturing needs. Discover our range or get in touch today.</p>
        </div>
        <div class="modern-cta-action">
          <a href="contact.php" class="modern-cta-btn">Get in Touch</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- AOS for gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once: true });</script>

<?php include 'assets/includes/footer.php'; ?>
