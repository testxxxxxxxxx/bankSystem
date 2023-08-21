<?php

declare(strict_types=1);

namespace App\Services;

class ControllerService
{
    public function __construct(private array $controllers)
    {
        $this->controllers=$controllers;

    }

    /*

        gets array with id and names controllers

    */

    public function getControllers(): array 
    {

        return $this->controllers;
    }

    /*

        gets number of controllers array fields

    */

    public function countOfControllers(): int 
    {

        return count($this->controllers);
    }

}