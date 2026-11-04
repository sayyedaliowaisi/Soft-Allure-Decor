
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard') | Soft Allure Décor
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        /* =====================================
           ADMIN LAYOUT
        ===================================== */

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f1f5f9;
        }

        body.admin-menu-open {
            overflow: hidden;
        }

        /* DESKTOP SIDEBAR */

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
            width: 288px;
            height: 100vh;
            height: 100dvh;
            display: flex;
            flex-direction: column;
            background: #0f172a;
            color: #fff;
            overflow: hidden;
        }

        .admin-sidebar-nav {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: #475569 transparent;
        }

        .admin-sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .admin-sidebar-nav::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 20px;
        }

        /* MAIN CONTENT */

        .admin-main-wrapper {
            margin-left: 288px;
            min-height: 100vh;
            min-width: 0;
        }

        .admin-main {
            min-width: 0;
            padding: 32px;
        }

        /* MOBILE TOPBAR */

        .admin-mobile-header {
            display: none;
        }

        .admin-sidebar-overlay {
            display: none;
        }

        /* TABLET & MOBILE */

        @media (max-width: 1023px) {

            .admin-sidebar {
                width: min(288px, 85vw);
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 100;
            }

            .admin-sidebar.is-open {
                transform: translateX(0);
            }

            .admin-main-wrapper {
                margin-left: 0;
                padding-top: 64px;
            }

            .admin-main {
                padding: 20px;
            }

            .admin-mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 80;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 18px;
                background: #0f172a;
                color: #fff;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            }

            .admin-menu-button {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border: 1px solid #334155;
                border-radius: 10px;
                background: #1e293b;
                color: #fff;
                cursor: pointer;
            }

            .admin-sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 90;
                display: block;
                background: rgba(2, 6, 23, 0.65);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .admin-sidebar-overlay.is-visible {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }
        }

        @media (max-width: 640px) {
            .admin-main {
                padding: 16px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .admin-sidebar,
            .admin-sidebar-overlay {
                transition: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100">

    {{-- =====================================
         MOBILE HEADER
    ===================================== --}}

    <header class="admin-mobile-header">

        <button
            type="button"
            id="adminMenuOpen"
            class="admin-menu-button"
            aria-label="Open admin menu"
            aria-controls="adminSidebar"
            aria-expanded="false"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <a href="{{ route('admin.dashboard') }}"
           class="text-lg font-bold text-white">
            Soft Allure
        </a>

        <span class="text-xs font-semibold text-amber-400">
            ADMIN
        </span>

    </header>


    {{-- =====================================
         MOBILE OVERLAY
    ===================================== --}}

    <div
        id="adminSidebarOverlay"
        class="admin-sidebar-overlay"
        aria-hidden="true"
    ></div>


    {{-- =====================================
         ADMIN SIDEBAR
    ===================================== --}}

    <x-admin.sidebar />


    {{-- =====================================
         MAIN CONTENT
    ===================================== --}}

    <div class="admin-main-wrapper">

        <main class="admin-main">

            @yield('content')

        </main>

    </div>


    {{-- =====================================
         MOBILE SIDEBAR SCRIPT
    ===================================== --}}

    <script>
        
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('adminSidebar');
    const openButton = document.getElementById('adminMenuOpen');
    const closeButton = document.getElementById('adminMenuClose');
    const overlay = document.getElementById('adminSidebarOverlay');

    const mobileBreakpoint = window.matchMedia(
        '(max-width: 1023px)'
    );

    if (!sidebar || !openButton || !overlay) {
        return;
    }

    const focusableSelector = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])'
    ].join(',');

    function isOpen() {
        return sidebar.classList.contains('is-open');
    }

    function getFocusableElements() {
        return Array.from(
            sidebar.querySelectorAll(focusableSelector)
        ).filter(function (element) {
            return element.getClientRects().length > 0;
        });
    }

    function openSidebar() {

        if (!mobileBreakpoint.matches) {
            return;
        }

        sidebar.removeAttribute('inert');

        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');

        document.body.classList.add('admin-menu-open');

        openButton.setAttribute('aria-expanded', 'true');
        sidebar.setAttribute('aria-modal', 'true');

        if (closeButton) {
            closeButton.focus();
        } else {
            const focusable = getFocusableElements();

            if (focusable.length) {
                focusable[0].focus();
            } else {
                sidebar.setAttribute('tabindex', '-1');
                sidebar.focus();
            }
        }
    }

    function closeSidebar(restoreFocus = false) {

        const wasOpen = isOpen();

        if (
            wasOpen &&
            mobileBreakpoint.matches &&
            sidebar.contains(document.activeElement)
        ) {
            openButton.focus();
        }

        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');

        document.body.classList.remove('admin-menu-open');

        openButton.setAttribute('aria-expanded', 'false');

        sidebar.removeAttribute('aria-modal');

        if (mobileBreakpoint.matches) {
            sidebar.setAttribute('inert', '');
        } else {
            sidebar.removeAttribute('inert');
        }

        if (
            restoreFocus &&
            wasOpen &&
            mobileBreakpoint.matches
        ) {
            openButton.focus();
        }
    }

    openButton.addEventListener('click', openSidebar);

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            closeSidebar(true);
        });
    }

    overlay.addEventListener('click', function () {
        closeSidebar(true);
    });

    document.addEventListener('keydown', function (event) {

        if (!mobileBreakpoint.matches || !isOpen()) {
            return;
        }

        if (event.key === 'Escape') {
            event.preventDefault();
            closeSidebar(true);
            return;
        }

        if (event.key !== 'Tab') {
            return;
        }

        const focusable = getFocusableElements();

        if (!focusable.length) {
            event.preventDefault();
            sidebar.focus();
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        const active = document.activeElement;

        if (event.shiftKey) {
            if (active === first || !sidebar.contains(active)) {
                event.preventDefault();
                last.focus();
            }
        } else {
            if (active === last || !sidebar.contains(active)) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            closeSidebar();
        });
    });

    mobileBreakpoint.addEventListener('change', function () {
        closeSidebar();
    });

    closeSidebar();
});

    </script>

    @stack('scripts')

</body>
</html>
