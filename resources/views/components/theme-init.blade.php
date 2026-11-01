<script>
    (() => {
        let theme = 'dark';
        try { theme = localStorage.getItem('hyvetree-theme') === 'light' ? 'light' : 'dark'; } catch {}
        document.documentElement.dataset.theme = theme;
    })();
</script>
