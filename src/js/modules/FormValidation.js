/**
 * Form validation
 *
 * @since 1.0.0
 */
import 'script!hyperform/dist/hyperform.js'

const FormValidation = () => {
  window.hyperform(window)
  const inputs = document.querySelectorAll('input')
  ;[...inputs].forEach(input => {
    if (input.required) {
      input.addEventListener('invalid', e => e.preventDefault())
    }
  })
}

export default FormValidation
