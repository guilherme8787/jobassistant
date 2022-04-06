<?php

namespace App;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class MailManager {
    
    public static function sendMail($dados){
        // Acesse para gerar uma senha para o seu gmail
        // https://support.google.com/accounts/answer/185833?hl=pt-BR
        $transport = Transport::fromDsn('smtp://email:senha@smtp.gmail.com:465');
        $mailer = new Mailer($transport);

        $html = '
            <p>Prezados,</p>
            <p>Meu nome é <Fulano de tal>, tenho X anos, e desejo me candidatar a vaga X conforme divulgada</p>
            <p>Em anexo envio meu currículo.</p>
            <p>Atenciosamente,<br><Fulano de tal></p>
        ';
        $textPlain = '
            Prezados,
            Meu nome é <Fulano de tal>, tenho X anos, e desejo me candidatar a vaga X conforme divulgada
            Em anexo envio meu currículo.
            Atenciosamente,
            <Fulano de tal>
        ';

        $email = (new Email())
            // Coloque o seu email aqui, o de envio
            ->from('<seuemail@email.com>')
            ->to($dados['email'])
            ->priority(Email::PRIORITY_HIGH)
            ->subject($dados['assunto'])
            ->text($textPlain)
            ->html($html)
            // Substitua <fulano de tal> pelo seu nome
            ->attachFromPath('path/to/cv', 'Curriculo_<fulano de tal>', 'application/pdf');
        
        $mailer->send($email);
    }

}