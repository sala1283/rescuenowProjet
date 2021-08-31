<?php

namespace App\Entity;

use App\Entity\Gite;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 3, max = 20)
     */
    private string $firstname;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 3, max = 20)
     */
    private string $lastname;
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 10)
     */
    private string $phone;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 500)
     */
    private string $message;

    /**
     * @Assert\NotBlank()
     */
    private string $demande;

    /**
     * Get the value of firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname): self
    {
        $this->firstname =  $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of demande
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set the value of demande
     *
     * @return  self
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;

        return $this;
    }
}
