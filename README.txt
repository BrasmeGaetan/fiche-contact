Pour accéder à la base de données, vous devrez installer XAMPP sur Windows, puis démarrer les services Apache (service web) et MySQL (service de base de données).

Il vous faudra démarrer les deux services (Apache et MySQL) via XAMPP. Ensuite, dans le dossier du projet, exécutez les commandes suivantes :
php bin/console doctrine:database:create (Commande qui permet de créer la base de données)
php bin/console doctrine:migrations:migrate (Commande qui permet d'appliquer les migrations et de créer les tables dans la base de données sur phpMyAdmin)
php bin/console doctrine:fixtures:load (Commande qui permet d'ajouter les départements préalablement définis dans le fichier DepartementFixtures)


Ensuite accéder au lien 