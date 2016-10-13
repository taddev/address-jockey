<?php

namespace AddressJockey\Mappers;

use AddressJockey\LibraryDatabases\DatabaseAdapterInterface;
use AddressJockey\Models\People;

class PeopleMapper extends AbstractDataMapper implements PeopleMapperInterface
{
    protected $addressMapper;
    protected $entityTable = "people";

    public function __construct(
        DatabaseAdapterInterface $adapter,
        AddressesMapperInterface $addressMapper
    ) {

        $this->addressMapper = $addressMapper;
        parent::__construct($adapter);
    }

    protected function createEntity(array $row)
    {
        $row['addresses'] = $this->addressMapper->findAll(
            array("people_id" => $row['id'])
        );

        return new People($row);
    }
}
