<?php

namespace App\Controller;

use Doctrine\DBAL\Schema\AbstractAsset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\String\ByteString;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
class MailerController extends  AbstractController
{
    /**
     * @var MailerInterface
     */
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
    /**
     * @Route("/mailer", name="mailer")
     */
    public function sendEmail(MailerInterface $mailer , $appEmail) {


        $email = (new TemplatedEmail())
            ->from($appEmail)
            ->to( 'farahchouikh@gmail.com')
            ->subject('Joyeux Anniversaire')

            ->htmlTemplate('emails/clientEmail.html.twig')
            ->context(
                ['expiry_date' => date_create('+3 days'),
                    'couponcode' =>
                        $random = uniqid('birthday_')
                ]
            );
        $this->mailer->send($email);
        return new Response ('Email envoyé');
    }



}