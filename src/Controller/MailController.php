<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{


    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/mail", name="mail")
     */
    public function sendEmail()
    {

        $email = (new Email())
            ->from("samuel.simonney@gmail.com")
            //->to($creator->getEmail())
            ->to("samuel.simonney@gmail.com")
            ->subject('Task n° a été mis à jour')
            ->text('L\'utilisateur  a effectué une modification')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }
}
