<?php


namespace Jet_Forms_NPR\Jet_Form_Builder;


class Action_Manager {

	public function __construct() {
		add_action(
			'jet-form-builder/actions/register',
			array( $this, 'register_actions' )
		);
	}

	public function register_actions( $manager ) {
		$manager->register_action_type( new Redirect_To_New_Post() );
	}

}