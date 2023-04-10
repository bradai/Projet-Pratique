# Mini-guide d'installation et de lancement des tests pour l'application Symfony 6

## Étape 1 : Créer une application Symfony 6
---------------------------------------

1. Assurez-vous que Composer est installé sur votre système. Si ce n'est pas le cas, installez-le en suivant les instructions sur https://getcomposer.org/download/
2. Exécutez la commande suivante pour créer un nouveau projet Symfony 6 :

composer create-project symfony/website-skeleton mon_projet

3. Accédez au dossier du projet créé :

cd mon_projet

4. Lancez le serveur de développement intégré avec la commande :

symfony server:start


## Étape 2 : Configurer le domaine
--------------------------------

1. Ouvrez le fichier `/etc/hosts` en tant qu'administrateur (Linux et macOS) ou `C:\Windows\System32\drivers\etc\hosts` (Windows).
2. Ajoutez la ligne suivante :

127.0.0.1 www.testrec01.local

3. Configurez le serveur web pour utiliser le port 5458. Modifiez le fichier `.env` dans le dossier du projet et ajoutez la ligne suivante :

APP_PORT=5458

4. Redémarrez le serveur de développement avec la commande :

## Étape 5 : Créer des fixtures pour les factures
---------------------------------------------

composer require knplabs/knp-paginator-bundle

## Étape 5 : Pour exécuter les tests, lancez la commande suivante :
---------------------------------------------
./bin/phpunit