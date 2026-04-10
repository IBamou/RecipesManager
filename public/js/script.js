document.addEventListener('DOMContentLoaded', function() {
    // Simple fade-in animation for elements with .fade-in-up class
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // Add a class to body when JS is enabled, for potential styling hooks
    document.body.classList.add('js-enabled');
});

// Function to toggle a mobile menu (to be called from a button)
function toggleMobileMenu() {
    const nav = document.querySelector('.main-nav');
    if (nav) {
        nav.classList.toggle('is-open');
    }
}
