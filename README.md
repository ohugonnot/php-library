# PHP Library

Exercice pédagogique conçu et donné à mes étudiants lors de mon activité de formateur développeur web.

**Objectif** : pratiquer la POO PHP sur un cas concret — parser un CSV de 100 livres et construire une bibliothèque interactive avec filtres, recherche et tri.

## Comment utiliser ce repo

| Branche | Contenu |
|---------|---------|
| [`exercice`](../../tree/exercice) | Point de départ : structure de dossiers et classes vides à compléter |
| [`solution`](../../tree/solution) | Correction complète avec tests PHPUnit |

> Commence par la branche `exercice`, consulte `solution` uniquement si tu es bloqué.

## L'exercice en bref

À partir d'un CSV de 100 livres, implémenter deux classes :

- **`Livre`** — modélise un livre (titre, auteur, genres, rating, image)
- **`Bibliotheque`** — parse le CSV, filtre par genre, recherche full-text, trie par propriété, cumule filtre + recherche

Le front (`index.php`) est fourni et ne doit pas être modifié.

## Stack

- PHP 8 — POO, namespaces, autoloading PSR-4
- Composer
- [league/csv](https://csv.thephpleague.com/) pour le parsing CSV
