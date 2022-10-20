<?php
namespace HivePress\Forms;

use HivePress\Helpers as hp;

defined( 'ABSPATH' ) || exit;

class Hello_World_Button extends Form {

	public function __construct( $args = [] ) {

		$args = hp\merge_arrays(
			[
				'action' => hivepress()->router->get_url('hello_world_page'),
                'redirect' => true,
                'button' => [
					'label' => esc_html__( 'Hello World', 'hello_world' ),
				],
			],
			$args
		);

		parent::__construct( $args );
	}
}
