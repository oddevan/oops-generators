<?php
/**
 * Main class for launching the generators
 *
 * @since 0.1
 * @package oddevan\oopsGenerators
 */

namespace oddevan\oopsGenerators;

class Main {
	public static function go( \Composer\Script\Event $event ) : int {
		$args = $event->getArguments();

		print_r( $args );
		echo "\n\n";

		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}
		return 0;
	}

	private static function help_text() {
?>
Generators for OOPS-WP
======================

Usage: composer oopsgen -- [type] [name]

Types
-----
cpt - Custom Post Type
tax - Custom Taxonomy
<?php
	}
}