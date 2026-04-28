# LinguaTech Frontend (React SPA)

This is the **React Single Page Application** for LinguaTech.
It communicates with the Laravel backend via a JSON API.

## Architecture

```
┌─────────────────┐      HTTP/JSON API      ┌──────────────────┐
│  React Frontend │  <────────────────────>  │  Laravel Backend │
│  (this folder)  │   Bearer Token (Sanctum) │  (../)           │
└─────────────────┘                          └──────────────────┘
```

## Quick Start

### 1. Install dependencies
```bash
cd frontend
npm install
```

### 2. Configure API URL
Create `.env`:
```
VITE_API_URL=http://localhost:8000/api
```

### 3. Start dev server
```bash
npm run dev
```
Opens at `http://localhost:3000`

### 4. Build for production
```bash
npm run build
```

## Project Structure

```
frontend/
├── src/
│   ├── api.js           # Axios instance with Bearer token interceptor
│   ├── App.jsx          # Router + Navigation
│   ├── main.jsx         # React entry point
│   └── components/
│       ├── Login.jsx       # Auth: Login form
│       ├── Register.jsx    # Auth: Registration form
│       ├── Library.jsx     # List overview
│       ├── ListDetail.jsx  # Single list with SRS stats
│       ├── SwipeLearn.jsx  # Card-based SRS learning
│       └── Profile.jsx     # User profile
├── index.html
├── package.json
└── vite.config.js
```

## API Endpoints Used

| Endpoint | Method | Description |
|----------|--------|-------------|
| `/api/register` | POST | Create account |
| `/api/login` | POST | Get Bearer token |
| `/api/logout` | POST | Revoke token |
| `/api/user` | GET | Current user |
| `/api/lists` | GET | All lists |
| `/api/lists/own` | GET | My lists |
| `/api/lists/{id}` | GET | List detail + SRS |
| `/api/lists/{id}/due-words` | GET | Due words for session |
| `/api/swipe` | POST | Process swipe (SM-2) |
| `/api/swipe/undo` | POST | Undo last swipe |
| `/api/words/{id}/priority` | POST | Set word priority |
| `/api/texts` | GET | All texts |
| `/api/texts/generate` | POST | AI text generation |
| `/api/translate` | POST | DeepL translation |
| `/api/profile` | GET/PUT | Profile data |

## Mobile / Capacitor

To wrap this as a native app:

```bash
# In project root
npm install @capacitor/core @capacitor/cli @capacitor/ios @capacitor/android

# Build the SPA
npm run build

# Copy build to Capacitor
npx cap add ios
npx cap add android
npx cap copy

# Open in Xcode / Android Studio
npx cap open ios
npx cap open android
```

## Key Features

- **JWT-style auth** via Laravel Sanctum Bearer tokens
- **SRS visible** on every card (interval, EF, repetitions)
- **Priority selector** ⭐-⭐⭐⭐⭐⭐ per word
- **Multi-undo** with server rollback (session snapshots)
- **Swipe learning** with card flip animation
