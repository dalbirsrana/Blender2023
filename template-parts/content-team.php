<?php
//  Our Team 
    if (!empty($args)) {
        $args += [	'post_type' 	=> 'team',
                    'post_status' 	=> 'publish',
                    // 'orderby'		=> 'meta_value_num',
                    // 'meta_key'		=> 'order'
                ];
    } else {
        $args = array(
            'post_type' 	=> 'team',
            'post_status' 	=> 'publish',
            'category_name' => 'advisors',
            // 'meta_key'		=> 'order',
            // 'orderby'		=> 'meta_value_num',
            'order'			=> 'ASC'
        );
    }
    $arr_team = new WP_Query( $args );
    ?>

    <div class="row">
    <?php
    if ( $arr_team->have_posts() ) :
        while ( $arr_team->have_posts() ) : $arr_team->the_post();

            ?>
            <div class="item col-md-6 col-xxl-4">

                <div class="item__preview hidden">
                    <div class="image">
                        <?php the_post_thumbnail(); ?>
                        <div>
                            <h6 class="name"><?php echo the_title(); ?></h6>
                            <p class="title small"><?php echo get_field("sub_title"); ?></p>
                        </div>
                    </div>
                    <div class="text">
                        <?php 
                            $content = get_the_content();
                            $content = strip_tags($content);
                            if (strlen($content) > 130) :
                                echo substr( $content, 0, 130 ) . '...';
                            else :
                                echo $content;
                            endif;
                         ?>
                    </div>
                </div>


                <div class="item__body">
                    <div class="hold">
                        <div class="row">
                            <div class="col-sm-4 image"><?php the_post_thumbnail(); ?></div>
                            <div class="col-sm-8 text">
                                <h6 class="name"><?php echo the_title(); ?></h6>
                                <p class="title small"><?php echo get_field("sub_title"); ?></p>
                                <?php the_content(); ?>
                            </div>
                            <a href="#" class="close"><i class="fas fa-times-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    
            <?php
        endwhile;
    endif;
    wp_reset_query();