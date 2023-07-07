<?php

namespace App\Services;

class EmailService{
    public function send(string $email, string $message){
        return (bool) mt_rand(0,1);
    }
}