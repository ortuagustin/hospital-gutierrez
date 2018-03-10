<?php

namespace App\Models;

/**
 *  A Model that is external to the system
 *  They consist in simple key-value pairs
 */
class ReferenceModel implements \JsonSerializable
{
    /**
     * @var int
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @param int $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Returns the key of the ReferenceModel
     *
     * @return int
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Returns the id. This is an alias for the key() method
     *
     * @return int
     */
    public function id()
    {
        return $this->key();
    }

    /**
     * Returns the value of the ReferenceModel
     *
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id'     => $this->id(),
            'key'    => $this->key(),
            'value'  => $this->value(),
        ];
    }
}
