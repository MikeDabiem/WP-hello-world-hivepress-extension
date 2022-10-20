<?php
namespace HivePress\Components;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Emails;

defined( 'ABSPATH' ) || exit;

final class Hello_World extends Component {

	public function __construct( $args = [] ) {
		// Attach functions to hooks here (e.g. add_action, add_filter).
		add_filter( 'hivepress/v1/menus/user_account', [ $this, 'add_menu_item' ] );
		add_filter( 'hivepress/v1/templates/page_sidebar_left', [ $this, 'add_hello_world_button' ] );

		parent::__construct( $args );
	}

	// Implement the attached functions here.
	public function add_menu_item( $menu ) {
		$menu['items']['hello_world_item'] = [
			'route'  => 'hello_world_page',
			'_order' => 1,
		];
		
		return $menu;
	}

	public function add_hello_world_button( $template ) {
		if ( hivepress()->request->get_context( 'listing' ) ) {
			return hp\merge_trees(
				$template,
				[
					'blocks' => [
						'page_sidebar' => [
							'blocks' => [
								'hello_world_button' => [
									'type' => 'form',
									'form' => 'hello_world_button',
									'_order'  => 123,
								],
							],
						],
					],
				],
			);
		} else {
			return $template;
		}
	}
}