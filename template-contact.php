<?php
/*
Template Name: Contact
*/
?>

<?php

$nameError = '';
$emailError = '';
$commentError = '';

if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your email address.';
			$hasError = true;
		} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}

		if(trim($_POST['comments']) === '') {
			$commentError = 'Please enter a message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		if(!isset($hasError)) {
			$emailTo = get_option('tz_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}

} ?>
<?php get_header(); ?>

            <!--BEGIN .page-header -->
            <div class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php if ( current_user_can( 'edit_post', $post->ID ) ):
				    edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' );
				endif; ?>
            <!--END .page-header -->
            </div>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<!--BEGIN .entry-content -->
					<div class="entry-content">

				<?php if(isset($emailSent) && $emailSent == true) { ?>

					<div class="thanks">
						<p><?php _e('Thanks, your email was sent successfully.', 'framework') ?></p>
					</div>

				<?php } else { ?>

					<?php the_content(); ?>

					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php _e('Sorry, an error occured.', 'framework') ?><p>
					<?php } ?>
	<p>Please provide the following info regarding your case: state and county which you reside, State and county of case, your needs, the paperwork you have already and if your case has been filed.
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
						<ul class="contactform">
							<li><label for="contactName"><?php _e('Name:', 'framework') ?></label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<span class="error"><?php echo $nameError; ?></span>
								<?php } ?>
							</li>

							<li><label for="email"><?php _e('Email:', 'framework') ?></label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?php echo $emailError; ?></span>
								<?php } ?>
							</li>

							<li class="textarea"><label for="commentsText"><?php _e('Message:', 'framework') ?></label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError; ?></span>
								<?php } ?>
							</li>

							<li class="buttons">
								<input type="hidden" name="submitted" id="submitted" value="true" />
								<button type="submit"><?php _e('Send Email', 'framework') ?></button>
							</li>
						</ul>
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
				<!--END .hentry-->
				</div>

				<?php endwhile; endif; ?>

			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
