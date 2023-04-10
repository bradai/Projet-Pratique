[comment]: <> (question 1)
Créer un nouveau projet Symfony
symfony new mon-projet --full

Configurer la base de données
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

[comment]: <> (question 2)
Modifier le fichier hosts
127.0.0.1 www.testrec01.local

créer un fichier de configuration "testrec01.local.conf" dans le dossier C:\wamp\bin\apache\apache2\conf\extra\


[comment]: <> (<VirtualHost *:5458>)

[comment]: <> (ServerName www.testrec01.local)

[comment]: <> (ServerAlias testrec01.local)

[comment]: <> (DocumentRoot C:\wamp\www\test-pratique /chemin du projet)

[comment]: <> (    DirectoryIndex /index.php)

[comment]: <> (    <Directory C:\wamp\www\test-pratique /chemin du projet)

[comment]: <> (        AllowOverride All)

[comment]: <> (        Order Allow,Deny)

[comment]: <> (        Allow from All)

[comment]: <> (        Require all granted)

[comment]: <> (        FallbackResource /index.php)

[comment]: <> (    </Directory>)

[comment]: <> (    ErrorLog ${APACHE_LOG_DIR}/testrec01.local_error.log)

[comment]: <> (    CustomLog ${APACHE_LOG_DIR}/testrec01.local_access.log combined)

[comment]: <> (</VirtualHost>)


sudo a2ensite testrec01.local

add in C:\wamp\bin\apache\apache2\conf\httpd.conf
Include conf/extra/testrec01.local.conf

and update in C:\wamp\bin\apache\apache2\conf\httpd.conf
Listen 5458

sudo service apache2 restart

[comment]: <> (question 3 ) 
composer require symfony/security-bundle
composer require symfony/form

Configurer la sécurité
