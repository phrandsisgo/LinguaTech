<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class texts_seeder extends Seeder
{
    public function run()
    {
        DB::table('texts')->insert([
            [
                'created_by' => 1,
                'lang_option_id' => 2,
                'title' => 'Meine Hobbys',
                'text' => 'Hallo! Ich bin Lisa. Ich komme aus Berlin. In meiner Freizeit habe ich verschiedene Hobbys. Eines meiner Hobbys ist das Lesen von Büchern. Ich lese gern Geschichten und Abenteuerbücher. Ein weiteres Hobby von mir ist das Kochen. Ich koche oft mit meiner Familie und probiere neue Rezepte aus. Außerdem mag ich es, im Park spazieren zu gehen und die Natur zu genießen. Das ist entspannend. Ich spiele auch Musik auf meiner Gitarre. Es macht mir Spaß, Lieder zu spielen und zu singen. Meine Hobbys machen mich glücklich und ich freue mich immer darauf, sie auszuüben.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 3,
                'title' => 'Mein Tagesablauf',
                'text' => 'Mein Tagesablauf beginnt früh am Morgen. Ich stehe um 6 Uhr auf und mache mich fertig. Dann frühstücke ich mit meiner Familie. Danach gehe ich zur Arbeit oder zur Schule.
            
                Die Arbeit oder die Schule dauert bis zum Nachmittag. In der Pause esse ich mein Mittagessen. Am Nachmittag habe ich verschiedene Aktivitäten. Manchmal treffe ich Freunde, gehe spazieren oder mache Sport. 
            
                Abends komme ich nach Hause und esse zu Abend. Danach entspanne ich mich und sehe fern oder lese ein Buch. Vor dem Schlafengehen gehe ich noch einmal nach draußen mit meinem Hund.
            
                Mein Tagesablauf ist ziemlich hektisch, aber ich mag es, beschäftigt zu sein. Ich versuche auch, genug Zeit für Entspannung und Freizeit zu finden.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1, // die UserId bleibt 1
                'lang_option_id' => 4, // Festgelegte Sprachoption ID
                'title' => 'Das Wetter', // Direkt eingefügter Titel
                'text' => 'Das Wetter hat einen großen Einfluss auf unseren Alltag. In Deutschland erleben wir vier Jahreszeiten: Frühling, Sommer, Herbst und Winter.
            
            Im Frühling wird es langsam wärmer, die Bäume bekommen grüne Blätter und die Blumen blühen. Die Leute genießen es, draußen spazieren zu gehen.
            
            Im Sommer ist es oft sehr heiß. Viele Menschen fahren in den Urlaub ans Meer, um sich abzukühlen. Wir tragen leichte Kleidung und essen Eis.
            
            Im Herbst fallen die Blätter von den Bäumen, und es wird kühler. Die Tage werden kürzer, und wir machen uns auf den Weg, um bunte Blätter zu sammeln.
            
            Im Winter kann es sehr kalt werden, und es schneit oft. Kinder bauen Schneemänner und fahren Schlitten. Wir trinken heiße Schokolade, um uns aufzuwärmen.
            
            Das Wetter kann manchmal unberechenbar sein. Wir schauen uns die Wettervorhersage im Fernsehen an, um zu wissen, wie das Wetter wird. Das hilft uns, uns darauf vorzubereiten.
            
            Das Wetter beeinflusst unsere Stimmung und Aktivitäten. Wenn die Sonne scheint, sind die Menschen glücklicher und aktiver. Aber an regnerischen Tagen bleiben wir oft drinnen und lesen Bücher oder schauen Filme.', // Direkt eingefügter Text
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 5,
                'title' => 'Arbeitsalltag',
                'text' => 'Mein Arbeitsalltag ist sehr abwechslungsreich. Als Marketingmanager bei XYZ GmbH beginnt mein Tag normalerweise um 8 Uhr morgens. Zuerst überprüfe ich meine E-Mails und beantworte dringende Nachrichten. Dann haben wir oft Team-Meetings, bei denen wir unsere laufenden Projekte besprechen und neue Ideen entwickeln.
            
                Ein großer Teil meiner Arbeit besteht darin, Marketingkampagnen zu planen und zu koordinieren. Ich arbeite eng mit meinem Team zusammen, um sicherzustellen, dass alle Aufgaben rechtzeitig erledigt werden. Wir analysieren auch regelmäßig die Ergebnisse unserer Kampagnen, um herauszufinden, was funktioniert und was verbessert werden kann.
            
                In meiner Mittagspause gehe ich gerne in das nahegelegene Café, um frische Luft zu schnappen und mich zu entspannen. Nachmittags setze ich meine Arbeit fort, oft mit Telefonkonferenzen oder Besprechungen mit Kunden.
            
                Mein Arbeitstag endet normalerweise um 18 Uhr. Nach der Arbeit treffe ich mich oft mit Freunden oder gehe ins Fitnessstudio, um mich fit zu halten. Insgesamt liebe ich meinen Arbeitsalltag, weil er spannend und herausfordernd ist.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 6,
                'title' => 'Reisen und Tourismus',
                'text' => 'Reisen ist meine große Leidenschaft! Ich habe schon viele Länder bereist und faszinierende Orte entdeckt. Eines meiner unvergesslichen Abenteuer war eine Reise nach Neuseeland, wo ich atemberaubende Landschaften und freundliche Menschen erleben durfte.
                
                In meiner Freizeit plane ich gerne meine nächsten Reisen. Ich recherchiere über verschiedene Reiseziele, erkunde lokale Kulturen und probiere gerne die landestypische Küche. Reisen ermöglicht es mir, meinen Horizont zu erweitern und neue Perspektiven zu gewinnen.
                
                Ich glaube, dass Reisen eine einzigartige Möglichkeit bietet, die Vielfalt unserer Welt zu schätzen und Verbindungen zu knüpfen. Es öffnet Türen zu neuen Erfahrungen und Erinnerungen, die ein Leben lang halten.
                
                Wenn du auch ein Reisefan bist oder Fragen zu bestimmten Reisezielen hast, lass es mich wissen! Ich teile gerne meine Reiseerlebnisse und Tipps mit dir.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 7,
                'title' => 'Mein Lieblingsessen',
                'text' => 'Mein absolut liebstes Essen ist Sushi. Ich kann nie genug davon bekommen! Die Kombination aus frischem Fisch, Reis und Algen ist für mich einfach unschlagbar. Ich probiere gerne verschiedene Sorten, von Nigiri bis Maki. Wenn ich Sushi esse, fühle ich mich glücklich und zufrieden. Es ist für mich nicht nur eine Mahlzeit, sondern auch ein kulinarisches Erlebnis. Ich versuche sogar, es selbst zuzubereiten, obwohl es nie genauso gut schmeckt wie im Restaurant. Egal wo ich bin, wenn es Sushi gibt, bin ich dabei!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1, // die UserId bleibt 1
                'lang_option_id' => 16, // Französisch (A1)
                'title' => 'Ma journée', // Titel für den Tagesablauf
                'text' => 'Bonjour ! Je m\'appelle Max. Je vis à Munich et je travaille en tant qu\'enseignant. Ma journée commence tôt. Je me lève à 6 heures du matin. Ensuite, je prends un bon petit déjeuner avec du café et des croissants. Après cela, je vais au travail. Je suis à l\'école de 8 heures du matin à 3 heures de l\'après-midi. J\'aime enseigner aux élèves. 
            
                Après l\'école, je rentre chez moi. Je prépare le dîner et je regarde la télévision. J\'adore les émissions de cuisine. Puis, je lis des livres. J\'aime beaucoup la science-fiction. 
            
                Vers 22 heures, je vais me coucher. C\'est ma journée typique. Bonne nuit !', // Text für den Tagesablauf
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 17,
                'title' => 'Mon plat préféré',
                'text' => 'Bonjour ! Mon plat préféré est la pizza. J\'adore la pizza car elle est délicieuse. Ma pizza préférée est celle avec du fromage, des champignons et du pepperoni. Je la mange souvent avec mes amis lors de nos sorties. La pizza est tellement savoureuse !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 18,
                'title' => 'La Météo',
                'text' => "Bonjour ! Je m'appelle Sophie. J'habite à Paris. Le temps ici est souvent changeant. En hiver, il fait froid et il peut neiger. Au printemps, les fleurs commencent à pousser. En été, il fait chaud et ensoleillé. J'aime beaucoup les journées ensoleillées, car je peux aller à la plage. En automne, les feuilles des arbres deviennent jaunes et oranges. Parfois, il pleut beaucoup. Je regarde toujours la météo à la télévision pour savoir comment sera la journée. Et toi, quel temps fait-il dans ta ville ?",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 19,
                'title' => 'Mes passe-temps', // Titel auf Französisch: Meine Hobbys
                'text' => 'Bonjour! Je m\'appelle Max. J\'habite à Munich et je travaille comme enseignant. Pendant mon temps libre, j\'aime lire des livres, faire du vélo et cuisiner. Le vélo me permet de rester en forme, la lecture me détend et cuisiner me permet de découvrir de nouvelles saveurs du monde entier. Partagez-moi vos passe-temps préférés !', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 20,
                'title' => "La vie professionnelle",
                'text' => "Bonjour ! Je m'appelle Sophie et je travaille en tant qu'architecte à Paris. Mon travail est très intéressant. Je dessine des plans pour les bâtiments et je collabore avec une équipe formidable. Nous avons beaucoup de réunions pour discuter de nos projets.
            
                Mon quotidien professionnel est bien rempli. Le matin, je vérifie mes e-mails et je réponds aux messages de mes collègues. Ensuite, je commence à travailler sur mes dessins et je les améliore. L'après-midi, je participe à des réunions avec nos clients et je leur présente nos idées. 
            
                En dehors du travail, j'aime lire des livres sur l'architecture et visiter des musées. C'est important de rester inspiré et créatif dans ce domaine. Je suis passionnée par mon travail et je suis reconnaissante d'avoir la chance de faire ce que j'aime tous les jours.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 21,
                'title' => "Voyages et Tourisme",
                'text' => "Bonjour ! Je suis passionné par les voyages. J'ai eu la chance de visiter de nombreux endroits incroyables dans le monde. Lors de mes voyages, j'aime découvrir de nouvelles cultures, goûter des plats locaux et rencontrer des gens du monde entier. L'un de mes voyages les plus mémorables était en Asie, où j'ai exploré des temples anciens et goûté des plats épicés. Voyager m'a ouvert l'esprit et m'a permis de voir la beauté de notre planète. Si vous avez des questions sur les voyages ou si vous avez besoin de recommandations, n'hésitez pas à me demander !",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 23,
                'title' => "Моя любимая еда", // Titel auf Russisch
                'text' => "Привет! Меня зовут Макс. Я живу в Мюнхене и работаю учителем. В свободное время я люблю есть пиццу и пить газированную воду. Пицца - это моя самая любимая еда. Она очень вкусная и сытная. Я также люблю картофель фри. Это мой завтрак по выходным. Я предпочитаю быструю еду, потому что она вкусная и удобная. Что касается напитков, то газированная вода - мой фаворит. Она освежает в жаркую погоду. А какую еду вы предпочитаете?",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 24,
                'title' => "Мой распорядок дня", // Titel auf Russisch
                'text' => "Добрый день! Меня зовут Макс. Я живу в Мюнхене и работаю учителем. В моем свободном времени я люблю читать книги и гулять в парке.", 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 25,
                'title' => "Погода", 
                'text' => "Привет! Сегодня хорошая погода. На улице солнечно и тепло. Я люблю, когда светит солнце, потому что можно гулять в парке и наслаждаться природой. Иногда идет дождь, и это тоже интересно. Я смотрю на капли дождя и слушаю звуки. Погода меняется, но всегда интересно наблюдать за ней.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1, // die UserId bleibt 1
                'lang_option_id' => 26, // Festgelegte Sprachoption ID für Russisch
                'title' => "Мой рабочий день", // Direkt eingefügter Titel auf Russisch
                'text' => "Привет! Меня зовут Макс. Я живу в Мюнхене и работаю учителем. Моя рабочая неделя обычно очень занята. Я провожу уроки с понедельника по пятницу в школе. Мои ученики разные возрасты и уровни знаний. Моя работа включает объяснение материала, помощь ученикам и проверку домашних заданий.\n\n
                Когда рабочий день заканчивается, у меня есть свободное время. В свободное время я часто читаю книги. Чтение помогает мне расслабиться и погрузиться в другой мир. Таким образом, моя жизнь сбалансирована между работой и увлечением.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 27,
                'title' => "Мои увлечения и интересы",
                'text' => "Привет! Меня зовут Макс. Я живу в Мюнхене и работаю учителем. В свободное время я увлекаюсь многими интересными вещами. Одним из моих главных увлечений является чтение книг. Я обожаю погружаться в миры литературы и узнавать новое каждый раз. Также я увлекаюсь музыкой и играю на гитаре. Это замечательный способ выразить свои чувства и эмоции. Когда погода хорошая, я часто хожу на прогулки в парке и фотографирую красивые моменты. Это увлечение помогает мне расслабиться и насладиться природой. Я также учусь новым языкам, и это дает мне возможность общаться с людьми со всего мира. Увлечения и интересы делают мою жизнь более насыщенной и увлекательной.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 28,
                'title' => "Путешествия и туризм", // Titel auf Russisch
                'text' => "Путешествия - это моя страсть! Я обожаю исследовать новые места и погружаться в разные культуры. Когда я путешествую, я всегда стараюсь попробовать местную кухню и посетить известные достопримечательности. 
            
            Я посетил множество удивительных мест, таких как Париж, Рим и Токио. Но моя самая запоминающаяся поездка была в Мачу-Пикчу в Перу. Это место полное истории и загадок.
            
            Мне нравится делиться своими путешествиями с другими и вдохновлять их на новые приключения. Я верю, что путешествия могут расширить наши горизонты и научить нас новым вещам. Если у вас есть вопросы о путешествиях или вы хотите узнать больше, не стесняйтесь спрашивать!",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 9,
                'title' => "My Daily Routine",
                'text' => "Hello! I'm Max. I live in Munich, Germany. I work as a teacher. In the morning, I wake up and have breakfast. Then, I go to work. I teach students and help them learn new things. After work, I come home and relax. I enjoy watching TV and cooking dinner. In the evening, I like to read books before going to bed. That's a typical day in my life.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 10,
                'title' => "Travel and Tourism",
                'text' => "Hello! My name is Max. I live in Munich, Germany. I work as a teacher, and I love to explore new places during my holidays. Traveling is an exciting adventure, and I enjoy discovering different cultures and trying new foods. One of my favorite destinations so far has been Paris. The Eiffel Tower was amazing! I hope to visit more beautiful places in the future.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 11,
                'title' => "My Work Routine",
                'text' => "Hello! My name is Max. I live in Munich and work as a teacher. My work routine is quite busy. I start my day early in the morning, and my first class begins at 8 AM. I teach English to high school students. 
            
                During my classes, I try to make learning fun and engaging. We work on grammar, vocabulary, and conversation skills. My students are wonderful, and I enjoy helping them improve their English.
            
                I have a short break at noon, and I usually eat lunch in the school cafeteria with my colleagues. We chat about our day and sometimes exchange teaching tips. After lunch, I have more classes until 4 PM.
            
                In the evenings, I like to relax by reading books. Reading helps me unwind and improve my knowledge. It's a great way to end a busy day.
            
                Overall, my work as a teacher can be challenging, but it's also very rewarding. I love helping my students learn and grow. It's a fulfilling job that keeps me motivated.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 12,
                'title' => "My Hobbies and Interests",
                'text' => "Hello! I'm John. I live in London, and I work as a software developer. In my free time, I have a variety of hobbies and interests that keep me busy and engaged. One of my biggest passions is playing the guitar. I've been playing for over five years, and I love strumming my favorite songs and even writing my own music.
            
                Another hobby I enjoy is hiking. I often escape the city on weekends to explore the beautiful countryside. There's something incredibly refreshing about being in nature, surrounded by trees and fresh air.
            
                I'm also an avid reader. I have a diverse taste in books, from classic literature to science fiction. Reading allows me to escape into different worlds and expand my knowledge.
            
                Additionally, I have a keen interest in photography. Capturing moments and scenes through my camera lens is a way for me to document my life's adventures.
            
                These are just a few of my hobbies and interests that make my life fulfilling. I believe that having diverse interests enriches our experiences and helps us grow as individuals.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 13,
                'title' => "Weather Forecast",
                'text' => "Greetings! I'm John. I live in London, and I'm passionate about weather forecasting. I have been studying weather patterns and climate for years. In my free time, I enjoy tracking weather systems, analyzing data, and making predictions. Understanding the weather is not only fascinating but also important for planning our daily activities and being prepared for any changes. It's amazing how nature influences our lives through the weather. I'm always eager to learn more and share my knowledge with others.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 14,
                'title' => "My Favorite Food",
                'text' => "Hello there! Let me tell you about my favorite food. It's sushi. I absolutely adore sushi because of its exquisite taste and variety. Whether it's the delicate flavors of sashimi, the perfect balance of rice and ingredients in a sushi roll, or the refreshing taste of miso soup, I can't get enough of it. Whenever I have sushi, it's like a culinary adventure. I enjoy trying different types of sushi, from classic salmon and tuna to more adventurous options like eel or sea urchin. Sushi is not just a meal; it's an experience that I savor every time. What's your favorite food?",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 30,
                'title' => "Minha Rotina Diária",
                'text' => "Bom dia! Meu nome é Carlos. Eu moro em São Paulo e trabalho como motorista de ônibus. Minha rotina diária começa cedo. Eu acordo às 5 da manhã e tomo café da manhã. Depois, eu saio para o trabalho por volta das 6 horas. Dirijo o ônibus pela cidade durante o dia.
                Às 12 horas, faço uma pausa para o almoço. Geralmente, eu como sanduíches ou comida rápida. À tarde, continuo dirigindo o ônibus até as 18 horas. Quando meu turno termina, volto para casa. 

                À noite, gosto de relaxar assistindo televisão. Eu também gosto de ler livros. Normalmente, vou para a cama por volta das 10 horas para descansar para o próximo dia de trabalho.

                Essa é a minha rotina diária. É um trabalho cansativo, mas eu gosto do que faço.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 31,
                'title' => "Meu Dia de Trabalho",
                'text' => "Bom dia! Meu nome é Carlos. Eu moro em São Paulo e trabalho como contador. No meu dia de trabalho, eu costumo verificar registros financeiros, fazer cálculos e preparar relatórios. Trabalho em um escritório tranquilo com colegas simpáticos. Às vezes, temos reuniões para discutir nossos projetos. Durante o intervalo para o almoço, gosto de ir a um restaurante próximo com meus colegas. À tarde, continuo meu trabalho e geralmente termino por volta das 18 horas. Após o trabalho, eu gosto de relaxar em casa, assistir televisão e passear com meu cachorro. É um dia típico de trabalho para mim.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 32,
                'title' => "Minhas Aventuras de Viagem",
                'text' => "Olá! Meu nome é André e sou um apaixonado por viagens. Adoro explorar novos lugares e conhecer diferentes culturas. Uma das minhas aventuras favoritas foi quando visitei o Brasil.
            
                O Brasil é um país incrível, cheio de diversidade. Passei algum tempo no Rio de Janeiro e fiquei maravilhado com suas praias deslumbrantes e festas animadas. Também explorei a Amazônia e me encantei com a selva tropical e sua vida selvagem única.
            
                Além do Brasil, já tive a oportunidade de viajar para outros países da América do Sul, como Argentina, Peru e Chile. Cada lugar tinha algo especial para oferecer, desde as montanhas dos Andes até as ruínas antigas de Machu Picchu.
            
                Viajar me ensinou a apreciar as pequenas coisas da vida e a ser mais aberto a diferentes perspectivas. Também adoro experimentar a culinária local em cada destino, e já provei pratos deliciosos como ceviche peruano e churrasco brasileiro.
            
                Se você também gosta de viajar, compartilhe suas aventuras comigo! Adoro ouvir histórias de viagem e obter dicas sobre novos destinos emocionantes.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'created_by' => 1,
                'lang_option_id' => 33,
                'title' => "Minha Comida Favorita",
                'text' => "Olá! Meu nome é Carla. Moro no Brasil e adoro comida brasileira. Minha comida favorita é feijoada. Feijoada é um prato tradicional brasileiro que consiste em feijão-preto cozido com várias carnes, como carne de porco, linguiça e bacon. É servido com arroz, couve e laranja. É uma comida muito saborosa e é frequentemente apreciada em ocasiões especiais. Eu também gosto de cozinhar em casa e experimentar novas receitas brasileiras. É uma maneira maravilhosa de conhecer a cultura e a culinária do meu país.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'created_by' => 1,    'lang_option_id' => 34,    'title' => "Meus Hobbies e Interesses",    'text' => "Olá! Meu nome é Rodrigo. Atualmente, moro em São Paulo, uma cidade incrível no Brasil. Sou apaixonado por várias atividades e hobbies.

                Uma das minhas grandes paixões é a fotografia. Sempre que tenho um tempo livre, gosto de sair com minha câmera e capturar momentos especiais. Adoro fotografar a beleza da natureza e as pessoas nas ruas da cidade. 

                Além disso, sou um grande fã de esportes. Adoro jogar futebol com meus amigos nos fins de semana. Também assisto a muitos jogos de futebol na TV e sou um torcedor fanático do meu time local.

                Outro interesse meu é a música. Toco violão desde criança e adoro tocar e aprender novas músicas. A música é uma forma incrível de expressão e relaxamento para mim.

                Além desses hobbies, tenho uma paixão por viajar. Gosto de explorar novos lugares, experimentar diferentes culturas e provar comidas deliciosas ao redor do mundo. 

                Esses são apenas alguns dos meus hobbies e interesses. Eles fazem a minha vida mais rica e emocionante. É sempre ótimo conhecer pessoas com interesses semelhantes e compartilhar experiências juntos.",    'created_at' => now(),    'updated_at' => now(),],

            [
                'created_by' => 1,
                'lang_option_id' => 35,
                'title' => "Meu Dia",
                'text' => "Olá! Meu nome é Ana. Moro em São Paulo e sou médica. No meu dia a dia, acordo cedo de manhã por volta das 6h. Depois, tomo um café da manhã saudável e me preparo para ir ao trabalho. Trabalho no hospital das 8h às 17h. Durante o meu expediente, vejo pacientes, faço exames médicos e ajudo a equipe médica. À tarde, gosto de praticar esportes, como corrida e natação. Também adoro ler livros, então passo algum tempo lendo à noite antes de dormir. Meu dia é ocupado, mas é gratificante.",
                'created_at' => now(),
                'updated_at' => now(),
            ],   
                        

        ]);
    }
}
//zum seeden folgenden Befehl verwenden: sail artisan db:seed --class=texts_seeder
