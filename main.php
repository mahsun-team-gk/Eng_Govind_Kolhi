<!-- all function		 -->
		<?php
		session_start();
		?>
		<?php
		// Include necessary files
		require_once ("General.php");
		// require_once ("Posts.php");

		// Display header
		General::site_header();

		// Display navbar
		General::site_navbar();

		// Display login modal
		// General::login_modal();

		// Display register modal
		// register::site_register();

		// Display main section
		General::site_section();
		General::site_posts();		
		// General::site_postss();
		// one remove commment


		General::site_footer();
		// General::site_contact_us();

		// Display footer scripts
		General::footer_scripts();

		//	 uploads/6826e7bf3af0f_1.png
		
	
		?>
<!-- all function		 -->
