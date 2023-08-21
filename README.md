## PHP Library

Pour s'entrainer au POO en php nous allons créer un site de consultation de livres présents dans une bibliothèque.     
Pour cela nous allons utiliser un fichier book.csv contenant les 100 livres les plus lus.     
      
Le but de l'exercice est d'extraire les 100 livres automatiquement et de créer une classe Livre avec les principales caractéristiques des ouvrages et de générer un array d'objet Livre.     
Il faudra ensuite injecter ses livres dans une classe Bibliothèque que nous travaillerons ensuite pour créer le front de notre bibliothèque.    
      
En s'inspirant du Template https://template.hasthemes.com/boighor/boighor/shop-grid.html vous créerez un site web type Bibliothèque avec les livres présents dans la classe Bibliothèque.       
Le front doit utiliser les classes Livre et Bibliothèque pour dynamiser le contenu de la page afin de factoriser et d'encapsuler un maximum de code.        
Le but et d'afficher la liste des 100 livres avec Image, Etoiles, Description, Titre, Auteur, et les genres dans le menu de gauche avec le nombre d'ouvrages par genre.       
Il faudra également pouvoir filtrer par genre en cliquant sur le menu de gauche et faire fonctionner la recherche en haut du site pour chercher dans les ouvrages.      
La recherche doit permettre d'afficher les livres dont la description, le titre ou l'auteur corresponde en totalité ou en partie à la recherche.       
Vous devrez pouvoir également trier par titre, auteur et rating.      
Vous devrez pouvoir cumuler la recherche avec le filtrage par genre.       

Fonction PHP utiles pour l'exercice.
- usort (trier un array avec une fonction anonyme sur mesure)
- in_array (vérifier si un array contient une valeur)
- array_filter (filter un array en enlevant les valeurs qui ne corresponde pas a un test)
- array_map (appliquer une fonction sur l'ensemble d'un array)
- str_contains (vérifier si un string contient une chaine de charactères)
    
Bonne chance      
