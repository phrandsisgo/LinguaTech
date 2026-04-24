// Simple translation helper (replace with i18n library like react-i18next later)
const translations = {};

export function __(key, replacements = {}) {
  let text = translations[key] || key;
  Object.entries(replacements).forEach(([k, v]) => {
    text = text.replace(new RegExp(`:${k}`, 'g'), v);
  });
  return text;
}
