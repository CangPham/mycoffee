<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class coffeeking_Widget_Icons extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $this->prefix = "icons";
        $widget_ops = array( 'description' => esc_html__( 'Display font-awesome icons', 'coffeeking' ) );
        parent::__construct( false, esc_html__( 'Like-Themes Icons', 'coffeeking' ), $widget_ops );
        
        // Create our options by using Unyson option types
        $this->options = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'coffeeking'),
            ),
			'list-type' => array(
				'label' => esc_html__( 'List type', 'coffeeking' ),
				'type' => 'radio',
				'choices' => array(
					'icons-list' => esc_html__( 'List with icons and text on right side', 'coffeeking' ),
					'icons-inline-large' => esc_html__( 'Large icons inline list', 'coffeeking' ),
					'icons-inline-small' => esc_html__( 'Small icons inline list', 'coffeeking' ),
				), 'value' => esc_html__( 'icons-inline-small', 'coffeeking' ),
			),
			'items' => array(
				'label' => esc_html__( 'Items', 'coffeeking' ),
				'type' => 'addable-box',
				'value' => array(),
				'desc' => esc_html__( 'Items list with text on left side and button on right', 'coffeeking' ),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'coffeeking' ),
						'type'  => 'icon',
					),
					'text' => array(
						'label' => esc_html__( 'Text', 'coffeeking' ),
						'desc' => esc_html__( 'If needed', 'coffeeking' ),
						'type' => 'text',
					),
					'href' => array(
						'label' => esc_html__( 'Link', 'coffeeking' ),
						'desc' => esc_html__( 'If needed', 'coffeeking' ),
						'type' => 'text',
						'value' => '#',
					),
                    'antispam' => array(
                        'label' => esc_html__( 'Antispam bot', 'coffeeking' ),
                        'desc' => esc_html__( 'Will encode e-mail in text field to secure it from spam bots.', 'coffeeking' ),
                        'type' => 'checkbox',
                    ),                    
				),
				'template' => '{{- text }}',
			),
        );

        add_action("admin_enqueue_scripts", array($this, "print_widget_javascript"));
    }
 
    function widget( $args, $instance ) {

        if ( !function_exists( 'fw' ) ) return false;

        extract( $args );
        $params = array();
 
        foreach ( $instance as $key => $value ) {
            $params[ $key ] = $value;
        }

        $instance = $params;
        if ( file_exists( LTX_PLUGIN_DIR . 'widgets/' . $this->prefix . '/views/widget.php' ) ) {

            include LTX_PLUGIN_DIR . 'widgets/' . $this->prefix . '/views/widget.php';
        }
    }
 
    function update( $new_instance, $old_instance ) {

        if ( !function_exists( 'fw' ) ) return false;

        return fw_get_options_values_from_input(
            $this->options,
            FW_Request::POST(fw_html_attr_name_to_array_multi_key($this->get_field_name($this->prefix)), array())
        );
    }
 
    function form( $values ) {
 
        $prefix = $this->get_field_id($this->prefix); // Get unique prefix, preventing dupplicated key
        $id = 'fw-widget-options-'. $prefix;
 
        // Print our options
        echo '<div class="fw-force-xs fw-theme-admin-widget-wrap" id="'. esc_attr($id) .'">';
        
        if ( function_exists( 'fw' ) ) {

            echo fw()->backend->render_options($this->options, $values, array(
                'id_prefix' => $prefix .'-',
                'name_prefix' => $this->get_field_name($this->prefix),
            ));
        }
            else {

            echo "<p>" . esc_html__( 'Widget requires Unyson Framework installed', 'coffeeking' ) . "</p>";
        }

        echo '</div>';

        return $values;
    }
    
    /*
     * Initialize options after saving.
     */
    function print_widget_javascript() {

    	wp_add_inline_script( 'jquery-core', '
            jQuery(function($) {

                function coffeekingWidgetsReinit(selector) {                  

                    var timeoutId;
                    $("#" + selector).on("remove", function(){ // ReInit options on html replace (on widget Save)

                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                            fwEvents.trigger("fw:options:init", { $elements: $("#" + selector) });
                            coffeekingWidgetsReinit(selector);
                        }, 100);
                    });           
                }

                $("#widgets-right .fw-theme-admin-widget-wrap").each(function(i, el) { 
                    coffeekingWidgetsReinit($(this).attr("id"));
                });
            });
        ' );
    }
}

