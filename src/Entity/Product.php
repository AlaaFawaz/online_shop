<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\String_;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",unique=true)
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $productName;
    /**
     * @ORM\Column(type="string")
     */
    private $productDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @param mixed $productDescription
     */
    public function setProductDescription($productDescription): void
    {
        $this->productDescription = $productDescription;
    }

}
