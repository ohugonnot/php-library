<?php
class Book
{
    public ?int $id;
    public ?string $title;
    public ?string $author;
    public ?string $description;
    public ?string $language;
    public ?array $genres;
    public ?array $characters;
    public ?string $img;
    public ?string $format;
    public ?string $edition;
    public ?int $pages;
    public ?string $publisher;
    public ?int $publishedYear;
    public ?array $awards;
    public ?float $rating;
    public ?int $numRatings;
    public ?int $isbn;
    public ?int $isbn13;

    public function __construct(array $book) {
        $this->id = (int)$book['bookId'];
        $this->title = trim($book['title']);;
        $this->author = trim($book['author']);
        $this->description = trim($book['description']);
        $this->language = trim($book['language']);
        $this->genres = array_map("trim",explode(",",$book['genres']));
        $this->characters = array_map("trim",explode(",",$book['characters']));
        $this->img = trim($book['coverImg']);
        $this->format = trim($book['bookFormat']);
        $this->edition = trim($book['edition']);
        $this->pages = (int)$book['pages'];
        $this->publisher = trim($book['publisher']);
        $this->publishedYear = (int)$book['publishedYear'];
        $this->awards = array_map("trim",explode(",",$book['awards']));
        $this->rating = (float)$book['rating'];
        $this->numRatings = (int)$book['numRatings'];
        $this->isbn = (int)$book['ISBN'];
        $this->isbn13 = (int)$book['ISBN13'];
    }

    public function getAuthor(): string {
        $authors = explode(",",$this->author);
        $authors = array_map('trim',$authors);
        return implode("<br>",$authors);
    }

    public function getStars(): string {
        $html = "<ul class=\"rating d-flex\">";
        $range = range(1,5);
        foreach ($range as $nb) {
            if($this->rating >= $nb) {
                $html .=  '<li class="on"><i class="fa fa-star-o"></i></li>';
            } else {
                $html .=  '<li><i class="fa fa-star-o"></i></li>';
            }
        }
        $html .=  "</ul>";
        return $html;
    }
}