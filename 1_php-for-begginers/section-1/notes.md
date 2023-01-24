# 1. The Fundamentals

## 1.1. PHP Tags
    Opening Tag: <?php ?>
    Echo Tag: <?= ?>

## 1.2. Variables
    $name = "Dark Matter";

## 1.3. Booleans
    $read = true;

## 1.4. Conditionals
    if ($read) {
        $message = "You have read Dark Matter!";
    } else {
        $message = "You have NOT read Dark Matter!";
    }

# 2. Arrays

## 2.1. Simple Arrays
    $books = [
        "Do Androids Dream of Electric Sheep",
        "The Langoliers",
        "Hail Mary"
    ];

    $book[0]

## 2.2. Associative Arrays
    $books = [
        [
            'name' => 'Do Androids Dream of Electric Sheep',
            'author' => 'Philip K. Dick',
            'purchaseUrl' => 'www.example.com'
        ],
        [
            'name' => 'Project Hail Mary',
            'author' => 'Andy Weir',
            'purchaseUrl' => 'www.example.com'
        ]
    ];

    $book['name']

# 3. Loops

## 3.1. Foreach
    foreach ($books as $book) {
        echo $book;
    }

## 3.2. Foreach with HTML
    <?php foreach ($books as $book) : ?>
        <li><?= $book ?></li>
    <?php endforeach; ?>

# 4. Functions

## 4.1. Basic Functions
    function filterByAuthor($books, $author) {
        $filteredBooks = [];

        foreach ($books as $book) {
            if ($book['author'] === $author) {
                $filteredBooks[] = $book;
            }
        }

        return $filteredBooks;
    }

    filterByAuthor($books, 'Philip K. Dick')

## 4.2. Built-In Functions
    $filteredBooks = array_filter($books, function ($book) {
        return $book['releaseYear'] === 2011;
    });