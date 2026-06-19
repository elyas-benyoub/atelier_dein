# Atelier Dein

Médiathèque PHP/MySQL en MVC procédural. Le MVP gère le catalogue de livres, films et jeux, les comptes, les emprunts et l’administration.

## Démarrer avec Docker

Prérequis : Docker et Docker Compose.

```bash
docker compose up --build
```

Ouvrir [http://localhost:8080](http://localhost:8080). Docker initialise une base vide avec [database/init.sql](database/init.sql), puis l’application utilise les variables `DB_HOST`, `DB_NAME`, `DB_USER` et `DB_PASS` définies dans `docker-compose.yml`.

Le script d’initialisation ne s’exécute que lors de la création d’une base MySQL vide. Il ne remplace pas une migration de base existante.

Pour arrêter les services :

```bash
docker compose stop
```

## Comptes de test

- Administrateur : `admin@example.com` / `password123`
- Utilisateur : créer un compte depuis `/auth/register`

Changer le mot de passe administrateur avant toute exposition publique.

## Fonctionnalités MVP

- Catalogue de livres, films et jeux avec recherche et filtres.
- Inscription, connexion, profil et messages de contact.
- Emprunt, retour, limite de trois emprunts et dates de retour.
- Administration des utilisateurs, médias et emprunts.
- Ajout de médias et édition réservés aux administrateurs.
- Upload d’images contrôlé (MIME, extensions autorisées, 2 Mo maximum).

## Routes utiles

| Route | Usage |
| --- | --- |
| `/` | Accueil et filtres du catalogue |
| `/home/info?id={id}` | Fiche média |
| `/auth/register` | Inscription |
| `/auth/login` | Connexion |
| `/home/profile` | Emprunts de l’utilisateur connecté |
| `/home/contact` | Formulaire de contact |
| `/admin/show_medias` | Administration des médias |
| `/admin/show_users` | Administration des utilisateurs |
| `/loan/show_loans` | Administration des emprunts |

Les routes `/admin/*` et les ajouts de médias sont réservés aux administrateurs.

## Sécurité appliquée

- Requêtes SQL préparées via PDO.
- Token CSRF vérifié sur toutes les requêtes POST.
- Actions d’emprunt, retour et suppression en POST.
- Vérification du rôle administrateur pour les actions sensibles.
- Échappement des sorties et messages flash.
- Régénération de session après connexion.

## Tests visuels Playwright

Après avoir démarré Docker, installer les dépendances puis lancer les tests :

```bash
npm install
npx playwright install chromium
npm run test:e2e
```

Les captures de l’accueil, de la connexion et de l’inscription sont générées dans `tests/screenshots/` pour les formats mobile, tablette et desktop.

## Exécution sans Docker

Copier `config/database.example.php` vers `config/database.php`, définir les variables d’environnement DB, puis importer `database/init.sql` dans MySQL. Le serveur web doit pointer vers `public/`.
