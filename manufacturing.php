<?php include 'assets/includes/header.php'; ?>
<style>
/* HERO SECTION (Manufacturing) */
.hero-section-mfg {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    min-height: 110vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 0;
    padding-top: 84px;
    padding-bottom: 40px;
    box-sizing: border-box;
}
.hero-overlay-mfg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, rgba(30,58,138,0.22) 0%, rgba(249,246,242,0.92) 100%), rgba(30,58,138,0.22);
    z-index: 1;
}
.hero-content-mfg {
    position: relative;
    z-index: 2;
    min-height: 110vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 0;
    padding-top: 84px;
    padding-bottom: 40px;
    box-sizing: border-box;
}
.hero-heading-mfg {
    font-size: 3.5rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 4px 24px rgba(30,58,138,0.22), 0 1px 2px rgba(0,0,0,0.12);
}
.hero-subtext-mfg {
    font-size: 1.2rem;
    color: #fff;
    text-shadow: 0 4px 24px rgba(30,58,138,0.22), 0 1px 2px rgba(0,0,0,0.12);
}
.hero-tags-mfg {
    margin-top: 1.5rem;
}
.hero-tag-mfg {
    display: inline-block;
    background: rgba(255,255,255,0.80);
    color: #1e3a8a;
    font-weight: 600;
    border-radius: 1.5rem;
    padding: 0.4rem 1.2rem;
    font-size: 1rem;
    box-shadow: 0 2px 10px 0 rgba(30,58,138,0.06);
    letter-spacing: 0.01em;
    transition: background 0.2s, color 0.2s;
}
.hero-tag-mfg:hover {
    background: #e0e7ff;
    color: #0a225c;
}
@media (max-width: 767px) {
    .hero-section-mfg {
        min-height: 110vh !important;
        margin-top: 15px !important;
        padding-top: 56px !important;
        padding-bottom: 50px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-sizing: border-box !important;
    }
    .hero-content-mfg {
        min-height: 110vh !important;
        margin-top: 15px !important;
        padding-top: 56px !important;
        padding-bottom: 50px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        padding-left: 6vw !important;
        padding-right: 6vw !important;
        box-sizing: border-box !important;
    }
    .hero-heading-mfg {
        font-size: 2.1rem !important;
        text-align: center !important;
        margin-bottom: 0.7rem !important;
        word-break: break-word !important;
    }
    .hero-subtext-mfg {
        font-size: 1rem !important;
        text-align: center !important;
        word-break: break-word !important;
        padding-left: 2vw !important;
        padding-right: 2vw !important;
    }
    .hero-tags-mfg {
        margin-top: 1.2rem !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        gap: 0.5rem !important;
    }
    .hero-tag-mfg {
        font-size: 0.89rem !important;
        padding: 0.32rem 0.8rem !important;
        margin: 0.2rem !important;
    }
}

/* PROCESS STEPS SECTION */
.process-section { background: linear-gradient(120deg, #f1f5fe 40%, #f9f6f2 100%); }
.process-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .process-timeline {
        flex-direction: row;
        gap: 1.2rem;
    }
}
@media (max-width: 767px) {
    .process-timeline {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 0.5rem !important;
    }
    .process-step-new {
        width: 92vw !important;
        max-width: 360px !important;
        min-width: 0 !important;
        margin: 0.4rem 0 !important;
        position: relative !important;
    }
    .process-step-new:not(:last-child)::after {
        content: '\2193'; /* Down arrow Unicode */
        display: block;
        font-size: 2.2rem;
        color: #6366f1;
        text-align: center;
        margin: 0.2rem auto 0.2rem auto;
    }
}
.process-step-new {
    background: linear-gradient(120deg, #fff 80%, #e0e7ff 100%);
    border-radius: 1.5rem;
    box-shadow: 0 4px 24px 0 rgba(30,58,138,0.10);
    padding: 2rem 1.25rem 1.25rem 1.25rem;
    min-width: 180px;
    max-width: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
    position: relative;
}
.process-step-new:hover {
    transform: scale(1.07) translateY(-8px);
    box-shadow: 0 10px 32px 0 rgba(30,58,138,0.16);
}
.process-step-icon { font-size: 2rem; margin-bottom: 0.7rem; }
.process-step-title { font-size: 1.08rem; font-weight: 700; margin-bottom: 0.3rem; color: var(--primary); }
.process-step-desc { font-size: 0.98rem; color: #444; }
</style>

<!-- HERO SECTION (Professional, Animated) -->
<section class="hero-section-mfg" style="background: url('assets/images/hero-bg.jpg') center center/cover no-repeat; position:relative; min-height:110vh; margin-top:0px; padding-top:84px; padding-bottom:40px; box-sizing:border-box;">
  <div class="hero-overlay-mfg"></div>
  <div class="container hero-content-mfg text-center flex flex-col items-center justify-center" style="min-height:110vh; position:relative; z-index:2; margin-top:0px; padding-top:84px; padding-bottom:40px; box-sizing:border-box;">
    <h1 class="hero-heading-mfg animate-hero-title">Manufacturing Excellence</h1>
    <p class="hero-subtext-mfg animate-hero-subtitle">Where innovation, precision, and quality meet to create the finest threads for the world's best textiles.</p>
    <div class="hero-tags-mfg flex flex-wrap justify-center gap-3 mt-6 animate-hero-tags">
      <span class="hero-tag-mfg">Lab-Grade Quality Control</span>
      <span class="hero-tag-mfg">High-Speed Machinery</span>
      <span class="hero-tag-mfg">Eco-Friendly Dyeing</span>
      <span class="hero-tag-mfg">Expert Workforce</span>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
      gsap.from('.animate-hero-title', { y: 60, opacity: 0, duration: 1.1, ease: 'power3.out' });
      gsap.from('.animate-hero-subtitle', { y: 40, opacity: 0, duration: 1, delay: 0.4, ease: 'power3.out' });
      gsap.from('.animate-hero-tags span, .hero-tag-mfg', { y: 30, opacity: 0, duration: 0.8, delay: 0.9, stagger: 0.18, ease: 'power3.out' });
    }
  });
</script>

<!-- START: WHY CHOOSE SUPREME THREAD SECTION -->

<!-- 
  CSS for the "Why Choose Us" section.
  For best results, move this to your main stylesheet (e.g., styles.css) 
-->
<style>
.why-choose-supreme-thread {
    padding: 80px 0;
    background-color: #f8f9fa; /* A light background to separate the section */
    font-family: sans-serif;
}

.why-choose-supreme-thread .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    text-align: center;
}

.why-choose-supreme-thread h2 {
    font-size: 2.8rem;
    margin-bottom: 20px;
    color: #212529;
}

.why-choose-supreme-thread .section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 700px;
    margin: 0 auto 50px auto;
}

.features-grid {
    display: grid;
    /* Creates a responsive grid that adjusts the number of columns */
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
    text-align: left;
}

.feature-card {
    background: #ffffff;
    border-radius: 10px;
    padding: 35px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
}

.feature-card .feature-icon {
    font-size: 3rem;
    color: #0d6efd; /* Your brand's primary color */
    margin-bottom: 20px;
}

.feature-card h3 {
    font-size: 1.3rem;
    color: #343a40;
    margin-bottom: 15px;
}

.feature-card p {
    font-size: 1rem;
    line-height: 1.6;
    color: #6c757d;
}
</style>

<section class="why-choose-supreme-thread">
    <div class="container">
        <h2>Why Choose Supreme Thread?</h2>
        <p class="section-subtitle">
            Our commitment to excellence is woven into every fiber. Discover the advantages that make Supreme Thread the preferred choice for leading manufacturers worldwide.
        </p>

        <div class="features-grid">
            <!-- Feature Card 1: Quality -->
            <div class="feature-card">
                <div class="feature-icon">💎</div> <!-- Tip: Replace with an SVG or an icon from a library like Font Awesome -->
                <h3>Unmatched Quality</h3>
                <p>Our threads are manufactured using state-of-the-art technology and the finest raw materials, ensuring superior strength, consistency, and durability for any application.</p>
            </div>

            <!-- Feature Card 2: Color -->
            <div class="feature-card">
                <div class="feature-icon">🎨</div>
                <h3>Vibrant & Lasting Colors</h3>
                <p>With an extensive and rich color palette, our threads maintain their vibrancy even after numerous washes, ensuring your final products look impeccable for longer.</p>
            </div>

            <!-- Feature Card 3: Eco-Friendly -->
            <div class="feature-card">
                <div class="feature-icon">🌿</div>
                <h3>Sustainable Practices</h3>
                <p>We are committed to eco-friendly manufacturing. Our sustainable processes reduce environmental impact without compromising the high quality you expect.</p>
            </div>

            <!-- Feature Card 4: Reliability -->
            <div class="feature-card">
                <div class="feature-icon">🌐</div>
                <h3>Global & Reliable Supply</h3>
                <p>Trusted by brands worldwide, our reliable and efficient supply chain ensures you get the threads you need, precisely when you need them, anywhere in the world.</p>
            </div>
        </div>
    </div>
</section>

<!-- END: WHY CHOOSE SUPREME THREAD SECTION -->



<!-- PROCESS STEPS SECTION -->
<section id="process" class="section process-section" style="background: white">
    <div class="container py-12">
        <h2 class="section-title text-center text-3xl font-bold mb-10 text-blue-900" style="text-decoration: underline; margin-top: -2rem;">How We Make Supreme Thread</h2>
        <div class="process-timeline flex flex-col md:flex-row gap-8 md:gap-6 justify-center items-stretch">
            <div class="process-step-new">
                <span class="process-step-icon">🧵</span>
                <h3 class="process-step-title">Raw Material</h3>
                <p class="process-step-desc">Premium cotton, polyester, and specialty fibers sourced globally.</p>
            </div>
            <div class="process-step-new">
                <span class="process-step-icon">🧺</span>
                <h3 class="process-step-title">Preparation</h3>
                <p class="process-step-desc">Fibers cleaned, blended, and prepped with utmost care.</p>
            </div>
            <div class="process-step-new">
                <span class="process-step-icon">🌀</span>
                <h3 class="process-step-title">Spinning</h3>
                <p class="process-step-desc">Transformed into strong, uniform threads with precision.</p>
            </div>
            <div class="process-step-new">
                <span class="process-step-icon">🎨</span>
                <h3 class="process-step-title">Dyeing</h3>
                <p class="process-step-desc">Eco-friendly, colorfast dyes for vibrant, lasting color.</p>
            </div>
            <div class="process-step-new">
                <span class="process-step-icon">🧪</span>
                <h3 class="process-step-title">Testing</h3>
                <p class="process-step-desc">Lab-tested for strength, color, and durability.</p>
            </div>
            <div class="process-step-new">
                <span class="process-step-icon">📦</span>
                <h3 class="process-step-title">Packaging</h3>
                <p class="process-step-desc">Secure, eco-friendly packaging for global delivery.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="modern-cta-section" style="margin-bottom:0 !important; background: white">
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

<?php include 'assets/includes/footer.php'; ?>
