<?php

namespace App;

class Bibliotheque
{
    public array $books = [];
    public array $selected_books = [];
    public array $genres = [];
    public function __construct(string $CSV_file_url){
        try {
            // throw new Exception('Exception message');
            $csvReader = \League\Csv\Reader::createFromPath($CSV_file_url, 'r');
            $csvReader->setHeaderOffset(0);
            $bookRecords = $csvReader->getRecords();
            $books = [];
            foreach($bookRecords as $bookRecord) {
                $books[] = new Livre($bookRecord);
            }
            $this->books = $books;
        } catch(Exception $e) {
            $file = fopen($CSV_file_url, 'rb');
            $i = 0;
            $headers = [];
            $books = [];
            while(!feof($file))
            {
                $book = fgetcsv($file);
                if($i === 0) {
                    $i++;
                    $headers = $book;
                    continue;
                }

                if(is_array($book)) {
                    foreach($book as $k=>$value) {
                        $book[$headers[$k]] = $value;
                        unset($book[$k]);
                    }
                    $books[] = new Livre($book);
                }
                $i++;
            }
            fclose($file);
            $this->books = $books;
        }
        $this->genres = $this->getUniqueGenres();
        $this->selected_books = $this->books;
    }
    private function getUniqueGenres(): array
    {
        $genres = [];
        foreach ($this->books as $book) {
            foreach($book->category as $genre) {
                $genres[$genre] = ($genres[$genre]??0)+1;
            }
        }
        arsort($genres);
        return $genres;
    }
    public function setSelectedBookFromCategory(string $category){
        $selected_books = array();
        foreach($this->books as $book){
            if($book->hasCategorie($category)){
                $selected_books[] = $book;
            }
        }
        $this->selected_books = $selected_books;
    }

    public function getCategory__toString(): string {
        $html = "";
        foreach($this->genres as $category => $nb_of_book){
            $html .= "<li><a href='index.php?category={$category}#'>{$category} <span>({$nb_of_book})</span></a></li>";
        }
        return $html;
    }

    public function searchByTitle($title){
        $selected_books = array();
        foreach($this->books as $book){
            if(str_contains(strtolower($book->title),strtolower($title))){
                $selected_books[] = $book;
            }
        }
        $this->selected_books = $selected_books;
    }

    public function setSelectedBookSortBy($prop,$order= 'asc'){
        usort($this->selected_books, function ($a,$b) use ($prop,$order){
            if($order == 'asc') {
                return $a->$prop <=> $b->$prop;
            }else{
                return $b->$prop <=> $a->$prop;
            }
        });
    }
}