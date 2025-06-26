// Mobile UX Enhancements
document.addEventListener('DOMContentLoaded', function() {
    
    // Add loading state to forms
    function addLoadingState(form, button) {
        const originalText = button.innerHTML;
        const loadingText = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        
        form.addEventListener('submit', function() {
            button.disabled = true;
            button.innerHTML = loadingText;
            
            // Re-enable after timeout as fallback
            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = originalText;
            }, 10000);
        });
    }
    
    // Apply loading states to search forms
    const searchForms = document.querySelectorAll('form[action*="search"], form[action*="jobs"]');
    searchForms.forEach(form => {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            addLoadingState(form, submitBtn);
        }
    });
    
    // Smooth scroll for anchor links
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
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 5000);
    });
    
    // Add touch feedback for cards
    const cards = document.querySelectorAll('.job-card, .category-card');
    cards.forEach(card => {
        card.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        card.addEventListener('touchend', function() {
            this.style.transform = '';
        });
    });
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Keyboard navigation improvements
    document.addEventListener('keydown', function(e) {
        // ESC key to close modals/dropdowns
        if (e.key === 'Escape') {
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
        
        // Enter key on card elements
        if (e.key === 'Enter' && e.target.classList.contains('job-card')) {
            const link = e.target.querySelector('a[href]');
            if (link) {
                link.click();
            }
        }
    });
    
    // Auto-suggest for search (simple implementation)
    const searchInputs = document.querySelectorAll('input[name="search"], input[name="q"]');
    searchInputs.forEach(input => {
        let timeout;
        input.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value.trim();
            
            if (query.length >= 2) {
                timeout = setTimeout(() => {
                    // Simple auto-suggest based on common job terms
                    const suggestions = [
                        'Railway Group D',
                        'SBI PO',
                        'SSC CGL',
                        'UPSC IAS',
                        'Banking Jobs',
                        'Teaching Jobs',
                        'Police Constable',
                        'Defense Jobs'
                    ].filter(term => 
                        term.toLowerCase().includes(query.toLowerCase())
                    );
                    
                    showSuggestions(this, suggestions);
                }, 300);
            }
        });
    });
    
    function showSuggestions(input, suggestions) {
        // Remove existing suggestions
        const existingSuggestions = input.parentNode.querySelector('.search-suggestions');
        if (existingSuggestions) {
            existingSuggestions.remove();
        }
        
        if (suggestions.length === 0) return;
        
        const suggestionsDiv = document.createElement('div');
        suggestionsDiv.className = 'search-suggestions position-absolute bg-white border rounded shadow-sm w-100';
        suggestionsDiv.style.top = '100%';
        suggestionsDiv.style.zIndex = '1050';
        
        suggestions.forEach(suggestion => {
            const item = document.createElement('div');
            item.className = 'suggestion-item p-2 border-bottom cursor-pointer';
            item.textContent = suggestion;
            item.style.cursor = 'pointer';
            
            item.addEventListener('click', () => {
                input.value = suggestion;
                suggestionsDiv.remove();
                input.form.submit();
            });
            
            item.addEventListener('mouseenter', () => {
                item.style.backgroundColor = '#f8f9fa';
            });
            
            item.addEventListener('mouseleave', () => {
                item.style.backgroundColor = 'white';
            });
            
            suggestionsDiv.appendChild(item);
        });
        
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(suggestionsDiv);
        
        // Close suggestions when clicking outside
        document.addEventListener('click', function closeHandler(e) {
            if (!input.parentNode.contains(e.target)) {
                suggestionsDiv.remove();
                document.removeEventListener('click', closeHandler);
            }
        });
    }
    
    // Performance optimization: Debounce scroll events
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            // Add scroll-based functionality here
            const scrolled = window.pageYOffset;
            const navbar = document.querySelector('.navbar');
            
            if (scrolled > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, 10);
    });
    
    // Add skip to content link for accessibility
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.className = 'skip-link';
    skipLink.textContent = 'Skip to main content';
    document.body.insertBefore(skipLink, document.body.firstChild);
    
    // Add main content wrapper for accessibility
    const mainContent = document.querySelector('main') || document.querySelector('#content') || document.body;
    if (mainContent && !mainContent.id) {
        mainContent.id = 'main-content';
    }
});

// Service Worker registration for offline functionality (progressive web app)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed');
            });
    });
}
