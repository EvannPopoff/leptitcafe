document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('valuesGrid');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    
    let currentIndex = 0; // Номер текущей карточки (от 0 до 3)
    const totalCards = 4;

    function updateSlider() {
        // Сдвигаем на 100% * индекс
        grid.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Блокируем кнопки на границах
        prevBtn.disabled = (currentIndex === 0);
        nextBtn.disabled = (currentIndex === totalCards - 1);
    }

    nextBtn.addEventListener('click', () => {
        if (currentIndex < totalCards - 1) {
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
});