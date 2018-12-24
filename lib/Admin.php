<?php

namespace Alexa_Flash_Briefing_Feed;

class Admin {

	function activate() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_init', [ $this, 'admin_init' ] );
	}

	function admin_menu() {
		add_options_page(
			__( 'Alexa Flash Briefing Feed', 'alexa-flash-briefing-feed' ),
			__( 'Alexa Flash Briefing Feed', 'alexa-flash-briefing-feed' ),
			'manage_options',
			__( 'Alexa Flash Briefing Feed', 'alexa-flash-briefing-feed' ),
			[ $this, "display" ]
		);
	}

	function admin_init() {
		register_setting(
			'alexa-flash-briefing-feed',
			'alexa-flash-briefing-feed'
		);

		add_settings_section(
			'basic_settings',
			__( 'Basic Settings', 'alexa-flash-briefing-feed' ),
			null,
			'alexa-flash-briefing-feed'
		);

		add_settings_field(
			'endpoint',
			__( 'Endpoint URL', 'alexa-flash-briefing-feed' ),
			[ $this, 'endpoint_callback' ],
			'alexa-flash-briefing-feed',
			'basic_settings'
		);
	}

	function endpoint_callback() {
		?>
		<p><code><?php echo esc_url( $endpoint ); ?></code></p>
		<p><code><?php echo esc_url( get_rest_url( null, 'afbf/v1/briefings' ) ); ?></code></p>
		<?php
		if ( ! is_ssl() ) {
			?>
			<p>
				<span class="dashicons dashicons-warning" aria-hidden="true"></span>
				<?php _e( 'SSL is recommended for endpoints.', 'alexa-flash-briefing-feed' ); ?>
			</p>
			<?php
		}
	}

	function display() {
		?>
		<h1><?php _e( 'Alexa Flash Briefing Feed', 'alexa-flash-briefing-feed' ); ?></h1>
		<?php
		settings_fields( 'alexa-flash-briefing-feed' );
		do_settings_sections( 'alexa-flash-briefing-feed' );
		?>
		<?php
	}
}
