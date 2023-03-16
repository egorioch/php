<?php

namespace App;

use DateTime;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Serializer\Annotaion\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class User
{
    #[Assert\NotBlank]
    private int $id;

    #[Assert\Length(['min=10'])]
    private string $name;

    #[Assert\NotBlank]
    private string $email;

    #[Assert\Length(['min=10'])]
    private string $password;

    private DateTime $dateTimeCreate;


    public function __construct($id, $name, $email, $password)
    {
        $this->id = ($this->isValidId($id)) ? $id : 0;
        $this->name = ($this->isValidName($name)) ? $name : "null";
        $this->email = ($this->isValidEmail($email)) ? $email : "null";
        $this->password = ($this->isValidPassword($password)) ? $password : "null";

        $this->dateTimeCreate = new DateTime($dateTime = "now");
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getDataCreate()
    {
        return $this->dateTimeCreate->format("Y-m-d H:i:s");
    }

    private function isValidId(int $id): bool
    {
        $res = true;
        $validator = Validation::createValidator();
        $validID = $validator->validate($id, [
            new Positive(),
            new NotBlank(),
        ]);
        if (count($validID) !== 0) {
            $res = false;
            foreach ($validID as $value)
                echo $value->getMessage() . " Error in ID" . $id . "\n";
        }
        return $res;
    }

    private function isValidName(string $name): bool
    {
        $res = true;
        $validator = Validation::createValidator();
        $validName = $validator->validate($name, [
            new NotBlank(),
            new Length(["min" => 1, "max" => 20]),
        ]);
        if (count($validName) !== 0) {
            $res = false;
            foreach ($validName as $value)
                echo $value->getMessage() . " Error in Name: " . $name . "\n";
        }
        return $res;
    }

    private function isValidEmail(string $email): bool
    {
        $res = true;
        $validator = Validation::createValidator();
        $validEmail = $validator->validate($email, [
            new NotBlank(),
            new Length(["min" => 5, "max" => 25]),
            new Email(),
        ]);
        if (count($validEmail) !== 0) {
            $res = false;
            foreach ($validEmail as $value)
                echo $value->getMessage() . " Error in Email: ". $email ."\n";
        }
        return $res;
    }

    private function isValidPassword(string $password): bool
    {
        $res = true;
        $validator = Validation::createValidator();
        $validName = $validator->validate($password, [
            new NotBlank(),
            new Length(["min" => 6, "max" => 30]),
        ]);
        if (count($validName) !== 0) {
            $res = false;
            foreach ($validName as $value)
                echo $value->getMessage() . " Error in Password: " . $password . "\n";
        }
        return $res;
    }

    public function toString(): string
    {
        return
            $this->id . " "
            . $this->name . " "
            . $this->email . " "
            . $this->password . " "
            . $this->getDataCreate()
            . "\n";
    }
}
