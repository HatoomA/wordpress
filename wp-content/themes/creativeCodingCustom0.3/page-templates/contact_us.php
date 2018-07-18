<?php
/*
 Template Name: contact_us
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/


?>

<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
						<main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<div class="contact_form_wrapper">
								<div class="alert_wrapper">
									<h1>Message Sent</h1>
									<h3>Thank you for reaching out! Expect a reply soon!</h3>
									<a id="contact_again" class="buttonLink" name="submit" type="submit">Send Another</a>
								</div>

								<div class="contact_us_form_wrapper">
									<h1>We'd Love to Hear From You!</h1>
									<form method='POST' id="contact_us_form">
										<input name="name" type="text" placeholder="Your Name">
										<input name="email" type="email" placeholder="Your Email Address">
										<select name="target">
		      						<option value="teachers" disabled selected>What is your inquiry?</option>
											<option value="parentsupport">Questions about our classes or your student</option>
											<option value="press">Press inquiries</option>
											<option value="jobs">Employment opportunities</option>
											<option value="learn">Interested in bringing Creative Coding to your school or organization</option>
											<option value="teachers">Business/Partnership inquiries</option>
											<option value="jack">IT/Bug Reports</option>
											<option value="teachers">Other questions</option>
										</select>
										<textarea name="message" form="contact_us_form" placeholder="Your message here"></textarea>
										<input class="buttonLink" name="submit" type="submit">
										<span class="sending_icon">sending</span>
									</form>
								</div>
							</div>
						</main>
				</div>
			</div>

<?php get_footer(); ?>
