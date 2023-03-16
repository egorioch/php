<?php
require_once("../vendor/autoload.php");

use App\Comment;
use App\User;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validation;


$date = new DateTime('2023-03-16 17:00:00');

$user1 = new User(1, "donecNon", "donecNon@yandex.ru", "qwerty");
$user2 = new User(2, "oao", "eratSagittis@yandex.ru", "qwerty"); // name exc
$user3 = new User(3, "finibusPurus", "finibusPurusyandex.ru", "qwerty"); // email exc
$user4 = new User(4, "duisOdioTurpis", "duisOdioTurpis@yandex.ru", "1"); // password exc

$comments = [
    new Comment($user1, "Lorem ipsum"),
    new Comment($user2, "Lorem ipsum dolor sit amet"),
    new Comment($user3, "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."),
    new Comment($user4, "empty string")
];

$timeAppropriateArray = [];
foreach ($comments as $comment) {
    if ($comment->getUser()->getDataCreate() < $date)
        $timeAppropriateArray[] = $comment;
}

echo "\n Вывод содержимого массива: \n";
for ($i = 0; $i < count($timeAppropriateArray); $i++) {
    echo $timeAppropriateArray[$i]->getUser()->toString();
}
