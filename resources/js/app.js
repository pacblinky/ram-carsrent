import './bootstrap';
import 'flowbite'; // Assuming Flowbite is used on most pages, keep it synchronous for simplicity
import "./theme-toggle";

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// --- Dynamic Imports for Performance ---

// 1. Lazy-load Firebase/Notification logic
// This ensures the heavy Firebase SDK is ONLY loaded and executed if the user is logged in
// and not on the login page, speeding up all other pages significantly.
if (window.location.pathname !== "/login" && window.userIsLoggedIn) {
    import('./firebase')
        .then(({ requestNotificationPermission }) => {
            requestNotificationPermission();
        })
        .catch(error => { 
            // Keep error logging for critical failures like this in production
            console.error("Failed to load Firebase module:", error);
        });
}

window.togglePassword = function(inputId, btn) {
    const input = document.getElementById(inputId);
    // Select only the specific eye icons using classes
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

// 2. Lazy-load International Phone Input
// This prevents the library from loading on every page, only when needed.
// It exposes the default object globally just like your original code.
import('intl-tel-input').then((module) => {
    window.intlTelInput = module.default;
    })
    .catch(error => {
        console.error("Failed to load International Phone Input:", error);
    });