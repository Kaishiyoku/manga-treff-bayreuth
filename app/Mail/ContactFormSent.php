<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormSent extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $fullname;
    public $content;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $fullname
     * @param string $content
     */
    public function __construct(string $email, string $fullname, string $content)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('home.contact.subject', ['name' => config('site.app_name')]))
            ->view('emails.contact.sent')
            ->text('emails.contact.sent')
            ->with([
                'email' => $this->email,
                'fullname' => $this->fullname,
                'content' => $this->content,
            ]);
    }
}
