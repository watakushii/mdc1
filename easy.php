
<?php

class OutOfRangeException extends Exception {}

class Person {
    public $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->setAge($age);
    }

    public function setAge($age) {
        if ($age < 0 || $age > 150) {
            throw new OutOfRangeException("Возраст должен быть в пределах от 0 до 150.");
        }
        $this->age = $age;
    }

    public function getAge() {
        return $this->age;
    }
}

try {
    $person = new Person("Иван", 30);
    echo "Возраст: " . $person->getAge() . "\n";

    // Попробуем установить неправильный возраст
    $person->setAge(200);
} catch (OutOfRangeException $e) {
    echo "Ошибка: " . $e->getMessage();
}

?>
