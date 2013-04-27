<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
                    <div id="logo">
                        <a href="http://blog.openstreetmap.org" title="OpenStreetMap blog home (recent posts)"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/osm-logo.png" width="135" height="135" alt="OSM logo" id="logo"/></a>
                        <h1>OpenStreetMap blog</h1>
                    </div>

			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
