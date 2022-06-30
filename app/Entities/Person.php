<?php

namespace Welldex\Entities;

class Person
{
    private string $name;
    private string $email;
    private int $delay;

    public function __construct(string $name, string $email, int $delay)
    {
        $this->name = $name;
        $this->email = $email;
        $this->delay = $delay;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setEmail(string $email) 
    {
        $this->email = $email;
    }

    public function setDelay(int $delay)
    {
        $this->delay = $delay;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDelay()
    {
        return $this->delay;
    }
}
?>