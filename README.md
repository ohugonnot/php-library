# PHP Library — Exercice

Exercice pédagogique conçu pour pratiquer la **POO en PHP** sur un cas concret.

## Comment utiliser ce repo

- **Branche `exercice`** (ici) — point de départ : structure de dossiers et classes vides à compléter
- **Branche `solution`** — correction complète

## Installation

```bash
composer install
php -S localhost:8000 public/
```

## Objectif

À partir d'un CSV de 100 livres (`books.csv`), tu dois :

1. Compléter la classe `Livre` pour modéliser un livre (titre, auteur, genres, rating, image)
2. Compléter la classe `Bibliotheque` qui :
   - Parse le CSV et instancie les objets `Livre`
   - Expose la liste des genres avec le nombre d'ouvrages par genre
   - Permet de filtrer les livres par genre
   - Permet de rechercher dans le titre, l'auteur et la description
   - Permet de trier par titre, auteur ou rating (asc/desc)
   - Permet de cumuler filtre de genre + recherche
3. Brancher les classes sur le `index.php` fourni pour afficher la bibliothèque

## Structure fournie

```
application/
├── class/
│   ├── Bibliotheque.php   ← à compléter
│   └── Livre.php          ← à compléter
data/
└── books.csv              ← les 100 livres
public/
└── index.php              ← front fourni, à ne pas modifier
```

## Stack

- PHP 8 — POO pure
- Composer / PSR-4 pour l'autoloading
- [league/csv](https://csv.thephpleague.com/) pour le parsing CSV
