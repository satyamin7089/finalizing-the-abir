/* Navigation is owned by the shared controller in assets/js/navigation.js.
   Page scripts must not bind their own menu toggle: two controllers fight over
   the .is-open state and the menu can close itself on the first tap. */
(() => {
            const reduceMotion =
                window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const revealEls = document.querySelectorAll('.ab-reveal:not(.is-visible)'); if ('IntersectionObserver' in window && !reduceMotion) {
                const
                observer = new IntersectionObserver(entries => entries.forEach(entry => {
                    if
                        (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target)
                    }
                }), {threshold: .12, rootMargin: '0px 0px -25px 0px'}); revealEls.forEach(el => observer.observe(el))
            } else
                revealEls.forEach(el => el.classList.add('is-visible'));
            const form = document.querySelector('#enquiry-form'), status =
                document.querySelector('#home-form-status'), topic =
                    document.querySelector('#home-topic'); document.querySelectorAll('[data-enquiry]').forEach(link => link.addEventListener('click', () => {
                        const val =
                            link.getAttribute('data-enquiry'); if (topic) {
                                const option =
                                    [...topic.options].find(o => o.text.toLowerCase() === val.toLowerCase()); if
                                    (option) topic.value = option.value; else if (val) topic.value = 'Other'
                            }
                    })); if (form) {
                form.addEventListener('submit', e => {
                    if (!form.reportValidity()) { e.preventDefault(); if (status) { status.textContent = 'Please complete the required fields and check the email address.'; status.dataset.state = 'error'; } return; }
                    if (status) { status.textContent = 'Sending your enquiry…'; status.dataset.state = 'info'; }
                });
            }
            document.querySelectorAll('[data-current-year]').forEach(el =>
                el.textContent = new Date().getFullYear());
        })();

        const result = new URLSearchParams(window.location.search).get('ab_enquiry');
        if (result) { const node = document.querySelector('#home-form-status'); if (node) { node.textContent = result === 'sent' ? 'Thank you. Your enquiry has been sent.' : 'We could not send your enquiry. Please try again or contact us directly.'; node.dataset.state = result === 'sent' ? 'success' : 'error'; } }


/* Stable cross-fade, thumbnail selection and arrow controls for the final banner gallery. */
(() => {
  const gallery = document.querySelector('[data-hero-photo-gallery]');
  if (!gallery) return;
  const photos = [...gallery.querySelectorAll('[data-hero-photo]')];
  if (photos.length < 2) return;
  const art = gallery.closest('.ab-hero-art');
  const thumbs = art ? [...art.querySelectorAll('[data-photo-thumb]')] : [];
  const previous = art?.querySelector('[data-photo-prev]');
  const next = art?.querySelector('[data-photo-next]');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let active = photos.find(photo => photo.classList.contains('is-active')) || photos[0];
  let timer = null;

  function readyPhotos() {
    return photos.filter(photo => photo.dataset.photoReady === 'true');
  }
  function setActive(photo) {
    active = photo;
    photos.forEach((item, index) => {
      const selected = item === active;
      item.classList.toggle('is-active', selected);
      item.setAttribute('aria-hidden', String(!selected));
      if (thumbs[index]) {
        thumbs[index].classList.toggle('is-active', selected);
        thumbs[index].setAttribute('aria-pressed', String(selected));
      }
    });
  }
  function stop() {
    if (timer) window.clearInterval(timer);
    timer = null;
  }
  function start() {
    stop();
    if (reduceMotion || document.hidden || readyPhotos().length < 2) return;
    timer = window.setInterval(() => step(1), 7000);
  }
  function step(direction) {
    const ready = readyPhotos();
    if (ready.length < 2) return;
    let index = ready.indexOf(active);
    if (index < 0) index = direction > 0 ? -1 : 0;
    setActive(ready[(index + direction + ready.length) % ready.length]);
  }
  function updatePhotoState(photo, image) {
    photo.dataset.photoReady = image.naturalWidth > 0 ? 'true' : 'false';
    const ready = readyPhotos();
    if (!ready.includes(active) && ready.length) setActive(ready[0]);
    start();
  }

  photos.forEach(photo => {
    const image = photo.querySelector('img');
    if (!image) {
      photo.dataset.photoReady = 'false';
      return;
    }
    image.loading = 'eager';
    if (image.complete) {
      updatePhotoState(photo, image);
    } else {
      image.addEventListener('load', () => updatePhotoState(photo, image), { once: true });
      image.addEventListener('error', () => updatePhotoState(photo, image), { once: true });
    }
  });

  if (art && thumbs.length) {
    art.classList.add('has-gallery-controls');
    thumbs.forEach(button => button.addEventListener('click', () => {
      const photo = photos[Number(button.dataset.photoThumb)];
      if (photo && readyPhotos().includes(photo)) {
        setActive(photo);
        start();
      }
    }));
    previous?.addEventListener('click', () => { step(-1); start(); });
    next?.addEventListener('click', () => { step(1); start(); });
  }
  document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());
  start();
})();
