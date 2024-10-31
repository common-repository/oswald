<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class oswaldSettings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Oswald',
            'Oswald',
            'administrator',
            'oswald',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'oswald_options' );
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'oswald_option_group' );
                do_settings_sections( 'oswald' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'oswald_option_group', // Option group
            'oswald_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'oswald_section', // ID
            'Oswald Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'oswald' // Page
        );

        add_settings_field(
            'owl_js', // ID
            'Enqueue Owl Carousel js', // Title
            array( $this, 'owl_js_callback' ), // Callback
            'oswald', // Page
            'oswald_section' // Section
        );

        add_settings_field(
            'owl_css', // ID
            'Enqueue Owl Carousel css', // Title
            array( $this, 'owl_css_callback' ), // Callback
            'oswald', // Page
            'oswald_section' // Section
        );

        add_settings_field(
            'fa', // ID
            'Enqueue Font Awesome', // Title
            array( $this, 'fa_callback' ), // Callback
            'oswald', // Page
            'oswald_section' // Section
        );

        add_settings_field(
            'emoji', // ID
            'Dequeue Emojis', // Title
            array( $this, 'emoji_callback' ), // Callback
            'oswald', // Page
            'oswald_section' // Section
        );

        add_settings_field(
            'lazyLoad', // ID
            'Include Lazy Load Script', // Title
            array( $this, 'lazyLoad_callback' ), // Callback
            'oswald', // Page
            'oswald_section' // Section
        );
    }

    public function sanitize( $input )
    {
        $newInput = array();
        //Owl JS
        if(isset($input['owl_js']))
            $newInput['owl_js'] = true;
        else
            $newInput['owl_js'] = false;

        //Owl CSS
        if(isset($input['owl_css']))
            $newInput['owl_css'] = true;
        else
            $newInput['owl_css'] = false;

        //FA
        if(isset($input['fa']))
            $newInput['fa'] = true;
        else
            $newInput['fa'] = false;

        //Emoji
        if(isset($input['emoji']))
            $newInput['emoji'] = true;
        else
            $newInput['emoji'] = false;

        //lazyLoad
        if(isset($input['lazyLoad']))
            $newInput['lazyLoad'] = true;
        else
            $newInput['lazyLoad'] = false;

        return $newInput;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        return;
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function owl_js_callback()
    {
        printf(
            '<input type="checkbox" id="owl_js" name="oswald_options[owl_js]" %s />',
            $this->options['owl_js'] ? 'checked' : ''
        );
    }

    public function owl_css_callback()
    {
        printf(
            '<input type="checkbox" id="owl_css" name="oswald_options[owl_css]" %s />',
            $this->options['owl_css'] ? 'checked' : ''
        );
    }

    public function fa_callback()
    {
        printf(
            '<input type="checkbox" id="fa" name="oswald_options[fa]" %s />',
            $this->options['fa'] ? 'checked' : ''
        );
    }

    public function emoji_callback()
    {
        printf(
            '<input type="checkbox" id="fa" name="oswald_options[emoji]" %s />',
            $this->options['emoji'] ? 'checked' : ''
        );
    }

    public function lazyLoad_callback()
    {
        printf(
            '<input type="checkbox" id="fa" name="oswald_options[lazyLoad]" %s />',
            $this->options['lazyLoad'] ? 'checked' : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new oswaldSettings();