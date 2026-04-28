# LinguaTech Mobile

## Ehrliche Einschätzung

Deine App ist eine **Laravel + Blade** App. Das bedeutet: **Server-Side Rendering**.
PHP generiert HTML auf dem Server, der Browser zeigt es an.

Das ist das Gegenteil von einer nativen App, die offline funktioniert.

### Was ich für dich vorbereitet habe

Ich habe zwei Ansätze eingerichtet:

---

## Option A: PWA (Progressive Web App) — Sofort nutzbar

Das ist die **einfachste** Option. Benutzer können die Webseite auf dem Homescreen installieren.

### Was ist passiert:
- `public/manifest.json` — App-Metadaten (Name, Icon, Theme)
- `public/sw.js` — Service Worker (cacht statische Assets)
- PWA Meta-Tags in `resources/views/layouts/lingua_main.blade.php`

### So funktioniert es:
1. Deploy deine App wie gewohnt auf einen Server
2. Benutzer öffnen die Seite im Browser
3. Browser zeigt "Zum Startbildschirm hinzufügen" an
4. App läuft wie eine native App, braucht aber Internet

### Limitationen:
- **Braucht Internet** — PHP läuft auf dem Server
- **Kein App Store** — funktioniert nur über Browser-Installation
- **Push-Notifications** — begrenzt unterstützt

---

## Option B: Capacitor (Native App Wrapper)

Capacitor verpackt deine Web-App als echte iOS/Android App.

### Was ist passiert:
- `capacitor.config.json` — Capacitor Konfiguration
- `package.json` — Build-Scripts erweitert

### WICHTIGE EINSCHRÄNKUNG:

**Capacitor allein reicht nicht.** Deine App ist server-side. Es gibt zwei Wege:

#### Weg 1: WebView auf deployed URL (Einfacher)
Die App ist ein nativer Browser, der auf deine live-URL zeigt.

1. Deploy deine Laravel App auf einen Server (z.B. DigitalOcean, Forge)
2. In `capacitor.config.json` ersetze:
   ```json
   "server": {
     "url": "https://dein-server.ch",
     "cleartext": false
   }
   ```
3. Dann ausführen:
   ```bash
   npm install @capacitor/core @capacitor/cli @capacitor/ios @capacitor/android
   npx cap add ios
   npx cap add android
   npx cap open ios      # öffnet Xcode
   npx cap open android  # öffnet Android Studio
   ```

#### Weg 2: API + SPA (Richtiger Weg, aber mehr Arbeit)
Dein Laravel Backend wird zur reinen API. Das Frontend wird ein separates React/Vue SPA, das mit Capacitor verpackt wird.

Das bedeutet:
- Laravel: Nur noch API-Routes (`routes/api.php`)
- Frontend: React/Vue App mit API-Calls
- Auth: JWT oder Laravel Sanctum Token-basiert

Das ist der professionelle Weg, aber erfordert einen **kompletten Rewrite** des Frontends.

---

## Meine Empfehlung für dich

### Kurzfristig (heute):
Nutze die **PWA**. Die funktioniert sofort, kostet nichts, und deine Nutzer können sie auf dem Homescreen installieren.

### Mittelfristig (in 2-3 Monaten):
Wenn du wirklich native Apps im Store willst, brauchst du Weg 2:
1. Laravel Backend als API umbauen
2. Frontend als React/Vue SPA neu schreiben
3. Mit Capacitor verpacken

Das ist kein kleiner Task. Das ist ein komplettes Refactoring.

---

## Dateien die ich erstellt/geändert habe

| Datei | Was ist neu |
|-------|-------------|
| `public/manifest.json` | PWA Manifest |
| `public/sw.js` | Service Worker für Caching |
| `capacitor.config.json` | Capacitor App-Config |
| `package.json` | Mobile Build-Scripts |
| `resources/views/layouts/lingua_main.blade.php` | PWA Meta-Tags + SW Registration |

---

## Nächste Schritte

### Für PWA (sofort):
```bash
# Deploy deine App normal
# Dann im Browser auf dem Handy öffnen
# "Zum Startbildschirm hinzufügen" tippen
```

### Für Capacitor (Weg 1 - WebView):
```bash
# 1. Capacitor installieren
npm install @capacitor/core @capacitor/cli @capacitor/ios @capacitor/android

# 2. Ziel-URL in capacitor.config.json eintragen

# 3. iOS/Android hinzufügen
npx cap add ios
npx cap add android

# 4. In Xcode/Android Studio öffnen
npx cap open ios
npx cap open android

# 5. Dort bauen und auf Device deployen
```

---

**Wichtig:** Die App funktioniert im Browser weiter genau wie bisher. Die PWA/Capacitor-Änderungen sind zusätzlich, nicht stattdessen.
