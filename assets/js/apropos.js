document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('valuesGrid');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const cards = grid.children;

    let currentIndex = 0;
    let visibleCards = 1;
    const totalCards = cards.length;

    function updateVisibleCards() {
        const width = window.innerWidth;
        visibleCards = width >= 768 ? 2 : 1;
        updateSlider();
    }

function updateSlider() {
    const cardStyle = window.getComputedStyle(cards[0]);
    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(cardStyle.marginRight) || 16;

    if (currentIndex > totalCards - visibleCards) {
        currentIndex = totalCards - visibleCards;
    }

    const shift = (cardWidth + gap) * currentIndex;
    grid.style.transform = `translateX(-${shift}px)`;

    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= totalCards - visibleCards;
}


    nextBtn.addEventListener('click', () => {
        if (currentIndex < totalCards - visibleCards) {
            currentIndex++;
            updateSlider();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    window.addEventListener('resize', updateVisibleCards);

    updateVisibleCards();
});
