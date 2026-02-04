import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Alpine.js Components for NGO Website
Alpine.data('donationForm', () => ({
    selectedAmount: null,
    customAmount: '',
    paymentMethod: 'esewa',
    isProcessing: false,
    
    selectAmount(amount) {
        this.selectedAmount = amount;
        this.customAmount = '';
    },
    
    setCustomAmount() {
        this.selectedAmount = null;
    },
    
    getAmount() {
        return this.selectedAmount || parseFloat(this.customAmount) || 0;
    },
    
    async submitDonation() {
        if (this.getAmount() <= 0) {
            alert('Please select or enter a valid donation amount.');
            return;
        }
        
        this.isProcessing = true;
        // Form will be submitted normally, this just provides UI feedback
    }
}));

Alpine.data('volunteerForm', () => ({
    currentStep: 1,
    totalSteps: 3,
    formData: {
        personal: {},
        skills: {},
        motivation: {}
    },
    
    nextStep() {
        if (this.currentStep < this.totalSteps) {
            this.currentStep++;
        }
    },
    
    prevStep() {
        if (this.currentStep > 1) {
            this.currentStep--;
        }
    },
    
    isStepActive(step) {
        return this.currentStep === step;
    },
    
    isStepCompleted(step) {
        return this.currentStep > step;
    }
}));

Alpine.data('impactCounter', () => ({
    count: 0,
    target: 0,
    duration: 2000,
    
    init() {
        this.target = parseInt(this.$el.dataset.target) || 0;
        this.animateCounter();
    },
    
    animateCounter() {
        const increment = this.target / (this.duration / 16);
        const timer = setInterval(() => {
            this.count += increment;
            if (this.count >= this.target) {
                this.count = this.target;
                clearInterval(timer);
            }
        }, 16);
    }
}));

Alpine.data('imageGallery', () => ({
    currentImage: 0,
    images: [],
    isOpen: false,
    
    init() {
        this.images = JSON.parse(this.$el.dataset.images || '[]');
    },
    
    openGallery(index) {
        this.currentImage = index;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    },
    
    closeGallery() {
        this.isOpen = false;
        document.body.style.overflow = 'auto';
    },
    
    nextImage() {
        this.currentImage = (this.currentImage + 1) % this.images.length;
    },
    
    prevImage() {
        this.currentImage = this.currentImage === 0 ? this.images.length - 1 : this.currentImage - 1;
    }
}));

Alpine.data('mobileMenu', () => ({
    isOpen: false,
    
    toggle() {
        this.isOpen = !this.isOpen;
        document.body.style.overflow = this.isOpen ? 'hidden' : 'auto';
    },
    
    close() {
        this.isOpen = false;
        document.body.style.overflow = 'auto';
    }
}));

Alpine.data('languageSwitcher', () => ({
    currentLang: 'en',
    
    init() {
        this.currentLang = document.documentElement.lang || 'en';
    },
    
    switchLanguage(lang) {
        window.location.href = `/lang/${lang}`;
    }
}));

Alpine.data('searchForm', () => ({
    query: '',
    isSearching: false,
    results: [],
    
    async search() {
        if (this.query.length < 2) {
            this.results = [];
            return;
        }
        
        this.isSearching = true;
        
        try {
            const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
            this.results = await response.json();
        } catch (error) {
            console.error('Search error:', error);
            this.results = [];
        } finally {
            this.isSearching = false;
        }
    }
}));

Alpine.data('contactForm', () => ({
    isSubmitting: false,
    message: '',
    messageType: '',
    
    async submitForm() {
        this.isSubmitting = true;
        this.message = '';
        
        try {
            const formData = new FormData(this.$refs.form);
            const response = await fetch('/contact', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const result = await response.json();
            
            if (response.ok) {
                this.message = result.message || 'Thank you for your message. We will get back to you soon.';
                this.messageType = 'success';
                this.$refs.form.reset();
            } else {
                this.message = result.message || 'There was an error sending your message. Please try again.';
                this.messageType = 'error';
            }
        } catch (error) {
            this.message = 'There was an error sending your message. Please try again.';
            this.messageType = 'error';
        } finally {
            this.isSubmitting = false;
        }
    }
}));

// Utility functions
window.formatCurrency = function(amount, currency = 'NPR') {
    return new Intl.NumberFormat('ne-NP', {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 0,
        maximumFractionDigits: 2
    }).format(amount);
};

window.formatNumber = function(number) {
    return new Intl.NumberFormat('ne-NP').format(number);
};

// Initialize Alpine
Alpine.start();

// Global event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
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
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Form validation enhancement
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalidField = form.querySelector('.border-red-500');
                if (firstInvalidField) {
                    firstInvalidField.focus();
                    firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
});

// Service Worker registration for PWA (future enhancement)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
            })
            .catch(function(error) {
                console.log('ServiceWorker registration failed');
            });
    });
}