# Message du debut 
Bienvenue !  
Quelques fonctionnalitées ne sont pas présentes :  
- Dataseed/factories
- Commandes & Historique de commande
- Création d'un(e) nouveau(elle) Origine, Type & Type de nourriture dans le back office
- Gestion des e-mails  

L'utilisateur "nozashop" possède un accès à la base de donnée mais pas les autres, il a également pas toutes les permissions.
# Démarrage du serveur 
Pour ce projet nous utilisons certains dépendances qui doivent être installés :
- [Node.JS](https://nodejs.org/en/)
- [PHP](https://www.php.net/manual/fr/install.php)
- [Composer](https://getcomposer.org)
- [XAMPP](https://www.apachefriends.org/fr/index.html)

Une fois les dépendances et le projet téléchargé vous devrez installer les dépendances du projet via les commandes  
```
composer i
npm i
```
Une fois ceci fait il faut faire la base de donnée via la commande :
```
php artisan migrate
```
Une fois le traitement terminé il faut executer le serveur via la commande 
```
php artisan serv
```
Voilà votre site est donc accessible via l'URL http://localhost:8000/
# Les pages
Toutes les pages qui ont dans la requette /admin (ex : http://localhost:8000/admin/show) est accessible seulement avec la permission "Administrator" qui peut être modifier dans la base de donnée a la table "users" il faut mettre la value en 1.
# Base de donnée
Si l'utilisateur n'est pas déjà présent n'oubliez pas de l'ajouter exemple : 
```SQL
CREATE USER 'noza_admin'@'%' IDENTIFIED VIA mysql_native_password USING '***';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'noza_admin'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `nozashop`.* TO 'noza_admin'@'%';
```
