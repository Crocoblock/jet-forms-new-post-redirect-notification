<?php


namespace Jet_Forms_NPR;


class Notification
{
    public $slug = 'redirect_to_new_post';
    public $plugin;
    public $is_new_post = false;

    public function __construct( ) {
        $this->plugin = Plugin::instance();
        $this->hooks();
    }

    public function hooks() {
        add_filter(
            'jet-engine/forms/booking/notification-types',
            array( $this, 'register_notification' )
        );
        add_action(
            'jet-engine/forms/booking/notification/' . $this->slug,
            array( $this, 'handle_notification' ), 0, 2
        );
        add_filter(
            'jet-engine/forms/insert-post/pre-check',
            array( $this, 'is_new_post' ), 99, 2
        );
    }

    /**
     * Register new notification type
     *
     * @return [type] [description]
     */
    public function register_notification( $notifications ) {
        $notifications[ $this->slug ] = __( 'Redirect to New Post' );
        return $notifications;
    }

    public function is_new_post( $res, $postarr ) {
        // Apply restrictions only for post inserting, not the update
        if ( empty( $postarr['ID'] ) ) {
            $this->is_new_post = true;
        }
        return $res;
    }

    public function handle_notification( $notification, $form ) {
        $form->log[] = true;

        if ( ! $form->is_success() ) {
            return;
        }

        if ( $this->is_new_post && isset( $form->handler->form_data['inserted_post_id'] ) ) {

            $post_id = $form->handler->form_data['inserted_post_id'];
            $url = site_url() . '?p=' . $post_id;

            if ( ! $form->handler->is_ajax() ) {
                wp_safe_redirect( $url );
                die();
            } else {
                $form->handler->add_response_data( array( 'redirect' => $url ) );
            }

        }
    }

}