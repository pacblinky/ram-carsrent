import { initializeApp, getApps } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase config
const firebaseConfig = {
  apiKey: "AIzaSyAHV-uf0yxhbSQu8nLYkcrqkyF2akSRO1Q",
  authDomain: "ram-car-rent.firebaseapp.com",
  projectId: "ram-car-rent",
  storageBucket: "ram-car-rent.firebasestorage.app",
  messagingSenderId: "584152847886",
  appId: "1:584152847886:web:b6110f2563b04e2b13ce5f",
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
            vapidKey: "BHrnD1XXXvFAX3REC0PAkKfaMrrs-pMOiNva_4YckeG9AQfr8ud42HGnSFCv9Mmh0W0Og4Oz7LtNwfQH-NeSdl0",
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