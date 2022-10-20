<?php
namespace HivePress\Forms;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Form class.
 */
class Hello_World_Form extends Form {

	/**
	 * Class constructor.
	 *
	 * @param array $args Form arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'description' => esc_html__( 'Hello World Form', 'hello-world-form' ),
				'action'      => hivepress()->router->get_url( 'hello_world_form' ),
				'method'      => 'POST',
				'redirect'    => true,
				'reset'       => true,

				'fields'      => [
					'hello' => [
						'label' => 'Hello',
						'type' => 'text',
						'required' => false,
						'_order' => 1,
					],
					'world' => [
						'label' => 'World',
						'type' => 'text',
						'required' => false,
						'_order' => 2,
					],
				],

				'button'      => [
					'label' => esc_html__( 'Change name', 'hello-world-form' ),
				],
			],
			$args
		);

		parent::__construct( $args );
	}
}