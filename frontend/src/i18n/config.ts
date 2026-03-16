import i18n from 'i18next'
import { initReactI18next } from 'react-i18next'
import LanguageDetector from 'i18next-browser-languagedetector'

import translationID from './locales/id/translation.json'
import translationEN from './locales/en/translation.json'

const resources = {
  id: { translation: translationID },
  en: { translation: translationEN },
}

i18n
  .use(LanguageDetector)
  .use(initReactI18next)
  .init({
    resources,
    fallbackLng: 'id',
    debug: true, // Enable debug to see what's happening
    interpolation: {
      escapeValue: false,
    },
    detection: {
      order: ['localStorage', 'navigator', 'htmlTag'],
      caches: ['localStorage'],
    },
  })

// Log when language changes
i18n.on('languageChanged', (lng) => {
  console.log('Language changed to:', lng)
})

export default i18n
