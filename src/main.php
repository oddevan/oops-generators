<?php
/**
 * Main class for launching the generators
 *
 * @since 0.1
 * @package oddevan\oopsGenerators
 */

namespace oddevan\oopsGenerators;

class Main {
	static function go( Event $event ) {
		$args = $event->getArguments();

		print_r( $args );
	}
}