'use strict'

function easeInOutQuad (t, b, c, d) {
  t /= d / 2

  if (t < 1) {
    return c / 2 * t * t + b
  }

  t--
  return -c / 2 * (t * (t - 2) - 1) + b
} // because it's so difficult to detect the scrolling element, just move them all

function move (amount) {
  document.documentElement.scrollTop = amount
  document.body.parentNode.scrollTop = amount
  document.body.scrollTop = amount
}

function position () {
  return document.documentElement.scrollTop || document.body.parentNode.scrollTop || document.body.scrollTop
}

export function scrollTo (to, duration, callback) {
  const start = position()
  const change = to - start
  const increment = 20
  let currentTime = 0
  duration = typeof duration === 'undefined' ? 500 : duration

  const animateScroll = function animateScroll () {
    currentTime += increment // find the value with the quadratic in-out easing function and move the document.body

    move(easeInOutQuad(currentTime, start, change, duration)) // do the animation unless its over

    if (currentTime < duration) {
      requestAnimationFrame(animateScroll)
    } else {
      if (callback && typeof callback === 'function') {
        // the animation is done so lets callback
        callback()
      }
    }
  }

  animateScroll()
}
