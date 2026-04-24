# LinguaTech React-Portierung – Status & Nächste Schritte

> Stand: Alle Blade-Views & SCSS-Styles wurden in `frontend/` als React-App portiert.
> Du kannst die Session schließen und später nahtlos weitermachen.

---

## ✅ Bereits erledigt

### 1. React-Scaffold
- `frontend/package.json` mit React 18, Vite, React Router, Sass, Axios
- `frontend/vite.config.js` (mit SCSS-Preprocessor, `additionalData` für globale Variablen)
- `frontend/index.html`
- `frontend/src/main.jsx` – Entry Point mit `BrowserRouter`
- `frontend/src/App.jsx` – alle Routen gemappt (32 Routes)

### 2. Globale Infrastruktur
- `src/contexts/AuthContext.jsx` – `useAuth()` Hook, Login/Logout
- `src/hooks/useTranslation.js` – `__(key)` Platzhalter für i18n
- `src/components/Navbar.jsx` – LinguaTech-Navbar mit Language-Dropdown, Mobile-Menü, Auth-Conditional Links
- `src/components/MainLayout.jsx` – Wrapper mit Navbar + Guest-Login/Register-Buttons

### 3. Styles (SCSS bleibt erhalten!)
**Ja, SCSS kann 100% beibehalten werden.** Vite kompiliert SCSS nativ (Paket `sass` ist schon in der `package.json`).
Es wurden folgende Dateien übernommen:
- `src/styles/colorsNvariables.scss`
- `src/styles/main.scss`
- `src/styles/library.scss`
- `src/styles/application.scss`
- `src/styles/animations.scss`
- `src/styles/playground.scss`
- `src/styles/textStyle.scss`

### 4. Seiten portiert (32 Stück)
| Bereich | Dateien |
|---------|---------|
| Library/Decks | `Home`, `Library`, `ListShow`, `ListCreate`, `ListUpdate`, `CopyList` |
| Lernen | `SwipeLearn`, `SwipePlay` |
| Texte | `DisplayAllTexts`, `TextShow`, `NewText`, `UpdateText`, `GenerateText`, `TextPlay` |
| Auth | `Login`, `Register`, `ForgotPassword`, `ResetPassword` |
| Profil | `Profile`, `InitiateProfile`, `Dashboard` |
| Statisch | `Welcome`, `AboutMe`, `AboutProject`, `Playground` |
| Payment | `Stripe`, `SuccessPayment`, `CancelPayment`, `PaymentFailed` |
| Sonstiges | `PatchList`, `PatchShow`, `Spielwiese` |

---

## ⏳ Nächste Schritte (Checkliste)

### A. Erstmal React-App starten
```bash
cd frontend
npm install
npm run dev
```
- Öffne dann die angezeigte URL (meist `http://localhost:5173`)
- Teste ob die Navbar lädt und die Routen funktionieren

### B. Assets in `frontend/public/` kopieren
Die React-App referenziert Bilder/Icons über absolute Pfade wie `/svg-icons/learnIcon.svg`.
Du musst diese aus dem Laravel-Projekt in `frontend/public/` kopieren:
```bash
# Beispiele – anpassen je nachdem was du brauchst
cp -r svg-icons/ frontend/public/svg-icons/
cp -r Images/ frontend/public/Images/
cp profilbild.jpg frontend/public/
cp favicon.ico frontend/public/
```

### C. SCSS / Styling testen
- Die SCSS-Dateien sind bereits importiert (z.B. `import '../styles/library.scss'` in den Pages)
- Falls das globale `@import "colorsNvariables.scss";` in Vite nicht klappt,
  prüfe die `additionalData`-Zeile in `vite.config.js`
- Bei Fehlern: prüfe ob `sass` installiert ist (`npm list sass`)

### D. Mock-Daten → echte API (Laravel-Backend anbinden)
Jede Page enthält momentan **Mock-Daten**. Du musst:
1. CORS im Laravel-Backend aktivieren (`config/cors.php`)
2. API-Routes definieren oder bestehende Web-Routes als JSON ausgeben
3. In den React-Components `axios.get('/api/library')` etc. einbauen
4. `BASE_URL` in einem Axios-Interceptor setzen (z.B. `http://localhost:8000`)

### E. i18n (Übersetzungen)
Momentan gibt es nur den `__(key)`-Platzhalter. Für echte Übersetzungen:
- Option A: `react-i18next` installieren und `__()`-Aufrufe ersetzen
- Option B: Eigene JSON-Dateien für `de` und `en` anlegen und den `__()`-Helper befüllen

### F. Auth richtig verkabeln
- `Login.jsx` und `Register.jsx` machen aktuell nur einen Mock-Login
- Ersetze durch echte POST-Requests an `/login` bzw. `/register`
- Speicher Token (z.B. JWT oder Laravel-Sanctum Token) im `AuthContext`

---

## 🚀 Laravel-Backend starten (dein bestehendes Projekt)

Um das Laravel-Projekt parallel laufen zu lassen (damit die React-App später dagegen fetcht):

```bash
# Im ROOT-Verzeichnis des Projekts (nicht frontend/)
composer install          # Falls vendor/ fehlt
cp .env.example .env    # Falls .env noch nicht existiert
php artisan key:generate
php artisan serve         # Startet Laravel auf http://localhost:8000
```

Für die Assets (CSS/JS im alten Laravel-Setup):
```bash
# Im ROOT-Verzeichnis (zweites Terminal)
npm install
npm run dev
```

Falls du die Datenbank brauchst:
```bash
php artisan migrate
php artisan db:seed
```

**Tipp:** Starte beides:
- Terminal 1 (Root): `php artisan serve` → Backend/API
- Terminal 2 (Root): `npm run dev` → Laravel Vite (für die alte App, falls noch nötig)
- Terminal 3 (`frontend/`): `npm run dev` → Neue React-App

---

## 🔧 Schnelle Troubleshooting-Notizen

| Problem | Lösung |
|---------|--------|
| `Cannot find module 'react'` | `cd frontend && npm install` |
| SCSS wird nicht kompiliert | Prüfe ob `sass` installiert ist (`npm i -D sass`) |
| Bilder/Icons fehlen | In `frontend/public/` kopieren, nicht `src/` |
| Route zeigt 404 | React Router im `BrowserRouter` prüfen; ggf. `vite.config.js` `base` setzen |
| CORS-Fehler beim API-Call | Laravel: `php artisan config:publish cors` & Origins auf `http://localhost:5173` setzen |
