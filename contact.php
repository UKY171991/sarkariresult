<?php
$page_title = "Contact Us";
$breadcrumb = ['Contact' => null];
include 'includes/config.php';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with us for any queries or suggestions</p>
    </div>
</div>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="content-section">
                    <h2 class="section-title">Send us a Message</h2>
                    
                    <form action="contact-process.php" method="POST" class="contact-form">
                        <div class="form-row">
                            <div class="form-group half-width">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group half-width">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="form-group half-width">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" class="form-control" required>
                                    <option value="">Select Subject</option>
                                    <option value="job-query">Job Related Query</option>
                                    <option value="result-query">Result Related Query</option>
                                    <option value="admit-card">Admit Card Issue</option>
                                    <option value="technical">Technical Issue</option>
                                    <option value="suggestion">Suggestion</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" class="form-control" placeholder="Please describe your query in detail..." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <div class="captcha-container">
                                <label>Verification *</label>
                                <div class="captcha-box">
                                    <img src="captcha.php" alt="Captcha" class="captcha-image">
                                    <button type="button" class="refresh-captcha" title="Refresh Captcha">🔄</button>
                                </div>
                                <input type="text" name="captcha" class="form-control" placeholder="Enter captcha code" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="privacy" name="privacy" required>
                                <label for="privacy">I agree to the <a href="privacy-policy.php">Privacy Policy</a> and <a href="terms.php">Terms of Service</a> *</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sidebar">
                    <h3>Contact Information</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p>info@sarkariresult.com.cm</p>
                                <p>support@sarkariresult.com.cm</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Phone</h4>
                                <p>+91-XXXXXXXXXX</p>
                                <p>Mon-Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Address</h4>
                                <p>Sarkari Result Office<br>
                                New Delhi, India<br>
                                PIN: 110001</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Business Hours</h4>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                                Saturday: 10:00 AM - 4:00 PM<br>
                                Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar">
                    <h3>Follow Us</h3>
                    <div class="social-links-contact">
                        <a href="#" class="social-link-contact whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <h4>WhatsApp</h4>
                                <p>Get instant updates</p>
                            </div>
                        </a>
                        
                        <a href="#" class="social-link-contact telegram">
                            <i class="fab fa-telegram"></i>
                            <div>
                                <h4>Telegram</h4>
                                <p>Join our channel</p>
                            </div>
                        </a>
                        
                        <a href="#" class="social-link-contact facebook">
                            <i class="fab fa-facebook"></i>
                            <div>
                                <h4>Facebook</h4>
                                <p>Like our page</p>
                            </div>
                        </a>
                        
                        <a href="#" class="social-link-contact twitter">
                            <i class="fab fa-twitter"></i>
                            <div>
                                <h4>Twitter</h4>
                                <p>Follow for updates</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="sidebar">
                    <h3>Frequently Asked Questions</h3>
                    <div class="faq-list">
                        <div class="faq-item">
                            <h4>How can I check my exam result?</h4>
                            <p>Visit our Results section and search for your exam. Enter your roll number and date of birth to check results.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>When will admit cards be available?</h4>
                            <p>Admit cards are usually released 10-15 days before the exam date. Check our Admit Card section regularly.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>How to apply for government jobs?</h4>
                            <p>Browse our Latest Jobs section, click on the job you're interested in, and follow the application link.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>Is this website official?</h4>
                            <p>No, we are an independent information portal. Always verify information on official websites.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-form {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 20px;
}

.form-group.half-width {
    flex: 1;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: #3498db;
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.captcha-container {
    margin-bottom: 20px;
}

.captcha-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 10px 0;
}

.captcha-image {
    height: 45px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.refresh-captcha {
    background: #3498db;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.checkbox-group input[type="checkbox"] {
    margin-top: 4px;
}

.checkbox-group label {
    margin-bottom: 0;
    font-weight: normal;
    font-size: 14px;
}

.checkbox-group a {
    color: #3498db;
    text-decoration: none;
}

.checkbox-group a:hover {
    text-decoration: underline;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.contact-item i {
    color: #3498db;
    font-size: 20px;
    margin-top: 5px;
    min-width: 20px;
}

.contact-item h4 {
    margin: 0 0 8px 0;
    color: #2c3e50;
    font-size: 16px;
}

.contact-item p {
    margin: 0;
    color: #7f8c8d;
    font-size: 14px;
    line-height: 1.5;
}

.social-links-contact {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.social-link-contact {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
}

.social-link-contact:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.social-link-contact.whatsapp {
    border-left: 4px solid #25d366;
}

.social-link-contact.telegram {
    border-left: 4px solid #0088cc;
}

.social-link-contact.facebook {
    border-left: 4px solid #1877f2;
}

.social-link-contact.twitter {
    border-left: 4px solid #1da1f2;
}

.social-link-contact i {
    font-size: 24px;
    color: #3498db;
}

.social-link-contact h4 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 16px;
}

.social-link-contact p {
    margin: 0;
    color: #7f8c8d;
    font-size: 13px;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #3498db;
}

.faq-item h4 {
    margin: 0 0 10px 0;
    color: #2c3e50;
    font-size: 15px;
}

.faq-item p {
    margin: 0;
    color: #555;
    font-size: 13px;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .form-group.half-width {
        flex: none;
    }
    
    .contact-form {
        padding: 20px;
    }
    
    .captcha-box {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .checkbox-group {
        align-items: flex-start;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('.contact-form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Name validation
        if (nameInput.value.trim().length < 2) {
            showError(nameInput, 'Name must be at least 2 characters long');
            isValid = false;
        } else {
            clearError(nameInput);
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        } else {
            clearError(emailInput);
        }
        
        // Message validation
        if (messageInput.value.trim().length < 10) {
            showError(messageInput, 'Message must be at least 10 characters long');
            isValid = false;
        } else {
            clearError(messageInput);
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    function showError(input, message) {
        clearError(input);
        input.style.borderColor = '#e74c3c';
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.cssText = 'color: #e74c3c; font-size: 12px; margin-top: 5px;';
        input.parentNode.appendChild(errorDiv);
    }
    
    function clearError(input) {
        input.style.borderColor = '#e0e0e0';
        const existingError = input.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
    }
    
    // Character counter for message
    const maxLength = 1000;
    const counter = document.createElement('div');
    counter.style.cssText = 'text-align: right; font-size: 12px; color: #7f8c8d; margin-top: 5px;';
    messageInput.parentNode.appendChild(counter);
    
    function updateCounter() {
        const remaining = maxLength - messageInput.value.length;
        counter.textContent = `${messageInput.value.length}/${maxLength} characters`;
        counter.style.color = remaining < 50 ? '#e74c3c' : '#7f8c8d';
    }
    
    messageInput.addEventListener('input', updateCounter);
    updateCounter();
    
    // Captcha refresh
    const refreshCaptcha = document.querySelector('.refresh-captcha');
    if (refreshCaptcha) {
        refreshCaptcha.addEventListener('click', function() {
            const captchaImg = document.querySelector('.captcha-image');
            captchaImg.src = 'captcha.php?' + new Date().getTime();
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
