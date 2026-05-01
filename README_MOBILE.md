# LinguaTech – React SPA & Mobile App

Dieser Branch (`react-spa`) enthält das React SPA Frontend, das über Laravel als JSON-API-Backend läuft.
Der `main` Branch (Blade-Version) bleibt vollständig unverändert.

---

## Voraussetzungen

- PHP 8.2 oder 8.3 (nicht 8.4 oder 8.5 wegen Package-Kompatibilität)
- Composer 2.x
- Node.js 18+
- MySQL 8.x

## Setup

1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `php artisan migrate`
5. Terminal 1: `php artisan serve`
6. Terminal 2: `npm install && npm run dev`
7. Browser: http://localhost:8000/app

---

## Architektur

```
Laravel (Backend)  →  JSON API (api/*)
React SPA          →  /app/* (Vite + React Router)
Capacitor          →  iOS & Android App
```

---

## Lokal starten

### Voraussetzungen

- PHP 8.1+
- Composer
- Node.js 18+
- MySQL

### 1. Laravel Backend starten

```bash
# Dependencies installieren
composer install

# .env konfigurieren
cp .env.example .env
php artisan key:generate

# Datenbank migrieren
php artisan migrate

# Laravel starten
php artisan serve
```

### 2. React Frontend starten (Vite Dev Server)

```bash
# Node Dependencies installieren
npm install

# Vite Dev Server starten (mit Hot Reload)
npm run dev
```

Das React SPA ist dann unter `http://localhost:8000/app` erreichbar.

### 3. Frontend bauen (für Produktion)

```bash
npm run build
```

---

## Umgebungsvariablen

Kopiere `.env.example` und fülle die folgenden Werte aus:

```env
APP_URL=http://localhost:8000

DEEPL_API_KEY=dein-deepl-schlüssel
OPENAI_SECRET_KEY=dein-openai-schlüssel
STRIPE_KEY=dein-stripe-public-key
STRIPE_SECRET=dein-stripe-secret

FRONTEND_URL=http://localhost:5173
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:5173
```

---

## API Endpunkte

### Auth (Token-basiert via Sanctum)

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| POST | `/api/auth/login` | Login, gibt Token zurück |
| POST | `/api/auth/register` | Registrierung, gibt Token zurück |
| POST | `/api/auth/logout` | Logout (auth:sanctum) |
| GET | `/api/auth/user` | Eingeloggter User (auth:sanctum) |
| POST | `/api/auth/forgot-password` | Passwort-Reset E-Mail |
| POST | `/api/auth/reset-password` | Passwort zurücksetzen |

### WordLists / Library

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| GET | `/api/wordlists` | Alle Listen |
| POST | `/api/wordlists` | Neue Liste erstellen |
| GET | `/api/wordlists/{id}` | Einzelne Liste mit Wörtern |
| PUT | `/api/wordlists/{id}` | Liste updaten |
| DELETE | `/api/wordlists/{id}` | Liste löschen |
| POST | `/api/wordlists/{id}/copy` | Liste kopieren |
| POST | `/api/wordlists/{id}/words` | Wort hinzufügen |
| DELETE | `/api/words/{id}` | Wort löschen |
| POST | `/api/swipe` | SwipeLearn Handle |

### Texte

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| GET | `/api/texts` | Alle Texte |
| POST | `/api/texts` | Neuen Text erstellen |
| GET | `/api/texts/{id}` | Einzelner Text |
| PUT | `/api/texts/{id}` | Text updaten |
| DELETE | `/api/texts/{id}` | Text löschen |
| POST | `/api/texts/generate` | Text via AI generieren |

### Profil

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| PATCH | `/api/profile` | Profil updaten |
| DELETE | `/api/profile` | Account löschen |
| POST | `/api/profile/interests` | Interessen updaten |
| POST | `/api/profile/languages` | Sprache hinzufügen |
| DELETE | `/api/profile/languages/{id}` | Sprache entfernen |
| POST | `/api/profile/cancel-subscription` | Abo kündigen |
| POST | `/api/profile/initiate` | Profil initialisieren |

### Sonstiges

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| GET | `/api/languages` | Alle Sprachen |
| POST | `/api/translate` | DeepL Übersetzung |
| GET | `/api/home` | Home-Daten |
| GET | `/api/patch-notes` | PatchNotes Liste |
| GET | `/api/patch-notes/{id}` | Einzelne PatchNote |

---

## Als iOS/Android App verpacken (Capacitor)

### Voraussetzungen

- Xcode (für iOS)
- Android Studio (für Android)

### Setup

```bash
# Capacitor installieren
npm install @capacitor/core @capacitor/cli @capacitor/ios @capacitor/android

# Frontend bauen
npm run build

# Capacitor initialisieren (falls noch nicht gemacht)
npx cap init LinguaTech com.linguatech.app

# iOS/Android Plattform hinzufügen
npx cap add ios
npx cap add android

# Build synchronisieren
npx cap sync

# In Xcode öffnen (iOS)
npx cap open ios

# In Android Studio öffnen (Android)
npx cap open android
```

### capacitor.config.json

```json
{
  "appId": "com.linguatech.app",
  "appName": "LinguaTech",
  "webDir": "public/build",
  "server": {
    "url": "https://deine-production-url.com/app",
    "cleartext": true
  }
}
```

---

## Frontend Struktur

```
frontend/src/
├── main.jsx              # Entry point
├── App.jsx               # Router & Guards
├── index.css             # Tailwind CSS
├── api/
│   └── index.js          # Alle API-Calls (Axios)
├── context/
│   └── AuthContext.jsx   # Auth State Management
├── components/
│   ├── Layout.jsx        # Navbar + Main Layout
│   ├── LoadingSpinner.jsx
│   └── ErrorMessage.jsx
└── pages/
    ├── auth/
    │   ├── LoginPage.jsx
    │   ├── RegisterPage.jsx
    │   └── ForgotPasswordPage.jsx
    ├── library/
    │   ├── LibraryPage.jsx
    │   ├── ListShowPage.jsx
    │   ├── ListCreatePage.jsx
    │   ├── ListUpdatePage.jsx
    │   └── CopyListPage.jsx
    ├── texts/
    │   ├── TextsPage.jsx
    │   ├── TextShowPage.jsx
    │   ├── AddTextPage.jsx
    │   ├── UpdateTextPage.jsx
    │   └── GenerateTextPage.jsx
    ├── profile/
    │   ├── ProfilePage.jsx
    │   └── InitiateProfilePage.jsx
    ├── patchnotes/
    │   ├── PatchListPage.jsx
    │   └── PatchShowPage.jsx
    ├── HomePage.jsx
    ├── DashboardPage.jsx
    ├── SwipeLearnPage.jsx
    ├── StripePage.jsx
    ├── AboutMePage.jsx
    └── AboutProjectPage.jsx
```
