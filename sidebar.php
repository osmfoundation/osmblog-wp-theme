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
                <a href="<?php echo esc_attr(get_bloginfo( 'url' )); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?> home (recent posts)"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/osm-logo.png" width="135" height="135" alt="OSM logo" id="logo"/></a>
                <h1><?php echo esc_attr(get_bloginfo( 'name' )); ?></h1>
            </div>

            <?php if (wp_count_posts()->publish > 1) { ?>
                <aside id="rss-widget">
                    <h3 class="widget-title">Subscribe</h3>
                    <div class="rss-content">
                        <a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" width="40" height="40" alt="RSS" class="rss-icon"/></a>
                        via RSS
                    </div>
                </aside>
            <?php } ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->
    <?php endif; ?>
