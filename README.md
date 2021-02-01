Pierre Hansen, Projet 5 OpenClassroom, "Créez votre premier blog en PHP"

Instructions d'installation:


Etape 1 - Créez votre dossier.

Sur MAMP, rendez vous dans l'emplacement du fichier, puis 'htdocs' et créez le dossier dans lequel vous souhaitez cloner le projet.


Etape 2- Clonez le projet.

Pour se faire rendez vous sur l'onglet "<> Code" sur la page du projet GitHub et cliquez sur le bouton vert "Code". Copiez ensuite le lien HTTPS.
Rendez vous ensuite dans le dossier créé plus tôt avec GitBash - si ce n'est pas déjà fait initialisez Git dans ce dossier en executant 'git init' sur GitBash-
Puis clonez le projet avec la commande 'git clone [URL]'.


Etape 3- Intégrez la base de donnée.

Rendez vous sur phpMyAdmin puis 'New', saisissez 'databasep5' comme nom puis 'utf8_general_ci' puis Create.
Depuis la nouvelle base créée, cliquez sur l'onglet 'Import' puis selectionnez le fichier 'databasep5.sql' qui se trouve dans le dossier Model. Cliquez ensuite sur 'Go'
ATTENTION: Il est possible que la base de donnée ne se connecte pas, si vous n'êtes pas chez free, configurez le fichier 'Db.php' dans le dossier 'Core' et modifiez la constante DBPASS par "private const DBPASS = '';".


Etape 4- Configurez le serveur (?)