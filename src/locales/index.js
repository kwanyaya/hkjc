import { language } from '../stores/language'

import en from './en.json'
import tc from './tc.json'
import err from './err.json'

const locales = {
  en,
  tc,
}

export const getLocale = (page) => {
  if (page === 'err') {
    return err[language.value]
  }

  return locales[language.value][page]
}

export const localesPlugin = {
  install(app) {
    app.config.globalProperties.$t = getLocale
    app.provide('$t', getLocale)
  },
}
