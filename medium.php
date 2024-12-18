
<?php

class InvalidAmountException extends Exception {}
class InsufficientFundsException extends Exception {}

class BankAccount {
    private $balance;

    public function __construct($initialBalance) {
        if ($initialBalance < 0) {
            throw new InvalidAmountException("Начальный баланс не может быть отрицательным.");
        }
        $this->balance = $initialBalance;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма депозита должна быть положительной.");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма снятия должна быть положительной.");
        }
        if ($amount > $this->balance) {
            throw new InsufficientFundsException("Недостаточно средств на счете.");
        }
        $this->balance -= $amount;
    }
}

try {
    $account = new BankAccount(100);
    echo "Текущий баланс: " . $account->getBalance() . "\n";

    // Попробуем внести некорректную сумму
    $account->deposit(-50);
} catch (InvalidAmountException $e) {
    echo "Ошибка: " . $e->getMessage();
}

try {
    // Попробуем снять большую сумму
    $account->withdraw(200);
} catch (InsufficientFundsException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
