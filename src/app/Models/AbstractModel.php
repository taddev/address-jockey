<?php

namespace AddressJockey\Models;

abstract class AbstractModel implements \JsonSerializable
{
    /**
     * @param array $fields the associative array of properties to use on object
     *                      creation.
     */
    public function __construct(array $fields = [])
    {
        if (!empty($fields)) {
            $this->fillFields($fields);
        }
    }

    /**
     * fillFields allows for bulk input and update of fields in the entity.
     *
     * @param array $fields an associative array of the fields to input and
     *                      their values
     */
    public function fillFields(array $fields)
    {
        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * JsonSerialize checks if the class properties are not null and populates
     * and returns an array with the set fields.
     *
     * @return array an associative array with the property names and their
     *               values
     */
    public function JsonSerialize()
    {
        $properties = get_object_vars($this);
        foreach ($properties as $key => $value) {
            if (isset($value)) {
                $setFields[$key] = $value;
            }
        }

        return $setFields;
    }
}
