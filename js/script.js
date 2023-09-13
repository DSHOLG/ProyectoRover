

window.addEventListener('DOMContentLoaded', () => {
    const imageContainer = document.querySelector('.image-container');
    const images = imageContainer.querySelectorAll('img');
    const imageWidth = 100; // Ancho máximo de las imágenes
    const imageHeight = 100; // Alto máximo de las imágenes
    const margin = 20; // Margen entre las imágenes

    const positions = new Set();

    images.forEach((img) => {
        let x, y;
        do {
            x = Math.random() * (window.innerWidth - imageWidth - margin);
            y = Math.random() * (window.innerHeight - imageHeight - margin);
        } while (isOverlapping(positions, x, y, imageWidth + margin, imageHeight + margin));

        positions.add({ x, y, width: imageWidth + margin, height: imageHeight + margin });

        img.style.left = `${x}px`;
        img.style.top = `${y}px`;
    });
});

function isOverlapping(positions, x, y, width, height) {
    for (const pos of positions) {
        if (
            x < pos.x + pos.width &&
            x + width > pos.x &&
            y < pos.y + pos.height &&
            y + height > pos.y
        ) {
            return true;
        }
    }
    return false;
}

