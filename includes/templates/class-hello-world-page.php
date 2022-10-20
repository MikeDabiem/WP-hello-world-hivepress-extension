<?php
namespace HivePress\Templates;

use HivePress\Helpers as hp;

defined( 'ABSPATH' ) || exit;

class Hello_World_Page extends User_Account_Page {

	public function __construct( $args = [] ) {
		$args = hp\merge_trees(
			[
				'blocks' => [
					'page_content' => [
						'blocks' => [
							'form' => [
								'type' => 'form',
								'form'    => 'hello_world_form',
								'redirect'   => true,
								'_order' => 10,
							],
						],
					],
				],
			],
			$args
		);

		parent::__construct( $args );
	}

}