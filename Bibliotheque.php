<?php

class Bibliotheque
{

    /** @var Book[] */
    public array $books = [];

    /** @var Book[] */
    public array $selected_books = [];
    public array $genres = [];

    public function __construct(array $books)
    {
        $this->books = $books;
        $this->genres = $this->getUniqueGenres();
        $this->selected_books = $this->books;
    }

    public function sortBy(string $param): self
    {
    }

    public function getBook(int $id): ?Book
    {
        foreach ($this->books as $book) {
            if ($book->id === $id) {
                return $book;
            }
        }
        return null;
    }

    public function findBooksBy(string $param, string $search): self
    {
    }

    public function findBooksByGenre(string $genre): self
    {
    }

    public function findBooksByAuthor(string $author): self
    {
    }

    public function findBooksByDescription(string $description): self
    {
    }

    public function findBooksByTitle(string $title): self
    {
    }

    public function search(string $search): self
    {
    }

    private function getUniqueGenres(): array
    {
        $genres = [];
        foreach ($this->books as $book) {
            foreach($book->genres as $genre) {
                $genres[$genre] = ($genres[$genre]??0)+1;
            }
        }
        arsort($genres);
        return $genres;
    }
}
