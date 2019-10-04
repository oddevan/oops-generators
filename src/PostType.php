<?php
/**
 * Class for generating custom post types
 *
 * @since 0.1
 * @package oddevan\oopsGenerators
 */

namespace oddevan\oopsGenerators;

use Doctrine\Common\Inflector\Inflector;

class PostType {
	public static function go( $config, $args ) : int {
		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}

		foreach ( $args as $cptname ) {
			$class_namespace = $config['base_namespace'] . 'Content\\PostType';
			$class_file      = $config['base_directory'] . 'Content/PostType/' . Inflector::classify( $cptname ) . '.php';

			echo "Generating Custom Post Type {$cptname} at {$class_file}...\n";

			\ob_start();
?>
 //phpcs:ignore Wordpress.Files.Filename
/**
 * A general description of your post type
 *
 * @since <?php echo $config['version'] . "\n"; ?>
 * @package <?php echo $config['package'] . "\n"; ?>
 */

namespace <?php echo $class_namespace; ?>;

use WebDevStudios\OopsWP\Structure\Content\PostType;

/**
 * A general description of your post type
 *
 * @since <?php echo $config['version'] . "\n"; ?>
 */
class <?php echo Inflector::classify( $cptname ); ?> extends PostType {
	/**
	 * Permalink slug for this post type
	 *
	 * @var string $slug Permalink prefix
	 * @since <?php echo $config['version'] . "\n"; ?>
	 */
	protected $slug = '<?php echo str_replace( '_', '-', Inflector::tableize( $cptname ) ); ?>';

	/**
	 * Override the superclass method and provide the labels array
	 * for registering the <?php echo Inflector::classify( $cptname ); ?> post type
	 *
	 * @return Array labels for post type.
<?php if ( $config['author'] ) : ?>
	 * @author <?php echo $config['author'] . "\n"; ?>
<?php endif; ?>
	 * @since <?php echo $config['version'] . "\n"; ?>
	 */
	protected function get_labels() : array {
		return [
			'name'                  => _x( '<?php echo Inflector::pluralize( $cptname ); ?>', 'Post Type General Name', '<?php echo $config['text_domain']; ?>' ),
			'singular_name'         => _x( '<?php echo Inflector::singularize( $cptname ); ?>', 'Post Type Singular Name', '<?php echo $config['text_domain']; ?>' ),
			'menu_name'             => __( '<?php echo Inflector::pluralize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'name_admin_bar'        => __( '<?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'archives'              => __( '<?php echo Inflector::singularize( $cptname ); ?> Archives', '<?php echo $config['text_domain']; ?>' ),
			'attributes'            => __( '<?php echo Inflector::singularize( $cptname ); ?> Attributes', '<?php echo $config['text_domain']; ?>' ),
			'parent_item_colon'     => __( 'Parent <?php echo Inflector::singularize( $cptname ); ?>:', '<?php echo $config['text_domain']; ?>' ),
			'all_items'             => __( 'All <?php echo Inflector::pluralize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'add_new_item'          => __( 'Add New <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'add_new'               => __( 'Add New', '<?php echo $config['text_domain']; ?>' ),
			'new_item'              => __( 'New <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'edit_item'             => __( 'Edit <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'update_item'           => __( 'Update <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'view_item'             => __( 'View <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'view_items'            => __( 'View <?php echo Inflector::pluralize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'search_items'          => __( 'Search <?php echo Inflector::pluralize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'not_found'             => __( 'Not found', '<?php echo $config['text_domain']; ?>' ),
			'not_found_in_trash'    => __( 'Not found in Trash', '<?php echo $config['text_domain']; ?>' ),
			'featured_image'        => __( 'Featured Image', '<?php echo $config['text_domain']; ?>' ),
			'set_featured_image'    => __( 'Set featured image', '<?php echo $config['text_domain']; ?>' ),
			'remove_featured_image' => __( 'Remove featured image', '<?php echo $config['text_domain']; ?>' ),
			'use_featured_image'    => __( 'Use as featured image', '<?php echo $config['text_domain']; ?>' ),
			'insert_into_item'      => __( 'Insert into <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'uploaded_to_this_item' => __( 'Uploaded to this <?php echo Inflector::singularize( $cptname ); ?>', '<?php echo $config['text_domain']; ?>' ),
			'items_list'            => __( '<?php echo Inflector::pluralize( $cptname ); ?> list', '<?php echo $config['text_domain']; ?>' ),
			'items_list_navigation' => __( '<?php echo Inflector::pluralize( $cptname ); ?> list navigation', '<?php echo $config['text_domain']; ?>' ),
			'filter_items_list'     => __( 'Filter <?php echo Inflector::pluralize( $cptname ); ?> list', '<?php echo $config['text_domain']; ?>' ),
		];
	}

	/**
	 * Override the superclass method and provide the args array
	 * for registering the <?php echo Inflector::classify( $cptname ); ?> post type
	 *
	 * @return Array information for post type.
<?php if ( $config['author'] ) : ?>
	 * @author <?php echo $config['author'] . "\n"; ?>
<?php endif; ?>
	 * @since <?php echo $config['version'] . "\n"; ?>
	 */
	protected function get_args() : array {
		return [
		];
	}
}

<?php
			$output = \ob_get_contents();
			\ob_end_clean();

			$fileout = fopen( $class_file, 'w' );
			fwrite( $fileout, '<' . '?php' . $output );
			fclose( $fileout );
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
