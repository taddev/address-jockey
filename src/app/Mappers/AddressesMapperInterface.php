<?php

namespace AddressJockey\Mappers;

interface AddressesMapperInterface
{
    public function findById($id);
    public function findAll(array $conditions = array());
}
