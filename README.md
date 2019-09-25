# Application chess

## Contexte

Chess développé en PHP Pur

## Objectif

- Migrer ce projet sur Symfony
- Cleaner un peu le code tant qu'à faire

## Niveau 1

Migrer le projet sur Symfony
Adapter la conf nginx 
Refactoriser le code pour virer deprecated
PHP7.3-4 compliant
PSR 1-4 compliance

## Niveau 2

Utilisateur:
email/mdp (reprendre test bière pour mdp)
Faire une page création compte/login basique
Authentification
Bonus: Mdp oublié envoie de mail token blah blah

Pour initialisation partie:
- Distinguer les 2 joueurs (rentrer les nom, attribution blanc noir au choix (aléatoire par défaut, choix possible...)
- Sauvegarder les parties (joueurs impliqués, état (en cours, draw, check mat...), et stats)

 
## Niveau 3
Sur un compte:
- Stopper et reprendre une ou plusieurs parties
- Un partie: 2 joueurs créé à la volet (dans un contexte de session) 
   (choix : persister jeu dans BDD table Game, Player...)


## Niveau 4 MASTER
- WEBSOCKETS !
- Un player = un utilisateur
- Chacun peu jouer devant son écran
