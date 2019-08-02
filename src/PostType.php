<?php
/**
 * Class for generating custom post types
 *
 * @since 0.1
 * @package oddevan\oopsGenerators
 */

namespace oddevan\oopsGenerators;

class PostType {
	public static function go( $args ) : int {
		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}

		foreach ( $args as $cptname ) {
			echo "Generating Custom Post Type {$cptname} (but not really)...\n";
		}

		return 0;
	}

	private static function help_text() {
?>
Generators for OOPS-WP
======================

Usage: composer oopsgen -- cpt [name]

Will generate a custom post type for each [name] provided.
<?php
	}
}