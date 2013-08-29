<?php 

namespace Core;

use Core\Helpers\Rummage;

/**
 * Mailer
 *
 * Basic mailer class for
 * sending basic email requests.
 *
 * @todo This will need to incorporate
 * twig at a later date.
 */
class Mailer
{
	/**
	 * send
	 *
	 * Sends mail.
	 * 
	 * @param  string|array $recipient array of email addresses 
	 *                                 or single email address.
	 * @param  string $subject   Mail subject.
	 * @param  string $message   Mail body.
	 * @return bool              True if mail sends.
	 */
	public function send($recipient, $subject, $message)
	{
		// Checks if one or more email addresses.
		if ( is_array( $recipient ) ) {

			// Foreach email address.
			foreach ( $recipient as $r ) {

				// Sends mail to each recipient.
				mail( $r, $subject, $message );
			}
		}

		// Sends mail to single recipient.
		mail( $recipient, $subject, $message );
	}
}