// Initialize Swiper
const swiper = new Swiper('.hero-slider', {
    loop: true,
    autoplay: {
        delay: 5000,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

// Countdown Timer
document.querySelectorAll('.countdown').forEach(countdown => {
    const endTime = new Date(countdown.dataset.ends).getTime();
    
    const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        countdown.querySelector('.countdown-timer').innerHTML = 
            `${days}d ${hours}h ${minutes}m ${seconds}s`;
            
        if (distance < 0) {
            clearInterval(timer);
            countdown.querySelector('.countdown-timer').innerHTML = "EXPIRED";
        }
    }, 1000);
});