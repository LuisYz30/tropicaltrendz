document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('reseñaCarousel');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pages = document.querySelectorAll('.reseña-page');
    let currentIndex = 0;

    const updateButtons = () => {
        prevBtn.style.display = currentIndex > 0 ? 'block' : 'none';
        nextBtn.style.display = currentIndex < pages.length - 1 ? 'block' : 'none';
    };

    const slideTo = (index) => {
        const width = carousel.clientWidth;
        carousel.style.transform = `translateX(-${index * 100}%)`;
        currentIndex = index;
        updateButtons();
    };

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) slideTo(currentIndex - 1);
    });

    nextBtn.addEventListener('click', () => {
        if (currentIndex < pages.length - 1) slideTo(currentIndex + 1);
    });

    updateButtons();
});