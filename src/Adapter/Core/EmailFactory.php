<?php

namespace App\Adapter\Core;

final class EmailFactory
{
    private $from;

    public function __construct(
        $from
    ){
        $this->from = $from;
    }

    public function create(
        string $subject,
    string $template,
    array $users
    )
    {
        $swiftMessage = new \Swift_Message();
        $swiftMessage->setSubject($subject);

        $swiftMessage
            ->setBody(nl2br($template), 'text/html')
            ->setFrom($this->from, 'Statysta+')
            ->setTo($users);
        $this->mailer->send($swiftMessage);
        return $swiftMessage;
    }
}