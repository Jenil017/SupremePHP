<?php include 'assets/includes/header.php'; ?>

<!-- Inline styles for contact form, map, and responsive (from HTML) -->
<style>
:root {
    --primary: #1A3C40;
    --secondary: #f9e79f;
    --text-primary: #333;
    --text-secondary: #666;
    --background: #f8f9fa;
    --common-radius: 1.2rem;
    --btn-radius: 2rem;
    --underline-height: 0.35em;
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
.contact-gallery-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}
.contact-gallery-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
    width: 100%;
    box-sizing: border-box;
}
.contact-gallery-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2.5rem;
    margin-top: 3rem;
    background-color: white;
}
.contact-gallery-map {
    background-color: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.contact-map-container {
    width: 100%;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 350px;
    border-radius: 16px 16px 0 0;
}
.contact-map-container iframe {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    filter: contrast(1.05) saturate(1.1);
    transition: all 0.5s ease;
    border: none;
}
.contact-map-container:hover iframe {
    filter: contrast(1.1) saturate(1.2);
}
.quick-contact-strip {
    background: linear-gradient(135deg, #1A3C40 0%, #255358 100%);
    padding: 1.2rem 2rem;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    border-top: 4px solid rgba(255, 255, 255, 0.1);
}
.quick-contact-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    color: #fff;
    font-size: 0.95rem;
}
.quick-contact-item i {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
}
.contact-gallery-form-wrapper {
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 100%;
}
.contact-gallery-form {
    background: var(--primary) !important;
    box-shadow: 0 6px 32px 0 rgba(31, 51, 73, 0.12);
    border-radius: 18px;
    padding: 2.2rem 2rem 2.2rem 2rem;
    margin-bottom: 0;
    transition: box-shadow 0.3s;
    color: #fff;
}
.contact-gallery-form input,
.contact-gallery-form textarea {
    background: rgba(255,255,255,0.18);
    border: 1px solid #e0e0e0;
    color: #fff;
}
.contact-gallery-form input::placeholder,
.contact-gallery-form textarea::placeholder {
    color: #e0e0e0;
    opacity: 1;
}
.contact-gallery-form label {
    color: #fff;
}
.contact-gallery-form:hover {
    box-shadow: 0 10px 40px 0 rgba(31, 51, 73, 0.18);
}
.contact-form-title {
    font-size: 1.7rem;
    font-weight: 700;
    margin-bottom: 1.8rem;
    color: #fff;
    word-wrap: break-word;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    width: 100%;
}
.form-group {
    margin-bottom: 1.5rem;
    width: 100%;
}
.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    color: #fff;
    font-weight: 500;
}
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-sizing: border-box;
}
.form-group input:focus,
.form-group textarea:focus {
    border-color: #1A3C40;
    box-shadow: 0 0 0 3px rgba(26, 60, 64, 0.1);
    outline: none;
}
.contact-form-btn {
    background: linear-gradient(135deg, #1A3C40 0%, #1D5C63 100%);
    color: #fff;
    border: none;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 1rem;
    max-width: 100%;
    box-sizing: border-box;
}
.contact-form-btn:hover,
.contact-form-btn:focus {
    color: #fff !important;
    background: linear-gradient(135deg, #1A3C40 0%, #1D5C63 100%) !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
    transform: none !important;
}
@media (max-width: 992px) {
    .contact-gallery-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
        background-color: white;
    }
    .contact-gallery-map { height: auto; }
    .contact-map-container { min-height: 400px; }
    .quick-contact-strip { flex-direction: column; gap: 0.8rem; padding: 1.2rem 1.5rem; }
}
@media (max-width: 768px) {
    .contact-gallery-section { padding: 4rem 0; }
    .form-row { grid-template-columns: 1fr; gap: 1rem; }
    .contact-map-container { min-height: 350px; }
    .contact-form-title { font-size: 1.5rem; }
}
@media (max-width: 600px) {
    .contact-gallery-section { padding: 3rem 0; }
    .contact-gallery-container { padding: 0 1rem; }
    .contact-gallery-form { padding: 1.5rem; }
    .contact-map-container { min-height: 300px; }
    .quick-contact-strip { padding: 1rem; }
    .quick-contact-item { font-size: 0.9rem; }
    .contact-form-title { font-size: 1.3rem; margin-bottom: 1.2rem; }
    .form-group { margin-bottom: 1.2rem; }
    .contact-form-btn { padding: 0.8rem 1.5rem; font-size: 1rem; }
}
</style>

<!-- Contact Us Section - Before Footer -->
<section class="contact-gallery-section" style="margin-top: 45px;">
  <div class="contact-gallery-container">
      <h2 class="section-heading" data-aos="fade-up">Get In Touch</h2>
      <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Have questions about our thread products or want to request samples? Contact our team today.</p>
      <div class="contact-gallery-wrapper">
          <!-- Contact Form FIRST -->
          <div class="contact-gallery-form-wrapper" data-aos="fade-left" data-aos-delay="150">
              <div class="contact-gallery-form">
                  <h3 class="contact-form-title">Send Us a Message</h3>
                  <form id="contactForm">
                  <div class="form-row">
                      <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" id="name" name="name" placeholder="Your name" required>
                      </div>
                      <div class="form-group">
                          <label for="email">Email Address</label>
                              <input type="email" id="email" name="email" placeholder="Your email" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="subject">Subject</label>
                          <input type="text" id="subject" name="subject" placeholder="Subject of your message" required>
                  </div>
                  <div class="form-group">
                      <label for="message">Your Message</label>
                          <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                  </div>
                  <button type="submit" class="contact-form-btn">Send Message</button>
              </form>
              </div>
          </div>
          <!-- Contact Map SECOND -->
          <div class="contact-gallery-map" data-aos="fade-right" data-aos-delay="150">
              <div class="contact-map-container">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59573.31858055624!2d72.8079043387085!3d21.190882010435476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1652363139973!5m2!1sen!2sin" 
                  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <!-- Quick Contact Info Strip -->
              <div class="quick-contact-strip">
                  <div class="quick-contact-item">
                      <i class="fas fa-map-marker-alt"></i>
                      <span>123 Industrial Area, Surat, Gujarat</span>
                  </div>
                  <div class="quick-contact-item">
                      <i class="fas fa-phone-alt"></i>
                      <span>+91 9876543210</span>
                  </div>
                  <div class="quick-contact-item">
                      <i class="fas fa-envelope"></i>
                      <span>info@supremethread.com</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- AOS and GSAP scripts for animation -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
AOS.init({ once: true });
</script>

<?php include 'assets/includes/footer.php'; ?>
