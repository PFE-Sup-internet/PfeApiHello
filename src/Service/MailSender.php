<?php

namespace App\Service;

use App\Entity\Person;
use App\Entity\Task;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailSender
{

    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(Task $task, Person $user)
    {
        $assigned = $task->getAssignedUsers();
        $toADresses = [];
        foreach ($assigned as $userAssigned) {
            $toADresses[] = new Address($userAssigned->getEmail());
        }
        $creator = $task->getCreator();
        $email = (new Email())
            ->from($creator->getEmail())
            ->to($creator->getEmail())
            ->addTo(...$toADresses)
            ->subject('Task n°' . $task->getId() . ' a été mis à jour')
            ->text('L\'utilisateur ' . $user->getUserName() . ' a effectué une modification')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }
}
