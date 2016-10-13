<?php

namespace AddressJockey\Mappers;

use AddressJockey\LibraryDatabases\DatabaseAdapterInterface;
use AddressJockey\Models\Addresses;

class AddressesMapper extends AbstractDataMapper implements AddressesMapperInterface
{
    protected $entityTable = "addresses";

    public function __construct(DatabaseAdapterInterface $adapter)
    {
        parent::__construct($adapter);
    }

    protected function createEntity(array $row)
    {
        return new Addresses($row);
    }
}
