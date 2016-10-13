<?php

namespace AddressJockey\Models;

class People extends AbstractModel
{
    protected $id;
    protected $created_at;
    protected $updated_at;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $addresses;
}
