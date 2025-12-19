import { initializeApp, getApps } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase config
const firebaseConfig = {
  apiKey: "AIzaSyBc7lYb09hmzgzRDtY8qCkNigOhMg2iUVw",
  authDomain: "ram-cars-rent.firebaseapp.com",
  projectId: "ram-cars-rent",
  storageBucket: "ram-cars-rent.firebasestorage.app",
  messagingSenderId: "134418214220",
  appId: "1:134418214220:web:63e23c5f04210e22a5b3e9"
};

// Init Firebase
// Use getApps() to avoid initializing twice if the script is loaded multiple times
const app = getApps().length ? getApps()[0] : initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Request permission + get token
export async function requestNotificationPermission() {
    try {
        const permission = await Notification.requestPermission();

        if (permission !== "granted") {
            // console.warn("Notification permission not granted."); // Removed console.warn
            return;
        }

        const token = await getToken(messaging, {
            vapidKey: "BJJOY2lwYEI3iLzHWXU5iFIhkXB36GfsYGrirbeRGleHea8SeHlm0nYyt8o25mEYKazdbIqDNX4abFtWMtA66aw",
            serviceWorkerRegistration: await navigator.serviceWorker.ready
        });

        // console.log("FCM Token:", token); // Removed console.log (token is sensitive)

        await fetch("/save-fcm-token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ token })
        });

    } catch (error) {
        // console.error("Error requesting permission:", error); // Removed console.error
    }
}

// Foreground messages
onMessage(messaging, (payload) => {
    // console.log("Foreground message:", payload); // Removed console.log

    // Prioritize data payload for consistency, then fall back to notification payload
    const notificationData = payload.data || payload.notification || {};

    const title = notificationData.title || 'New Notification';
    const body = notificationData.body || 'You have a new message.';
    const icon = notificationData.icon || '/favicon.png';

    new Notification(title, {
        body: body,
        icon: icon
    });
});