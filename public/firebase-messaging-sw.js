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

messaging.onBackgroundMessage((payload) => {
  const notificationData = payload.data || payload.notification || {};
  
  const title = notificationData.title || 'New Notification';
  const body = notificationData.body || 'You have a new message.';
  const icon = notificationData.icon || '/favicon.png'; 
  
  self.registration.showNotification(title, { 
      body: body, 
      icon: icon,
      data: payload.data
  });
});