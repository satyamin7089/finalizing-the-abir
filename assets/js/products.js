/* Live, accessible filtering for both Abiroverseas product directory templates. */
(() => {
    'use strict';

    const search = document.querySelector('[data-product-search]');
    const grid = document.querySelector('[data-product-grid]');
    if (!search || !grid) return;

    const cards = Array.from(grid.querySelectorAll('[data-product-card]'));
    const count = document.querySelector('[data-products-count]');
    const empty = document.querySelector('[data-products-empty]');
    const status = document.querySelector('[data-products-status]');
    const initialCount = cards.length;

    const normalise = (value) => String(value || '')
        .toLocaleLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9/+-]+/g, ' ')
        .trim();

    function filterProducts() {
        const query = normalise(search.value);
        const terms = query ? query.split(/\s+/).filter(Boolean) : [];
        let visible = 0;

        cards.forEach((card) => {
            const searchable = normalise((card.getAttribute('data-search') || '') + ' ' + card.textContent);
            const matches = terms.every((term) => searchable.includes(term));
            card.hidden = !matches;
            if (matches) visible += 1;
        });

        if (count) count.textContent = String(visible);
        if (empty) empty.hidden = visible !== 0;
        if (status) {
            status.textContent = visible === initialCount
                ? initialCount + (initialCount === 1 ? ' product shown' : (grid.classList.contains('ab-range-grid') ? ' materials shown' : ' product families shown'))
                : visible + (grid.classList.contains('ab-range-grid') ? ' of ' + initialCount + ' materials shown' : ' of ' + initialCount + ' product families shown');
        }
    }

    search.addEventListener('input', filterProducts);
    search.addEventListener('search', filterProducts);
    filterProducts();
})();