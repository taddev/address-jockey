<?php

namespace AddressJockey\Mappers;

interface PeopleMapperInterface
{
    public function findById($id);
    public function findAll(array $conditions = array());
}
