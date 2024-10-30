<?php
/* Plugin Name: Mobile Contact Buttons
Description: Adds Call, Email and SMS buttons on bottom of website. Only for Mobile View of website. The plugin will use default call, text and email providers installed on user phone.
Version: 1.3
Author URI: http://linkeri.net
Author:Dijana Jugurdzija, Numana SEO
*/ 

function cubm_mobile_contact_buttons_deactivation() { 
} 
register_deactivation_hook(__FILE__, 'cubm_mobile_contact_buttons_deactivation'); 


function cubm_mobile_contact_buttons_activate() {
} 
register_activation_hook( __FILE__, 'cubm_mobile_contact_buttons_activate' ); 


function cubm_mobile_contact_buttons_css_files() {
	wp_enqueue_style( 'cubm-mobile-contact-buttons-css-file', plugins_url('css/cubm-style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'cubm_mobile_contact_buttons_css_files' );


function cubm_mobile_contact_buttons_customize_register( $wp_customize ) {	
  $wp_customize->add_section( 'cubm_data', array(
	  'title' => __( 'Mobile Contact Buttons ', 'cubm' )
  ));
	
	$wp_customize->add_setting( 'cubm_showup', array(
  'default' => 'noshow',
) );

$wp_customize->add_control( 'cubm_showup', array(
  'type' => 'radio',
  'section' => 'cubm_data', 
  'label' => __( 'Show SMS Button' ),
  'choices' => array(
    'show' => __( 'Yes' ),
    'noshow' => __( 'No' ),
  ),

) );
  $wp_customize->add_setting(
		  'cubm_color', array (
			  'default' => '#3394bf',
			  'type' => 'option'
		  )
	  );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'cubm_color',
		array (
			'label' =>  __( 'Background Color', 'cubm' ),
			'section' => 'cubm_data',
			'settings' => 'cubm_color',
			'description' =>__( 'Background color for buttons', 'cubm' ),
		)
	));

    $wp_customize->add_setting(
		  'cubm_call', array (
			  'default' => '+1',
			  'type' => 'option'
		  )
	  );
	$wp_customize->add_control(
		'cubm_call',
		array (
			'label' =>  __( 'Phone Number', 'cubm' ),
			'section' => 'cubm_data',
			'settings' => 'cubm_call',
		  'description' =>__( 'Phone Number for Calls', 'cubm' ),
	));

    $wp_customize->add_setting(
		  'cubm_email', array (
			  'default' => 'example@gmail.com',
			  'type' => 'option'
		  )
	  );
	$wp_customize->add_control(
		'cubm_email',
		array (
			'label' =>  __( 'Email Address', 'cubm' ),
			'section' => 'cubm_data',
			'settings' => 'cubm_email'
	));
  
    $wp_customize->add_setting(
		  'cubm_sms', array (
			  'default' => '+1',
			  'type' => 'option'
		  )
	  );
	$wp_customize->add_control(
		'cubm_sms',
		array (
			'label' =>  __( 'SMS Number', 'cubm' ),
			'section' => 'cubm_data',
			'settings' => 'cubm_sms',
			'description' =>__( 'Phone Number for SMS', 'cubm' ),
	));
  
   
}
add_action( 'customize_register', 'cubm_mobile_contact_buttons_customize_register' );

function cubm_mobile_contact_buttons_custom_content() {
$cubm_showup=get_theme_mod('cubm_showup');
$cubm_color = get_option( 'cubm_color' );
$cubm_call = get_option('cubm_call');
$cubm_email = get_option('cubm_email');
$cubm_sms = get_option('cubm_sms');
  ?>
<div id="mobile_contact_buttons_container">
	<?php if($cubm_showup=='show'){?>
	<div id="mobile_contact_buttons">
		<div class="col-xs-4 mobile_contact_buttons_call">
			<a href="tel:<?php echo $cubm_call;?>">
			<i class="fa fa-phone"></i>
			<span>Call</span>
			</a>
		</div>
		<div class="col-xs-4 mobile_contact_buttons_email">
			<a href="mailto:<?php echo $cubm_email;?>">
			<i class="fa fa-envelope"></i>
			<span>Email</span>
			</a>
		</div>
		<div class="col-xs-4 mobile_contact_buttons_sms">
			<a href="sms:<?php echo $cubm_sms;?>">
			<i class="fa fa-comment"></i>
			<span>SMS</span>
			</a>
		</div>
	</div>
<?php
	}
	else{
?>

	<div id="mobile_contact_buttons2">
		<div class="col-xs-6 mobile_contact_buttons_call2">
			<a href="tel:<?php echo $cubm_call;?>">
			<i class="fa fa-phone"></i>
			<span>Call</span>
			</a>
		</div>
		<div class="col-xs-6 mobile_contact_buttons_email2">
			<a href="mailto:<?php echo $cubm_email;?>">
			<i class="fa fa-envelope"></i>
			<span>Email</span>
			</a>
		</div>
		</div>
    <?php
}
	?>
	</div>
<style>
#mobile_contact_buttons, #mobile_contact_buttons2{
	background:<?php echo $cubm_color;?> !important;
  }
	
</style>
<?php
}
add_action('wp_footer', 'cubm_mobile_contact_buttons_custom_content');
?>