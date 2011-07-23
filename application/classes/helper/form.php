<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Form
{
    /**
     * Formats errors in a readable way using HTML
     * @param object $object must be a child of the ORM-class
     */
    public static function error_messages_for($object)
    {
        $fields = $object->validation()->errors('errors');

        // Don't output anything when the errors-array is empty
        if (sizeof($fields) === 0) {
            return;
        }

        echo '<div class="notification error">';
        echo '<p><strong>De wijzigingen konden niet worden opgeslagen:</strong></p>';

        echo '<ul>';

        foreach ($fields as $field => $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul></div>';
    }
}