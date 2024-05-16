function asignarEventos() {
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
      modal.classList.remove('hidden');
      overlay.classList.remove('hidden');
  }
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

  calcular.addEventListener('click', openModal);
  overlay.addEventListener('click', closeModal);
  addOrderButton.addEventListener('click', openModalForm);
  cancelButton.addEventListener('click', closeModalForm);

  optionsButton.forEach((but, index) => {
      but.addEventListener('click', () => {
          optionsList[index].classList.remove('hidden');
          invisibleOverlay.classList.remove('hidden');
      });
  });
  invisibleOverlay.addEventListener('click', closeOptionsList);

}
  
  //Automatizacion pedidos 
      function extraerNumeroDesdeElemento(elemento) {
          let miTexto = elemento.value;
          let miNumero = Number(miTexto);
      
          return miNumero;
        }
        function calcular2() {
          let ventas = [];
          let posicionVentas = 0;
          let elementosVentas = document.getElementById("container_data_reportes");
      
          for (let item of elementosVentas.children) {
            let valorVenta = extraerNumeroDesdeElemento(item.children[0]);
            ventas[posicionVentas] = valorVenta;
            posicionVentas = posicionVentas + 1;
          }
      
          let totalVentas = sumarTotal(ventas);
          let ventaMayor = calcularMayor(ventas);
          let ventaMenor = calcularMenor(ventas);
      
          for (let item of elementosVentas.children) {
            let valorVenta = extraerNumeroDesdeElemento(item.children[1]);
      
            item.children[0].className = "menuNeutro";
      
            if (valorVenta == ventaMayor) {
              item.children[0].className = "menuInputMayor";
            }
      
            if (valorVenta == ventaMenor) {
              item.children[0].className = "menuInputMenor";
            }
          }
      
          let mensajeSalida = "$ " + totalVentas;
      
          let elementoSalida = document.getElementById("parrafoSalida");
      
          elementoSalida.textContent = mensajeSalida;
          console.log(totalVentas);
        }
      
        function sumarTotal(array) {
          let total = 0;
      
          for (let venta of array) {
            total = total + venta;
          }
      
          return total;
        }
      
        function calcularMayor(array) {
          let maximo = array[0];
      
          for (let venta of array) {
            if (venta > maximo) {
              maximo = venta;
            }
          }
      
          return maximo;
        }
      
        function calcularMenor(array) {
          let minimo = array[0];
      
          for (let venta of array) {
            if (venta < minimo) {
              minimo = venta;
            }
          }
      
          return minimo;
        }