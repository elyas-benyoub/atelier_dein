# Checklist manuelle MVP — Atelier Dein

Pré-requis : application démarrée avec Docker, compte admin `admin@example.com` / `password123`, et un compte utilisateur standard.

## Authentification

- [ ] Inscription avec un email inédit : succès, redirection vers la connexion.
- [ ] Inscription avec un email existant : erreur, aucun compte créé.
- [ ] Connexion avec le compte utilisateur : succès et session créée.
- [ ] Connexion avec un mauvais mot de passe : erreur, aucune session créée.
- [ ] Déconnexion : retour à un état invité.

## Catalogue et médias

- [ ] Accueil : recherche, type, genre et disponibilité filtrent le catalogue.
- [ ] Fiche média inexistante : page 404.
- [ ] Compte standard : accès refusé à `/book/add`, `/movie/add` et `/game/add`.
- [ ] Admin : ajout d’un livre, film et jeu avec image valide ; les médias apparaissent dans le catalogue.
- [ ] Admin : édition d’un média conserve son type, ses genres précochés et son image.
- [ ] Upload d’une image invalide ou de plus de 2 Mo : erreur, aucun média modifié.

## Emprunts

- [ ] Utilisateur : emprunt d’un média disponible ; le bouton devient « Retour ».
- [ ] Utilisateur : quatrième emprunt refusé.
- [ ] Utilisateur A : tentative de retour d’un emprunt de l’utilisateur B refusée.
- [ ] Admin : retour possible pour n’importe quel emprunt actif.
- [ ] Retour : le média redevient disponible.

## Administration

- [ ] Compte standard : accès refusé aux routes `/admin/*` et `/loan/show_loans`.
- [ ] Admin : modification d’un utilisateur, avec rôle limité à `user` ou `admin`.
- [ ] Admin : tentative de suppression de son propre compte refusée.
- [ ] Admin : suppression d’un autre utilisateur ou média via un formulaire POST confirmé.

## Sécurité des formulaires

- [ ] Retirer ou modifier `csrf_token` avant une soumission POST : erreur et aucune modification.
- [ ] Ouvrir directement une ancienne URL GET d’emprunt, retour ou suppression : aucune modification.
