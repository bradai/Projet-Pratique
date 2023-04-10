# Mini-guide d'installation et de lancement des tests pour l'application Symfony 6

## Étape 1 : Récupérer le projet depuis Git
---------------------------------------


<pre>
git clone https://github.com/bradai/Projet-Pratique.git
</pre>

## Étape 2 : Accédez au dossier du projet cloné
---------------------------------------
<pre>
cd Projet-Pratique
</pre>

## Étape 3 : Configurer le domaine
--------------------------------

1. Ouvrez le fichier `/etc/hosts` en tant qu'administrateur (Linux et macOS) ou `C:\Windows\System32\drivers\etc\hosts` (Windows).
2. Ajoutez la ligne suivante :

127.0.0.1 www.testrec01.local

3. Configurez le serveur web pour utiliser le port 5458. Modifiez le fichier `.env` dans le dossier du projet et ajoutez la ligne suivante :

APP_PORT=5458

4. Redémarrez le serveur de développement avec la commande :

## Étape 4 : Installer les dépendances
---------------------------------------------

<pre>
composer install
</pre>


## Étape 5 : Appliquer les migrations
---------------------------------------------


<pre>
php bin/console doctrine:migrations:migrate
</pre>

## Étape 5 : Charger les fixtures
---------------------------------------------
<pre>
php bin/console doctrine:fixtures:load
</pre>

## Étape 5 : Lancer le serveur de développement
---------------------------------------------
<pre>
symfony server:start
</pre>


## Étape 5 : Exécuter les tests unitaires
---------------------------------------------

<pre>
./bin/phpunit
</pre>


##Les commande utiliser

1. question 1
<pre>
composer create-project symfony/website-skeleton test-pratique
</pre>

2. question 2
<pre>
composer require symfony/security-bundle
</pre>

3. question 3
<pre>
php bin/console make:entity
</pre>


<pre>
php bin/console make:crud
</pre>

4.question 4
<pre>
composer require dompdf/dompdf
</pre>

5 question 5
<pre>
php bin/console make:fixtures
</pre>



