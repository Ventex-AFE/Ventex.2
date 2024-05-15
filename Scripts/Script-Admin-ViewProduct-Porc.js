const optionsButton = document.querySelectorAll('.checkButton');
const optionsList = document.querySelectorAll('.pointsOptions');
const invisibleOverlay = document.querySelector('.invisibleOverlay');

const closeOptionsList = () =>{
    optionsList.forEach((list) => {
            list.classList.add('hidden');
    });
    invisibleOverlay.classList.add('hidden');
}

optionsButton.forEach((but, index) => {

    console.log('hola');
    but.addEventListener('click', () => {
        console.log('hola');
        optionsList[index].classList.remove('hidden');
        invisibleOverlay.classList.remove('hidden');
    });
});
invisibleOverlay.addEventListener('click', closeOptionsList);
