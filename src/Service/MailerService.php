<?php

namespace App\Service;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail()
    {
        $email = (new Email())
            ->from('kefi.maher@esprit.tn')
            ->to('kefi.maher@esprit.tn')
            ->subject('Hello')
            ->text('This is the plain text message.')
            ->html('<p>This is the HTML message.</p>');

        $this->mailer->send($email);
    }
}
