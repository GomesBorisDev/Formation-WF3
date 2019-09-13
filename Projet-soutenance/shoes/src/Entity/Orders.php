<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;
    /**
     * @ORM\Column(type="json")
     */
    private $basket = [];
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }
    public function getBasket(): ?array
    {
        return $this->basket;
    }
    public function setBasket(array $basket): self
    {
        $this->basket = $basket;
        return $this;
    }
}
