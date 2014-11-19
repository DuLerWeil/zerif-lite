<?php get_header(); ?>


<?php
	if(isset($_POST['submitted'])) :


			/* name */


			if(trim($_POST['myname']) === ''):


				$nameError = __('* Please enter your name.','zerif-lite');


				$hasError = true;


			else:


				$name = trim($_POST['myname']);


			endif;


			/* email */


			if(trim($_POST['myemail']) === ''):


				$emailError = __('* Please enter your email address.','zerif-lite');


				$hasError = true;


			elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :


				$emailError = __('* You entered an invalid email address.','zerif-lite');


				$hasError = true;


			else:


				$email = trim($_POST['myemail']);


			endif;


			/* subject */


			if(trim($_POST['mysubject']) === ''):


				$subjectError = __('* Please enter a subject.','zerif-lite');


				$hasError = true;


			else:


				$subject = trim($_POST['mysubject']);


			endif;


			/* message */


			if(trim($_POST['mymessage']) === ''):


				$messageError = __('* Please enter a message.','zerif-lite');


				$hasError = true;


			else:


				$message = stripslashes(trim($_POST['mymessage']));


			endif;





			/* send the email */


			if(!isset($hasError)):


				$zerif_contactus_email = get_theme_mod('zerif_contactus_email');
				
				if( empty($zerif_contactus_email) ):
				
					$emailTo = get_theme_mod('zerif_email');
				
				else:
					
					$emailTo = $zerif_contactus_email;
				
				endif;


				if(isset($emailTo) && $emailTo != ""):

					if( empty($subject) ):
						$subject = 'From '.$name;
					endif;

					$body = "Name: $name \n\nEmail: $email \n\n Subject: $subject \n\n Message: $message";


					$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;


					wp_mail($emailTo, $subject, $body, $headers);


					$emailSent = true;


				else:


					$emailSent = false;


				endif;


			endif;


		endif;



	$zerif_bigtitle_show = get_theme_mod('zerif_bigtitle_show');

	if( isset($zerif_bigtitle_show) && $zerif_bigtitle_show != 1 ):

		include get_template_directory() . "/sections/big_title.php";
	endif;


?>


</header> <!-- / END HOME SECTION  -->


<div id="content" class="site-content">



<?php

	/* OUR FOCUS SECTION */

	$zerif_ourfocus_show = get_theme_mod('zerif_ourfocus_show');

	if( isset($zerif_ourfocus_show) && $zerif_ourfocus_show != 1 ):
		include get_template_directory() . "/sections/our_focus.php";
	endif;


	/* RIBBON WITH BOTTOM BUTTON */


	include get_template_directory() . "/sections/ribbon_with_bottom_button.php";







	/* ABOUT US */

	$zerif_aboutus_show = get_theme_mod('zerif_aboutus_show');

	if( isset($zerif_aboutus_show) && $zerif_aboutus_show != 1 ):

		include get_template_directory() . "/sections/about_us.php";
	endif;


	/* OUR TEAM */

	$zerif_ourteam_show = get_theme_mod('zerif_ourteam_show');

	if( isset($zerif_ourteam_show) && $zerif_ourteam_show != 1 ):

		include get_template_directory() . "/sections/our_team.php";
	endif;


	/* TESTIMONIALS */

	$zerif_testimonials_show = get_theme_mod('zerif_testimonials_show');

	if( isset($zerif_testimonials_show) && $zerif_testimonials_show != 1 ):

		include get_template_directory() . "/sections/testimonials.php";
	endif;




	/* RIBBON WITH RIGHT SIDE BUTTON */


	include get_template_directory() . "/sections/ribbon_with_right_button.php";

	/* CONTACT US */
	$zerif_contactus_show = get_theme_mod('zerif_contactus_show');

	if( isset($zerif_contactus_show) && $zerif_contactus_show != 1 ):
		?>
		<section class="contact-us" id="contact">
			<div class="container">
				<!-- SECTION HEADER -->
				<div class="section-header">
					<h2 class="white-text"><?php _e('Get in touch','zerif-lite'); ?></h2>
					<?php
						$zerif_contactus_subtitle = get_theme_mod('zerif_contactus_subtitle');
						if(isset($zerif_contactus_subtitle) && $zerif_contactus_subtitle != ""):
							echo '<h6 class="white-text">'.$zerif_contactus_subtitle.'</h6>';
						endif;
					?>
				</div>
				<!-- / END SECTION HEADER -->

				<!-- CONTACT FORM-->
				<div class="row">

					<?php

						if(isset($emailSent) && $emailSent == true) :

							echo '<p class="error white-text">'.__('Thanks, your email was sent successfully!','zerif-lite').'</p>';

						elseif(isset($_POST['submitted'])):

							echo '<p class="error white-text">'.__('Sorry, an error occured.','zerif-lite').'<p>';

						endif;



						if(isset($nameError) && $nameError != '') :

							echo '<p class="error white-text">'.$nameError.'</p>';

						endif;

						if(isset($emailError) && $emailError != '') :

							echo '<p class="error white-text">'.$emailError.'</p>';

						endif;

						if(isset($subjectError) && $subjectError != '') :

							echo '<p class="error white-text">'.$subjectError.'</p>';

						endif;

						if(isset($messageError) && $messageError != '') :

							echo '<p class="error white-text">'.$messageError.'</p>';

						endif;

					?>

					<form role="form" method="POST" action="" onSubmit="this.scrollPosition.value=document.body.scrollTop" class="contact-form">

						<input type="hidden" name="scrollPosition">

						<input type="hidden" name="submitted" id="submitted" value="true" />

						<div class="col-lg-4 col-sm-4" data-scrollreveal="enter left after 0s over 1s">

							<input type="text" name="myname" placeholder="Your Name" class="form-control input-box" value="<?php if(isset($_POST['myname'])) echo $_POST['myname'];?>">

						</div>

						<div class="col-lg-4 col-sm-4" data-scrollreveal="enter left after 0s over 1s">

							<input type="email" name="myemail" placeholder="Your Email" class="form-control input-box" value="<?php if(isset($_POST['myemail'])) echo $_POST['myemail'];?>">

						</div>

						<div class="col-lg-4 col-sm-4" data-scrollreveal="enter left after 0s over 1s">

							<input type="text" name="mysubject" placeholder="Subject" class="form-control input-box" value="<?php if(isset($_POST['mysubject'])) echo $_POST['mysubject'];?>">

						</div>

						<div class="col-md-12" data-scrollreveal="enter right after 0s over 1s">

							<textarea name="mymessage" class="form-control textarea-box" placeholder="Your Message"><?php if(isset($_POST['mymessage'])) { echo stripslashes($_POST['mymessage']); } ?></textarea>

						</div>
	
						<?php
							$zerif_contactus_button_label = get_theme_mod('zerif_contactus_button_label','Send Message');
							if( !empty($zerif_contactus_button_label) ):
								echo '<button class="btn btn-primary custom-button red-btn" type="submit" data-scrollreveal="enter left after 0s over 1s">'.$zerif_contactus_button_label.'</button>';
							endif;
						?>
						
					</form>

				</div>

				<!-- / END CONTACT FORM-->

			</div> <!-- / END CONTAINER -->

		</section> <!-- / END CONTACT US SECTION-->
		<?php
	endif;

}
get_footer(); ?>
