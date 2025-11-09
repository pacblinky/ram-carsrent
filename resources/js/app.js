import './bootstrap';
import 'flowbite';
import "./theme-toggle"
import { requestNotificationPermission } from './firebase';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

requestNotificationPermission();
