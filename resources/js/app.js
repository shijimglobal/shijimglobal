import './bootstrap';
import 'flyonui/flyonui';

const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.15 },
);

document.querySelectorAll('[data-reveal]').forEach((element) => revealObserver.observe(element));

const navbar = document.querySelector('[data-navbar]');

const updateNavbar = () => {
    navbar?.classList.toggle('shadow-lg', window.scrollY > 12);
    navbar?.classList.toggle('shadow-primary/5', window.scrollY > 12);
};

window.addEventListener('scroll', updateNavbar, { passive: true });
updateNavbar();

const navigationLinks = [...document.querySelectorAll('[data-nav-link]')];
const trackedSections = [...new Set(navigationLinks.map((link) => link.getAttribute('href')))]
    .map((hash) => document.querySelector(hash))
    .filter(Boolean);

const navigationIndicator = document.querySelector('[data-nav-indicator]');
const navigationTrack = document.querySelector('[data-nav-track]');
let activeSectionId = null;

const moveNavigationIndicator = () => {
    if (!navigationIndicator || !navigationTrack) {
        return;
    }

    const activeLink = navigationTrack.querySelector(`[data-nav-link][href="#${activeSectionId}"]`);

    if (!activeLink) {
        navigationIndicator.style.opacity = '0';

        return;
    }

    navigationIndicator.style.opacity = '1';
    navigationIndicator.style.width = `${activeLink.offsetWidth}px`;
    navigationIndicator.style.transform = `translateX(${activeLink.parentElement.offsetLeft}px)`;
};

const setActiveSection = (sectionId) => {
    if (sectionId === activeSectionId) {
        return;
    }

    activeSectionId = sectionId;

    navigationLinks.forEach((link) => {
        const isActive = link.getAttribute('href') === `#${sectionId}`;
        link.setAttribute('aria-current', isActive ? 'true' : 'false');
    });

    moveNavigationIndicator();
};

/**
 * The active section is the one crossing a line at 35% of the viewport height.
 * Computed from live positions on every frame so fast scrolling never skips a section.
 */
const detectActiveSection = () => {
    const activationLine = window.innerHeight * 0.35;
    const currentSection = trackedSections.find((section) => {
        const { top, bottom } = section.getBoundingClientRect();

        return top <= activationLine && bottom > activationLine;
    });

    setActiveSection(currentSection?.id ?? null);
};

let isDetectionQueued = false;

const queueActiveSectionDetection = () => {
    if (isDetectionQueued) {
        return;
    }

    isDetectionQueued = true;

    requestAnimationFrame(() => {
        isDetectionQueued = false;
        detectActiveSection();
    });
};

window.addEventListener('scroll', queueActiveSectionDetection, { passive: true });
window.addEventListener('resize', () => {
    moveNavigationIndicator();
    queueActiveSectionDetection();
});
document.fonts?.ready.then(moveNavigationIndicator);
detectActiveSection();

// Desktop browsers open m.me links on messenger.com, which needs a separate login;
// send them to the page conversation on facebook.com where they are usually signed in.
if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    document.querySelectorAll('a[data-desktop-href]').forEach((link) => {
        if (link.dataset.desktopHref) {
            link.href = link.dataset.desktopHref;
        }
    });
} else {
    // Phones: the link opens the Messenger app directly (the OS asks Open / Cancel).
    document.querySelectorAll('a[data-app-href]').forEach((link) => {
        if (link.dataset.appHref) {
            link.href = link.dataset.appHref;
            link.removeAttribute('target');
        }
    });
}

document.querySelectorAll('[data-theme-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', () => {
        const isDark = document.documentElement.dataset.theme === 'shijim-dark';
        document.documentElement.dataset.theme = isDark ? 'shijim' : 'shijim-dark';

        try {
            localStorage.setItem('theme', isDark ? 'light' : 'dark');
        } catch (error) {
            // Storage may be unavailable (private mode); the theme still applies for this page view.
        }
    });
});

const adminSidebar = document.querySelector('[data-sidebar]');
const adminSidebarBackdrop = document.querySelector('[data-sidebar-backdrop]');

const setAdminSidebarOpen = (isOpen) => {
    adminSidebar?.classList.toggle('-translate-x-full', !isOpen);
    adminSidebarBackdrop?.classList.toggle('hidden', !isOpen);
    document.body.classList.toggle('overflow-hidden', isOpen);
};

document.querySelector('[data-sidebar-open]')?.addEventListener('click', () => setAdminSidebarOpen(true));
document.querySelector('[data-sidebar-close]')?.addEventListener('click', () => setAdminSidebarOpen(false));
adminSidebarBackdrop?.addEventListener('click', () => setAdminSidebarOpen(false));
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        setAdminSidebarOpen(false);
    }
});

document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', () => {
        const passwordInput = document.querySelector(toggle.dataset.passwordToggle);
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';
        toggle.querySelector('i')?.classList.replace(isHidden ? 'ti-eye' : 'ti-eye-off', isHidden ? 'ti-eye-off' : 'ti-eye');
    });
});

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
});

const notificationPoller = document.querySelector('[data-notification-poll]');

if (notificationPoller) {
    const notificationBadge = document.querySelector('[data-notification-badge]');
    const notificationToast = document.querySelector('[data-notification-toast]');
    const originalTitle = document.title;
    let knownUnreadCount = Number(notificationPoller.dataset.notificationCount) || 0;
    let toastTimeout = null;

    const renderUnreadCount = (unreadCount) => {
        notificationBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
        notificationBadge.classList.toggle('hidden', unreadCount === 0);
        document.title = unreadCount > 0 ? `(${unreadCount}) ${originalTitle}` : originalTitle;
    };

    const hideToast = () => {
        notificationToast.classList.add('opacity-0', 'translate-x-4');
        notificationToast.classList.remove('opacity-100', 'translate-x-0');
    };

    const showToast = (latestNotification) => {
        notificationToast.querySelector('[data-notification-toast-title]').textContent = latestNotification.title;
        notificationToast.querySelector('[data-notification-toast-body]').textContent = latestNotification.body;
        notificationToast.querySelector('[data-notification-toast-link]').href = latestNotification.url;
        notificationToast.classList.remove('opacity-0', 'translate-x-4');
        notificationToast.classList.add('opacity-100', 'translate-x-0');

        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(hideToast, 8000);
    };

    const showBrowserNotification = (latestNotification) => {
        if (!('Notification' in window) || Notification.permission !== 'granted' || !document.hidden) {
            return;
        }

        const browserNotification = new Notification(latestNotification.title, {
            body: latestNotification.body,
            icon: '/assets/ico/android-chrome-192x192.png',
            tag: latestNotification.id,
        });

        browserNotification.onclick = () => {
            window.focus();
            window.location.assign(latestNotification.url);
        };
    };

    const pollNotifications = async () => {
        try {
            const response = await fetch(notificationPoller.dataset.notificationPoll, {
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });

            if (!response.ok) {
                return;
            }

            const { unread_count: unreadCount, latest: latestNotification } = await response.json();

            if (unreadCount > knownUnreadCount && latestNotification) {
                showToast(latestNotification);
                showBrowserNotification(latestNotification);
            }

            knownUnreadCount = unreadCount;
            renderUnreadCount(unreadCount);
        } catch (error) {
            // Network hiccups are ignored; the next poll will retry.
        }
    };

    notificationToast.querySelector('[data-notification-toast-close]').addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        hideToast();
    });

    document.querySelector('#notifications-dropdown')?.addEventListener('click', () => {
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
    });

    renderUnreadCount(knownUnreadCount);
    setInterval(pollNotifications, 20000);
}

document.querySelectorAll('#mobile-navigation a[href^="#"]').forEach((link) => {
    link.addEventListener('click', () => {
        const mobileToggle = document.querySelector('[data-collapse="#mobile-navigation"]');

        if (mobileToggle?.classList.contains('open')) {
            window.HSCollapse?.hide('#mobile-navigation');
        }
    });
});
