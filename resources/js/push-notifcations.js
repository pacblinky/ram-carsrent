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

window.updatePushIcon = async function() {
    if (!('serviceWorker' in navigator)) return;
    
    let subscription = null;
    try {
        const registration = await navigator.serviceWorker.ready;
        subscription = await registration.pushManager.getSubscription();
    } catch(e) {
        return; 
    }

    const btn = document.getElementById('push-notification-toggle-dropdown');
    
    if (!btn) return;
    
    const enabledIcon = document.getElementById('push-icon-enabled-dropdown');
    const disabledIcon = document.getElementById('push-icon-disabled-dropdown');

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

        await window.updatePushIcon();

    } catch (error) {
        console.error('Failed to unsubscribe:', error);
    }
};

window.togglePushSubscription = async function() {
    if (!('serviceWorker' in navigator)) return;

    const btn = document.getElementById('push-notification-toggle-dropdown');

    if (btn) {
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
    }
    
    try {
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

    } catch (error) {
        console.error('Error toggling subscription:', error);
    } finally {
        if (btn) {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
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