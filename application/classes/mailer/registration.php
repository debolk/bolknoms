<?php defined('SYSPATH') or die('No direct script access.');

class Mailer_Registration
{
    /**
     * Sends a confirmation email for a given set of registrations
     * @param array(Model_Registration) $registrations
     * @return void
     */
    public static function send_confirmation($name, $email, $registrations)
    {
        $title = '[deBolk] Aanmelding eettafel';
        $body = View::factory('front/email',array(
                                    'name' => $name,
                                    'registrations' => $registrations
                            ));
        $to = "$name <$email>";

        $headers  = 'From: Bolknoms <no-reply@debolk.nl>'.PHP_EOL;
        $headers .= 'Reply-To: '.Kohana::$config->load('bolknoms.email.reply_to').PHP_EOL;
        $headers .= 'Content-type: text/html'.PHP_EOL;

        mail($to, $title, $body, $headers);
    }
}