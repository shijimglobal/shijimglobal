// Only the FlyonUI plugins the site uses (collapse menu, dropdowns, FAQ accordion, service select).
import 'flyonui/dist/collapse.mjs';
import 'flyonui/dist/dropdown.mjs';
import 'flyonui/dist/accordion.mjs';
import 'flyonui/dist/select.mjs';

// FlyonUI initialises on window "load", which waits for every image and font.
// Initialise right away so menus and dropdowns respond as soon as the page is interactive.
[window.HSCollapse, window.HSDropdown, window.HSAccordion, window.HSSelect].forEach((plugin) => plugin?.autoInit());

const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);

                // Once revealed, drop the stagger delay so later hover effects react instantly.
                entry.target.addEventListener('transitionend', () => entry.target.style.setProperty('--reveal-delay', '0s'), { once: true });
            }
        });
    },
    { threshold: 0.15 },
);

document.querySelectorAll('[data-reveal], [data-reveal-line]').forEach((element) => revealObserver.observe(element));

const navbar = document.querySelector('[data-navbar]');

const updateNavbar = () => {
    navbar?.classList.toggle('shadow-lg', window.scrollY > 12);
    navbar?.classList.toggle('shadow-primary/5', window.scrollY > 12);
};

window.addEventListener('scroll', updateNavbar, { passive: true });
updateNavbar();

// Desktop menu: a pill sits under the current page's link (marked aria-current by the server)
// and glides to whichever link is hovered, returning when the pointer leaves the menu.
const navigationIndicator = document.querySelector('[data-nav-indicator]');
const navigationTrack = document.querySelector('[data-nav-track]');

const moveNavigationIndicator = (targetLink = navigationTrack?.querySelector('[data-nav-link][aria-current="true"]')) => {
    if (!navigationIndicator || !navigationTrack) {
        return;
    }

    if (!targetLink) {
        navigationIndicator.style.opacity = '0';

        return;
    }

    navigationIndicator.style.opacity = '1';
    navigationIndicator.style.width = `${targetLink.offsetWidth}px`;
    navigationIndicator.style.transform = `translateX(${targetLink.parentElement.offsetLeft}px)`;
};

navigationTrack?.querySelectorAll('[data-nav-link]').forEach((link) => {
    link.addEventListener('mouseenter', () => moveNavigationIndicator(link));
    link.addEventListener('focus', () => moveNavigationIndicator(link));
});
navigationTrack?.addEventListener('mouseleave', () => moveNavigationIndicator());

window.addEventListener('resize', () => moveNavigationIndicator());
document.fonts?.ready.then(() => moveNavigationIndicator());
moveNavigationIndicator();

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
        toggle.querySelector('i')?.classList.replace(isHidden ? 'icon-[tabler--eye]' : 'icon-[tabler--eye-off]', isHidden ? 'icon-[tabler--eye-off]' : 'icon-[tabler--eye]');
    });
});

document.querySelectorAll('[data-logo-input]').forEach((logoInput) => {
    logoInput.addEventListener('change', () => {
        const [logoFile] = logoInput.files;

        if (!logoFile) {
            return;
        }

        const logoPreview = document.querySelector('[data-logo-preview]');
        logoPreview.src = URL.createObjectURL(logoFile);
        logoPreview.classList.remove('hidden');
        document.querySelector('[data-logo-placeholder]')?.classList.add('hidden');
    });
});

const partnerModal = document.querySelector('[data-partner-modal]');

if (partnerModal) {
    const partnerForm = partnerModal.querySelector('[data-partner-form]');
    const partnerField = (name) => partnerForm.querySelector(`[data-partner-field="${name}"]`);
    const logoInput = partnerForm.querySelector('[data-logo-input]');
    const logoPreview = partnerForm.querySelector('[data-logo-preview]');
    const logoPlaceholder = partnerForm.querySelector('[data-logo-placeholder]');

    const clearValidationErrors = () => {
        partnerForm.querySelectorAll('.field-error').forEach((error) => error.remove());
        partnerForm.querySelectorAll('.is-invalid').forEach((field) => field.classList.remove('is-invalid'));
    };

    const openPartnerModal = (partner = null) => {
        const isEditing = partner !== null;

        clearValidationErrors();
        partnerForm.action = isEditing ? partner.update_url : partnerModal.dataset.storeUrl;
        partnerForm.querySelector('[data-partner-method]').disabled = !isEditing;
        partnerModal.querySelector('[data-partner-modal-title]').textContent = isEditing ? partnerModal.dataset.titleEdit : partnerModal.dataset.titleCreate;
        partnerModal.querySelector('[data-partner-submit-label]').textContent = isEditing ? partnerModal.dataset.submitEdit : partnerModal.dataset.submitCreate;

        partnerField('id').value = partner?.id ?? '';
        partnerField('name').value = partner?.name ?? '';
        partnerField('website_url').value = partner?.website_url ?? '';
        partnerField('is_active').checked = partner?.is_active ?? true;

        logoInput.value = '';
        logoInput.required = !isEditing;
        logoPreview.src = partner?.logo_url ?? '';
        logoPreview.classList.toggle('hidden', !isEditing);
        logoPlaceholder.classList.toggle('hidden', isEditing);

        partnerModal.showModal();
        partnerField('name').focus();
    };

    document.querySelectorAll('[data-partner-modal-open]').forEach((button) => {
        button.addEventListener('click', () => openPartnerModal(button.dataset.partner ? JSON.parse(button.dataset.partner) : null));
    });

    partnerModal.querySelectorAll('[data-partner-modal-close]').forEach((button) => {
        button.addEventListener('click', () => partnerModal.close());
    });

    // Clicking the dimmed backdrop (outside the dialog box) closes the modal.
    partnerModal.addEventListener('click', (event) => {
        if (event.target === partnerModal) {
            partnerModal.close();
        }
    });

    if (partnerModal.hasAttribute('data-open-on-load')) {
        logoInput.required = !partnerField('id').value;
        partnerModal.showModal();
    }
}

const partnerSortableList = document.querySelector('[data-partner-sortable]');

if (partnerSortableList) {
    const orderStatus = document.querySelector('[data-partner-order-status]');
    let orderStatusTimeout = null;

    const showOrderStatus = (state) => {
        const icons = { saving: 'icon-[tabler--loader-2] animate-spin', saved: 'icon-[tabler--circle-check] text-success', failed: 'icon-[tabler--alert-circle] text-error' };

        orderStatus.innerHTML = `<i class="${icons[state]} text-lg"></i><span></span>`;
        orderStatus.querySelector('span').textContent = orderStatus.dataset[`${state}Text`];
        orderStatus.classList.remove('opacity-0');

        clearTimeout(orderStatusTimeout);

        if (state === 'saved') {
            orderStatusTimeout = setTimeout(() => orderStatus.classList.add('opacity-0'), 2500);
        }
    };

    const renumberPositions = () => {
        partnerSortableList.querySelectorAll('[data-partner-position]').forEach((position, index) => {
            position.textContent = index + 1;
        });
    };

    const saveOrder = async () => {
        showOrderStatus('saving');
        renumberPositions();

        try {
            const response = await fetch(partnerSortableList.dataset.reorderUrl, {
                method: 'PATCH',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    partners: [...partnerSortableList.querySelectorAll('[data-partner-id]')].map((row) => Number(row.dataset.partnerId)),
                }),
            });

            showOrderStatus(response.ok ? 'saved' : 'failed');
        } catch (error) {
            showOrderStatus('failed');
        }
    };

    // SortableJS is only needed on this admin page, so it is loaded on demand as a separate chunk.
    import('sortablejs').then(({ default: Sortable }) => {
        Sortable.create(partnerSortableList, {
            handle: '[data-partner-drag-handle]',
            animation: 180,
            ghostClass: 'opacity-40',
            chosenClass: 'bg-primary/5',
            onEnd: (event) => {
                if (event.oldIndex !== event.newIndex) {
                    saveOrder();
                }
            },
        });
    });
}

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
        // "invisible" also stops the hidden toast link from catching clicks on the buttons beneath it.
        notificationToast.classList.add('invisible', 'opacity-0', 'translate-x-4');
        notificationToast.classList.remove('opacity-100', 'translate-x-0');
    };

    const showToast = (latestNotification) => {
        notificationToast.querySelector('[data-notification-toast-title]').textContent = latestNotification.title;
        notificationToast.querySelector('[data-notification-toast-body]').textContent = latestNotification.body;
        notificationToast.querySelector('[data-notification-toast-link]').href = latestNotification.url;
        notificationToast.classList.remove('invisible', 'opacity-0', 'translate-x-4');
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
            icon: '/assets/ico/icon-192.png',
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
