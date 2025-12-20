function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

// Function to update the Bell Icon UI based on subscription status
window.updatePushIcon = async function() {
    if (!('serviceWorker' in navigator)) return;
    
    // Only attempt if service worker is ready
    let subscription = null;
    try {
        const registration = await navigator.serviceWorker.ready;
        subscription = await registration.pushManager.getSubscription();
    } catch(e) {
        return; 
    }
    
    // Direct selection of the single button
    const btn = document.getElementById('push-notification-toggle-dropdown');
    
    if (!btn) return;
    
    const enabledIcon = document.getElementById('push-icon-enabled-dropdown');
    const disabledIcon = document.getElementById('push-icon-disabled-dropdown');
    
    // Show the button
    btn.classList.remove('hidden');

    if (subscription) {
        enabledIcon.classList.remove('hidden');
        disabledIcon.classList.add('hidden');
        btn.setAttribute('title', 'Disable Notifications');
    } else {
        enabledIcon.classList.add('hidden');
        disabledIcon.classList.remove('hidden');
        btn.setAttribute('title', 'Enable Notifications');
    }
};

window.subscribeToPush = async function() {
    if (!('serviceWorker' in navigator)) return;

    // Explicitly ask for permission if not granted
    if (Notification.permission === 'default') {
        const result = await Notification.requestPermission();
        if (result !== 'granted') return;
    }

    const vapidPublicKey = document.querySelector('meta[name="vapid-public-key"]')?.content;
    if (!vapidPublicKey) return;

    try {
        const registration = await navigator.serviceWorker.ready;
        
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
        });

        await fetch('/push/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(subscription)
        });

        // Update UI after success
        await window.updatePushIcon();

    } catch (error) {
        console.error('Push subscription failed:', error);
    }
};


window.unsubscribeFromPush = async function() {
    if (!('serviceWorker' in navigator)) return;

    try {
        const registration = await navigator.serviceWorker.ready;
        const subscription = await registration.pushManager.getSubscription();

        if (!subscription) {
            return;
        }

        await fetch('/push/unsubscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ endpoint: subscription.endpoint })
        });

        await subscription.unsubscribe();
        
        // Update UI after success
        await window.updatePushIcon();

    } catch (error) {
        console.error('Failed to unsubscribe:', error);
    }
};

// New Toggle Function called by the Button
window.togglePushSubscription = async function() {
    if (!('serviceWorker' in navigator)) return;
    
    // If permission is default, ask for it first
    if (Notification.permission === 'default') {
        const result = await Notification.requestPermission();
        if (result === 'granted') {
            await window.subscribeToPush();
        }
        return;
    }

    if (Notification.permission === 'denied') {
        alert('Notifications are blocked. Please enable them in your browser settings.');
        return;
    }

    const registration = await navigator.serviceWorker.ready;
    const subscription = await registration.pushManager.getSubscription();

    if (subscription) {
        await window.unsubscribeFromPush();
    } else {
        await window.subscribeToPush();
    }
};

window.checkSubscription = async function() {
    if (!('serviceWorker' in navigator)) return;
    await window.updatePushIcon();
};

window.handleLogout = async function(event) {
    event.preventDefault();
    const form = document.getElementById('logout-form');

    if (!form) {
        console.error('Logout form not found');
        return;
    }

    if ('serviceWorker' in navigator) {
        try {
            const registration = await navigator.serviceWorker.ready;
            const subscription = await registration.pushManager.getSubscription();
            
            if (subscription) {
                await fetch('/push/unsubscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ endpoint: subscription.endpoint })
                });
                
                await subscription.unsubscribe();
            }
        } catch (error) {
            console.error('Error removing subscription during logout:', error);
        }
    }
    
    form.submit();
};

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js');
}