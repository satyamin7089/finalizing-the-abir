/* Bhavik Enterprises — standalone scroll-reveal & interaction controller.
   Header mobile menu toggle is owned by assets/js/navigation.js. */
(function () {
  var items = document.querySelectorAll('.ab-reveal');
  if (!items.length) return;

  if (!('IntersectionObserver' in window)) {
    items.forEach(function (el) {
      el.classList.add('is-visible');
    });
    return;
  }

  var io = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -36px 0px' }
  );

  items.forEach(function (el) {
    io.observe(el);
  });
})();
