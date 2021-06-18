<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClasseMail extends Mailable
{
    use Queueable, SerializesModels;

    private $nome;
    private $email;
    private $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $link)
    {
        
        $this->nome = $nome;
        $this->email = $email;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Solicitação de redefinição de senha');
        $this->to($this->email);
        
        return $this->view('mail.classeMail',[
            'nome' => $this->nome,
            'link' => $this->link,
        ]);
    }
}
