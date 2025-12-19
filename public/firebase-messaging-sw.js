importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyBc7lYb09hmzgzRDtY8qCkNigOhMg2iUVw",
  authDomain: "ram-cars-rent.firebaseapp.com",
  projectId: "ram-cars-rent",
  storageBucket: "ram-cars-rent.firebasestorage.app",
  messagingSenderId: "134418214220",
  appId: "1:134418214220:web:63e23c5f04210e22a5b3e9"
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