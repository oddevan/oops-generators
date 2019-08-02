<?php
/**
 * Class for generating custom post types
 *
 * @since 0.1
 * @package oddevan\oopsGenerators
 */

namespace oddevan\oopsGenerators;

class PostType {
	public static function go( $config, $args ) : int {
		if ( ! is_array( $args ) || empty( $args ) ) {
			self::help_text();
			return 0;
		}

		foreach ( $args as $cptname ) {
			$class_namespace = $config['base_namespace'] . 'Content\\PostType\\';
			$class_file      = $config['base_dir'] . 'Content/PostType/' . $cptname . '.php';

			echo "Generating Custom Post Type {$cptname} at {$class_file}...";

			//\ob_start();
?>
 //phpcs:ignore Wordpress.Files.Filename
/**
 * A general description of your post type
 *
 * @since 0.0.0
 * @package <?php echo $config['base_namespace']; ?>
 */

namespace <?php echo $class_namespace; ?>;

use WebDevStudios\OopsWP\Structure\Content\PostType;

/**
 * A general description of your post type
 *
 * @since 0.0.0
 */
class <?php echo \Inflector::classify( $cptname ); ?> extends PostType {
	/**
	 * Permalink slug for this post type
	 *
	 * @var string $slug Permalink prefix
	 * @since 0.1.0
	 */
	protected $slug = '<?php echo str_replace( '_', '-', \Inflector::tableize( $cptname ) ); ?>';

	/**
	 * Override the superclass method and provide the labels array
	 * for registering the Connection post type
	 *
	 * @return Array labels for post type.
	 * @author me@eph.me
	 * @since 0.1.0
	 */
	protected function get_labels() : array {
		return [
			'name'                  => _x( '<?php echo Inflector::pluralize( $cptname ); ?>', 'Post Type General Name', 'smolblog' ),
			'singular_name'         => _x( '<?php echo Inflector::singularize( $cptname ); ?>', 'Post Type Singular Name', 'smolblog' ),
			'menu_name'             => __( '<?php echo Inflector::pluralize( $cptname ); ?>', 'smolblog' ),
			'name_admin_bar'        => __( '<?php echo Inflector::singularize( $cptname ); ?>n', 'smolblog' ),
			'archives'              => __( '<?php echo Inflector::singularize( $cptname ); ?> Archives', 'smolblog' ),
			'attributes'            => __( '<?php echo Inflector::singularize( $cptname ); ?> Attributes', 'smolblog' ),
			'parent_item_colon'     => __( 'Parent <?php echo Inflector::singularize( $cptname ); ?>:', 'smolblog' ),
			'all_items'             => __( 'All <?php echo Inflector::pluralize( $cptname ); ?>', 'smolblog' ),
			'add_new_item'          => __( 'Add New <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'add_new'               => __( 'Add New', 'smolblog' ),
			'new_item'              => __( 'New <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'edit_item'             => __( 'Edit <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'update_item'           => __( 'Update <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'view_item'             => __( 'View <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'view_items'            => __( 'View <?php echo Inflector::pluralize( $cptname ); ?>', 'smolblog' ),
			'search_items'          => __( 'Search <?php echo Inflector::pluralize( $cptname ); ?>', 'smolblog' ),
			'not_found'             => __( 'Not found', 'smolblog' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'smolblog' ),
			'featured_image'        => __( 'Featured Image', 'smolblog' ),
			'set_featured_image'    => __( 'Set featured image', 'smolblog' ),
			'remove_featured_image' => __( 'Remove featured image', 'smolblog' ),
			'use_featured_image'    => __( 'Use as featured image', 'smolblog' ),
			'insert_into_item'      => __( 'Insert into <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'uploaded_to_this_item' => __( 'Uploaded to this <?php echo Inflector::singularize( $cptname ); ?>', 'smolblog' ),
			'items_list'            => __( '<?php echo Inflector::pluralize( $cptname ); ?> list', 'smolblog' ),
			'items_list_navigation' => __( '<?php echo Inflector::pluralize( $cptname ); ?> list navigation', 'smolblog' ),
			'filter_items_list'     => __( 'Filter <?php echo Inflector::pluralize( $cptname ); ?> list', 'smolblog' ),
		];
	}

	/**
	 * Override the superclass method and provide the args array
	 * for registering the Connection post type
	 *
	 * @return Array information for post type.
	 * @author me@eph.me
	 * @since 0.1.0
	 */
	protected function get_args() : array {
		return [
		];
	}
}

<?php
			$output = \ob_end_flush();
			echo '<' . '?php' . $output;
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
