import './bootstrap';
import { animate, svg } from 'animejs';

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('page-transition-overlay');
    const loaderPath = document.getElementById('loader-path');
    const morphLoader = document.getElementById('morph-loader');

    if (!overlay || !loaderPath || !morphLoader) return;

    // Morphological animation sequence using dynamic elastic easing
    const morphAnimation = animate(loaderPath, {
        d: [
            { to: svg.morphTo('#shape-2', 0), easing: 'easeInOutElastic(1, .8)' },
            { to: svg.morphTo('#shape-3', 0), easing: 'easeInOutBack' },
            { to: svg.morphTo('#shape-4', 0), easing: 'easeOutElastic(1, .9)' },
            { to: svg.morphTo('#shape-1', 0), easing: 'easeInOutCirc' }
        ],
        duration: 4500,
        loop: true,
        autoplay: true
    });

    // Subtle spin and pulse animation for the entire SVG container
    const spinAnimation = animate(morphLoader, {
        rotate: '360deg',
        duration: 20000,
        easing: 'linear',
        loop: true,
        autoplay: true
    });

    const initAnimation = animate(morphLoader, {
        scale: [0.8, 1],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo'
    });

    window.addEventListener('load', () => {
        setTimeout(() => {
            overlay.classList.add('opacity-0');
            // Ensure pointer-events-none is applied to allow interactions through the faded overlay
            overlay.classList.add('pointer-events-none');

            // Slight scale up on fade out
            animate(morphLoader, {
                scale: 1.5,
                duration: 800,
                easing: 'easeInCubic'
            });

            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 800);
        }, 500);
    });

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            const target = link.getAttribute('target');

            if (href && href.startsWith('/') && !href.startsWith('#') && target !== '_blank' && !e.ctrlKey && !e.metaKey) {
                e.preventDefault();

                overlay.classList.remove('hidden');

                // Reset scale before fading in
                animate(morphLoader, {
                    scale: 1,
                    duration: 10
                });

                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                }, 10);

                setTimeout(() => {
                    window.location.href = href;
                }, 700);
            }
        });
    });
});
