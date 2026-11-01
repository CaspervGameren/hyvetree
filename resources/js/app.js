const root = document.documentElement;
const themeButtons = document.querySelectorAll('[data-theme-toggle]');

function setTheme(theme) {
    root.dataset.theme = theme === 'light' ? 'light' : 'dark';
    const isLight = root.dataset.theme === 'light';
    themeButtons.forEach((button) => {
        const label = isLight ? 'Switch to dark mode' : 'Switch to light mode';
        button.setAttribute('aria-pressed', String(isLight));
        button.setAttribute('aria-label', label);
        button.querySelector('.material-icons-outlined').textContent = isLight ? 'dark_mode' : 'light_mode';
        const tooltip = button.parentElement.querySelector(':scope > span[aria-hidden="true"]');
        if (tooltip) tooltip.textContent = label;
    });
}

let changingTheme = false;

themeButtons.forEach((button) => {
    button.addEventListener('click', async () => {
        if (changingTheme) return;

        const theme = root.dataset.theme === 'light' ? 'dark' : 'light';
        const applyTheme = () => {
            setTheme(theme);
            try { localStorage.setItem('hyvetree-theme', theme); } catch {}
        };

        if (!document.startViewTransition || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            applyTheme();
            return;
        }

        changingTheme = true;
        const rect = button.getBoundingClientRect();
        const x = rect.left + rect.width / 2;
        const y = rect.top + rect.height / 2;
        const radius = Math.hypot(Math.max(x, window.innerWidth - x), Math.max(y, window.innerHeight - y));
        root.classList.add('theme-pulse');

        try {
            const transition = document.startViewTransition(applyTheme);
            // Observe completion immediately, including when a background tab skips the transition.
            const finished = transition.finished.catch(() => {});
            try {
                await transition.ready;
                await root.animate(
                    { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
                    { duration: 650, easing: 'cubic-bezier(0.22, 1, 0.36, 1)', pseudoElement: '::view-transition-new(root)' },
                ).finished;
            } finally {
                await finished;
            }
        } catch {
            applyTheme();
        } finally {
            root.classList.remove('theme-pulse');
            changingTheme = false;
        }
    });
});

window.addEventListener('storage', (event) => {
    if (event.key === 'hyvetree-theme' || event.key === null) setTheme(event.newValue);
});

setTheme(root.dataset.theme);
