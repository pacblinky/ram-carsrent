var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
var themeToggleBtn = document.getElementById('theme-toggle');

// extra elements for mobile
var themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
var themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
var themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');

// function to sync icons for both desktop and mobile
function syncIcons(isDark) {
    if (isDark) {
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleDarkIcon.classList.add('hidden');
        themeToggleLightIconMobile.classList.remove('hidden');
        themeToggleDarkIconMobile.classList.add('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
        themeToggleLightIcon.classList.add('hidden');
        themeToggleDarkIconMobile.classList.remove('hidden');
        themeToggleLightIconMobile.classList.add('hidden');
    }
}

// 1. SYNC ICONS ON LOAD
var isDark = document.documentElement.classList.contains('dark');
syncIcons(isDark);

// 2. CLICK HANDLER
function toggleTheme() {
    // toggle icons inside both buttons
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');
    themeToggleDarkIconMobile.classList.toggle('hidden');
    themeToggleLightIconMobile.classList.toggle('hidden');

    // handle local storage and html class
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
}

// attach listeners to both buttons
themeToggleBtn.addEventListener('click', toggleTheme);
themeToggleBtnMobile.addEventListener('click', toggleTheme);
