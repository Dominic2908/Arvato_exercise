<?php


class Flear
{

    /**
     * @var int
     */
    private $rating;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    public function __construct($name, $price, $rating) {
        $this->name = $name;
        $this->price = $price;
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}