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

const calcular = document.querySelector('.calc');
const modal = document.querySelector('.calculateModal');
const overlay = document.querySelector('.overlay');
const cancelButton = document.querySelector('.cancel');
const modalForm = document.querySelector('.modalFormMainContainer');
const formOverlay = document.querySelector('.formOverlay');
const addOrderButton = document.querySelector('.addOrder');
const input = document.querySelectorAll('.input');
const optionsButton = document.querySelectorAll('.checkButton');
const optionsList = document.querySelectorAll('.pointsOptions');
const invisibleOverlay = document.querySelector('.invisibleOverlay');

const openModal = () => { // This function opens the modal
    console.log('Holap');
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
// JavaScript Logic
document.addEventListener('DOMContentLoaded', () => {
    const reportButton = document.querySelector('.reportButton');
    const reportModal = document.querySelector('.reportModal');
    const overlay = document.querySelector('.overlay');

    // Function to open the report modal
    const openModal = () => {
        reportModal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    };

    // Function to close the report modal
    const closeModal = () => {
        reportModal.classList.add('hidden');
        overlay.classList.add('hidden');
    };

    // Event listener for report button
    reportButton.addEventListener('click', openModal);

    // Event listener for overlay (to close the modal when clicked outside)
    overlay.addEventListener('click', closeModal);

    // Optional: Event listener for form submission (if you have a form inside the modal)
    const reportForm = document.getElementById('reportForm');
    reportForm.addEventListener('submit', (event) => {
        event.preventDefault();
        // Logic to handle form submission (e.g., sending data to server)
        // Then close the modal
        closeModal();
    });
});

const closeModal = () => { // This function close the modal
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
}
const openModalForm = () => { //This function opens the form modal
    modalForm.classList.remove('hidden');
    formOverlay.classList.remove('hidden');
}
const closeModalForm = () => { //This function close the form modal
    modalForm.classList.add('hidden');
    formOverlay.classList.add('hidden');
    for (let i = 0; input.length; i++) {
        input[i].value = '';
    }
}
const closeOptionsList = () => {
    optionsList.forEach((list) => {
        list.classList.add('hidden');
    });
    invisibleOverlay.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', () => {
    calcular.addEventListener('click', openModal);
    overlay.addEventListener('click', closeModal);
});

addOrderButton.addEventListener('click', openModalForm);
cancelButton.addEventListener('click', closeModalForm);

optionsButton.forEach((but, index) => {
    but.addEventListener('click', () => {
        optionsList[index].classList.remove('hidden');
        invisibleOverlay.classList.remove('hidden');
    });
});
invisibleOverlay.addEventListener('click', closeOptionsList);

