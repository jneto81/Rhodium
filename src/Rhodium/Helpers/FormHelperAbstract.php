<?php 

namespace Rhodium\Helpers;

use Rhodium\Helpers\Rummage;
/**
 * FormHelperAbstract
 *
 * Ewan's first Abstract Class
 *
 * @author 		Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright  	Ewan Valentine - Rhodium 2013
 */
abstract class FormHelperAbstract
{	

	abstract protected function input( $params );
	abstract protected function select( $params );
	abstract protected function create( $form, $collections );
	abstract protected function load( $template );

	// Common functions

	/**
	 * input
	 *
	 * Creates basic input form elements.
	 * 	
	 * @param  array $params Array of form params.
	 * @return string        Formatted HTML data.
	 */
	public function inputElement( $params )
	{
		$input = '<input type="'.$params['type'].'" 
		name="'.$params['name'].'" 
		class="'.$params['class'].'" 
		id="'.$params['id'].'" 
		placeholder="'.$params['placeholder'].'" '.$params['required'].'/>';

		return $input;
	}

	public function submitElement( $params )
	{
		$input = '<input type="submit" 
		name="'.$params['name'].'"
		class="'.$params['class'].'"
		id="'.$params['id'].'"
		value="'.$params['value'].'" />';

		return $input;
	}

	public function selectElement( $params )
	{
		$select = '<select name="'.$params['name'].'" 
		id="'.$params['id'].'"
		class="'.$params['class'].'">';

		foreach ( $params['options'] as $key => $option ) {
			$select .= "<option value='".$key."''>" . $option . "";
		}

		$select .= '</select>';

		return $select;
	}

	public function template( $template )
	{
		$this->rummage = new Rummage();
		$path = $this->rummage->getConfigPath() . '/forms';
		$file = $this->rummage->setFileLocation( $path, $template, 'json' );
		
		$form = $this->rummage->parseJSONAsArray();

		foreach ( $form as $key => $form ) {
			
			if( $key != 'form' ) {
				$collection[$key] = $form;
			}
		}

		foreach ( $collection as $key => $element ) {

			if ( $key == 'select' ) {
				$html[] = $this->selectElement( $element );
			}

			if ( $key == 'input' ) {
				$html[] = $this->inputElement( $element );
			}

			if( $key == 'submit' ) {
				$html[] = $this->submitElement( $element );
			}

			if( $key == 'password' ) {
				$html[] = $this->inputElement( $element );
			}
		}

		$form = $this->form( $form, $html );

		return $form;
	}

	/**
	 * form
	 *
	 * Creates form element.
	 * 			
	 * @param  array  $params     Array of form parameters.
	 * @param  array  $collection Array of form elements.
	 * @return string             Formated HTML data.
	 */
	public function form( $params, $collection )
	{
		$form = '<form action="'.$params['action'].'" 
		method="'.$params['method'].'" 
		class="'.$params['class'].'" id="'.$params['id'].'">';
		
		foreach ( $collection as $element ) {
			$form .= "\n";
			$form .= $element;
		}
		
		$form .= "</form>";

		return $form;
	}
}