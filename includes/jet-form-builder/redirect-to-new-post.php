<?php


namespace Jet_Forms_NPR\Jet_Form_Builder;


use Jet_Form_Builder\Actions\Action_Handler;
use Jet_Form_Builder\Actions\Types\Base;
use Jet_Form_Builder\Exceptions\Action_Exception;
use Jet_Forms_NPR\Plugin;

class Redirect_To_New_Post extends Base {

	public function __construct() {
		parent::__construct();

		add_action( 'jet-form-builder/action/after-post-insert', function () {
			Plugin::instance()->is_new_post = true;
		} );
	}

	public function get_id() {
		return 'redirect_to_new_post';
	}

	public function get_name() {
		return __( 'Redirect to New Post', 'jet-forms-new-post-redirect-notification' );
	}

	public function do_action( array $request, Action_Handler $handler ) {
		$post_id = $handler->get_inserted_post_id();

		if ( ! Plugin::instance()->is_new_post || ! $post_id ) {
			return;
		}

		$url = get_permalink( $post_id );

		if ( $request['__is_ajax'] ) {
			$handler->add_response( array(
				'redirect' => $url
			) );
		} else {
			wp_safe_redirect( $url );
			die();
		}
	}

	public function visible_attributes_for_gateway_editor() {
		return array();
	}

	public function self_script_name() {
		return '';
	}

	public function editor_labels() {
		return array();
	}
}