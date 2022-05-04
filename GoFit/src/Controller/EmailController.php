<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    private $mailer;


    /**
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface  $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(string $toMail, array $variables){
        $email=(new TemplatedEmail())
            ->from('gofitesprit@gmail.com')
            ->to($toMail)
            ->subject('votre commande est validée  ')
            ->htmlTemplate('email/order.html.twig')
            ->context($variables);
        $this->mailer->send($email);

    }



}