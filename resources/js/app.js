import './bootstrap';
import 'flowbite';
import "./theme-toggle";
import { requestNotificationPermission } from './firebase';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// ✅ Ask for permission AFTER page loads
if (window.location.pathname !== "/login" && window.userIsLoggedIn) {
    requestNotificationPermission();
}