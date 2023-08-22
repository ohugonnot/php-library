<?php

use PHPUnit\Framework\TestCase;

require "Bibliotheque.php";
require "Book.php";

class BibliothequeTest extends TestCase
{
    public function testFindBooksBy(): void
    {
        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->findBooksBy("title", "the");
        $this->assertSame(count($bibliotheque->selected_books), 41);


        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->findBooksBy("description", "girl");
        $this->assertSame(count($bibliotheque->selected_books), 29);

        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->findBooksBy("author", "susan");
        $this->assertSame(count($bibliotheque->selected_books), 1);

        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->findBooksBy("genres", "romance");
        $this->assertSame(count($bibliotheque->selected_books), 75);
    }

    public function testSortBy(): void
    {
        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->sortBy("rating");
        $this->assertSame($bibliotheque->selected_books[0]->title, "Harry Potter and the Sorcerer's Stone");

        $bibliotheque->sortBy("author");
        $this->assertSame($bibliotheque->selected_books[0]->author, "Abbi Glines");

        $bibliotheque->sortBy("title");
        $this->assertSame($bibliotheque->selected_books[0]->title, "A Court of Thorns and Roses");
    }

    public function testSearch(): void
    {
        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->search("harry");
        $this->assertSame(count($bibliotheque->selected_books), 1);
        $this->assertSame($bibliotheque->selected_books[0]->title, "Harry Potter and the Sorcerer's Stone");

        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->search("girl");
        $this->assertSame(count($bibliotheque->selected_books), 30);

        $bibliotheque = new Bibliotheque("books.csv");
        $bibliotheque->search("girl")->sortBy("title");
        $this->assertSame(count($bibliotheque->selected_books), 30);
        $this->assertSame($bibliotheque->selected_books[0]->title, "A Tree Grows in Brooklyn");
    }
}