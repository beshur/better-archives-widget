<?php 

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'baw_widgetarchives_register_widgets' );

 //register our widget
function baw_widgetarchives_register_widgets() {
    register_widget( 'baw_widgetarchives_widget_my_archives' );
}

//boj_widget_my_archives class
class baw_widgetarchives_widget_my_archives extends WP_Widget {

    //process the new widget
    function baw_widgetarchives_widget_my_archives() {
        $widget_ops = array( 
            'classname' => 'baw_widgetarchives_widget_class', 
            'description' => 'Display links to archives grouped by year then month.' 
            ); 
        $this->WP_Widget( 'baw_widgetarchives_widget_my_archives', 'Custom Archives Widget', $widget_ops );
    }

     //build the widget settings form
    function form( $instance ) {
        $defaults = array( 'title' => 'archives' ); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $exclude = $instance['exclude'];

        ?>
            <p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"  type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
            <p>Exclude Tag: <input placeholder="One tag ID" class="widefat" name="<?php echo $this->get_field_name( 'exclude' ); ?>"  type="text" value="<?php echo esc_attr( $exclude ); ?>" /></p>
        <?php
    }
 
    //save the widget settings
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['exclude'] = strip_tags( $new_instance['exclude'] );
 
        return $instance;
    }
 
    //display the widget
    function widget( $args, $instance ) {
        extract( $args );
 
        echo $before_widget;
        $title = apply_filters( 'widget_title', $instance['title'] );
        $exclude = $instance['exclude'];
 
        if ( ! empty( $title ) ) { 
            echo $before_title . $title . $after_title; 
        };
         
         // years - months
    global $wpdb;
        $prevYear = "";
        $currentYear = "";

        $months = $wpdb->get_results("SELECT DISTINCT DATE_FORMAT(post_date, '%b') AS month, MONTH(post_date) AS numMonth, YEAR( post_date ) AS year, COUNT( id ) AS post_count FROM $wpdb->posts WHERE ID NOT IN (SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id IN ('".$exclude."') ) AND post_status = 'publish' AND post_date <= now( ) AND post_type = 'post'GROUP BY month , year ORDER BY post_date DESC" );
        if ( $months) {
        echo '<ul>';
        

            foreach ( $months as $month ) {
                $currentYear = $month->year;
                if ( ( $currentYear != $prevYear ) && ( $prevYear != "" ) ) { echo "</ul></li>"; }
                if ( $currentYear != $prevYear ) {
                ?>
                <li class="baw-year"><a href="<?php echo get_year_link( $month->year ); ?>"><?php echo $month->year; ?></a>
                <ul class="baw-months">
                <?php
                } ?>
                <li class="baw-month"><a href="<?php echo get_month_link( $month->year, $month->numMonth ); ?>"><?php echo $month->month; ?><?php echo ' ' . $month->year; ?></a></li>
                <?php
                $prevYear = $month->year;
            }//end foreach
        }
        ?>
        </ul></li><?php
        echo '</ul>';
        echo $after_widget;
    }
}
?>