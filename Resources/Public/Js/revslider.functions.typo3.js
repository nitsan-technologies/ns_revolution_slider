function revslider_showDoubleJqueryError(sliderID) {
    var errorMessage = "Slider Revolution Error: You have some jquery.js library include that comes after the revolution files js include.";
    errorMessage += "<br> This includes make eliminates the Slider Revolution libraries, and make it not work.";
    errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
    errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
    jQuery(sliderID).show().html(errorMessage);
}

class CustomSlider {
    constructor(containerId, settings) {
        this.container = document.getElementById(containerId);
        this.slides = this.container.querySelectorAll('.rev_slider_wrapper');
        this.currentIndex = 0;
        this.loop = settings.loop ?? true;
        this.delay = settings.delay ?? 5000;
        this.autoPlay = settings.autoPlay ?? true;
        this.stopAtSlide = settings.stopAtSlide ?? -1;

        this.createBullets();
        this.showSlide(this.currentIndex);
        this.attachEvents();

        if (this.autoPlay) {
            this.startAutoPlay();
        }
    }

    showSlide(index) {
        this.slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        this.updateBullets(index);
    }

    nextSlide() {
        if (this.stopAtSlide >= 0 && this.currentIndex === this.stopAtSlide) return;
        this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        this.showSlide(this.currentIndex);
    }

    prevSlide() {
        this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        this.showSlide(this.currentIndex);
    }

    startAutoPlay() {
        this.interval = setInterval(() => this.nextSlide(), this.delay);
    }

    stopAutoPlay() {
        clearInterval(this.interval);
    }

    createBullets() {
        const bulletContainer = this.container.querySelector('.slider-bullets');
        this.slides.forEach((_, i) => {
            const bullet = document.createElement('span');
            bullet.className = 'bullet';
            bullet.addEventListener('click', () => {
                this.currentIndex = i;
                this.showSlide(i);
            });
            bulletContainer.appendChild(bullet);
        });
        this.bullets = bulletContainer.querySelectorAll('.bullet');
    }

    updateBullets(index) {
        this.bullets.forEach((b, i) => b.classList.toggle('active', i === index));
    }

    attachEvents() {
        this.container.querySelector('.arrow.next').addEventListener('click', () => this.nextSlide());
        this.container.querySelector('.arrow.prev').addEventListener('click', () => this.prevSlide());

        document.addEventListener('keydown', e => {
            if (e.key === 'ArrowRight') this.nextSlide();
            if (e.key === 'ArrowLeft') this.prevSlide();
        });

        // Touch swipe support
        let startX = 0;
        this.container.addEventListener('touchstart', e => startX = e.touches[0].clientX);
        this.container.addEventListener('touchend', e => {
            let endX = e.changedTouches[0].clientX;
            if (startX - endX > 50) this.nextSlide();
            if (endX - startX > 50) this.prevSlide();
        });
    }
}

// Initialize slider
new CustomSlider('slider-container', {
    delay: 3000,
    loop: true,
    autoPlay: true,
    stopAtSlide: -1
});