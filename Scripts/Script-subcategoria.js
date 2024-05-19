const products = document.querySelectorAll('.productContainer');
const prevButton = document.querySelectorAll('.prev');
const nextButton = document.querySelectorAll('.next');
const carrusel = document.querySelectorAll('.productsCarrusel');

const conter = [];


const prev = (ind) =>{
    

    if((Math.ceil(products.length / 5) - 1) > 0){
        console.log('hay mas de 5 productos');
        if(conter[ind] = 0){
            console.log('bich');
            conter[ind] = Math.ceil(products.length / 5) - 1;
        }
        else{
            conter[ind]--;
            console.log('bich 2');
        }
        scroll(ind);
    }
}
const next = (ind) =>{

    console.log(conter);
    if((Math.ceil(products.length / 5) - 1) > 0){
        console.log('hay mas de 5 productos next');
        if(conter[ind] >= Math.ceil(products.length / 5) - 1){
            conter[ind] = 0;
        }
        else{
            conter[ind]++;
        }
        
        scroll(ind);
    }
}

const scroll = (ind) =>{
    carrusel.forEach((item, index) =>{
        if(ind == index){
            item.style.transform = `translateX(-${conter[ind] * 80}vw)`;
        }
    });
}

carrusel.forEach((car, index) =>{

})

document.addEventListener("DOMContentLoaded", function() {

carrusel.forEach((prevBut, index) => {
    conter.push(0);
    prevButton[index].addEventListener('click', () => prev(index));
    nextButton[index].addEventListener('click', () => next(index));
});

});