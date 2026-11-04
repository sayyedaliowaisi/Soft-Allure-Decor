
import './bootstrap';
import './aos';
import './gsap';

import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

/*
|--------------------------------------------------------------------------
| ALPINE JS
|--------------------------------------------------------------------------
*/

window.Alpine = Alpine;

Alpine.start();

/*
|--------------------------------------------------------------------------
| LUCIDE ICONS
|--------------------------------------------------------------------------
*/

function initializeAdminIcons() {
    createIcons({
        icons,
        attrs: {
            'stroke-width': 1.8,
            'aria-hidden': 'true'
        }
    });
}

/*
|--------------------------------------------------------------------------
| INITIALIZE ICONS
|--------------------------------------------------------------------------
*/

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initializeAdminIcons
    );
} else {
    initializeAdminIcons();
}
