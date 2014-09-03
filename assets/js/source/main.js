(function($) {

	/* main js */
	/*
	@todo :	-supprimer le contenu superficiel
	*/

	var sly = new Sly(document.getElementById('frame')); // DOM element


	(function () {
		var $frame = $('#frame');
		var $wrap  = $frame.parent();

		// Call Sly on frame
		$frame.sly({
			horizontal: 1,
			itemNav: 'forceCentered',
			smart: 1,
			activateMiddle: 1,
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 0,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,

			// Buttons
			prev: $wrap.find('.prev'),
			next: $wrap.find('.next')
		});

		$frame.on('load', function () { $('.desc').addClass('animated slideInleft')});


		
	}());





	$(document).ready(function(){

			// var $container = $('.list-products');
			// // initialize Masonry after all images have loaded  
			// $container.imagesLoaded( function() {
			//   	$container.masonry({
			// 		itemSelector : 'li',
			// 		columnWidth : 20,
			// 		isAnimated: true,
			// 		isFitWidth: true
			// 	});
			// });




		$(window).height();   // returns height of browser viewport
		$(document).height(); // returns height of HTML document
		$(window).width();   // returns width of browser viewport
		$(document).width(); // returns width of HTML document


		var $socialButtons = $('#social-buttons'),
			$addFormVideo = $('#primary-form-video'),
			$addFormBonsplans = $('#primary-form-bp'),
			$addFormPhoto = $('#primary-form-photo');
			

		$("html").addClass("has-js");

		/* initialisation bouton radio */
		$(".toggle").each(function(index, toggle) {
	        toggleHandler(toggle);
	    });

		/* initialisation des tabs */
	    $('a[data-toggle="tab"]').on('shown', function (e) {
			e.target // activated tab
			e.relatedTarget // previous tab
		});


		$(".ajax_delete_post").click( function(){
			var postID = $(this).attr("id");
				nameLi = '#post-'+ postID ; 
				console.log(nameLi);

			event.preventDefault();
	        var data =  {
	            action: 'wpse_delete_post',
	            post_id: $(this).attr("id")
	        };
	        $.post(ajaxurl, data, function(response, post_id) {
	            console.log(response);
	            
	            $(nameLi).slideUp('slow');
	        });

	    });


		/* formulaire interactif */
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

		elems.forEach(function(html) {
		  var switchery = new Switchery(html);
		});


		$('.form .option').hide();

	    var horaireBox = $('#horaire-box');
		var localBox = $('#localisation-box');

		horaireBox.hide("fast");
		localBox.hide("fast");

		var htmlBody = $('html, body');

		$("#showhoraire").change(
			function(){
				"use strict";
				if ($(this).prop('checked')){ 
					//la ckeck-box est activée
					horaireBox.show("fast"),
					htmlBody.animate({scrollTop: horaireBox.position().top}, 'slow');
				} else { 
					//la ckeck-box est desactivée
					$(this).parent().removeClass("active"),
					horaireBox.hide("fast"),
					htmlBody.animate({scrollTop: horaireBox.position().top}, 'slow');
				}
			}
		);

		$("#showadress").change(
			function(){
				"use strict";
				if ($(this).prop('checked')){
					localBox.show("fast"),
					htmlBody.animate({scrollTop: localBox.position().top}, 'slow');
				} else {
					//la ckeck-box est desactivée
					localBox.hide("fast");
					htmlBody.animate({scrollTop: localBox.position().top}, 'slow');
				}
			}
		);


		/* image preview before upload */

		$(function() {
			/* on defini le container */
		    var scntDiv = $('.images-field-container');
		    /* on defini le le nombre d'image selectionnées */
		    var i = $('.images-field-container fieldset').size() + 1;
		    /* on lance le image preview pour ne pas avoir de sintillement */
		   	$('.preview-img').imgPreview();


		   	/* des que l'on clique sur ajouter une image*/
		    $('#add_input_image_field').bind('click', function() {
		    	var scnDiv = $('#add-image');
		    	/* on rajoute un champs image apres la derniere image */
				$('<fieldset class="col-md-4 image-show" id="img-field-' + i +'"><label for="thumbnail' + i +'">Image</label><input type="file" name="thumbnail-' + i +'" id="thumbnail' + i +'" class="preview-img" multiple="multiple"></label> <a class="btn remove_input_image_field close" href="#" ></a></fieldset>').prependTo(scntDiv);
				/* on lance le preview sur cette image */ 
				$(function() {$('.preview-img').imgPreview();});
				/* incrementation du nombre d'images */
				i++;
				return false;
		    });

		    $('.remove_input_image_field').bind('click', function() {
		    	alert('work');
				$(this).closest('fieldset').hide('fast').remove();

				i--;
				return false;
		    });
		});

		/* swiper */
		$(function(){
		  var mySwiper = $('.swiper-container.swiper-car').swiper({
		    //Your options here:
		    mode:'horizontal',
		    loop: true,
		    slidesPerView:3
		    //etc..
		  });
		})


	    // First let's prepend icons (needed for effects)
	    $(".checkbox, .radio").prepend("<span class='icon'></span><span class='icon-to-fade'></span>");

	    $(".checkbox, .radio").click(function(){
	        setupLabel();
	    });
	    setupLabel();


		/* sidebar ads */
		$("ul[data-liffect] li").each(function (i) {
			$(this).attr("style", "-webkit-animation-delay:" + i * 800 + "ms;" + "-moz-animation-delay:" + i * 800 + "ms;" + "-o-animation-delay:" + i * 800 + "ms;" + "animation-delay:" + i * 800 + "ms;");
			if (i == $("ul[data-liffect] li").size() -1) {
				$("ul[data-liffect]").addClass("play");
			}
		});



		// affiche ou ferme le second menu sur la partie mobile
		$('#header_mobile_dispatcher').click(
			function toggleHeadSecondMenu() {
				"use strict";
				$header_mobile.slideToggle("fast");
			}
		);

		$('#create-account').click(
			function toggleHeadSecondMenu() {
				"use strict";
				$registerB.slideToggle("fast");
			}
		);

		// ouvre le formulaire video dans la page voir-mes-videos-php
		$('#open-video-form').click(
			function toggleHeadSecondMenu() {
				"use strict";
				$addFormVideo.slideToggle("fast"),
				$('html, body').animate({scrollTop: $addFormVideo.position().top}, 'slow');
			}
		);

		// ouvre le formulaire bonsplans dans la page voir-mes-bon-plan-php
		$('#open-bp-form').click(
			function toggleHeadSecondMenu() {
				"use strict";
				$addFormBonsplans.slideToggle("fast"),
				$('.form .option').show(),
				$('.icon-ok').hide(),
				$('html, body').animate({scrollTop: $addFormBonsplans.position().top}, 'slow'),
				$('.preview-img').imgPreview(),
				$(this).hide();
			}
		);



		// ouvre le formulaire bonsplans dans la page voir-mes-photos-php
		$('#open-photo-form').click(
			function toggleHeadSecondMenu() {
				"use strict";
				$addFormPhoto.slideToggle("fast"),
				$('html, body').animate({scrollTop: $addFormPhoto.position().top}, 'slow'),
				$('.preview-img').imgPreview();
			}
		);


		//fall back bouton partagez  ->  mobile, tablette
		$('#show-partagez-fiche').click(
			function openCloseShareBt() {
				"use strict";
				$socialButtons.toggleClass("show");
			}
		);




		/* google map api asynchrone */

		/*

		function initialize() {
		  var mapOptions = {
		    zoom: 8,
		    center: new google.maps.LatLng(-34.397, 150.644),
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		  }
		  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		}

		function loadScript() {
		  var script = document.createElement("script");
		  script.type = "text/javascript";
		  script.src = "http://maps.googleapis.com/maps/api/js?client=AIzaSyBj7llzzMqQ72P1PQiqSoGsSNtZzU_emeo&sensor=true&callback=initialize";
		  document.body.appendChild(script);
		}

		window.onload = loadScript;

		*/

	});
	/*
	$(document).ready(function(){



	*/

	(function( $ ){
	  var settings = {
	  		'scale': 'contain', // cover
	  		'prefix': 'prev_',
			'types': ['image/gif', 'image/png', 'image/jpeg'],
			'mime': {'jpe': 'image/jpeg', 'jpeg': 'image/jpeg', 'jpg': 'image/jpeg', 'gif': 'image/gif', 'png': 'image/png', 'x-png': 'image/png', 'tif': 'image/tiff', 'tiff': 'image/tiff'}
		};

	  var methods = {
	     init : function( options ) {
			settings = $.extend(settings, options);

			return this.each(function(){
				$(this).bind('change', methods.change);
				$('#'+settings['prefix']+this.id).html('').addClass(settings['prefix']+'container');
			});
	     },
	     destroy : function( ) {
			return this.each(function(){
				$(this).unbind('change');
			})
	     },
	     change : function(event) { 
	     	var id = this.id
	     	
	     	$('#'+settings['prefix']+id).html('');
	     	
	     	if(window.FileReader){
	     		for(i=0; i<this.files.length; i++){
			 		if(!$.inArray(this.files[i].type, settings['types']) == -1){
			 			window.alert("File of not allowed type");	
			 			return false
			 		}
			 	}
	     	
	     	    for(i=0; i<this.files.length; i++){
	     	    	var reader = new FileReader();
		    		reader.onload = function (e) {
		    			$('<div />').css({'background-image': ('url('+e.target.result+')'), 'background-repeat': 'no-repeat', 'background-size': settings['scale'] }).addClass(settings['prefix']+'thumb').appendTo($('#'+settings['prefix']+id));
		    		};
		    		reader.readAsDataURL(this.files[i]);
	     	    }
	     	}else{
	     		//if(window.confirm('Internet Explorer do not support required HTML5 features. \nPleas, download better browser - Firefox, Google Chrome, Opera... \nDo you want to download and install Google Chrome now?')){ window.location("//google.com/chrome"); }
	     	}
	     }
	  };

	  $.fn.preimage = function( method ) {
	    if ( methods[method] ) {
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
	    } else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.preimage' );
	    }    
	  
	  };

	})( jQuery );



	function setupLabel() {
	    // Checkbox
	    var checkBox = ".checkbox";
	    var checkBoxInput = checkBox + " input[type='checkbox']";
	    var checkBoxChecked = "checked";
	    var checkBoxDisabled = "disabled";

	    // Radio
	    var radio = ".radio";
	    var radioInput = radio + " input[type='radio']";
	    var radioOn = "checked";
	    var radioDisabled = "disabled";

	    // Checkboxes
	    if ($(checkBoxInput).length) {
	        $(checkBox).each(function(){
	            $(this).removeClass(checkBoxChecked);
	        });
	        $(checkBoxInput + ":checked").each(function(){
	            $(this).parent(checkBox).addClass(checkBoxChecked);
	        });
	        $(checkBoxInput + ":disabled").each(function(){
	            $(this).parent(checkBox).addClass(checkBoxDisabled);
	        });
	    }

	    // Radios
	    if ($(radioInput).length) {
	        $(radio).each(function(){
	            $(this).removeClass(radioOn);
	        });
	        $(radioInput + ":checked").each(function(){
	            $(this).parent(radio).addClass(radioOn);
	        });
	        $(radioInput + ":disabled").each(function(){
	            $(this).parent(radio).addClass(radioDisabled);
	        });
	    }
	}

	// single dataset
	/*
	$('#city').typeahead({
	  name: 'accounts',
	  local: ['timtrueman', 'JakeHarding', 'vskarich']
	});
	*/
	// multiple datasets
	/*
	$('#city').typeahead(
	  {
	     remote: 'https://graph.facebook.com/search?q=%QUERY&type=adcity&access_token=009157948d81fe57af3c95acdceb812b'
	  }
	);
	*/
	// multiple datasets
	/*
	$('input.twitter-search').typeahead([
	  {
	    name: 'accounts',
	    prefetch: 'https://twitter.com/network.json',
	    remote: 'https://twitter.com/accounts?q=%QUERY'
	  }
	]);
	*/



	/* boutons radios */
	var toggleHandler = function(toggle) {
	    var toggle = toggle;
	    var radio = $(toggle).find("input");

	    var checkToggleState = function() {
	        if (radio.eq(0).is(":checked")) {
	            $(toggle).removeClass("toggle-off");
	        } else {
	            $(toggle).addClass("toggle-off");
	        }
	    };

	    checkToggleState();

	    radio.eq(0).click(function() {
	        $(toggle).toggleClass("toggle-off");
	    });

	    radio.eq(1).click(function() {
	        $(toggle).toggleClass("toggle-off");
	    });
	};




	window.onload = function() {
		// JS input/textarea placeholder
	    $("input, textarea").placeholder();

	};










	$('.date').pickadate({
		monthsFull: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Julliet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ],
		monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec' ],
		weekdaysFull: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		weekdaysShort: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		format: 'dddd dd mmm yyyy',
		today: 'aujourd\'hui',
	    clear: 'effacer',
		formatSubmit: 'yyyy-mm-dd'
	})

	$("input[type='time']").pickatime()


	/*





	$('.date').pickadate({
		monthsFull: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Julliet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ],
		monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec' ],
		weekdaysFull: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		weekdaysShort: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		format: 'dddd dd mmm yyyy',
		today: 'aujourd\'hui',
	    clear: 'effacer',
		formatSubmit: 'yyyy-mm-dd'
	});
	*/
	/*

	jQuery(document).ready(function($) {
		$('.date').datepicker({
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dateFormat: "yy-mm-dd",
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Julliet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ]
		});
	});
	*/

	var domains = ['hotmail.com', 'gmail.com', 'aol.com'];
	var topLevelDomains = ["com", "net", "org"];
	var superStringDistance = function(string1, string2) {
	  // a string distance algorithm of your choosing
	};

	$('input.email').on('blur', function() {
	  $(this).mailcheck({
	    domains: domains,                       // optional
	    topLevelDomains: topLevelDomains,       // optional
	    distanceFunction: superStringDistance,  // optional
	    suggested: function(element, suggestion) {
	      // callback code
	    },
	    empty: function(element) {
	      // callback code
	    }
	  });
	});






	$(function(){
		/**
		* the element
		*/
		var $ui = $('#search-box');    // #search-box

		/**
		* on focus and on click display the dropdown, 
		* and change the arrow image
		*/
		$ui.find('#search').bind('focus click',function(){     // #search
			$ui.find('#searchOptions')    //#searchOption
			.show("fast");
		});

		/**
		* on mouse leave hide the dropdown, 
		* and change the arrow image
		*/
		$ui.bind('mouseleave',function(){
			$ui.find('#searchOptions') //#searchOption
			.hide("fast");
		});
	});


	//Async Sharing Buttons
	(function(doc, script) {
	  var js, 
	      fjs = doc.getElementsByTagName(script)[0],
	      frag = doc.createDocumentFragment(),
	      add = function(url, id) {
	          if (doc.getElementById(id)) {return;}
	          js = doc.createElement(script);
	          js.src = url;
	          id && (js.id = id);
	          frag.appendChild( js );
	      };
	      
	    // Google+ button
	    add('http://apis.google.com/js/plusone.js');
	    // Facebook SDK
	    add('//connect.facebook.net/en_US/all.js#xfbml=1&appId=1389782261252251', 'facebook-jssdk');
	    // Twitter SDK
	    add('//platform.twitter.com/widgets.js');

	    fjs.parentNode.insertBefore(frag, fjs);
	}(document, 'script'));


})(jQuery);