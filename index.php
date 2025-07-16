<?php include 'assets/includes/header.php'; ?>
    <!-- Main Content Starts -->
    <!-- Hero Section -->
    <section class="hero bg-cover bg-center relative flex items-center hero-section" style="background-image: url('assets/images/hero.jpg');">
        <div class="hero-overlay"></div>
        <div class="container mx-auto px-6 py-16 flex flex-col items-center justify-center">
            <div class="hero-content text-center">
                <h1 class="hero-title font-heading font-bold text-white drop-shadow-lg mb-6">Premium Quality Threads for Every Need</h1>
                <p class="hero-subtitle font-medium mb-8">Threads that Bind Quality and Innovation</p>
                <div class="hero-buttons">
                    <a href="products.php" class="hero-btn">
                        <i class="fas fa-box-open mr-2"></i> Explore Products
                    </a>
                    <a href="contact.php" class="hero-btn btn-outline">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
        <style>
        .hero { 
            min-height: 60vh; 
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.52);
            z-index: 1;
        }
        .container { position: relative; z-index: 2; }
        .hero-content { text-align: center; max-width: 800px; margin: 0 auto; }
        .hero-title { font-size: 3.5rem; font-weight: 700; color: #fff; margin-bottom: 1.5rem; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .hero-subtitle { color: #a9a9a9; font-size: 1.5rem; font-weight: 500; margin-bottom: 2rem; text-shadow: 0 1px 3px rgba(0,0,0,0.3); }
        .hero-buttons { display: flex; flex-direction: row; gap: 1.5rem; justify-content: center; }
        .hero-btn { font-size: 1.1rem; border-radius: var(--btn-radius); padding: 0.85em 2.5em; font-weight: 600; box-shadow: 0 2px 10px rgba(0,0,0,0.15); transition: transform 0.25s, background 0.25s, color 0.25s; background: var(--primary); color: #fff; border: 2px solid var(--primary); text-decoration: none; display: inline-block; }
        .hero-btn:hover { transform: translateY(-3px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); background: #142e32; border-color: #142e32; }
        .hero-btn.btn-outline { background: transparent; color: #fff; border: 2px solid var(--primary); }
        .hero-btn.btn-outline:hover { background: rgba(26, 60, 64, 0.2); color: #fff; border-color: #fff; }
        .hero-btn i { margin-right: 0.6em; }
        @media (max-width: 992px) { .hero-title { font-size: 2.8rem; } .hero-subtitle { font-size: 1.3rem; } .hero-content { display: flex; flex-direction: column; align-items: center; justify-content: center; } }
        @media (max-width: 768px) { .hero { min-height: 50vh; padding-top: 2rem; } .hero-title { font-size: 2.3rem; } .hero-subtitle { font-size: 1.2rem; } }
        @media (max-width: 600px) { .hero { min-height: 40vh; padding-top: 0; } .hero-content .hero-buttons { flex-direction: column; gap: 1rem; width: 100%; } .hero-content .hero-btn { font-size: 1rem !important; padding: 0.9em 1.5em !important; width: 100%; margin: 0 auto; } .hero-title { font-size: 1.8rem; margin-bottom: 1rem; } .hero-subtitle { font-size: 1rem; margin-bottom: 1.5rem; } }
        </style>
    </section>
    <!-- GSAP Animation for Hero Section Text (Word-safe) -->
    <script>
      function splitTextWordSafe(element) {
        if (!element) return;
        const text = element.textContent;
        element.innerHTML = text.split(' ').map(word => {
          const letters = word.split('').map(char => `<span class='hero-letter'>${char}</span>`).join('');
          return `<span class='hero-word'>${letters} </span>`;
        }).join('');
      }
      const heroTitle = document.querySelector('.hero-title');
      splitTextWordSafe(heroTitle);
      gsap.fromTo('.hero-title .hero-letter',
        { opacity: 0, y: 40 },
        { opacity: 1, y: 0, stagger: 0.04, duration: 0.7, ease: 'power3.out', delay: 0.2 }
      );
      const heroSubtitle = document.querySelector('.hero-subtitle');
      if (heroSubtitle) {
        heroSubtitle.innerHTML = heroSubtitle.textContent.split(' ').map(word => `<span class='hero-word'>${word} </span>`).join('');
        gsap.fromTo('.hero-subtitle .hero-word',
          { opacity: 0, y: 30 },
          { opacity: 1, y: 0, stagger: 0.12, duration: 0.6, ease: 'power2.out', delay: 1.1 }
        );
      }
    </script>
    <!-- About Section -->
    <section class="section about-section">
        <div class="container">
            <h2 class="section-heading">Welcome to Supreme Thread</h2>
            <div class="about-grid">
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" alt="Modern Textile Factory - Supreme Thread" class="img-responsive">
                </div>
                <div class="about-content">
                    <div class="key-points">
                        <div class="key-point-heading">Key Points:</div>
                        <ul class="key-point-list">
                            <li>Over 20 years of industry expertise</li>
                            <li>State-of-the-art manufacturing in Surat</li>
                            <li>Serving clients across India & globally</li>
                            <li>Commitment to sustainability & quality</li>
                        </ul>
                    </div>
                    <div class="about-button">
                        <a href="about.php" class="example-btn">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .about-section { padding: 5rem 0; background-color: #fff; }
        .about-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; margin-top: 2rem; }
        .key-points { text-align: left; }
        @media (min-width: 1025px) { .about-grid { grid-template-columns: 1fr 1fr; align-items: center; justify-items: center; } .about-content { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; } .about-content p { margin-bottom: 2.2em; line-height: 2.2; font-size: 1.45rem; color: var(--text-primary, #222); max-width: 750px; } .about-content h1, .about-content .hero-title { font-size: 3rem; margin-bottom: 1.4em; } }
        @media (min-width: 1300px) { .about-content p { font-size: 1.6rem; max-width: 850px; } .about-content h1, .about-content .hero-title { font-size: 3.4rem; } .key-point-heading { font-size: 2rem; margin-bottom: 1.2rem; } .key-point-list li { font-size: 1.05rem; padding: 1rem 0.5rem; margin-bottom: 0.2rem; } }
        @media (max-width: 992px) { .about-grid { grid-template-columns: 1fr; gap: 2.5rem; } .about-image { order: -1; display: flex; justify-content: center; } .about-image img { height: 380px; width: 100%; max-width: 520px; } .key-point-heading { text-align: center; } .key-point-list li { text-align: center; font-size: 1.2rem; padding: 0.5rem 0; margin-bottom: 0.2rem; line-height: 1.6; max-width: 850px; } }
        @media (max-width: 600px) { .about-section { padding: 3.5rem 1.2rem; } .about-content h1, .hero-title, .facts-section h2, .facts-section .section-title, .testimonials-section h2, .testimonials-section .section-title { margin-bottom: 2rem !important; }   .about-grid { gap: 2.2rem; } .about-image img { height: 380px; max-width: 100%; border-radius: 14px; } .key-point-heading { font-size: 1.2rem; margin-bottom: 1.2rem; } .key-point-list li { font-size: 1.05rem; padding: 1rem 0.5rem; margin-bottom: 0.2rem; } .about-button { margin-top: 1.8rem; display: flex; justify-content: center; } .about-button .example-btn { padding: 0.9em 2.2em; width: 100%; text-align: center; font-size: 1.05rem; } }
        @media (min-width: 768px) and (max-width: 992px) { .about-grid { grid-template-columns: 1fr; gap: 2.5rem; } .about-image { display: flex; justify-content: center; align-items: center; margin-bottom: 2rem; } .about-image img { height: 340px; max-width: 440px; width: 100%; border-radius: 14px; object-fit: cover; } .about-content { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; } .section-heading { font-size: 2.3rem; text-align: center; margin-bottom: 1.2rem; } .key-points { width: 100%; max-width: 500px; margin: 0 auto 1.5rem auto; text-align: left; } .key-point-heading { font-size: 1.35rem; text-align: center; margin-bottom: 0.7rem; font-weight: 600; } .key-point-list { margin: 0 auto; padding: 0; list-style: none; } .key-point-list li { font-size: 1.15rem; text-align: left; padding: 0.5rem 0.5rem 0.5rem 1.2rem; margin-bottom: 0.15rem; line-height: 1.5; position: relative; } .key-point-list li::before { content: '\2022'; color: var(--primary, #c49a6c); position: absolute; left: 0; font-size: 1.2rem; top: 0.2rem; } .about-button { margin-top: 1.4rem; display: flex; justify-content: center; } .about-button .example-btn { padding: 0.9em 2.2em; font-size: 1.1rem; width: auto; min-width: 180px; border-radius: 30px; text-align: center; } }
        @media (min-width: 820px) { .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; } .about-image { grid-column: 1; display: flex; justify-content: flex-end; align-items: center; } .about-image img { height: 380px; max-width: 100%; border-radius: 14px; object-fit: cover; } .about-content { grid-column: 2; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; } .section-heading { font-size: 2.5rem; text-align: center; margin-bottom: 1.2rem; width: 100%; } .key-points { width: 100%; max-width: 520px; margin: 0 0 1.5rem 0; text-align: center; } .key-point-heading { font-size: 1.35rem; text-align: center; margin-bottom: 0.7rem; font-weight: 600; } .key-point-list { margin: 0 auto; padding: 0; list-style: none; display: inline-block; text-align: left; } .key-point-list li { font-size: 1.15rem; text-align: left; padding: 0.5rem 0.5rem 0.5rem 1.2rem; margin-bottom: 0.15rem; line-height: 1.5; position: relative; } .key-point-list li::before { content: '\2022'; color: var(--primary, #c49a6c); position: absolute; left: 0; font-size: 1.2rem; top: 0.2rem; } .about-button { margin-top: 1.4rem; display: flex; justify-content: center; width: 100%; } .about-button .example-btn { padding: 0.9em 2.2em; font-size: 1.1rem; width: auto; min-width: 180px; border-radius: 30px; text-align: center; } }
        </style>
    </section>
    <!-- Facts Section -->
    <section class="section facts-section">
        <div class="container">
            <h2 class="section-heading">Facts about Supreme Thread</h2>
            <div class="facts-grid">
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="1000">1,000</span></div>
                    <div class="fact-text">tons yarn manufacturing per month</div>
                </div>
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="1000">1,000</span></div>
                    <div class="fact-text">tons yarn dyeing per month</div>
                </div>
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="1.5">1.5</span></div>
                    <div class="fact-text">million metres weaving per month</div>
                </div>
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="300">300</span></div>
                    <div class="fact-text">tons warp knitting per month</div>
                </div>
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="300">300</span></div>
                    <div class="fact-text">tons circular knitting per month</div>
                </div>
                <div class="fact-card">
                    <div class="fact-number"><span class="counter-outline" data-target="30">30</span></div>
                    <div class="fact-text">million meters fabric processing & printing per month</div>
                </div>
            </div>
        </div>
        <style>
        .facts-section { padding: 5rem 0; background-color: #fff; }
        .facts-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 2.5rem; }
        @media (max-width: 1200px) and (min-width: 1024px) { .facts-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .facts-grid { grid-template-columns: 1fr; gap: 1rem; } }
        .fact-card { background: #fff; border-radius: var(--common-radius); box-shadow: 0 4px 18px rgba(0,0,0,0.08); padding: 2.2rem 1.5rem; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 180px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .fact-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .fact-number { font-size: 2.5rem; font-weight: 700; color: var(--primary); margin-bottom: 1.2rem; }
        .fact-text { font-size: 1.1rem; color: var(--text-secondary); line-height: 1.5; }
        @media (max-width: 992px) { .facts-grid { grid-template-columns: repeat(2, 1fr); gap: 1.8rem; } .fact-card { padding: 2rem 1.5rem; min-height: 170px; } }
        @media (max-width: 600px) { .facts-section { padding: 4rem 1.5rem; } .facts-grid { grid-template-columns: 1fr !important; gap: 1.8rem; margin-top: 2rem; } .fact-card { min-height: 150px; padding: 1.8rem 1.5rem; margin: 0 0.5rem; border-radius: 14px; } .fact-number { font-size: 2.2rem; margin-bottom: 1rem; } .fact-text { font-size: 1.05rem; padding: 0 0.5rem; } }
        @media (max-width: 480px) { .facts-section { padding: 3.5rem 1rem; } .fact-card { padding: 1.8rem 1rem; } }
        </style>
    </section>
    <!-- Testimonial Section -->
    <section class="section testimonial-section">
        <div class="container">
            <h2 class="section-heading">What Our Clients Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">Supreme Thread has been our trusted partner for over 5 years. Their quality is consistently excellent and delivery is always on time. Highly recommended!</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-img">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client">
                        </div>
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">Rajesh Sharma</h4>
                            <p class="testimonial-author-position">CEO, Fashion Trends Ltd</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">The consistent quality and color matching of Supreme Thread products have helped us maintain our high standards. Their technical support is outstanding.</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-img">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client">
                        </div>
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">Priya Patel</h4>
                            <p class="testimonial-author-position">Production Head, Textile Masters</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">We've been using Supreme Thread's industrial-grade threads for our automotive applications. Their durability and strength are unmatched in the industry.</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-img">
                            <img src="https://randomuser.me/api/portraits/men/62.jpg" alt="Client">
                        </div>
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">Vikram Singh</h4>
                            <p class="testimonial-author-position">Procurement Manager, Auto Components Inc</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .testimonial-section { padding: 4rem 0; background-color: #fff; }
        .testimonials-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.2rem; margin-top: 1.5rem; }
        .testimonial-card { background: #fff; border-radius: var(--common-radius); box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden; display: flex; flex-direction: column; height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .testimonial-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .testimonial-content { padding: 1rem; flex-grow: 1; display: flex; flex-direction: column; }
        .testimonial-quote { font-size: 1.5rem; color: var(--primary); opacity: 0.5; margin-bottom: 0.7rem; }
        .testimonial-text { font-size: 0.95rem; line-height: 1.6; color: var(--text-primary); margin-bottom: 0.7rem; flex-grow: 1; }
        .testimonial-rating { color: #FFD700; font-size: 0.9rem; margin-bottom: 0.4rem; }
        .testimonial-author { display: flex; align-items: center; padding: 0.8rem 1rem; background-color: var(--primary); color: white; }
        .testimonial-author-img { width: 40px; height: 40px; border-radius: 50%; overflow: hidden; margin-right: 0.8rem; border: 2px solid white; }
        .testimonial-author-img img { width: 100%; height: 100%; object-fit: cover; }
        .testimonial-author-name { font-size: 1rem; font-weight: 600; margin: 0 0 0.1rem; color: white; }
        .testimonial-author-position { font-size: 0.8rem; opacity: 0.85; margin: 0; color: white; }
        @media (max-width: 992px) { .testimonials-grid { grid-template-columns: repeat(2, 1fr); gap: 1.2rem; } .testimonial-content { padding: 1rem; } }
        @media (max-width: 768px) { .testimonial-section { padding: 3.5rem 0.8rem; } }
        @media (max-width: 600px) { .testimonial-section { padding: 3rem 0.8rem; } .testimonials-grid { grid-template-columns: 1fr; gap: 1.2rem; margin: 1.2rem 0.2rem 0; } .testimonial-card { border-radius: 10px; margin-bottom: 0.3rem; } .testimonial-content { padding: 1rem; } .testimonial-quote { font-size: 1.4rem; margin-bottom: 0.6rem; } .testimonial-text { font-size: 0.95rem; line-height: 1.5; margin-bottom: 0.7rem; } .testimonial-author { padding: 0.8rem; } .testimonial-author-img { width: 36px; height: 36px; } }
        </style>
    </section>
    <!-- Revert to previous state: Remove new CTA section -->
    <!-- (No CTA section here, restoring previous layout) -->
<?php include 'assets/includes/footer.php'; ?>
