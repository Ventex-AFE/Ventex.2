const products = document.querySelectorAll('.productContainer');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
let cont = 0;

const prev = () =>{
    
    if(cont == 0){
        cont = Math.ceil(products.length / 5) - 1;
    }
    else{
        cont--;
    }
    scroll();
}
const next = () =>{

    if(cont >= Math.ceil(products.length / 5) - 1){
        cont = 0;
    }
    else{
        cont++;
    }
    
    scroll();
}

const scroll = () =>{
    products.forEach(item =>{
        item.style.transform = `translateX(-${cont * 80}vw)`;
    });
}

prevButton.addEventListener('click', prev);
nextButton.addEventListener('click', next);