/**
 * Empêche les doubles soumissions (ex. recliquer « Valider » pendant que la page charge).
 * On n’utilise pas disabled=true au moment du submit : ça retirerait le name du bouton du POST.
 */
(function () {
    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.submitting === '1') {
                event.preventDefault();
                return;
            }

            form.dataset.submitting = '1';

            form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(function (btn) {
                btn.style.pointerEvents = 'none';
                btn.style.opacity = '0.65';
                btn.setAttribute('aria-busy', 'true');
                if (btn.tagName === 'INPUT') {
                    btn.dataset.originalValue = btn.value;
                    btn.value = 'Envoi…';
                } else {
                    btn.dataset.originalText = btn.textContent;
                    btn.textContent = 'Envoi…';
                }
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (!event.persisted) {
                return;
            }
            form.dataset.submitting = '0';
            form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(function (btn) {
                btn.style.pointerEvents = '';
                btn.style.opacity = '';
                btn.removeAttribute('aria-busy');
                if (btn.tagName === 'INPUT' && btn.dataset.originalValue) {
                    btn.value = btn.dataset.originalValue;
                } else if (btn.dataset.originalText) {
                    btn.textContent = btn.dataset.originalText;
                }
            });
        });
    });
})();
