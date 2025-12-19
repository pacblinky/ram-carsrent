importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAHV-uf0yxhbSQu8nLYkcrqkyF2akSRO1Q",
  authDomain: "ram-car-rent.firebaseapp.com",
  projectId: "ram-car-rent",
  storageBucket: "ram-car-rent.firebasestorage.app",
  messagingSenderId: "584152847886",
  appId: "1:584152847886:web:b6110f2563b04e2b13ce5f",
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