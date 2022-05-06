<?php

namespace App\Services\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailerService
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
     * @throws TransportExceptionInterface
     */

        public function sendEmail(string $toMail, array $variables){
            $email=(new TemplatedEmail())
                ->from('gofit2022bythefive@gmail.com')
                ->to($toMail)
                ->subject('votre reclamation est envoyée  ')
                ->htmlTemplate('Email/email.html.twig')
                ->context($variables);
            $this->mailer->send($email);

        }
}