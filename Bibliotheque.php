<?php

use League\Csv\Reader;

class Bibliotheque
{
    /** @var Book[] */
    public array $books = [];

    /** @var Book[] */
    public array $selected_books = [];
    public array $genres = [];

    public function __construct(string $csv)
    {
        try {
            $this->books = $this->getBooks($csv);
        } catch (Exception $e) {
            $this->books = $this->getBooksWithoutLib($csv);
        }

        $this->genres = $this->getUniqueGenres();
        $this->selected_books = $this->books;
    }

    private function getBooks(string $csv): array
    {
        $csvReader = Reader::createFromPath($csv, 'r');
        $csvReader->setHeaderOffset(0);
        $bookRecords = $csvReader->getRecords();
        $books = [];
        foreach ($bookRecords as $bookRecord) {
            $books[] = new Book($bookRecord);
        }
        $this->books = $books;
        return $books;
    }

    private function getBooksWithoutLib(string $csv): array
    {
        $file = fopen($csv, 'rb');
        $i = 0;
        $headers = [];
        $books = [];
        while (!feof($file)) {
            $book = fgetcsv($file);
            if ($i === 0) {
                $i++;
                $headers = $book;
                continue;
            }

            if (is_array($book)) {
                foreach ($book as $k => $value) {
                    $book[$headers[$k]] = $value;
                    unset($book[$k]);
                }
                $books[] = new Book($book);
            }
            $i++;
        }
        fclose($file);
        return $books;
    }

    private function getUniqueGenres(): array
    {
        $genres = [];
        foreach ($this->books as $book) {
            foreach ($book->genres as $genre) {
                $genres[$genre] = ($genres[$genre] ?? 0) + 1;
            }
        }
        arsort($genres);
        return $genres;
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

    public function findBooksBy(string $param = "title", string $search = "girl"): self
    {
        $this->selected_books = array_filter($this->selected_books, function ($book) use ($param, $search) {
            if (is_array($book->$param)) {
                if (in_array(strtolower($search), array_map("strtolower", $book->$param), true)) {
                    return true;
                }
            } else {
                if (str_contains(strtolower($book->$param), strtolower($search))) {
                    return true;
                }
            }
            return false;
        });
        return $this;
    }

    public function findBooksByGenre(string $genre): self
    {
        $this->findBooksBy('genres', $genre);
        return $this;
    }

    public function findBooksByDescription(string $description): self
    {
        $this->findBooksBy('description', $description);
        return $this;
    }

    public function findBooksByTitle(string $title): self
    {
        $this->findBooksBy('title', $title);
        return $this;
    }

    public function findBooksByAuthor(string $author): self
    {
        $this->findBooksBy('author', $author);
        return $this;
    }

    public function search(string $search): self
    {

    }

    public function sortBy(string $param): self
    {

    }
}
