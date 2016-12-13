/**
 * Styleguide navigation
 */

;(function () {
  var styleguideNavigation = document.querySelector('.js-styleguide-navigation')
  var styleguideNavigationButton = document.querySelector('.js-open-styleguide-navigation')

  styleguideNavigationButton.addEventListener('click', function (e) {
    e.preventDefault()
    styleguideNavigation.classList.toggle('styleguide-navigation--is-open')
  })
})()
