<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="estimated_products")
 */
class EstimatedProduct
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estimate", inversedBy="estimatedProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estimate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /** @ORM\Column(type="decimal", scale=2) */
    private $price;

    /** @ORM\Column(type="integer") */
    private $quantity;

    public function getId()
    {
        return $this->id;
    }

    public function getEstimate()
    {
        return $this->estimate;
    }

    public function setEstimate($estimate)
    {
        $this->estimate = $estimate;
        return $this;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getTotal()
    {
        return round($this->price * $this->quantity, 2);
    }
}
