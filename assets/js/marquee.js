/**
 * Partner logo marquee interactions.
 *
 * CSS runs the seamless one-way loop and already pauses it on hover and on
 * keyboard focus. This file adds the two behaviours CSS cannot cover:
 *   1. touch — pause while a finger is on the strip (the mobile "hover stop"),
 *   2. off-screen — pause while the strip is out of view so it stays idle and
 *      resumes from a stable frame when it scrolls back in.
 */
( function () {
    'use strict';

    function initMarquee( box ) {
        // 1. Touch: pause while touching, resume on release.
        box.addEventListener( 'touchstart', function () {
            box.classList.add( 'is-paused' );
        }, { passive: true } );

        [ 'touchend', 'touchcancel' ].forEach( function ( type ) {
            box.addEventListener( type, function () {
                box.classList.remove( 'is-paused' );
            }, { passive: true } );
        } );

        // 2. Pause when the strip leaves the viewport.
        if ( 'IntersectionObserver' in window ) {
            new IntersectionObserver( function ( entries ) {
                entries.forEach( function ( entry ) {
                    box.classList.toggle( 'is-paused', ! entry.isIntersecting );
                } );
            } ).observe( box );
        }
    }

    document.querySelectorAll( '.ab-logo-marquee' ).forEach( initMarquee );
} )();
