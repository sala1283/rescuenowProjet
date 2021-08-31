<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification
{
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function notify(Contact $contact)
    {
        $email = (new Email())
            ->from("webmaster75000@gmail.com")
            ->to($contact->getEmail())
            ->subject("Demande de contact")
            ->text($contact->getMessage());

        $this->mailer->send($email);
    }
}
