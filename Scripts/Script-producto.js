document.addEventListener('DOMContentLoaded', () => {
    // Código para manejar carruseles de productos
    (function() {
        const carrusels = document.querySelectorAll('.productsCarrusel');
        const prevButtons = document.querySelectorAll('.prev');
        const nextButtons = document.querySelectorAll('.next');
        const reportButton = document.querySelector('.reportButton');

        const reportModal = document.querySelector('.reportModal');
        const overlay = document.querySelector('.overlay')
        const openModal = () => { // This function opens the modal
            console.log('Holap');
            reportModal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        };
        
        const closeModal = () => { // This function close the modal
            reportModal.classList.add('hidden');
            overlay.classList.add('hidden');
        };
        
        reportButton.addEventListener('click', openModal);
        overlay.addEventListener('click', closeModal);
        


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
    })();
    
    // Código para manejo de modales
    (function() {
        const calcular = document.querySelector('.calc');
        const modal = document.querySelector('.calculateModal');
        const cancelButton = document.querySelector('.cancel');
        const modalForm = document.querySelector('.modalFormMainContainer');
        const formOverlay = document.querySelector('.formOverlay');
        const addOrderButton = document.querySelector('.addOrder');
        const input = document.querySelectorAll('.input');
        const optionsButton = document.querySelectorAll('.checkButton');
        const optionsList = document.querySelectorAll('.pointsOptions');
        const invisibleOverlay = document.querySelector('.invisibleOverlay');
        
;
        

        
        const openModalForm = () => { // This function opens the form modal
            modalForm.classList.remove('hidden');
            formOverlay.classList.remove('hidden');
        };
        
        const closeModalForm = () => { // This function close the form modal
            modalForm.classList.add('hidden');
            formOverlay.classList.add('hidden');
            input.forEach(i => i.value = '');
        };
        
        const closeOptionsList = () => {
            optionsList.forEach((list) => {
                list.classList.add('hidden');
            });
            invisibleOverlay.classList.add('hidden');
        };
        
        calcular.addEventListener('click', openModal);
        
        addOrderButton.addEventListener('click', openModalForm);
        cancelButton.addEventListener('click', closeModalForm);
        
        optionsButton.forEach((but, index) => {
            but.addEventListener('click', () => {
                optionsList[index].classList.remove('hidden');
                invisibleOverlay.classList.remove('hidden');
            });
        });
        
        invisibleOverlay.addEventListener('click', closeOptionsList);
    })();
});
