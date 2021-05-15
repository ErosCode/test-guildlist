## Creez la base de donnée;

## Modifier le .env pour changer la BDD;

## Utilisez php artisan migrate à la racine du projet pour créer les tables ;

## Insérez ses données manuellement:

> blockquote insert into specs (name) values ('Arme'), ('Fureur'), ('Protection'), ('Givre'), ('Feu'), ('Arcane'), ('Sacre'), ('Discipline'), ('Ombre'), ('Maitrise des betes'), ('Survie'), ('Precision');

> blockquote insert into races (name) values ('Humain'), ('Elfe'), ('Nain'), ('Orc');

> blockquote insert into classes (name, favorite_skill) values ('Guerrier', 'Coup préféré'), ('Mage', 'Sort préféré'), ('Pretre', 'Soin préféré'), ('Chasseur', 'Coup préféré');

> blockquote insert into armors(name) values ('Tissu'), ('Cuir'), ('Metal'), ('Or'), ('Platine');

## Créez un personnage depuis le site avec localhost;