Hallo ich habe einen Fehler entdeckt wie ich gewisse Fehler oder zumindest die Muster davvon erkennen kann.

Schritt1: ich muss auf dem ".env" den APP_ENV=production einstellen ( statt local)
Und dann mit "npm run build" nachschauen was für Fehler auftreten.(auch noch siail down & up)
Und jenachdem liegt das problem daran das ein neues .css/.scss file neu ist auf dem vite.config geladen werden muss. (das selbe Problem könnte auch mit .js files auftreten.)
 # falls ich Probleme habe mit Wörter hinzu zu fügen für die Listen. Dann muss ich folgendes machen:
  - ich brauche Einträge bei den Wörtern ind der Datenbank (id 1&2 da diese als foreign key genommen werden.)

# Falls ich Forge kündigen sollte:
 - Dann kann ich am besten über https://certbot.eff.org eine https certifikat beantragen mit einstellungen (ngnix & Ubuntu)
 - von nun an in der SSH zum anmelden alse forge anmelden mit dem Befehl "su - forge" dann auf den linguatech ordner gehen und zum upgraden und mittels "git pull" auf den neusten Stand bringen.

# falls ich probleme mit permission habe :


    Create the docker group if it does not exist

$ sudo groupadd docker

    Add your user to the docker group.

$ sudo usermod -aG docker $USER

    Log in to the new docker group (to avoid having to log out / log in again; but if not enough, try to reboot):

$ newgrp docker

    Check if docker can be run without root

$ docker run hello-world

Reboot if still got error

$ reboot

(https://stackoverflow.com/questions/48957195/how-to-fix-docker-got-permission-denied-issue)
