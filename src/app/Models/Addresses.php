<?php

namespace AddressJockey\Models;

class Addresses extends AbstractModel
{
    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $people_id;
    public $address;
    public $city;
    public $state;
    public $zip;
}
