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

// 2. Lazy-load International Phone Input
// This prevents the library from loading on every page, only when needed.
// It exposes the default object globally just like your original code.
import('intl-tel-input').then((module) => {
    window.intlTelInput = module.default;
    import('intl-tel-input/utils').then((utils) => {
        window.intlTelInput.utils = utils;
    });
    })
    .catch(error => {
        console.error("Failed to load International Phone Input:", error);
    });