<?php

namespace Service;

use App\Service;
use App\Entity\Product;
use Service\MailerService;
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
            ->from('faustine@example.com')
            ->to($to)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}