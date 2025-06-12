import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const IMAGENES = ["/assets/img/logo_dragonballapi-ngN4G3c.webp", "/assets/img/unnamed-SyjGglf.jpg", "/assets/img/dragon-ball-super-pictures-6s9gnffpcvuar9c4-UitZxi4.jpg"];

    let imagen = document.querySelector('.slider-img');
    let posicionActual = 0;
    let botonRetroceder = document.querySelector('.prev');
    let botonAvanzar = document.querySelector('.next');

    botonAvanzar.addEventListener('click', adelantarImagen);
    botonRetroceder.addEventListener('click', retrocederImagen);
    renderizarImagen();

    function adelantarImagen() {
        if (posicionActual >= IMAGENES.length -1) {
            posicionActual = 0;
        } else {
            posicionActual++;
        }
        renderizarImagen();
    }

    function retrocederImagen() {
        if (posicionActual <= 0) {
            posicionActual = IMAGENES.length - 1;
        } else {
            posicionActual--;
        }
        renderizarImagen();
    }

    function renderizarImagen() {
        imagen.style.backgroundImage = `url(${IMAGENES[posicionActual]})`;
    }
   
});

