Hallo ich habe einen Fehler entdeckt wie ich gewisse Fehler oder zumindest die Muster davvon erkennen kann.

Schritt1: ich muss auf dem ".env" den APP_ENV=production einstellen ( statt local)
Und dann mit "npm run build" nachschauen was für Fehler auftreten.(auch noch siail down & up)
Und jenachdem liegt das problem daran das ein neues .css/.scss file neu ist auf dem vite.config geladen werden muss. (das selbe Problem könnte auch mit .js files auftreten.)