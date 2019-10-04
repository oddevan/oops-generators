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
		$composer_pkg   = $event->getComposer()->getPackage();
		$composer_extra = $composer_pkg->getExtra();
		$composer_autoload = $composer_pkg->getAutoload();
		$args           = $event->getArguments();

		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}

		if ( ! isset( $composer_autoload ) ||
			! isset( $composer_autoload['psr-4'] ) ) {
				echo "Please make sure your psr-4 autoloader is set in your composer.json!\n";
				return 1;
		}

		$config = [
			'package' => $composer_pkg->getName(),
			'version' => $composer_pkg->getPrettyVersion() ?? 'dev-master',
		];
		$config['base_namespace'] = array_keys( $composer_autoload['psr-4'] )[0];
		$config['base_directory'] = $composer_autoload['psr-4'][ $config['base_namespace'] ];
		$type   = array_shift( $args );

		switch ( $type ) {
			case 'cpt':
				PostType::go( $config, $args );
				return 0;

			case 'debug':
				print_r( $composer_pkg->getName() );
				echo "\n---\n";
				print_r( $composer_pkg->getTargetDir() );
				echo "\n---\n";
				print_r( $composer_pkg->getVersion() );
				echo "\n---\n";
				print_r( $composer_pkg->getPrettyVersion() );
				echo "\n---\n";
				print_r( $composer_pkg->getAutoload() );
				echo "\n---\n";
				print_r( $composer_pkg->getAuthors() );
				echo "\n---\n";
				print_r( $composer_pkg->getConfig() );
				echo "\n---\nConfig:\n";
				print_r( $config );
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