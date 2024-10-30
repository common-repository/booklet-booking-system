<?php 

class Booklet_Admin{
	
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
            'Settings Admin', 
            'Booklet Settings', 
            'manage_options', 
            'booklet-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'booklet_option_name' );
        ?>
        <div class="wrap">
            <h2><?php esc_html_e( 'Booklet Settings', 'voip' ); ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'booklet_option_group' );   
                do_settings_sections( 'booklet-setting-admin' );
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
            'booklet_option_group', // Option group
            'booklet_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Booklet Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'booklet-setting-admin' // Page
        );  
        add_settings_field(
            'booklet_form_title', // ID
            'Form Title', // Title 
            array( $this, 'booklet_form_title_callback' ), // Callback
            'booklet-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'booklet_form_subtitle', 
            'Form Sub Title', 
            array( $this, 'booklet_form_subtitle_callback' ), 
            'booklet-setting-admin', 
            'setting_section_id'
        );
        add_settings_field(
            'booklet_from_email', 
            'From Email ID', 
            array( $this, 'booklet_from_email_callback' ), 
            'booklet-setting-admin', 
            'setting_section_id'
        );
		
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['booklet_form_title'] ) )
            $new_input['booklet_form_title'] = sanitize_text_field( $input['booklet_form_title'] );

        if( isset( $input['booklet_form_subtitle'] ) )
            $new_input['booklet_form_subtitle'] = sanitize_text_field( $input['booklet_form_subtitle'] ); 

        if( isset( $input['booklet_from_email'] ) )
            $new_input['booklet_from_email'] = sanitize_text_field( $input['booklet_from_email'] ); 
		
		
		
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
		print '<p>You can show booking form using shortcode bellow: </p>';
		print '<p><code>[booklet-form]</code></p>';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function booklet_form_title_callback()
    {
        printf(
            '<input type="text" id="booklet_form_title" name="booklet_option_name[booklet_form_title]" placeholder="Restaurant Booking Form" value="%s" />',
            isset( $this->options['booklet_form_title'] ) ? esc_attr( $this->options['booklet_form_title']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function booklet_form_subtitle_callback()
    {
        printf(
            '<input type="text" id="booklet_form_subtitle" name="booklet_option_name[booklet_form_subtitle]" placeholder="" value="%s" />',
            isset( $this->options['booklet_form_subtitle'] ) ? esc_attr( $this->options['booklet_form_subtitle']) : ''
        );
		
    }
    /** 
     * Get the settings option array and print one of its values
     */
    public function booklet_from_email_callback()
    {
        printf(
            '<input type="text" id="booklet_from_email" name="booklet_option_name[booklet_from_email]" placeholder="support@yourdomain.com" value="%s" />',
            isset( $this->options['booklet_from_email'] ) ? esc_attr( $this->options['booklet_from_email']) : ''
        );
		
    }	

	
}

$BookletAdmin = new Booklet_Admin();