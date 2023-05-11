<?php
//upcomming Events
$today = date("Ymd");
$args = array(
    'post_type' 	=> 'post',
    'post_status' 	=> 'publish',
    'category_name' => 'events',
    'meta_key' => 'event_end_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'posts_per_page' => 20,
    'meta_query' => array(
        array(
          'key' => 'event_end_date',
          'value' => $today,
          'compare' => '>='  // for past events 'compare' => '<'
        )
      ),
);
$events = new WP_Query( $args );
?>

<?php if ( $events->have_posts() ) : ?>
    <section class="events">
        <div class="container">
            <h3>Events</h3>
            <p>Here are some key dates in the CNR calendar, where we expect to be either speaking or attending.<br>
                If you'd like to arrange a meeting at an event, don't hesitate to get in contact</p>

            <div class="row">
                <?php while ( $events->have_posts() ) : $events->the_post(); ?>
                    <div class="col-sm-6 col-xl-4">
                        <div class="item">
                            <?php 
                                $start_date = get_field("event_start_date");
                                $end_date = get_field("event_end_date");   
                                $index = strpos($end_date, ',');
                                $end_date = substr($end_date, 0, $index);
                            ?>
                            <time>
                                <?php if ( strcmp($start_date, $end_date) !== 0 ) { the_field("event_start_date"); echo " - "; } ?>
                                <?php the_field("event_end_date"); ?>
                            </time>

                            <?php if ( get_field("event_website_url") ) : ?>
                                <h6 class="name">
                                    <a href="<?php echo get_field("event_website_url")['url']; ?>" target="_blank"><?php the_title(); ?><i class="fa fa-external-link-alt"></i></a>
                                </h6>
                            <?php else: ?>
                                <h6 class="name">
                                   <?php the_title(); ?>
                                </h6>
                            <?php endif; ?>                            
                            <address><?php echo get_field("event_location"); ?></address>
                            <div class="text"><?php the_content(); ?></div>
                            <div class="expand">[+]</div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif;
wp_reset_query();