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

<!-- WHY CHOOSE SUPREME THREAD SECTION (Modern Card Layout) -->
<section id="why-choose" class="section_our_solution" style="background: white; padding-top: 2rem; padding-bottom: 2rem; margin-top: 0;">
  <div class="container">
    <h2 class="section-title text-center font-bold mb-5" style="color: var(--primary, #1e3a8a); font-size: 2.4rem; margin-top: 0; letter-spacing: 0.01em; text-decoration: underline; padding-bottom: 3rem;">Why Choose Supreme Thread</h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="our_solution_category">
          <div class="solution_cards_box">
            <div class="solution_card">
              <div class="hover_color_bubble"></div>
              <div class="so_top_icon">
                <span class="why-icon-mfg text-4xl mb-3">✨</span>
              </div>
              <div class="solu_title">
                <h3>Durability Tested</h3>
              </div>
              <div class="solu_description">
                <p>Every spool is tested for strength and longevity, ensuring premium quality.</p>
              </div>
            </div>
            <div class="solution_card">
              <div class="hover_color_bubble"></div>
              <div class="so_top_icon">
                <span class="why-icon-mfg text-4xl mb-3">🌍</span>
              </div>
              <div class="solu_title">
                <h3>Eco-Friendly Dyes</h3>
              </div>
              <div class="solu_description">
                <p>We use sustainable, safe dyes to protect the planet and your products.</p>
              </div>
            </div>
          </div>
          <div class="solution_cards_box sol_card_top_3">
            <div class="solution_card">
              <div class="hover_color_bubble"></div>
              <div class="so_top_icon">
                <span class="why-icon-mfg text-4xl mb-3">⚙️</span>
              </div>
              <div class="solu_title">
                <h3>Precision Winding</h3>
              </div>
              <div class="solu_description">
                <p>Advanced machinery ensures even, flawless winding on every spool.</p>
              </div>
            </div>
            <div class="solution_card">
              <div class="hover_color_bubble"></div>
              <div class="so_top_icon">
                <span class="why-icon-mfg text-4xl mb-3">🚚</span>
              </div>
              <div class="solu_title">
                <h3>Global Logistics</h3>
              </div>
              <div class="solu_description">
                <p>Efficient shipping and support for clients worldwide, on time every time.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
