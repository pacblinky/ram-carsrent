import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase config — replace with your own
const firebaseConfig = {
  apiKey: "AIzaSyAD0PGaiSGBwCTozTApEeoeBp9dU60o7Lg",
  authDomain: "ram-cars-rental-notifcation.firebaseapp.com",
  projectId: "ram-cars-rental-notifcation",
  storageBucket: "ram-cars-rental-notifcation.firebasestorage.app",
  messagingSenderId: "261423185349",
  appId: "1:261423185349:web:e094b5628e8a8cf2b45fac",
  measurementId: "G-ZJFCBZP5FT"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Ask user for permission & get FCM token
export async function requestNotificationPermission() {
  try {
    const permission = await Notification.requestPermission();

    if (permission === "granted") {
      const token = await getToken(messaging, {
        vapidKey: "YOUR_VAPID_KEY", // from Firebase Cloud Messaging > Web Push certificates
      });

      console.log("🔑 FCM Token:", token);

      // Send token to your backend
      await fetch("/save-fcm-token", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
        body: JSON.stringify({ token }),
      });
    } else {
      console.warn("❌ Notification permission not granted.");
    }
  } catch (error) {
    console.error("FCM error:", error);
  }
}

// Handle foreground messages (app is open)
onMessage(messaging, (payload) => {
  console.log("📨 Message received in foreground:", payload);
  new Notification(payload.notification.title, {
    body: payload.notification.body,
    icon: payload.notification.icon,
  });
});
