<?php
namespace HivePress\Controllers;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Blocks;

defined( 'ABSPATH' ) || exit;

final class Hello_World extends Controller {

	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'routes' => [
                    'hello_world_page' => [
                        'title'     => esc_html__( 'Hello World', 'hello-world' ),
                        'base'      => 'user_account_page',
                        'path'      => '/hello-world',
                        'redirect'  => [ $this, 'redirect_hello_world' ],
                        'action'    => [ $this, 'render_hello_world' ],
                        'paginated' => true,
                    ],
                    'hello_world_form' => [
                        'base'   => 'user_name',
                        'path'   => '/change',
                        'method' => 'POST',
                        'action' => [ $this, 'change_user_name' ],
                        'rest'   => true,
                    ],
				],
			],
			$args
		);

		parent::__construct( $args );
	}
	
    public function redirect_hello_world() {
        $user = wp_get_current_user();

        if ($user->exists()) {
            if ( $user->roles[0] === 'administrator' && strtotime($user->data->user_registered) < time() - 3600 ) {
                return false;
            }
        }
        return home_url();
    }

    public function render_hello_world() {
        return ( new Blocks\Template(
            [
                'template' => 'hello_world_page',
            ]
        ) )->render();
    }

    public function change_user_name( $request ) {
        $user = wp_get_current_user();
        $user_id = $user->ID;
        global $wpdb;
        
        if ($user->user_login != 'Hello World') {
            $wpdb->update(
                $wpdb->users,
                ['user_login' => 'Hello World'],
                ['ID' => $user_id],
            );
        } else {
            $wpdb->update(
                $wpdb->users,
                ['user_login' => 'John Doe'],
                ['ID' => $user_id],
            );
        }
        
        return hp\rest_response(
            200,
            [
                'data' => [],
                ]
        );
    }
}