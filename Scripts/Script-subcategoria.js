document.addEventListener('DOMContentLoaded', () => {
    const carrusels = document.querySelectorAll('.productsCarrusel');
    const prevButtons = document.querySelectorAll('.prev');
    const nextButtons = document.querySelectorAll('.next');

    const carrouselsData = [];

    carrusels.forEach((carrusel, index) => {
        const products = carrusel.querySelectorAll('.productContainer');
        const totalProducts = products.length;
        const itemsPerPage = 5;
        const totalPages = Math.ceil(totalProducts / itemsPerPage);
        carrouselsData.push({
            index,
            currentPage: 0,
            totalPages,
            itemsPerPage
        });
    });

    const updateCarrusel = (carruselIndex) => {
        const data = carrouselsData[carruselIndex];
        const carrusel = carrusels[carruselIndex];
        const offset = data.currentPage * data.itemsPerPage * 16; // Assuming each item is 20vw wide
        carrusel.style.transform = `translateX(-${offset}vw)`;
    };

    prevButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const data = carrouselsData[index];
            if (data.currentPage > 0) {
                data.currentPage--;
            } else {
                data.currentPage = data.totalPages - 1;
            }
            updateCarrusel(index);
        });
    });

    nextButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const data = carrouselsData[index];
            if (data.currentPage < data.totalPages - 1) {
                data.currentPage++;
            } else {
                data.currentPage = 0;
            }
            updateCarrusel(index);
        });
    });
});
