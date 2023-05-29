import './bootstrap';

function dropDown(elem) {
    return () => {
        if (elem.querySelector('ul').classList.contains("hidden")) {
            elem.querySelector('ul').classList.add('flex', 'flex-col');
            elem.querySelector('ul').classList.remove('hidden');
        } else {
            elem.querySelector('ul').classList.remove('flex', 'flex-col');
            elem.querySelector('ul').classList.add('hidden');
        }
    }
}

function rotateToggle(elem) {
    return () => {
        if (elem.querySelector('svg')) {
            elem.querySelector('svg').classList.toggle('rotate-90');
        }
    }
}

function burgerToggler() {
    burger.querySelector('.open').classList.toggle('hidden');
    burger.querySelector('.open').classList.toggle('inline-block');
    burger.querySelector('.close').classList.toggle('hidden');
    burger.querySelector('.close').classList.toggle('inline-block');
    document.querySelector('#burger + ul').classList.toggle('hidden');
}


let burger = document.getElementById('burger');
let elements = document.getElementsByClassName('drop-down');

burger.addEventListener('click', burgerToggler);

for (let elem of elements) {
    elem.addEventListener('click', dropDown(elem));
    elem.addEventListener('click', rotateToggle(elem));
}