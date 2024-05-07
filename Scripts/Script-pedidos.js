const calcular = document.querySelector('.calc');
const modal = document.querySelector('.modal');
const overlay = document.querySelector('.overlay');
const cancelButton = document.querySelector('.cancel');
const modalForm = document.querySelector('.modalFormMainContainer');
const formOverlay = document.querySelector('.formOverlay');
const addOrderButton = document.querySelector('.addOrder');
const input = document.querySelectorAll('.input');

const openModal = () =>{ // This function opens the modal
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
const closeModal = () =>{ // This function close the modal
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
}
const openModalForm = () =>{ //This function opens the form modal
    modalForm.classList.remove('hidden');
    formOverlay.classList.remove('hidden');
}
const closeModalForm = () =>{ //This function close the form modal
    modalForm.classList.add('hidden');
    formOverlay.classList.add('hidden');
    for(let i = 0; input.length; i++){
        input[i].value = '';
    }
}

calcular.addEventListener('click', openModal);
overlay.addEventListener('click', closeModal);
addOrderButton.addEventListener('click', openModalForm);
cancelButton.addEventListener('click', closeModalForm);