/**
 * Main.js
 *
 * @since 1.0.0
 */

import Raven from 'raven-js'
import ObserveFontFace from './modules/ObserveFontFace'
import FormValidation from './modules/FormValidation'

;(function IIFE () {
  if (process.env.NODE_ENV === 'production') {
    // Raven
    // .config('')
    // .install()
  }
  ObserveFontFace()
  FormValidation()
})()
