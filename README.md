# PHP Library

Bibliothèque de livres en PHP orienté objet. Parse un CSV de 100 livres, les expose via des classes métier et génère une interface web avec filtres, recherche et tri.

## Fonctionnalités

- Parsing du CSV et hydratation en objets `Livre`
- Classe `Bibliothèque` avec filtrage par genre, recherche full-text (titre, auteur, description) et tri (titre, auteur, rating)
- Cumul filtre + recherche
- Affichage de la liste des genres avec compteur d'ouvrages

## Stack

- PHP 8 — POO pure, pas de framework
- Composer pour l'autoloading PSR-4

## Lancer le projet

```bash
composer install
php -S localhost:8000
```

Puis ouvrir `http://localhost:8000`.
