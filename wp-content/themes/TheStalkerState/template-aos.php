<?php 
/*
Template Name: Architecture of Surveillance
Template Post Type: post, page
Template Description: Template for AoS immersive experience
Template styles: template-single
*/
if(isset($config_mode) && $config_mode){


  $options   = array();
  $options['displays']['option_name']           	= esc_html__('Display / Hide Elements', 'narratium');
  $options['displays']['option_description']     	= esc_html__("Check the elements to display in this template.", 'narratium');
  $options['displays']['option_priority'] 				= 1;
  $options['displays']['option_type']            	= 'checkboxes';
  $options['displays']['option_type_vars']				= array(
                                                    'post_categories' => esc_html__('Post categories', 'narratium'),
                                                    'post_author' => esc_html__('Post author', 'narratium'),
                                                    'post_comments_count' => esc_html__('Post comments count', 'narratium'),
                                                    'post_categories' => esc_html__('Post categories', 'narratium'),
                                                    'post_date' => esc_html__('Post date', 'narratium'),
                                                  );
  $options['displays']['option_default']					= array(
                                                    'post_categories' => 1,
                                                    'post_author' => 1,
                                                    'post_comments_count' => 1,
                                                    'post_categories' => 1,
                                                    'post_date' => 1,
                                                  );

  if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
    $options['displays']['option_type_vars']['post_read_time'] = esc_html__('Post read time', 'narratium');
    $options['displays']['option_default']['post_read_time'] = 1;
  }






  /**
  * Posts per page
  */
  $options['posts_per_page']['option_name']             = esc_html__('Posts per page', 'narratium');
  $options['posts_per_page']['option_description']      = esc_html__("You can select how many posts per page are going to be shown by this template.", 'narratium');
  $options['posts_per_page']['option_priority'] 	      = 5;
  $options['posts_per_page']['option_type']             = 'select';
  $options['posts_per_page']['option_type_vars']			  = array_merge(array('' => esc_html__("default", 'narratium')), array_combine(range(1,30), range(1,30)));
  $options['posts_per_page']['option_default']					= '';




  return $options;

}



get_header();
?>

  <div data-flex data-layout="column"  data-layout-align="center stretch">
    <div  id="site-body" <?php if (is_single()) post_class();?>>

    		<div class="typography-responsive site-body-content-wrap max-width-1500">
    			<div class="margin-auto site-typeface-content site-body-content padding-left-0 padding-right-0 typo-size-content">


            <?php if (!$wp_query->posts) {?>
                <div data-flex >
                  <div class="typo-size-upper-big icon-emo-unhappy"></div>
                  <div class="typo-size-medium padding-top-20 typo-weight-300"><?php esc_html_e('Sorry, no results found.', 'narratium');?></div>
                </div>
            <?php } ?>


            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>



                  <?php if (is_single() || is_page()) {?>
                  	<div class="aos-immersive">
                  		<audio src="/wp-content/themes/TheStalkerState/assets/music/c-thru-inst.mp3"></audio>
                        <div class="audio-controls"><span id="audioToggle" class="audio-toggle">Play</span></div>

						<div class="aos-infographic_intro">
							<h1 class="aos-page-title"><a href="https://thestalkerstate.org/architecture-of-surveillance/"><?php the_title(); ?></a></h1>
							<div class="aos-infographic__nav">
								<a href="#" class="button m-hidden" id="infographicPrev"><img src="/wp-content/themes/TheStalkerState/assets/images/arrow-left.svg" alt="Previous Button"/></a>
								<a href="#" class="button" id="infographicNext"><img src="/wp-content/themes/TheStalkerState/assets/images/arrow-right.svg" alt="Next Button"/></a>
							</div>
						</div>
						<div class="aos-infographic">
							<div class="aos-infographic__info">
								<div class="aos-infographic__display">
								</div>
								<div class="aos-infographic__text" id="infographic__text-intro">
								  <p>Without the massive amounts of surveillance equipment deployed by LAPD, creating ever-present surveillance within communities, the operationalization of programs like Data Informed Community Focused Policing could not exist. The now defunct LASER program is an example of how location-based policing and person-based policing was dependent on CCTV, ALPRs, risk assessments, crime databases, Field Interview (FI) cards, and ArcGIS, with plans to expand the use of Palantir mobile and social network analysis into the program.</p>
								</div>
								<div class="aos-infographic__text" id="infographic__text1">
									<h2 class="aos-infographic__title">Joint Terrorism Task Force</h2>
									<ul class="aos-list">
										<li>The FBI conducts its counter-terrorism intelligence operations primarily through Joint Terrorism Task Forces (JTTF).</li>
										<li>According to the FBI’s website, over 600 state, local and federal agencies participate in JTTFs, including the U.S. military and, at one point at least, the Central Intelligence Agency (CIA).</li>
										<li>In 2004 the ACLU engaged in a FOIA campaign that uncovered FBI JTTF spying on political advocacy organizations.</li>
										<li>A follow-up Inspector General investigation proved the FBI lied to hide these improper activities from Congress and the American public.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text2">
									<h2 class="aos-infographic__title">Fusion Centers</h2>
									<p>“Mega Spy Centers”</p>
									<ul class="aos-list">
										<li>Fusion Centers are hubs, which tie local collectors and users of intelligence data into a National Information Sharing Environment (ISE).</li>
										<li>LA’s Fusion Center is officially known as the Joint Regional Intelligence Center (JRIC)- located in Norwalk, CA</li>
										<li>A US Senate Report on Fusion Centers released in October 2012 revealed that Intelligence Gathering at Fusion Centers was Useless, Flawed, Irrelevant, Inappropriate, Unrelated to Terrorism, Outdated, and Potential Violation of Privacy Act Protections.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text3">
									<h2 class="aos-infographic__title">SAR</h2>
									<p>The National Suspicious Activity Reporting (SAR) Initiative was launched in March 2008 by the LAPD with the issuance of Special Order (SO) 11.  SO11 was revised in January of 2012, operating as SO1. An additional revision in August 2012 changed the name to SO17.</p>
									<p>The SAR program criminalizes ordinary behaviors as “suspicious” and authorizes LAPD to write up secret files on individuals based on speculation and hunches. These files once gathered, are stored and shared with thousands of law enforcement and public agencies, and access to private contractors through Fusion Centers. Suspicious activities listed in SAR include using cameras in public, shooting videos, using binoculars, drawing diagrams, taking notes, and inquiring about hours of operation.The SAR program is not an evidence-based practice.  It criminalizes innocent behavior, creates a culture of suspicion and fear, promotes racial profiling, invades privacy, and wastes precious resources.</p>
									<p>A recent LAPD Inspector General audit of the SAR program released in January 2015 revealed overwhelming racial profiling of Black communities in Los Angeles:</p>
									<ul class="aos-list">
										<li>Over 30% of SARs that went to fusion centers were written on Black residents of LA.  The city’s Black population is less than 10%.</li>
										<li>In the gender count 50% of SARs that went to fusion centers were written on Black women</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text4">
									<h2 class="aos-infographic__title">iWATCH</h2>
									<p>In October 2009, LAPD launched the iWATCH — “See Something, Say Something” program.  It encourages community members to spy and report on fellow community members. A recent LAPD Inspector General audit of the SAR program released in January 2015 revealed community members initiated 81% of SARs.</p>
								</div>
								<div class="aos-infographic__text" id="infographic__text5">
									<h2 class="aos-infographic__title">ATIS-IGG</h2>
									<p>Anti-Terrorism Intelligence Section: Intelligence Gathering Guidelines.</p>
									<p>In September 2012 the Los Angeles Police Commission approved new guidelines for intelligence gathering on political groups and others engaged in social justice work.</p>
									<p>Under new guidelines:</p>
									<ul class="aos-list">
										<li>LAPD can place informants at an organization for 180 days based on a tip.</li>
										<li>LAPD officers can take on fictitious personas for online investigations such as Facebook and other web-based and social media tools</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text6">
									<h2 class="aos-infographic__title">Predictive Policing</h2>
									<p>With its history of building statistical model of “terrorist and insurgent activities” in Iraq and Afghanistan, this “new high-tech method is increasingly being used by police to crunch crime statistics and other data with algorithms to “predict” when and where future crimes are most likely to occur.</p>
									<p>By feeding history of predominantly survival crime in low income neighborhoods, predictive policing is inherently biased leading to same neighborhoods, poor neighborhoods, predominantly nonwhite communities, people of color impacted by increased police presence and police violence.</p>
								</div>
								<div class="aos-infographic__text" id="infographic__text7">
									<h2 class="aos-infographic__title">Trapwire</h2>
									<ul class="aos-list">
										<li>Street camera style surveillance system– more accurate than modern facial recognition technology</li>
										<li>Every few seconds, data picked up at surveillance points are recorded digitally on the spot, then encrypted and instantaneously delivered to a fortified central database center at an undisclosed location to be aggregated with other intelligence.</li>
										<li>Documents have revealed that LAPD has invested heavily in this.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text8">
									<h2 class="aos-infographic__title">Stingray</h2>
									<ul class="aos-list">
										<li>These devices mimic cell phone towers, electronically fooling all nearby mobile phones to send their signals into an LAPD computer.</li>
										<li>The technology sucks up the data of every cell phone in the area, and phone owners never know police are grabbing their information.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text9">
									<h2 class="aos-infographic__title">DRT</h2>
									<p>Digital Receiver Technology “dirt boxes”</p>
									<ul class="aos-list">
										<li>This is Stingray on steroids· 	LAPD has been using DRT Boxes for 10 years</li>
										<li>DRT is a Military Surveillance technology that can intercept data, calls and text messages from hundreds of cell phones simultaneously, as well as jam device transmissions</li>
										<li>The extent of proliferation of this technology in LAPD is still not known</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text10">
									<h2 class="aos-infographic__title">ALPR</h2>
									<p>Automatic License Plate Reader</p>
									<ul class="aos-list">
										<li>High-speed cameras mounted on poles and patrol cars that record every passing vehicle’s license plate, along with time, date and location.</li>
										<li>Millions are being scanned regularly</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text11">
									<h2 class="aos-infographic__title">HD Camera</h2>
									<ul class="aos-list">
										<li>LAPD uses high-definition cameras that stream video to a remote command post and is also agile enough for use in densely packed, large-crowd events.</li>
										<li>During Occupy, LAPD had a mesh system with Axis cameras deployed around the encampment at City Hall Park for most of the last few weeks it was going on.</li>
										<li>LAPD Counter Terrorism and Special Operations Bureau surveillance system includes HD cameras that can be easily installed on a temporarily basis for covert investigations and crowd control.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text12">
									<h2 class="aos-infographic__title">Body Cameras</h2>
									<ul class="aos-list">
										<li>Body Worn Cameras: An Empty Reform to Expand the Surveillance State</li>
										<li>Body Cameras have not helped enforce accountability.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text13">
									<h2 class="aos-infographic__title">Militarization</h2>
									<p>Through the Urban Area Security Initiative (UASI) and the Department of Defense 1033 program, Billions of dollars of funding and military grade equipment have been disbursed to local police departments for “counter-terrorism programs.”</p>
									<ul class="aos-list">
										<li>Between 2003 and 2012 local law enforcement agencies received over $7 Billion through UASI for “unique planning, organization, equipment training and exercise needs of high-threat, high-density urban areas that are susceptible to terrorism and other calamities.”  To date the Greater Los Angeles area has received almost $800 Million.</li>
										<li>Since 1997 the Department of Defense’s (DOD) Excess Property Program of the National Defense Authorization Act (NDAA), more commonly known as the “1033 program,” has given surplus equipment such as “office equipment, tents, generators, pick-up trucks and ATVs” as well as “military aircraft, weapons (including grenade launchers), and heavily armored tactical vehicles” to local police departments.  However, 1033 creates a perverse incentive whereby equipment given to local law enforcement “must be placed into use within one (1) year of receipt, unless the condition of the property renders it unusable.”</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text14">
									<h2 class="aos-infographic__title">Drones</h2>
									<p>In May 2014 LAPD received 2 Draganflyer X6 Drones from the Seattle Police Department for no cost.  In July 2014 the Stop LAPD Spying Coalition in partnership with several organizations launched the Drone-Free LAPD/No Drones, LA! Campaign.  The acquisition of drones by the LAPD signifies a giant step forward in the militarization of local law enforcement. The use of drone technology continues the normalization of surveillance. Drone technology in the hands of Los Angeles Police Department must be stopped because:</p>
									<ul class="aos-list">
										<li>LAPD cannot be trusted- in April 2014 it was exposed that LAPD officers sabotaged voice recording and video equipment inside patrol cars installed to monitor officer conduct;</li>
										<li>Drones open the door to an unparalleled invasion of everyone’s privacy, and create a great potential of false identification;</li>
										<li>With LAPD’s history of “Mission Creep” there is no guarantee that drones will only be used for their stated purpose;</li>
										<li>Historically drones are used to commit acts of war abroad therefore it is logical for Angeleños to question if drones open the door to usage for ”The War at Home.”</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text15">
									<h2 class="aos-infographic__title">DHS Memo</h2>
									<ul class="aos-list">
										<li>Local police forces are engaged in the planting of informants and the infiltration of organizations</li>
										<li>A July 2013 Department of Homeland Security (DHS) memo claims – “Self-Identified Anarchists Extremists Target Urban ‘Gentrification’ Sites with Arson.</li>
										<li>The memo ends with a call to file suspicious activity Reports – SARs</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text16">
									<h2 class="aos-infographic__title">Data Collection</h2>
									<ul class="aos-list">
										<li>14,200 local law enforcement agencies now have the capability to share SARs;</li>
										<li>53 federal agencies are participating in the National SAR Initiative</li>
										<li>SE/SAR shared space (fusion centers, FBI e-Guardian etc) filings nationally increased from 3256 in January 2010 to 27,855 in October 2012, a 750% jump</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text17">
									<h2 class="aos-infographic__title">Profiling</h2>
									<p>The occurrence of racial and ethnic profiling is deeply embedded in these programs.  For example the Office of Inspector General released an audit of LAPD’s SAR program in March 2013 followed by another audit released in January 2015. The March 2013 audit revealed that out of a four month sample of race/descent data, over 82% of the SARs were filed on individuals belonging to groups identified as non-white. The largest numbers of SARs were filed on African-Americans.  The January 2015 audit revealed that over 30% of SARs that went to fusion centers were written on African-Americans.  Los Angeles has less than 10% African-American population, the audit showed a 3 to 1 disproportionate impact on LA’s Black community.  In the gender count 50% of SARs were opened on Black women.</p>
								</div>
								<div class="aos-infographic__text" id="infographic__text18">
									<h2 class="aos-infographic__title">Corporate Profit</h2>
									<p>Surveillance, Spying, and Infiltration programs have been a major source of corporate profit making.  It’s not just Taser International, manufacturers and suppliers of body cameras, whose stock prices have doubled over the last year but for years hundreds and thousands of “security firms” are milking the Surveillance Industrial Complex that sees no end to the “War on Terror.” As of July 19, 2010 some 1,271 government organizations and 1,931 private companies worked on programs related to counter-terrorism, homeland security and intelligence in about 10,000 locations across the United States.</p>
								</div>
								<div class="aos-infographic__text" id="infographic__text19">
									<h2 class="aos-infographic__title">Policing Strategies and Tactics</h2>
									<ul class="aos-list">
										<li>Counter-terrorism and counter-insurgency programs have merged into everyday policing. For example, Suspicious Activity Reporting (SAR) and Predictive Policing were initially designed for counter-terrorism and counter-insurgency, but are now primary tactics of domestic policing.  Evidence shows disparate impact on non-white communities.</li>
										<li>Data collected against individuals who are not suspected of any crime, let alone terrorism, are entered into city, state and federal databases such as fusion centers where they can be retained- as in the case of the FBI, retention is allowed for up to 30 years.</li>
										<li>Mere suspicion becomes seen as “observed behavior” (behavioral surveillance or rather speculation) that is “reasonably indicative” of preoperational planning (no longer probable cause or reasonable suspicion, but now reasonable indication which is defined as an articulable “concern”). These are vague and meaningless standards with police now routinely using intelligence-led policing methodology through information gathering, storing, and sharing.</li>
										<li>Allows the routine use of innocent activity (taking pictures or using binoculars in public) as suspicious- opening formal police investigations without one’s knowledge.</li>
									</ul>
								</div>
								<div class="aos-infographic__text" id="infographic__text20">
									<a class="button-behaviour cursor-pointer display-block padding-both-10 padding-left-20 padding-right-20 site-palette-yin-2-color site-palette-yang-4-background-color flex-auto" href="https://thestalkerstate.org/the-stalker-state/">The Stalker State</a>
									<a class="button-behaviour cursor-pointer display-block padding-both-10 padding-left-20 padding-right-20 site-palette-yin-2-color site-palette-yang-4-background-color flex-auto" href="https://thestalkerstate.org/architecture-of-surveillance/">The Architecture of Surveillance</a>
									<a class="button-behaviour cursor-pointer display-block padding-both-10 padding-left-20 padding-right-20 site-palette-yin-2-color site-palette-yang-4-background-color flex-auto" href="https://thestalkerstate.org/before-the-bullet-hits-the-body/">Before the Bullet Hits the Body</a>
								</div>
							</div>
							<div class="aos-infographic__animation">
								<div class="video-consainer">
									<img id="source" src="/wp-content/themes/TheStalkerState/assets/images/loading.png" width="1180" height="640">
								    <video id="video1" width="1280" height="720" playsinline>
								      <source src="/wp-content/themes/TheStalkerState/assets/videos/1.mp4" type="video/mp4"/>
								    </video>
								    <video id="video2" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/2.mp4" type="video/mp4"/>
								    </video>
								    <video id="video3" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/3.mp4" type="video/mp4"/>
								    </video>
								    <video id="video4" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/4.mp4" type="video/mp4"/>
								    </video>
								    <video id="video5" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/5.mp4" type="video/mp4"/>
								    </video>
								    <video id="video6" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/6.mp4" type="video/mp4"/>
								    </video>
								    <video id="video7" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/7.mp4" type="video/mp4"/>
								    </video>
								    <video id="video8" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/8.mp4" type="video/mp4"/>
								    </video>
								    <video id="video9" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/9.mp4" type="video/mp4"/>
								    </video>
								    <video id="video10" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/10.mp4" type="video/mp4"/>
								    </video>
								    <video id="video11" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/11.mp4" type="video/mp4"/>
								    </video>
								    <video id="video12" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/12.mp4" type="video/mp4"/>
								    </video>
								    <video id="video13" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/13.mp4" type="video/mp4"/>
								    </video>
								    <video id="video14" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/14.mp4" type="video/mp4"/>
								    </video>
								    <video id="video15" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/15.mp4" type="video/mp4"/>
								    </video>
								    <video id="video16" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/16.mp4" type="video/mp4"/>
								    </video>
								    <video id="video17" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/17.mp4" type="video/mp4"/>
								    </video>
								    <video id="video18" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/18.mp4" type="video/mp4"/>
								    </video>
								    <video id="video19" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/19.mp4" type="video/mp4"/>
								    </video>
								    <video id="finalShot" width="1280" height="720" playsinline>
								    	<source src="/wp-content/themes/TheStalkerState/assets/videos/last_shot.mp4" type="video/mp4"/>
								    </video>
								</div>
							    <canvas id="videoCanvas" width="1180" height="640"></canvas> 
							</div>
						</div>
					</div>
                        <div class="clearfix"></div>


                        <?php
                        global $multipage;
                        if (0 !== $multipage) {?>
                        <div class="multi-page-pagination site-typeface-caption-1 site-palette-yang-3-background-color text-align-center padding-both-5 margin-both-50">
                          <?php wp_link_pages();?>
                        </div>
                        <?php }?>

                  <?php } else {?>

                        <h2 class=" typo-size-large">
                          <a href="<?php echo get_permalink();?>" class=" classic-link site-palette-yin-1-color site-typeface-title typo-size-xlarge post-title">
                          <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                          </a>
                        </h2>

                        <h3 class="typo-weight-300 site-palette-yin-3-color padding-top-0 padding-bottom-5 site-typeface-headline typo-size-medium post-subtitle">
                          <?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
                        </h3>

                        <?php the_excerpt();?>

                        <p>
                          <a class="typo-size-xsmall site-typeface-body margin-left-5 display-inline-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 " href="<?php echo the_permalink();?>">
                          <em class="icon-book-open padding-right-5 "></em> <?php esc_html_e('Read more', 'narratium');?>
                          </a>
                        </p>


                  <?php } ?>
    				<?php endwhile; ?>
    				<?php endif; ?>
    			</div>
    		</div>
    </div>
  </div>

<?php
get_footer();
