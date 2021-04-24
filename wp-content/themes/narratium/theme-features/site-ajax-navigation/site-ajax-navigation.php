<?php
/**
 * Ajax Navigation Support
 * version 1.4.1
 */

/*
HOOKS ---------------------------------------------------------------


do_action('KTT_theme_ajax_load_content_before');
It runs just before the request starts to load content from the url
It is useful to prepare animations before loading


do_action('KTT_theme_ajax_load_content_success');
It runs when the content load of a url has successfully occurred


do_action('KTT_theme_ajax_load_content_error');
It runs when an error has occurred trying to load a url


do_action('KTT_theme_ajax_load_content_finally');
It is executed when it has finished loading a url, regardless of the result
It is useful to finish animations



FILTERS --------------------------------------------------------------

apply_filters('KTT_theme_ajax_template_parts', $result);
We will use this filter to add elements to the ajax parts array
This array is the one that indicates which parts of the html should be updated with ajax

*/








/**
* Returns true if we have ajax enabled on the site
*/
function KTT_ajax_is_enabled() {
		if(is_user_logged_in()) return false;
		return get_option(KTT_var_name('active_ajax_navigation'));
}



/**
* This function is responsible for returning an array that indicates the html parts
* of the theme to be updated with ajax.
* Format:
 array(
		'selector' => '#selector',
		'content' => ''
		'compile' => true
)
*/
function KTT_get_theme_ajax_template_parts() {

		$result = array();

		/**
		* Thanks to this filter we can add elements from third parties
		*/
		$result = apply_filters('KTT_theme_ajax_template_parts', $result);

		/**
		* Let's devour the resulting array
		*/
		return $result;

}




/**
* This hook allows us to change the url of the browser without updating the content
*/
function KTT_update_browser_url() {

		?>
		history.pushState({}, url, url);
		<?php

}
add_action('KTT_theme_ajax_load_content_success', 'KTT_update_browser_url');



/**
* This hook is responsible for re-triggering the ready document events
* and content loaded after each ajax flame
*/
function KTT_trigger_ready_events() {

	?>
	setTimeout(function () {

		// jquery ready (works?): https://stackoverflow.com/a/7135839
		jQuery.ready()

		// event DOMContentLoaded
		var DOMContentLoaded_event = document.createEvent("Event");
		DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true);
		window.document.dispatchEvent(DOMContentLoaded_event);

	}, 1000);
	<?php

}
add_action('KTT_theme_ajax_load_content_after', 'KTT_trigger_ready_events', 9999 );



/**
* This function is responsible for adding all the code necessary to operate
* the ajax navigation on the site
* do_action('KTT_after_ajax_link_load')
* do_action('KTT_before_ajax_link_load')
*/
function KTT_ajax_js() {

	if (!KTT_ajax_is_enabled()) return;
	?>

	/**
	* This function is responsible for operating the page buttons
	* previous browser
	*/
	window.onpopstate = function(event) {
		//if(event.state !== null) {
			window.location.replace(location.href);
			//$scope.load_ajax_url(location.href);
		//}
	}

	/**
	* We define the divs that we seek to update
	*/
	$scope.parts_to_update = <?php echo json_encode(KTT_get_theme_ajax_template_parts(), JSON_PRETTY_PRINT) ?>;;

	/**
	* In this variable we save the html that we are going to use
	*/
	$scope.current_html;
	$scope.current_doc;

	/**
	* We capture the links of the document
	*/
	$scope.get_links = function() {

				/**
				* We get the links
				*/
				var links = angular.element('a');

				/**
				* We return the links
				*/
				return links;
	}

	/**
	* This function is responsible for updating the head of the page
	*/
	$scope.update_page_head = function() {


				var new_head = $scope.current_doc.head;

				/**
				* We get the current head of the page
				*/
				var current_head = document.head;




				/**
				* We eliminate from the current head elements that we know should be
				* update, such as the title, the feed or the links prev and next
				*/
				angular.forEach(current_head.childNodes, function(current_elem) {
						/**
						* If this element is not among the new elements then
						* means that the new page does not appear, therefore
						* we will eliminate it
						*/
						if (current_elem.outerHTML) if (jQuery(new_head).html().indexOf(current_elem.outerHTML) < 0) {
							 current_elem.remove()
						}

				});





				/**
				* We are going to roam for each one of the head elements of the new
				* page and we will be adding to the current one only the elemtnso new
				*/
				angular.forEach(new_head.childNodes, function(new_elem) {
						/**
						* If the element that we are driving already appears in the
						* current head then we do nothing with else
						*/
						if (new_elem.outerHTML) if (jQuery(current_head).html().indexOf(new_elem.outerHTML) < 0) {
							 jQuery('head').append(new_elem);
						}

				});


	}



	$scope.update_page_footer = function() {

				/**
				* new footer
				*/
				var new_footer = $scope.current_doc.querySelector("#wp_footer_wrap");

				/**
				* We get the current head of the page
				*/
				var current_footer = document.querySelector("#wp_footer_wrap");




				angular.forEach(current_footer.childNodes, function(current_elem) {

						/**
						* If this element is not among the new elements then
						* means that the new page does not appear, therefore
						* we will eliminate it
						*/
						if (current_elem.outerHTML) if (jQuery(new_footer).html().indexOf(current_elem.outerHTML) < 0) {
							 current_elem.remove();
						}

				});




				angular.forEach(new_footer.childNodes, function(new_elem) {

						/**
						* If the element that we are driving already appears in the
						* current head then we do nothing with else
						*/
						if (new_elem.outerHTML) if (jQuery(current_footer).html().indexOf(new_elem.outerHTML) < 0) {
							 jQuery(current_footer).append(new_elem);
						}

				});




	}


	/**
	* This function receives a data with html code and tries to return only
	* the content in the div that we pass as a parameter
	*/
	$scope.get_data_div_content = function (selector, data, compile) {

				if (!compile) compile = false;

				/**
				* We get the html
				*/
				var result = jQuery("<div>" + data + "</div>").find(selector).html(); //angular.element(data).filter('.container').html();

				/**
				* We compile the html so that the directives start well
				* and other angularjs mierdecicas
				*/
				if (compile) var result = $compile(result)($scope);

				/**
				* We return the compiled html
				*/
				return result;

	}



	/**
	* This function is responsible for loading a url into a variable and returning it
	*/
	$scope.load_url_content = function(url) {

				/**
				* In this variable we keep what will be the response of the function
				* false if it gives error or an attach_id if it has been successful.
				*/
				var result = false;

				/**
				* We create a deferred object that will help us to manage the promise.
				*/
				var defer = $q.defer();

				/**
				* This action helps us to execute code before it starts executing
				* the function that connects to the url and extracts the content
				*/
				<?php do_action('KTT_theme_ajax_load_content_before');?>

				/**
				* We make the call http
				*/
				var request = $http({
	            method: "get",
	            url:  url
	      });

	      /**
				* If the call has been successful ...
				*/
				request.then(function(response) {

						/**
						* We update the current code
						*/
						$scope.current_html = response.data;

						/**
						* We create a new doctype
						*/
						var parser = new DOMParser();
				    $scope.current_doc = parser.parseFromString(response.data, "text/html");


						/**
						* This action helps us to execute code at the moment in which
						* the request ends with exit
						*/
						<?php do_action('KTT_theme_ajax_load_content_success');?>

						/**
						*
						*/
						result = response.data;

	      });

	      /**
	      * Check if an error has occurred
	      */
	      request.catch(function(response) {

						/**
						* This action helps us to execute code at the moment in which
						* the request ends with error
						*/
						<?php do_action('KTT_theme_ajax_load_content_error');?>

						/**
						* We return the error message
						*/

	      });

	      /**
	      * Actions to be carried out once the call is finished
	      */
	      request.finally(function() {

						/**
						* This action helps us to execute code at the moment in which
						* the request ends (either satisfactorily or note)
						*/
						<?php do_action('KTT_theme_ajax_load_content_finally');?>


						/**
		         * In the defer we define the result of this function
		        */
		        if (result) defer.resolve(result)
		        else defer.reject(result);

				});

				/**
				* we return the premise
				*/
				return defer.promise;

	}



	/**
	* This function is responsible for adding to a link the bind to work with ajax
	*/
	$scope.add_ajax_to_link = function(link_object) {


			var string_url = jQuery(link_object).attr('href');
			if (!string_url) return;

			if (string_url.indexOf('#') != -1) {
				return;
			}

			var url = new URL(string_url);



			/**
			* We get the DOM element with its attributes
			*/
			link_object = angular.element(link_object);

			/**
			* We add the binding
			*/
			link_object.unbind("click").bind('click', function(e) {

					/**
					* If we are facing a valid url then we are going to add the bind that
					* will transform it into an ajax link
					*/
					if ($scope.link_is_ajax_friendly(url)) {

								/**
								* We prevent the link from moving forward the load
								*/
								e.preventDefault();

								/**
								* We capture the url
								*/
								//var url = link_object.context.attributes.href.value;

								/**
								* We load the url with ajax
								*/
								$scope.load_ajax_url(url.href);

					}

			});

	}


	/**
	* This function is responsible for loading a url ajax and do everything necessary
	* to update the page as we have configured it
	*/
	$scope.load_ajax_url = function(url) {


			/**
			* We contacted the url to obtain its content.
			*/
			var ajax_request = $scope.load_url_content(url);

			/**
			* In case of success ...
			*/
			ajax_request.then(function(data){

						/**
						* We update the header
						*/
						$scope.update_page_head();
						$scope.update_page_footer();



						/**
						* We obtain the html content of the divs that interest us
						*/
						$scope.parse_html_contents(data);

						/**
						* We update the classes of the most important elements of the  DOCTYPE html
						* like the html and the body
						*/
						$scope.update_classes();

						/**
						* We update the divs
						*/
						$scope.update_ajax_parts();


						/**
						* We make the new links also be ajax
						*/
						$scope.convert_links_to_ajax();

						/**
						* This action helps us to execute code before it starts executing
						* the function that connects to the url and extracts the content
						*/
						<?php do_action('KTT_theme_ajax_load_content_after');?>

			});

	}

	/**
	* This function is responsible for updating the classes of the elements
	* most important of the document
	*/
	$scope.update_classes = function() {

			jQuery("html").removeClass();
			jQuery("html").addClass(jQuery($scope.current_doc).find('html').attr("class"));

			jQuery("body").removeClass();
			jQuery("body").addClass(jQuery($scope.current_doc).find('body').attr("class"));

	}



	/**
	* This function is responsible for obtaining the content of the divs that we are from the html code
	* looking to update.
	*/
	$scope.parse_html_contents = function(html) {

			/**
			* We're going for each of the divs we're looking for
			*/
			angular.forEach($scope.parts_to_update, function(part) {

					/**
					* We update your content with the content we have obtained
					* of the html.
					*/
					part.content = $scope.get_data_div_content(part.selector, html, part.compile);

			});

	}



	/**
	* This function is responsible for updating the content of the ajax parts
	*/
	$scope.update_ajax_parts = function() {

			/**
			* We're going for each of the divs we're looking for
			*/
			angular.forEach($scope.parts_to_update, function(part) {

					/**
					* We add the compiled code to the div
					*/
					if (Object.keys(part.content).length > 1) jQuery(part.selector).html(part.content);

			});

	}


	/**
	* This function is responsible for evaluating if a url is valid to use ajax
	* We should not transform into link ajax those that go to an external url
	*/
	$scope.link_is_ajax_friendly = function(url_object) {


			/**
			* If the hostname of the home element with our current url then we return
			* true since it is an internal link
			*/
			if (window.location.hostname === url_object.hostname || url_object.href.length ) {

					/**
					* Main page?
					*/
				  if (url_object.href == url_object.hostname) return false;

					/**
					* Before returning a true let's check that it is not an administration URL
					* in this case we must return false;
					*/
					if (url_object.href.indexOf('wp-admin') != -1) return false;

					/**
					* We must check if an extension exists at the termination of the url
					* archive
					*/
					if (url_object.href.split('.').pop().length < 5) return false;

					/**
					* With hashtag nanai, because it's an internal link
					*/
					if (url_object.href.indexOf('#') != -1) return false;

					/**
					* If we have passed the filters, we return true;
					*/
					return true;

			}

			/**
			* If we have arrived here it is because we have not been able to validate the url of the element as
			* an internal url that is apt to load with AJAX, therefore we return a false
			* and we left the function
			*/
			return false;

	}



	/**
	* This function is responsible for searching the links in the html and converting them
	* ajax magically
	*/
	$scope.convert_links_to_ajax = function() {
		var links = $scope.get_links();
		angular.forEach(links, function(link) {
				$scope.add_ajax_to_link(link);
		});
	}


	$scope.convert_links_to_ajax();



	<?php
}
add_action('THEME_angularjs_main_app', 'KTT_ajax_js');




/**
* If ajax navigation is active we will wrap the footer inside a div
*/
if (KTT_ajax_is_enabled()) {

	function KTT_footer_wrap_start() {echo '<div id="wp_footer_wrap">';}
	add_action('wp_footer', 'KTT_footer_wrap_start', 1);

	function KTT_footer_wrap_end() {echo '</div>';}
	add_action('wp_footer', 'KTT_footer_wrap_end', 99999999);

}


















/**
* A section helps us organize the elements of the page
*/

$args                           	= array();
$args['section_id']              	= KTT_var_name('ajax-navigation');
$args['section_title']            = esc_html__('AJAX Navigation', 'narratium');
$args['section_description']     	= sprintf(esc_html__('AJAX Navigation can be activated with just one click to accelerate and approach the navigation throughout %s.', 'narratium'), get_bloginfo('name'));
new KTT_new_customize_section($args);







// add option to admin panel

$args                           = array();
$args['option_id']              = KTT_var_name('active_ajax_navigation');
$args['option_name']           	= esc_html__('AJAX Navigation', 'narratium');
$args['option_description']     = esc_html__('Active dynamic navigation in the site.', 'narratium');
$args['option_label']     			= esc_html__('Enable', 'narratium');
$args['option_priority'] 				= 40;
$args['option_type']            = 'checkbox';
$args['option_type_vars']				= array(
																	'selector' => '.site-typeface-title',
																	'font_family' => true,
																	'font_size' => false,
																	);
$args['option_default'] 				= 0;
$args['option_section']    			= KTT_var_name('ajax-navigation');
new KTT_new_customize_setting($args);




?>
