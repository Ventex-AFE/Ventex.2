'use strict';

let stylePage = 1;
let productBoxStyle = 1;

// const headerStyle = document.querySelector('.headerContainer');

const Page = document.getElementById('style-catalog');
const productBox = document.getElementById('style-product-box');

Page.href = `./Styles-Frames/Styles-catalogo-${stylePage}.css`;
productBox.href = `./Styles-Product-Box/product-box-${productBoxStyle}.css`;

console.log(`width: ${screen.width} height: ${screen.height}`);