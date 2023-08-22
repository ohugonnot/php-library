<?php

namespace App;

class Livre
{
    public ?int $id;
    public ?string $title;
    public ?string $author;
    public ?string $description;
    public ?string $language;
    public ?array $category;
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
        $this->category = array_map("trim",explode(",",$book['genres']));
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

    public function getLabel() : string {
        if($this->rating > 4){
        return <<<EOL
            <div class="hot__box color--2">
                    <span class="hot-label">HOT</span>
            </div>
EOL;
        }
        return "";
    }

    public function hasCategorie(string $category){
        if(in_array($category,$this->category)){
            return $this;
        }
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

    public function tabBook__toString()
    {
        return <<<EOL
        <!-- Start Single Product -->
        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="product__thumb">
                <a class="first__img" href="index.php?single-product=#"><img src="{$this->img}" alt="product image"></a>
                <a class="second__img animation1" href="index.php?single-product=#"><img src="{$this->img}" alt="product image"></a>
                {$this->getLabel()}
            </div>
            <div class="product__content content--center is-visible">
                <h5>{$this->title}</h5>
                <h6>{$this->getAuthor()}</h6>
                {$this->getStars()}
            </div>
        </div>
        <!-- End Single Product -->
                                
EOL;

    }
    public function listBook__toString(){
        return <<<EOL
        <!-- Start Single Product -->
        <div class="list__view">
            <div class="thumb">
                <a class="first__img" href="index.php?single-product=#"><img src="{$this->img}" alt="product images"></a>
                <a class="second__img animation1" href="index.php?single-product=#"><img src="{$this->img}" alt="product images"></a>
            </div>
            <div class="content">
                <h1>{$this->title}</h1>
                <h2>{$this->getAuthor()}</h2>
                {$this->getStars()}
                <p>{$this->description}</p>
            </div>
        </div>
        <!-- End Single Product -->
EOL;

    }

}