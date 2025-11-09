importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAD0PGaiSGBwCTozTApEeoeBp9dU60o7Lg",
  authDomain: "ram-cars-rental-notifcation.firebaseapp.com",
  projectId: "ram-cars-rental-notifcation",
  storageBucket: "ram-cars-rental-notifcation.firebasestorage.app",
  messagingSenderId: "261423185349",
  appId: "1:261423185349:web:e094b5628e8a8cf2b45fac",
  measurementId: "G-ZJFCBZP5FT"
});

const messaging = firebase.messaging();

// Handle background notifications
messaging.onBackgroundMessage((payload) => {
  console.log("📩 Received background message:", payload);
  const { title, body, icon } = payload.notification;
  self.registration.showNotification(title, { body, icon });
});
