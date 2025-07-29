<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="estimates")
 */
class Estimate
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $title;

    /** @ORM\Column(type="text", nullable=true) */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstimatedProduct", mappedBy="estimate", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $estimatedProducts;

    public function __construct()
    {
        $this->estimatedProducts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getEstimatedProducts()
    {
        return $this->estimatedProducts;
    }

    public function addEstimatedProduct(EstimatedProduct $product)
    {
        if (!$this->estimatedProducts->contains($product)) {
            $this->estimatedProducts[] = $product;
            $product->setEstimate($this);
        }
        return $this;
    }

    public function removeEstimatedProduct(EstimatedProduct $product)
    {
        if ($this->estimatedProducts->contains($product)) {
            $this->estimatedProducts->removeElement($product);
            $product->setEstimate(null);
        }
        return $this;
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->estimatedProducts as $product) {
            $total += $product->getTotal();
        }
        return $total;
    }
}
