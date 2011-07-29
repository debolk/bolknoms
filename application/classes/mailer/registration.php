<?php defined('SYSPATH') or die('No direct script access.');

class Mailer_Registration
{
    /**
     * Sends a confirmation email for registrations
     * @param array(Model_Registration) $registrations
     * @return void
     */
    public static function send_confirmation($name, $email, $registrations)
    {
        $title = 'Hello, World';
        $body = 'This is my body, it is nice.';
        $to = "$name <$email>";

        $headers  = 'From: Bolknoms <no-reply@bolk.nl>'.PHP_EOL;
        $headers .= 'Reply-To: bestuur@nieuwedelft.nl'.PHP_EOL;

        mail($to, $title, $body, $headers);
    }
}