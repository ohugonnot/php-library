# PHP Library — Solution

Correction de l'exercice POO PHP : bibliothèque de livres avec filtres, recherche et tri.

> La branche `exercice` contient le point de départ si tu veux faire l'exercice toi-même.

## Installation

```bash
composer install
php -S localhost:8000 public/
```

## Ce qui a été implémenté

- **`Livre`** — hydratation depuis un enregistrement CSV, gestion des genres multiples
- **`Bibliotheque`** — parsing CSV via `league/csv` (fallback natif si indisponible), filtrage par genre, recherche full-text (titre + auteur + description), tri par propriété avec ordre asc/desc, cumul filtre + recherche
- **`BibliothequeTest`** — tests unitaires PHPUnit couvrant les principales méthodes

## Stack

- PHP 8 — POO, namespaces, autoloading PSR-4
- [league/csv](https://csv.thephpleague.com/) pour le parsing CSV
- PHPUnit pour les tests
