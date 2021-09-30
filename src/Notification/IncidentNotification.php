<?php

namespace App\Notification;

use App\Entity\Incident;
use app\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class IncidentNotification
{
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function notifyIncident(Incident $incident)
    {
        $email = (new Email())
            ->from("contact@rescuenow.eu")
            ->to($incident->getUser()->getEmail())
            ->subject("Ticket incident#" . $incident->getId())
            ->text($incident->getDescription());

        $this->mailer->send($email);
    }
}
