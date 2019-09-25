# Application Chess

L'application est une version très simplifié d'un jeu d'échec où chaque joueur joue tour à tour sur une même page.

Le plateau et les pions sont générés dans un canvas par un script javascript. Ce dernier va, à chaque action sur le plateau, faire des appels au serveur PHP via une requête AJAX qui renvoi les deplacements possible de la piece selectionnee, puis lors de la selection du mouvement effectuer le mouvement et envoyer les nouvelle coordonnees de la pieces pour mise  a jour.

Le contexte et le déroulé de la partie sont stockées dans la session PHP.

## Composition du projet

Initialement, la stack du projet est :
- PHP
- Javascript
- CSS

## Objectif

L'objectif est multiple :
- Il faut migrer le projet sur du Symfony 4
- Tant qu'à faire, il faut en profiter pour cleaner et factoriser un peu le code
- Si possible, y apporter quelques améliorations et des features bien sympas
- Adapter le script JS et le CSS pour que les appels AJAX et le chargement des images fonctionne

**Remarque**
Concernant le script JS, il s'agit ici de modifier des chemins d'image et des appels AJAX. Les appels doivent fonctionner et les images doivent être chargées.
En revanche, il est possible que le code javascript soit un peu buggé et que le jeu ne fonctionne pas de manière optimal (en gros c'est un peu pété). L'idée est de se concentrer sur le back (génération des pages, routing, appels AJAX pour les coups...).
Il n'est donc pas nécessaire de toucher au corps du script mais juste de faire en sorte que les appels et les images fonctionnent.
Après si le besoin irrépressible de débugger du JS se fait sentir, on ne pénalisera pas pour ça.

## Environnement

Sur le projet, on trouve tout ce qu'il faut pour monter un environnement fonctionnel sur Docker.
On trouvera de quoi faire tourner l'application PHP ainsi qu'une base de données prête à fonctionner.

Pour le lancer il faut :
* Installer Docker
* S'assurer que *make* soit installé
* À la racine du projet, lancer `$ make setup` 
* Dans un navigateur ce rendre sur chess.docker.localhost:8666

## Specifications fonctionnelles

## Niveau 1

Dans cette première étape, l'idée est de migrer tout simplement le projet sur Symfony.

* Installer et configurer symfony
* Implémenter une route "/move" qui sera appelé par le script Javascript à chaque action sur le plateau. Il faudra également remplacer l'appel vers "ajax.php" pour appeler cette nouvelle route
* Adapter la conf nginx
* Refactoriser le code pour qu'il soit PHP7.3-4 compliant et pour qu'il respecte les normes PSR1-4

## Niveau 2

Une fois le projet migré, cleané et fonctionnel, on va commencer à l'améliorer.
On va donc ajouter une gestion très simplifiée de compte utilisateur pour pouvoir jouer.
L'idée est de créer un compte puis de se connecter pour pouvoir lancer une partie en créant des joueurs à la volée (un compte utilisateur = plusieurs players en gros).

En détail ça donne ça:
* On doit pouvoir créer un compte avec un *email* et un *mot de passe*. On peut choisir un *username* différent du mail
* Le mot de passe doit contenir au moins 8 caractères, 1 Majuscule, 1 chiffre et 1 caractère spécial
* On doit pouvoir se connecter avec un email et mot de passe
* Depuis un compte utilisateur, on peut créer une nouvelle partie et créer les jouers à la volée ou reprendre des joueurs qu'on aurait créé dans des parties précédentes
* Un joueur possède :
   * Un pseudo
* Une partie contient:
  * Deux joueurs
  * Un état : en cours, gagné, perdu, draw
* Lors de la création des joueurs, l'attribution des couleurs se fait de manière aléatoire par défaut, mais elle peut être également spécifiée à la création du jeu
   
**Bonus**
* On doit pouvoir récupérer son mot de passe via un mail avec un système de token expirant en 24h
 
## Niveau 3

Sur un compte:
- Stopper et reprendre une ou plusieurs parties
- Un partie: 2 joueurs créé à la volet (dans un contexte de session) 
   (choix : persister jeu dans BDD table Game, Player...)


## Niveau 4 MASTER
- WEBSOCKETS !
- Un player = un utilisateur
- Chacun peu jouer devant son écran
