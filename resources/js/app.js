import './bootstrap';
import 'flowbite'; // Assuming Flowbite is used on most pages, keep it synchronous for simplicity
import "./theme-toggle";
import "./push-notifcations";

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

window.togglePassword = function(inputId, btn) {
    const input = document.getElementById(inputId);
    const openIcon = btn.querySelector('.eye-open');
    const closedIcon = btn.querySelector('.eye-closed');
    
    if (input.type === 'password') {
        input.type = 'text';
        if(openIcon) openIcon.classList.add('hidden');
        if(closedIcon) closedIcon.classList.remove('hidden');
    } else {
        input.type = 'password';
        if(openIcon) openIcon.classList.remove('hidden');
        if(closedIcon) closedIcon.classList.add('hidden');
    }
};

import('intl-tel-input').then((module) => {
    window.intlTelInput = module.default;
    })
    .catch(error => {
        console.error("Failed to load International Phone Input:", error);
    });