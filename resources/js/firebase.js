import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase config
const firebaseConfig = {
  apiKey: "AIzaSyAD0PGaiSGBwCTozTApEeoeBp9dU60o7Lg",
  authDomain: "ram-cars-rental-notifcation.firebaseapp.com",
  projectId: "ram-cars-rental-notifcation",
  storageBucket: "ram-cars-rental-notifcation.firebasestorage.app",
  messagingSenderId: "261423185349",
  appId: "1:261423185349:web:e094b5628e8a8cf2b45fac",
};

// Init Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Request permission + get token
export async function requestNotificationPermission() {
    try {
        const permission = await Notification.requestPermission();

        if (permission !== "granted") {
            console.warn("Notification permission not granted.");
            return;
        }

        const token = await getToken(messaging, {
            vapidKey: "BHrnD1XXXvFAX3REC0PAkKfaMrrs-pMOiNva_4YckeG9AQfr8ud42HGnSFCv9Mmh0W0Og4Oz7LtNwfQH-NeSdl0",
            serviceWorkerRegistration: await navigator.serviceWorker.ready
        });

        console.log("FCM Token:", token);

        await fetch("/save-fcm-token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ token })
        });

    } catch (error) {
        console.error("Error requesting permission:", error);
    }
}

// Foreground messages
onMessage(messaging, (payload) => {
    console.log("Foreground message:", payload);

    new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon
    });
});
