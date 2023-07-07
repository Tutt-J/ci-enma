<?php

namespace App\Services;

class Invoice
{
    public function __construct(
        private EmailService $emailService
    ) {
    }

    public function process($email, $amount)
    {
        return $this->emailService->send($email, "Votre commande d’un montant de ".$amount ."€ est confirmée");
    }
}
