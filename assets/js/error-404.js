/**
 * Error 404 — Smart "Back to Previous Page" Navigation Controller.
 *
 * Returns visitors directly to the page they came from (preserving browser
 * scroll state via history.back() when session history exists, or navigating
 * to document.referrer / safe homepage fallback when opened in a fresh tab).
 */
(function () {
    'use strict';

    var backBtn = document.querySelector('[data-ab-go-back]');
    if (!backBtn) {
        return;
    }

    var fallbackUrl = backBtn.getAttribute('data-fallback-url') || '/';
    var prevHint = document.querySelector('[data-ab-prev-hint]');
    var prevValue = document.querySelector('[data-ab-prev-value]');
    var requestedPathEl = document.querySelector('[data-ab-requested-path]');

    if (requestedPathEl && window.location && window.location.pathname) {
        requestedPathEl.textContent = window.location.pathname + (window.location.search || '');
    }

    var validReferrerUrl = null;
    if (document.referrer) {
        try {
            var parsedRef = new URL(document.referrer);
            var isSameBrokenPage = parsedRef.href === window.location.href;
            var isHttp = parsedRef.protocol === 'http:' || parsedRef.protocol === 'https:';

            if (isHttp && !isSameBrokenPage) {
                validReferrerUrl = parsedRef;
                backBtn.setAttribute('href', parsedRef.href);

                if (prevHint && prevValue) {
                    var label = parsedRef.origin === window.location.origin
                        ? (parsedRef.pathname + (parsedRef.hash || ''))
                        : parsedRef.hostname;
                    prevValue.textContent = label || '/';
                    prevHint.hidden = false;
                }
            }
        } catch (err) {
            validReferrerUrl = null;
        }
    }

    backBtn.addEventListener('click', function (event) {
        // Respect Cmd/Ctrl/Shift/middle-click so opening in a new tab works naturally.
        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
        }

        if (validReferrerUrl && window.history.length > 1) {
            event.preventDefault();
            window.history.back();
            return;
        }

        if (validReferrerUrl) {
            event.preventDefault();
            window.location.assign(validReferrerUrl.href);
            return;
        }

        if (window.history.length > 1) {
            event.preventDefault();
            var startHref = window.location.href;
            window.history.back();
            window.setTimeout(function () {
                if (document.visibilityState === 'visible' && window.location.href === startHref) {
                    window.location.assign(fallbackUrl);
                }
            }, 450);
            return;
        }

        event.preventDefault();
        window.location.assign(fallbackUrl);
    });
})();
