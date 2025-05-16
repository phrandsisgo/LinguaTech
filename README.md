# Projektname: LinguaTech

## Beschreibung
LinguaTech ist eine Web-App zum Erlernen von Sprachen, die als Portfolioprojekt für meinen Quereinstieg in die Webentwicklung entstanden ist. Die App nutzt diverse Technologien, um Nutzern das Erlernen von neuem Vokabular in fremdsprachen durch den Einsatz Swipebaren Karten und einfache Texte zu erleichtern.
Bei Fragen zögern sie nicht mich zu kontaktieren.

## Meine Motivation für dieses Projekt:
Eines meiner on&off Hobbies ist es Sprachen zu lernen. Desswegen habe ich schon einige Sprachapps ausprobiert jedoch noch keine gefunden die wirklich zu mir passt.
Dazu habe ich im Sommer 2023 habe ich ein [Bootcamp](https://www.stadt-zuerich.ch/sd/de/index/unterstuetzung/ai/arbeitsintegrationsozialhilfe/opportunity.html) für Webentwicklung besucht und habe dort einige Programmiertechnologien ([laravel](https://laravel.com/), HTML, JavaScript & [SASS](https://sass-lang.com/)) gelernt die ich verwenden wollte.
Als Abschlussprojekt wollte ich dann meine eigene Sprachapp entwickeln mit funktionalitäten die für mich bisher funktioniert haben. Dazu gehört eine digitale Version von Karteikarten die man beidseitig beschreiben kann mit dem Fremdwort und die Übersetzung.

## Features
- Vocabulary learning with swipeable flashcards
- Text-based learning materials
- DeepL translation integration
- Openai text generation from current vocab
- Custom word lists and libraries
- Progress tracking
- Keyboard and touch support
- Multi-language support

## Live-Demo
Zur Zeit befindet sich die App noch in einem MVP stadium. Falls Sie die App ausprobieren wollen, dann probieren sie  [Linguatech](http://linguatech.ch) aus.

## Requirements
- PHP 8.1 or higher
- Composer
- Docker & Docker Compose (for using Laravel Sail)
- Node.js & NPM
- DeepL API key

## Installation
1. Clone the repository
```bash
git clone https://github.com/yourusername/LinguaTech.git
cd LinguaTech
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```
- Add your DeepL API key to .env
- Configure database settings

4. Start the application
```bash
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
npm run dev
```

The application should now be running at `http://localhost`

## Quickinstall 
 - Sie brauchen zuerst Composer (den packet manager für php)
 - Dann können Sie dieses Projekt clonen.
 - Um alle dependencies zu installieren eignet sich dann am besten der 
 ```
 composer install
 ```
 befehl. 

 Zuerst müssen Sie eine .env datei einrichten. Als Beispiel können Sie gerne das .env.example verwenden und gegebnfalls zu Ihrer präferenzen einrichten.
 Dezu müssen Sie noch einen API Schlüssel hinzufügen sodass sie alle Funktionen ausprobieren können.


 Danach können sie das Projekt starten mit dem sie den Befehl
 ```
 ./vendor/bin/sail up 
 ``` 
 das Projekt lokal starten und ausprobieren.

 Nach dem der Server läuft, kann man mit
 ```
 ./vendor/bin/sail up 
 ``` 
 das NPM und somit die CSS files laden um jetzt damit arbeiten zu können.

## TechStack
- Backend: PHP mit Laravel
- Frontend:SCSS, HTML, JavaScript,  Bootstrap
- Weitere: DeepL API, Figma für das Design

## Über den Entwickler
Mein Name ist [Francisco Wohlgemuth](http://linguatech.ch/about_me). Ich lebe in Zürich und bin 29 Jahre alt.
Ich habe schon ein wenig vorherige Erfahrung mit Flutter-Dart (siehe mein HouseHold projekt auf github) und auch schon Erfahrungen mit Python-Flask (Projekt nicht öffentlich).

## Deklarierung eines Fehlers in der Entwicklung.
Leider ist mir beim Erstellen der Datenbank ein Fehler unterlaufen. Der es geübten hackers mittels eines CURL command erlaubt gewisse Sachen aus der Datenbank zu löschen.
Es ist mir Bewusst und ich werde in naher Zukunft daran arbeiten.
Der Fehler betrifft das erstellen einer Middleware, Jedoch um den Fehler nachhalting zu korrigieren(sodass er in der zukunft auch nicht mehr vorkommt), müsste ich meine Datenbankstruktur überarbeiten was mir zur Zeit ein wenig zu viel Arbeit ist.

## Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## License
[Add your chosen license here]

## Contact
[Your contact information or preferred method of contact]
