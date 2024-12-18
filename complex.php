
<?php

class BookAlreadyExistsException extends Exception {}
class LibraryFullException extends Exception {}

class Book {
    public $title;
    public $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }
}

class Library {
    private $books = [];
    private $maxBooks;

    public function __construct($maxBooks) {
        $this->maxBooks = $maxBooks;
    }

    public function addBook(Book $book) {
        if (count($this->books) >= $this->maxBooks) {
            throw new LibraryFullException("Библиотека переполнена.");
        }

        foreach ($this->books as $existingBook) {
            if ($existingBook->getTitle() == $book->getTitle()) {
                throw new BookAlreadyExistsException("Книга с таким названием уже существует.");
            }
        }

        $this->books[] = $book;
    }

    public function getBooks() {
        return $this->books;
    }
}

try {
    $library = new Library(2); // Максимум 2 книги
    $book1 = new Book("Война и мир", "Лев Толстой");
    $book2 = new Book("1984", "Джордж Оруэлл");

    $library->addBook($book1);
    $library->addBook($book2);

    // Попробуем добавить книгу с таким же названием
    $book3 = new Book("Война и мир", "Лев Толстой");
    $library->addBook($book3);
} catch (BookAlreadyExistsException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
} catch (LibraryFullException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}

?>
