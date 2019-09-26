# Application Chess

L'application est une version très simplifié d'un jeu d'échec où chaque joueur joue tour à tour sur une même page.

Elle est composé d'un script JS qui va dessiner le plateau sur un canvas et gérer les actions suivantes :
1 - Lorsque le joueur clique sur une de ses pièce, il envoie une requête vers ajax.php qui va retourner les coordonnées de touts les nouvelles positions possibles
2 - Lorsque le joueur clique sur des destinations possibles, il envoie une requête vers ajax.php avec la nouvelle position puis déplace la pièce.

Le contexte et le déroulé de la partie sont stockées dans la session PHP. On stocke le plateau avec le status de chaque case (pion et sa couleur, ou vide) et le joueur qui doit jouer.

## Composition du projet

Initialement, la stack du projet est :
- PHP
- Javascript
- CSS

## Objectif

L'objectif est multiple :
- Il faut migrer le projet sur du Symfony 4
- Tant qu'à faire, il faut en profiter pour cleaner et factoriser un peu le code
- Si possible, y apporter quelques améliorations et des features bien sympas
- Adapter le script JS et le CSS pour que les appels AJAX et le chargement des images fonctionne

**Remarque**

Concernant le script JS, il s'agit ici de modifier des chemins d'image et des appels AJAX. Les appels doivent fonctionner et les images doivent être chargées.
En revanche, il est possible que le code javascript soit un peu buggé et que le jeu ne fonctionne pas de manière optimal (en gros c'est un peu pété). L'idée est de se concentrer sur le back (génération des pages, routing, appels AJAX pour les coups...).
Il n'est donc pas nécessaire de toucher au corps du script mais juste de faire en sorte que les appels et les images fonctionnent.
Après si le besoin irrépressible de débugger du JS se fait sentir, on ne pénalisera pas pour ça ;)

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
* Adapter la conf nginx
* Implémenter une route "/enabled_moves" qui prend en paramètre les coordonnées d'une case et qui retourne la liste des coordonées des différentes positions possible pour un pion donné lors du clic vers celui ci
   * Retourner une liste de pair [x,y]
   * /enabled_moves doit retourner une 400 si la case sélectionné ne contient pas de pion de la couleur du joueur
   * /enabled_moves retourne rien si aucun coup n'est possible pour ce joueur
* Implémenter une route "/move" qui va modifier la position du pion dans le plateau sauvegardé dans la session PHP
   * On retourne une 400 si le coup n'est pas possible
   * On change le joueur qui doit jouer le prochain coup en session
   * On retourne le status "check", "checkmate" ou "draw" si c'est le cas
* Refactoriser le code pour qu'il soit PHP7.3-4 compliant et pour qu'il respecte les normes PSR1-4

**Remarque**

Le JS actuel n'est plus du tout adapté à ce qu'on demande. Il faudra tester avec des appels à la main :/

## Niveau 2

Une fois le jeu migré, cleané et fonctionnel, on va commencer à ajouter des petites fonctionnalité autour de celui-ci.
On va donc ajouter une gestion très simplifiée de compte utilisateur pour pouvoir jouer.
L'idée est de créer un compte puis de se connecter pour pouvoir lancer une partie en créant des joueurs à la volée (un compte utilisateur = plusieurs players en gros).

En détail ça donne ça:

**Une page de connexion**
* On doit pouvoir créer un compte avec un *email* et un *mot de passe*. On peut choisir un *username* différent du mail
* Le mot de passe doit contenir au moins 8 caractères, 1 Majuscule, 1 chiffre et 1 caractère spécial
* On doit pouvoir se connecter avec un email et mot de passe

**Liste des parties**
* Liste des parties (en cours, terminées...)
* On peut filtrer par statut(s) (en cours, terminé, gagné, perdu)
* On peut filtrer par joueur(s)
* On peut trier par date de début et date de fin

**Page de création de partie**
* On peut créer une nouvelle partie et créer les joueurs à la volée ou reprendre des joueurs qu'on aurait créé dans des parties précédentes
* Lors de la création des joueurs, l'attribution des couleurs se fait de manière aléatoire par défaut, mais elle peut être également spécifiée à la création du jeu

**Liste des joueurs**
* Quand on créé une partie, on doit pouvoir créer des joueurs à la volée ou bien réutiliser des joueurs existant. Il faut pouvoir lister ces joueurs sur une page et afficher le nombre de partie terminées dont gagnées et perdues.
* On peut supprimer un joueur
* On peut modifier un joueur (nom)

**Données**
* Un joueur possède :
   * Un pseudo (username)
   * Une date de création (createdAt)
   * Une date de modification (updatedAt)
* Une partie contient:
  * Deux joueurs
  * Un état : en cours, gagné, perdu, draw
  * Une date de création (createdAt)
  * Une date de modification (updatedAt)
  * Une date de fin de partie (endAt)  

**Bonus**
* On doit pouvoir récupérer le mot de passe d'un utilisateur via un mail avec un système de token expirant en 1h
 
## Niveau 3 ADVANCED

Cette fois ci, on veut pouvoir stocker le déroulé de partie en base de données. 

* La progression d'une partie (position des pièces etc...) doit être enregistrée dans la BDD
* Sur la page de liste des parties, sur une partie en cours, on doit pouvoir cliquer sur "reprendre" et retourner sur la partie avec les pièces positionnées comme avant
    * Créer une route /load qui va retourner toutes les coordonnées du plateau avec la pièce et la couleur ainsi que le status du jeu (check si jamais c'était le cas)
* Sur la page de liste des parties, sur une partie terminée, on doit pouvoir cliquer sur "voir" et retourner sur la partie avec les pièces positionnées comme avant pour voir comment s'est terminée la partie (histoire d'humilier son adversaire si on lui a fait le coup du verger par ex)
   * On utilise la route /load qui va retourner le status "checkmate" ou "draw"


## Niveau 4 MASTER

Pour ceux qui veulent siéger au conseil ET avoir le rang de maitre, il faut maitriser les Websokets.
L'idée ici c'est de ne plus faire affronter deux joueurs sur un meme compte utilisateur, mais deux comptes utilisateurs bien distinct. (Oui cela nécessite de la refacto et de la migration).

En gros une partie implique maintenant deux comptes utilisateurs (ou deux joueurs appartenant à deux comptes utilisateurs distinct, chacun fait comme il veut).

La partie se déroule avec chaque joueur devant son écran et le tous est orchestré en temps réel.

