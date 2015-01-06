<?php

namespace Practise\FuncBundle\FuncHandle\Component;

interface FuncInterface
{
    public function insertDatabase($object);
    public function deleteDatabase($object);
}