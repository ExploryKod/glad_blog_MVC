<p align="center">
  <img width="30%" src="./pexels-pixabay-265667.jpg" />
</p>

# <p align="center">Glad Blog </a></p>

Un simple blog qui fait un CRUD mais écrit en php pure pour apprendre les fondamentaux.

## Buts

Le but est essentiellement d'apprendre PHP sur un simple CRUD, une authentification minimaliste, monter un premier projet en production, créer un environnement de dev avec Docker et appréhender certains design pattern essentiels. Je le présente car il est intéressant sur certains plan et fut une de mes premières étapes dans l'exploration de PHP.

**Remarque**: Le projet est loin d'être un projet fini et malgré quelques ajouts récent il est ancien. Il lui manque des couches de sécurité, des design pattern essentiels, une gestion des tests et bien d'autres aspects.

J'ai pu explorer ces compétences :
- Une architecture MVC (Model - View - Controller) et la POO en php.
- Un modèle de domaine riche (règles métier dans les Entities, Managers = persistance).
- Des contrôleurs fins via injection de dépendances (`AppContainer` → Managers / Session).
- Utilisation d'un système de route avec les outils de php sans framework.
- Usage de Docker pour démarrer l'app avec docker-compose en définissant soi-même la configuration.

Les [design patterns](https://refactoring.guru/design-patterns) mis en œuvre :

- **[Abstract Factory](https://refactoring.guru/design-patterns/abstract-factory)** : `PdoConnectionFactory` (MySQL / Postgres) et `DocumentConnectionFactory` (Mongo) ; l’app utilise `MySqlConnectionFactory` par défaut.
- **[Template Method](https://refactoring.guru/design-patterns/template-method)** : les classes abstraites `AbstractController`, `BaseManager` et `BaseEntity` fixent le squelette (dispatch, connexion PDO, hydratation) ; les sous-classes n’implémentent que le détail.

Routing sans framework : Attributes + Reflection

Le routage ne repose pas sur un fichier YAML chargé à la main, mais sur les [Attributes PHP](https://www.php.net/manual/fr/language.attributes.overview.php) `#[Route]` déclarés au-dessus des méthodes des contrôleurs. Au démarrage, `index.php` parcourt ces classes avec l’[API Reflection](https://www.php.net/manual/fr/book.reflection.php) (`ReflectionClass`, `getAttributes()`), instancie chaque attribut et enregistre la route (chemin, méthodes HTTP, contrôleur, action). C’est ainsi qu’une annotation du type `#[Route('/read', name: "read", methods: ["GET"])]` devient une entrée utilisable par le front controller.

## Technologie

Langages: PHP 8.1/JavaScript/HTML/CSS<br/>
Base de donnée: SQL/MySQL<br/>
Serveur: Apache

## Installation

1. Clonez le dépôt et placez-vous sur la branche `main` :

Note : vous pouvez aussi fork le dépôt ou utiliser le template.

```bash
git clone https://github.com/ExploryKod/glad_blog_MVC.git
cd glad_blog_MVC
```

2. Lancez les conteneurs :

```bash
docker compose up -d --build
```

3. Ouvrez l’application :

| Service | URL |
|---------|-----|
| Blog | http://localhost:1300 |
| Adminer | http://localhost:1301 |

Base de donnée (adminer) : 
- Serveur : database
- User : root
- Password : password
- Database : glad_blog

4. Se connecter avec l'utilisateur de démo
- pseudo : `amaury` / mot de passe : `password`