<?php
/**
 * Template Name: About Page
 * Template for the About page
 *
 * @package Slumber_Falls
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- Breadcrumb -->
		<nav class="breadcrumb bg-gray-100 py-3 px-4" aria-label="<?php esc_attr_e( 'Breadcrumb', 'slumber-falls' ); ?>">
			<div class="container mx-auto">
				<ol class="flex items-center space-x-2 text-sm list-none">
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-[#558EAF] hover:underline">
							<?php esc_html_e( 'Home', 'slumber-falls' ); ?>
						</a>
					</li>
					<li>
						<span class="text-gray-400 mx-2">&gt;</span>
					</li>
					<li class="text-gray-600" aria-current="page">
						<?php esc_html_e( 'About', 'slumber-falls' ); ?>
					</li>
				</ol>
			</div>
		</nav>

		<!-- Hero Section -->
		<header class="page-header bg-[#558EAF] text-white py-16 px-4">
			<div class="container mx-auto text-center">
				<h1 class="text-4xl md:text-5xl font-bold mb-4">
					<?php the_title(); ?>
				</h1>
				<p class="text-xl text-blue-100 max-w-3xl mx-auto">
					Building campfires and community since 1958
				</p>
			</div>
		</header>

		<!-- Main Content -->
		<div class="container mx-auto px-4 py-12">

			<!-- Our Story Section -->
			<section class="about-section mb-16">
				<div class="max-w-4xl mx-auto">
					<h2 class="text-3xl font-bold text-[#558EAF] mb-6">Our Story</h2>
					<div class="prose prose-lg max-w-none">
						<p class="mb-4">
							For over 68 years, Slumber Falls Camp & Retreat Center has been a cornerstone of faith-based outdoor education in the heart of Texas Hill Country. Founded in 1958 by a group of dedicated church leaders, our camp began with a simple but powerful vision: to create a place where young people could experience the transformative power of nature, community, and faith.
						</p>
						<p class="mb-4">
							What started as a humble collection of cabins along the Guadalupe River has grown into a thriving 200-acre camp and retreat center. Through the decades, we've welcomed tens of thousands of campers, from energetic elementary students experiencing their first night away from home to teenagers discovering their calling, to families seeking to reconnect with each other and their faith.
						</p>
						<p>
							Today, Slumber Falls continues to honor its founding mission while embracing modern best practices in youth development, environmental stewardship, and inclusive programming. Our legacy is built not just in buildings and grounds, but in the countless lives touched, friendships forged, and faith strengthened under the Texas stars.
						</p>
					</div>
				</div>
			</section>

			<!-- Our Mission Section -->
			<section class="about-section mb-16 bg-gray-50 -mx-4 px-4 py-12">
				<div class="max-w-4xl mx-auto">
					<h2 class="text-3xl font-bold text-[#558EAF] mb-6">Our Mission</h2>
					<div class="prose prose-lg max-w-none mb-6">
						<p>
							At Slumber Falls, we believe that the combination of outdoor adventure, intentional community, and faith-centered teaching creates an environment where young people can thrive. Our mission is guided by three core pillars:
						</p>
					</div>
					<div class="grid md:grid-cols-3 gap-8">
						<div class="mission-card bg-white p-6 rounded-lg shadow-md">
							<h3 class="text-xl font-bold text-[#558EAF] mb-3">Faith-Based Values</h3>
							<p>
								We provide a welcoming Christian environment where campers explore their faith, ask big questions, and experience God's love through worship, Bible study, and meaningful conversations.
							</p>
						</div>
						<div class="mission-card bg-white p-6 rounded-lg shadow-md">
							<h3 class="text-xl font-bold text-[#558EAF] mb-3">Outdoor Education</h3>
							<p>
								Through canoeing, hiking, swimming, and outdoor skills training, we teach campers to appreciate creation, develop confidence, and build resilience in the face of challenges.
							</p>
						</div>
						<div class="mission-card bg-white p-6 rounded-lg shadow-md">
							<h3 class="text-xl font-bold text-[#558EAF] mb-3">Character Development</h3>
							<p>
								Camp is where leadership is learned, friendships are deepened, and values like kindness, courage, and integrity are practiced daily in a supportive community.
							</p>
						</div>
					</div>
				</div>
			</section>

			<!-- Our Team Section -->
			<section class="about-section mb-16">
				<div class="max-w-4xl mx-auto">
					<h2 class="text-3xl font-bold text-[#558EAF] mb-6">Our Team</h2>
					<div class="prose prose-lg max-w-none mb-8">
						<p>
							Slumber Falls is blessed with a dedicated team of professional staff, seasonal counselors, and volunteers who share a passion for youth ministry and outdoor education. Our leadership team brings decades of combined experience in camping, education, and ministry.
						</p>
					</div>
					<!-- Team members grid -->
					<?php
					// Get team member data from custom fields.
					$director_photo    = get_post_meta( get_the_ID(), 'director_photo', true );
					$director_bio      = get_post_meta( get_the_ID(), 'director_bio', true );
					$program_dir_photo = get_post_meta( get_the_ID(), 'program_director_photo', true );
					$program_dir_bio   = get_post_meta( get_the_ID(), 'program_director_bio', true );

					// Default bio text if none provided.
					$default_director_bio = 'Our executive director oversees all camp operations, program development, and strategic planning. With a heart for ministry and years of camping experience, they ensure every camper has a safe, meaningful experience.';
					$default_program_bio  = 'Our program director designs engaging activities that balance fun and learning, ensuring each camp session offers diverse experiences from outdoor adventures to creative arts and worship.';
					?>
					<div class="grid md:grid-cols-2 gap-8">
						<!-- Camp Director -->
						<div class="team-member bg-gray-50 p-6 rounded-lg">
							<?php if ( $director_photo ) : ?>
								<div class="mb-4 rounded-lg overflow-hidden">
									<?php echo wp_get_attachment_image( $director_photo, 'medium', false, array( 'class' => 'w-full h-48 object-cover' ) ); ?>
								</div>
							<?php else : ?>
								<div class="bg-gray-300 h-48 mb-4 rounded-lg flex items-center justify-center">
									<span class="text-gray-500">[Director Photo]</span>
								</div>
							<?php endif; ?>
							<h3 class="text-xl font-bold mb-2">Camp Director</h3>
							<p class="text-gray-700">
								<?php echo esc_html( $director_bio ? $director_bio : $default_director_bio ); ?>
							</p>
						</div>

						<!-- Program Director -->
						<div class="team-member bg-gray-50 p-6 rounded-lg">
							<?php if ( $program_dir_photo ) : ?>
								<div class="mb-4 rounded-lg overflow-hidden">
									<?php echo wp_get_attachment_image( $program_dir_photo, 'medium', false, array( 'class' => 'w-full h-48 object-cover' ) ); ?>
								</div>
							<?php else : ?>
								<div class="bg-gray-300 h-48 mb-4 rounded-lg flex items-center justify-center">
									<span class="text-gray-500">[Program Director Photo]</span>
								</div>
							<?php endif; ?>
							<h3 class="text-xl font-bold mb-2">Program Director</h3>
							<p class="text-gray-700">
								<?php echo esc_html( $program_dir_bio ? $program_dir_bio : $default_program_bio ); ?>
							</p>
						</div>
					</div>
				</div>
			</section>

			<!-- Facilities & Grounds Section -->
			<section class="about-section mb-16 bg-gray-50 -mx-4 px-4 py-12">
				<div class="max-w-4xl mx-auto">
					<h2 class="text-3xl font-bold text-[#558EAF] mb-6">Facilities & Grounds</h2>
					<div class="prose prose-lg max-w-none mb-6">
						<p>
							Nestled along the Guadalupe River in New Braunfels, Texas, our 200-acre property offers the perfect blend of natural beauty and modern amenities. The camp's setting provides endless opportunities for adventure while maintaining the comfort and safety families expect.
						</p>
					</div>
					<div class="grid md:grid-cols-2 gap-6">
						<ul class="space-y-2">
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Climate-controlled cabins with modern bathrooms</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Olympic-size swimming pool with lifeguard station</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Outdoor chapel and amphitheater</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Recreation hall with games and activities</span>
							</li>
						</ul>
						<ul class="space-y-2">
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Riverside access for canoeing and fishing</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>High and low ropes courses</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Nature trails and outdoor classroom spaces</span>
							</li>
							<li class="flex items-start">
								<span class="text-[#558EAF] mr-2">✓</span>
								<span>Commercial kitchen and dining hall</span>
							</li>
						</ul>
					</div>
				</div>
			</section>

			<!-- Safety & Accreditation Section -->
			<section class="about-section mb-16">
				<div class="max-w-4xl mx-auto">
					<h2 class="text-3xl font-bold text-[#558EAF] mb-6">Safety & Accreditation</h2>
					<div class="prose prose-lg max-w-none">
						<p class="mb-6">
							The safety and wellbeing of our campers is our highest priority. Slumber Falls maintains rigorous safety standards and protocols that meet or exceed industry best practices.
						</p>
						<div class="bg-blue-50 border-l-4 border-[#558EAF] p-6 mb-6">
							<h3 class="text-xl font-bold mb-3">Our Commitment to Safety</h3>
							<ul class="space-y-2">
								<li><strong>Licensed & Inspected:</strong> Fully licensed by the Texas Department of State Health Services as a youth camp</li>
								<li><strong>Certified Staff:</strong> All counselors complete comprehensive training in first aid, CPR, water safety, and emergency response</li>
								<li><strong>Background Checks:</strong> Mandatory background screenings for all staff and volunteers</li>
								<li><strong>Low Camper-to-Staff Ratios:</strong> We maintain small group sizes to ensure individual attention and safety</li>
								<li><strong>Emergency Protocols:</strong> 24/7 on-site medical staff, detailed emergency action plans, and regular safety drills</li>
								<li><strong>Lifeguard Training:</strong> All waterfront activities supervised by certified lifeguards</li>
							</ul>
						</div>
						<p>
							Parents can rest assured that their children are in caring, capable hands. We maintain open communication with families throughout the camp experience and welcome questions about our safety practices.
						</p>
					</div>
				</div>
			</section>

			<!-- Call to Action -->
			<section class="cta-section text-center py-12">
				<div class="max-w-3xl mx-auto">
					<h2 class="text-3xl font-bold mb-4">Ready to join the Slumber Falls family?</h2>
					<p class="text-xl text-gray-700 mb-8">
						Discover our summer camps and retreat programs designed to inspire, challenge, and transform young lives.
					</p>
					<a href="<?php echo esc_url( home_url( '/camps/' ) ); ?>" class="inline-block bg-[#558EAF] text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-[#467396] transition-colors shadow-lg">
						Explore Our Camps
					</a>
				</div>
			</section>

		</div>

	<?php endwhile; ?>

</main><!-- #primary -->

<?php get_template_part( 'template-parts/sections/pre-footer-cta', null, array( 'wave_from' => 'white' ) ); ?>

<?php
get_footer();
