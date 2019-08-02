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
		$composer_extra = $event->getComposer()->getPackage()->getExtra();
		$args           = $event->getArguments();

		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}

		if ( ! isset( $composer_extra['oopsgen'] ) ||
			! isset( $composer_extra['oopsgen']['base_namespace'] ) ||
			! isset( $composer_extra['oopsgen']['base_dir'] ) ) {
				echo 'Please make sure your `base_namespace` and `base_dir` are set in your composer.json!';
				return 1;
		}

		$config = $composer_extra['oopsgen'];
		$type   = array_shift( $args );

		switch ( $type ) {
			case 'cpt':
				PostType::go( $config, $args );
				return 0;
		}

		self::help_text();
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