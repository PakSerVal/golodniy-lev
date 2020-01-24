import Presearch from './presearch';

/**
 * Presearch.
 *
 * @author Pak Sergey
 */
document.addEventListener('DOMContentLoaded', () => {
    const presearchInput = document.getElementById('presearch-input') as HTMLInputElement;

    if (null === presearchInput) {
        return;
    }

    const presearchUrl = presearchInput.dataset.presearchUrl;

    const presearch = new Presearch(presearchInput, presearchUrl);
    presearch.init();
});
