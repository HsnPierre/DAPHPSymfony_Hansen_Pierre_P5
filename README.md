**Pierre Hansen, Projet 5 OpenClassroom, "Créez votre premier blog en PHP"**
### Instructions d'installation
#### Etape 1 - **Créez votre dossier**

Rendez vous dans votre dossier 'www' ou 'htdocs' selon votre serveur puis créez le dossier dans lequel vous souhaitez cloner le fichier (vous pouvez aussi directement cloner le fichier directement dans 'www' ou 'htdocs').  

#### Etape 2- **Clonez le projet**

Pour se faire rendez vous sur l'onglet "<> Code" sur la page du projet GitHub et cliquez sur le bouton vert "Code". Copiez ensuite le lien HTTPS.  

Rendez vous ensuite dans le dossier créé plus tôt avec GitBash - si ce n'est pas déjà fait initialisez Git dans ce dossier en executant 'git init' sur GitBash-  

Puis clonez le projet avec la commande 'git clone URL'.  

#### Etape 3- **Intégrez la base de donnée**

Rendez vous sur phpMyAdmin puis 'New', saisissez le nom puis 'utf8mb4_bin' puis Create.  

Depuis la nouvelle base créée, cliquez sur l'onglet 'Import' puis selectionnez le fichier 'databasep5.sql' qui se trouve dans le dossier Model. Cliquez ensuite sur 'Go'  

Configurez ensuite les différentes information en vous rendant dans le dossier 'Core' puis 'Db.php'.  

Modifiez les champs suivants (ligne 12-15):  
"private const DBHOST = '';" Le nom de votre host  
"private const DBUSER = '';" Le nom d'utilisateur   
"private const DBPASS = '';" Le mot de passe  
"private const DBNAME = '';" Le nom de la base saisi plus haut
