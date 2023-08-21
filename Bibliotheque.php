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
        } catch(Exception $e) {
            $this->books = $this->getBooksWithoutLib($csv);
        }

        $this->genres = $this->getUniqueGenres();
        $this->selected_books = $this->books;
    }

    public function sortBy(string $param): self
    {
        if(!property_exists('Book',$param)) {
            return $this;
        }
        usort($this->selected_books, static function($a, $b) use ($param) {
            if ($param === 'rating') {
                [$a, $b] = [$b, $a];
            }
            return $a->$param <=> $b->$param;
        });
        return $this;
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
        $selected_books = $this->selected_books;
        $this->selected_books = [];
        foreach ($selected_books as $book) {
            if (is_string($book->$param)) {
                if (str_contains(strtolower($book->$param), strtolower($search))) {
                    $this->selected_books[] = $book;
                }
            } elseif (is_array($book->$param)) {
                if (in_array(strtolower($search), array_map('strtolower', $book->$param), true)) {
                    $this->selected_books[] = $book;
                }
            }
        }
        return $this;
    }

    public function findBooksByGenre(string $genre): self
    {
        $this->findBooksBy('genres', $genre);
        return $this;
    }

    public function findBooksByAuthor(string $author): self
    {
        $this->findBooksBy('author', $author);
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

    public function search(string $search): self
    {

        $selected_books = $this->selected_books;
        $this->findBooksByDescription($search);
        $books = array_merge([], $this->selected_books);
        $this->selected_books = $selected_books;

        $this->findBooksByTitle($search);
        $books = array_merge($books, $this->selected_books);
        $this->selected_books = $selected_books;

        $this->findBooksByAuthor($search);
        $books = array_merge($books, $this->selected_books);
        $this->selected_books = array_unique($books, SORT_REGULAR);

        return $this;
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

    /**
     * @param string $csv
     * @return array
     * @throws \League\Csv\Exception
     * @throws \League\Csv\UnavailableStream
     */
    public function getBooks(string $csv): array
    {
        // throw new Exception('Exception message');
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

    /**
     * @param string $csv
     * @return void
     */
    public function getBooksWithoutLib(string $csv): array
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
}
