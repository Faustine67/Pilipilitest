<?php

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class MailerService
{
    private MailerInterface $mailer;
    private UrlGeneratorInterface $urlGenerator;
    private string $adminEmail;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail($subject, $to, $body)
    {
        $email = (new Email())
            ->from('michelfaustine@gmail.com')
            ->to($to)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }

    public function sendProductActivationEmail(Product $product)
{
    // Construire le message email
    $subject = 'Activation de produit';
    $to = 'michelfaustine@gmail.com';
    $body = 'Le produit ' . $product->getName() . ' a été activé.';
    $this->sendMail($subject, $to, $body);
}

}