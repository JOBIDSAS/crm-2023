<?php

namespace App\Mail\CRM;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EligibilityMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $zoom;
    protected $cid;
    protected $grant;
    protected $company;
    protected $email;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($zoom, $cid, $grant, $company, $email, $date, $token)
    {
        $this->zoom = $zoom;
        $this->cid = $cid;
        $this->grant = $grant;
        $this->company = $company;
        $this->email = $email;
        $this->date = $date;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = new DateTime($this->date);
        $dstr = new DateTime($this->date);
        $date = $date->format("l, d F Y à H:i");
        $dstr = $dstr->format("Y-m-d");

        $date = str_replace(
            array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"),
            array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"),
            $date
        );
        $date = str_replace(
            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
            array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'),
            $date
        );
        $data = [
            "cid" => $this->cid,
            "join_url" => $this->zoom['join_url'],
            "password" => $this->zoom['password'],
            "date" => $date,
            "amount" => $this->grant,
            "token" => $this->token,
        ];
        return $this->with("mailers.smtp")
            ->from('noreply@cpn-aide-aux-entreprises.com',"cpn-aide-aux-entreprises")
            ->to($this->email)
            ->bcc("s.smida@jobid.fr")
            ->bcc("votreconseiller@cpn-aide-aux-entreprise.com")
            ->subject($this->company.", Félicitation votre subvention est approuvée")
            ->markdown('mails.crm.confirmation',["data"=>$data]);
    }
}
