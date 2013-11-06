<?php 

namespace Rhodium\Helpers;

use Rhodium\Helpers\FormHelperAbstract;

class FormHelper extends FormHelperAbstract
{
	public function input( $params )
	{
		return $this->inputElement( $params );
	}

	public function select( $params )
	{
		return $this->selectElement( $params );
	}

	public function create( $form, $collection )
	{
		return $this->form( $form, $collection );
	}

	public function load( $template )
	{
		$template = $this->template( $template );

		return $template;
	}
}