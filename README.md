## Creez la base de donnée;

## Modifier le .env pour changer la BDD;

## Utilisez php artisan migrate à la racine du projet pour créer les tables ;

## Insérez ses données manuellement:

> blockquote insert into specs (name, classe_id) values ('Arme', 1), ('Fureur', 1), ('Protection', 1), ('Givre', 2), ('Feu', 2), ('Arcane', 2), ('Sacré', 3), ('Discipline', 3), ('Ombre', 3), ('Maîtrise des bêtes', 4), ('Survie', 4), ('Précision', 4);

> blockquote insert into races (name) values ('Humain'), ('Elfe'), ('Nain'), ('Orc');

> blockquote insert into classes (name, favorite_skill) values ('Guerrier', 'Coup préféré'), ('Mage', 'Sort préféré'), ('Prêtre', 'Soin préféré'), ('Chasseur', 'Coup préféré');

> blockquote insert into armors(name) values ('Tissu'), ('Cuir'), ('Metal'), ('Or'), ('Platine');

## Créez un personnage depuis le site avec localhost;