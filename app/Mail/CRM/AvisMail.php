<?php

namespace App\Mail\CRM;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AvisMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->with("mailers.smtp")
            ->from('noreply@cpn-aide-aux-entreprises.com',"cpn-aide-aux-entreprises")
            ->to($this->email)
            ->bcc("s.smida@jobid.fr")
            ->bcc("votreconseiller@cpn-aide-aux-entreprise.com")
            ->subject("Félicitation 🎉 vous faites désormais partie de notre réseau CPN")
            ->markdown('mails.crm.Avis');
    }
}
