/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/


// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if (prop == 'float') prop = 'styleFloat';
			if (re.test(prop)) {
				prop = prop.replace(re, function () {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}
function load_posts(content,posttype,resourcetype) {
	var $content = $(content);
    var offset = $(content + ' .individual').length;
    var loading = true;
    $.ajax({
        type       : 'GET',
        data       : {offset : offset, posttype : posttype,resourcetype: resourcetype},
        dataType   : 'html',
        url        : '/wp-content/themes/seicus/loopHandler.php',
        beforeSend : function(){
        },
        success    : function(data){
            $data = $(data);
            $data.hide();
            $content.append($data);
            $data.fadeIn(500, function(){
                loading = false;
            });
        },
        error     : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }
    });
}
// as the page loads, call these scripts
jQuery(document).ready(function($) {

$("#tabs").tabs({
        activate: function(event, ui) {
            window.location.hash = ui.newPanel.attr('id');
			/* ImageMapper Wordpress frontend script
			*/
			var Image;
			var Canvas, Ctx;
			
			jQuery(function($) {
				
				$('img[usemap]').each(function() {
					var areas = [];
					$('map[name="' + $(this).attr('usemap').substr(1) + '"]').find('area').each(function() {
						areas.push({
							'key': $(this).attr('data-mapkey'),
							'toolTip': $(this).attr('data-tooltip'),
							'isSelectable': false,
							'render_highlight': {
								'fillColor': $(this).attr('data-fill-color'),
								'fillOpacity': $(this).attr('data-fill-opacity'),
								'strokeColor': $(this).attr('data-stroke-color'),
								'strokeOpacity': $(this).attr('data-stroke-opacity'),
								'stroke': $(this).attr('data-stroke-width') > 0,
								'strokeWidth': $(this).attr('data-stroke-width'),
								'fade': true,
								'fadeDuration': 300
							}
						});
					});
					
					var map = this;
					$(this).mapster({
						clickNavigate: true,
						showToolTip: true,
						toolTipContainer: $('<div class="imagemapper-tooltip"></div>'),
						toolTipClose: ['area-mouseout'],
						mapKey: 'data-mapkey',
						onClick: AreaClicked,
						onMouseover: function(m) {
							if(!m.options.toolTip.length)
								$(map).mapster('tooltip', false);
								
							clearTimeout($(map).data('mapster-highlight-timeout'));
							$(map).mapster('highlight', false);
							$(map).mapster('highlight', m.key);
						},
						singleSelect: true,
						render_select: {
							fillOpacity: 0
						},
						areas: areas
					});
			
					// If pulse option is set, initialize it.
					if(imgmap.pulseOption && imgmap.pulseOption != 'never') {
						$(this).mouseenter(function(e) {
							
							//Prevent pulse from happening when mouse moves on the image map from tooltip or area. (Prevent mouseenter from "inner" elements)
							if($(e.fromElement).hasClass('imagemapper-tooltip') || $(e.fromElement).is('area')) 
								return;
							
							//If this is set true, the pulse has been done already and Wordpress doesn't want to do it again.
							if(!$(this).attr('data-first-mouseenter')) {
								
								//Mark image map as "pulsed" if the first_time pulse option is set.
								if(imgmap.pulseOption == 'first_time')
									$(this).attr('data-first-mouseenter', true);
								
								//Prevent duplicate highlights
								$(this).mapster('highlight', false);
								//Highlight all areas
								for(var area in areas) {
									$(this).mapster('highlight', areas[area].key);
								}
								
								var map = this;
								
								// Stop highlighting after a short delay
								// Also fade highlighted areas out rather than hide them instantly
								clearTimeout($(this).data('mapster-highlight-timeout'));
								$(this).data('mapster-highlight-timeout', setTimeout(function() { 
									$(map).closest('.imgmap-frontend-image').find('canvas').each(function() { 
										$(this).stop().animate({ opacity: 0 }, 300, function() { $(map).mapster('highlight', false); });
									});						
								}, 500));
							}
						});
					}
					//Close tooltips when clicking outside the tooltip.
					$('body').click(function(e) {
						if(!$(e.target).is('.imagemapper-tooltip') && !$(e.target).closest('.imagemapper-tooltip').length && $(e.target).attr('data-type') != 'tooltip')
							$(map).mapster('tooltip', false);
							
						if(!$(e.target).is('.imgmap-dialog-alt') && !$(e.target).closest('.imgmap-dialog-alt').length)
							$('.imgmap-dialog-alt').hide(200);
					}); 
				});
				if(!imgmap.alt_dialog) {
					if($().dialog) {
						$('.imgmap-dialog-wrapper').dialog({ 
							autoOpen: false, 
							zIndex: 10000,
							maxWidth: 700,
							width: 'auto',
							show: 300,
							dialogClass: 'imgmap-dialog',
							position: {
								of: $(parent)
								}
							});
						$('body').click(function(e) {
							if(!$(e.target).is('.ui-dialog, a') && !$(e.target).closest('.ui-dialog').length)
								$('.imgmap-dialog-wrapper').each(function(e) { $(this).dialog('close'); });
						});
					}
					else {
						if($('area[data-type="popup"]').length) {
							
							if(imgmap.admin_logged) {
								var close = $('<a>');
								close.text('Close').css( { cursor: 'pointer', float: 'right', fontSize: '0.9em' });
								close.click(function() { $('.imgmap-dialog-wrapper').text(''); });
								
								$('.imgmap-dialog-wrapper').
								html("There was a problem loading jQuery UI Dialog widget. A plugin or a theme you're using might be including its own copy of jQuery library which causes conflict with the copy included in Wordpress. Because of this ImageMapper isn't able to use jQuery UI Dialog widget causing the popup window function incorrectly or not at all.<br />This message is shown only to an admin. This message is shown because some of the image map areas on this page are using the popup functionality and thus not working properly.").
								css({ color: 'red', padding: '5px', fontSize: '0.8em' }).append(close);
							}
						}
					}
				}
				
				
				
				$('.alternative-links-imagemap').
				click(AlternativeLinkClicked).
				mouseenter(function () {
					var mapster = $($(this).attr('data-parent').replace('imgmap', '#imagemap')).get(0);
					jQuery(mapster).mapster('highlight', false);
					jQuery(mapster).mapster('highlight', $(this).attr('data-key'));
				}).
				mouseleave(function () {
					var mapster = $($(this).attr('data-parent').replace('imgmap', '#imagemap')).get(0);
					jQuery(mapster).mapster('highlight', false);
				});
				
				$('.altlinks-toggle').click(function() {
					$('#altlinks-container-' + $(this).attr('data-parent')).toggle(200);
				});
				
			});
			
			
			
			function AlternativeLinkClicked() {
				var key = jQuery(this).attr('data-key');
				var type = jQuery(this).attr('data-type');
				var parent = jQuery(this).attr('data-parent');
				AlternativeLinkAction(key, type, parent);
			}
			
			function AlternativeLinkAction(areaKey, areaType, imagemap) {
				switch(areaType) {
					case 'popup': 
						OpenImgmapDialog(areaKey, jQuery('map[name="' + imagemap + '"]').get(0));
					break;
					
					case 'tooltip':
						imagemap = jQuery('img[usemap="#' + imagemap + '"]').get(0);
						jQuery(imagemap).mapster('tooltip', areaKey);
					break;
				}
			}
			
			function AreaClicked(data) {
				var type = jQuery('area[data-mapKey='+data.key+']').attr('data-type'); 
				if(type == 'popup' || type == '' ) {
					OpenImgmapDialog(data.key, jQuery(this).parent()[0]);
				}
			}
			
			function OpenImgmapDialog(key, parent) {
				var image = jQuery('#' + parent.name.replace('imgmap', 'imagemap'));
				var dialog = parent.name.replace('imgmap', '#imgmap-dialog');
				
				jQuery.post(imgmap.ajaxurl, { 
					action: 'imgmap_load_dialog_post',
					id: key.replace('area-', '')
					}, function(response) {
						if(response.length <= 0) return; 
						if(!imgmap.alt_dialog) {
								jQuery(dialog).dialog('option', 'title', jQuery('area[data-mapkey='+key+']').attr('title'));
								jQuery(dialog).html(response).dialog('open');
						} else {
							
							// Some ugly quick bug-fixing code
							// Sometimes it's needed since everything does not always make sense. Or at least seem to do.
							
							// Resets the element
							// Without this centering the element doesn't work well
							jQuery(dialog).replaceWith('<div class="imgmap-dialog-wrapper" id="' + dialog.replace('#','') + '" style="visibility:hidden"></div>').hide(0);
							
							jQuery(dialog).addClass('imgmap-dialog-alt').html(response);
							setTimeout(function() {
								jQuery(dialog).position({ 
									my: 'center',
									at: 'center',
									of: image
								}).
								hide().
								css({visibility:'visible'}).
								show(200);
							}, 0);
							
							
						}
				});
			}
	
        }
        
    });
//load more triggers!
	$('#load-news').click(function(e) {
		e.preventDefault();
		load_posts('#tabs-1','post');
	});
	$('#load-guidelines').click(function(e) {
		e.preventDefault();
		load_posts('#guidelines-standards-content','resources','childhood-sexuality-guidelines-standards');
	});
	$('#load-controversy').click(function(e) {
		e.preventDefault();
		load_posts('#controversy-reports-content','resources','controversy-reports');
	});
	$('#load-facts').click(function(e) {
		e.preventDefault();
		load_posts('#fact-sheets-content','resources','fact-sheets');
	});
	$('#load-publications').click(function(e) {
		e.preventDefault();
		load_posts('#publications-content','resources','controversy-reports,childhood-sexuality-guidelines-standards');
	});


	/*
	Responsive jQuery is a tricky thing.
	There's a bunch of different ways to handle
	it, so be sure to research and find the one
	that works for you best.
	*/
	
	/* getting viewport width */
	var responsive_viewport = $(window).width();
	
	/* if is below 481px */
	if (responsive_viewport < 481) {
		
	
	} /* end smallest screen */
	
	/* if is larger than 481px */
	if (responsive_viewport > 481) {
		
	} /* end larger than 481px */
	
	/* if is less than 768px */
	if (responsive_viewport < 768) {
		$('.panel-row-style-home-top .widget_text .widget-title').click(function() {
			$('.panel-row-style-home-top .widget_text .ribbon-menu').slideToggle('fast');
		});
		$('.panel-row-style-top-row .widget_text .widget-title').click(function() {
			$('.panel-row-style-top-row .widget_text .ribbon-menu').slideToggle('fast');
		});
		$('.panel-row-style-top-row .widget_execphp .widget-title').click(function() {
			$('.panel-row-style-top-row .widget_execphp .build-menu').slideToggle('fast');
		});
	} /* end less than 768px */

	/* if is above or equal to 768px */
	if (responsive_viewport >= 768) {
	
		/* load gravatars */
		$('.comment img[data-gravatar]').each(function(){
			$(this).attr('src',$(this).attr('data-gravatar'));
		});
		
		var last_row = $('.panel-row-style-bottom-row').parent();
		if(last_row.length > 0) {
			$('<div class="bottom-row" />').insertBefore('.footer');
			$('.bottom-row').prepend(last_row);
		}

		/*if($('h2.big').length) {
			var build_title_width = $('h2.big').outerWidth();
			$('.jump-menu').css('margin-left',build_title_width+50);
		}
		if($('h2.build-page-type-title').length) {
			var build_title_width = $('h2.build-page-type-title').outerWidth();
			$('.jump-menu').css('margin-right',550 - build_title_width);
		} */
	}
	
	/* off the bat large screen actions */
	if (responsive_viewport > 1030) {
	
	}
	
 	
 	//toggle resource details
	jQuery('.toggle').click(function (e) {
		jQuery(this).toggleClass('active');
		var active = jQuery(this).siblings('.post-detail');
		var tease = jQuery(this).siblings('.post-tease');
		tease.toggle('fast').addClass('closed');
		active.slideToggle('fast').addClass('open');
		var text = jQuery(this).text();
        jQuery(this).text(text == "Show Detail" ? "Hide Detail" : "Show Detail");
        jQuery('.open').not(active).slideUp('slow').removeClass('open');
        jQuery('.toggle').not(this).text('Show Detail').removeClass('active');
		e.preventDefault();
	});

	$('.uwpqsftext').attr('placeholder', 'Enter Keywords');

  // accordion
  
$( "#menu-issues" ).accordion();
	
$( ".search-button" ).click(function() {
  $( ".search-form" ).toggle();
  $( "#s" ).focus();
});


	//click map area
	if($('.imgmap-frontend-image').length > 0) {
		$('area').click(function(e) {
			var tip = $(this).attr('data-tooltip');
			var url = tip.match('a href=[\'"]?([^\'" >]+)');
			window.location = url[1];
		});
	}

 //resource read more function to make sure the specific PDF link is inserted into the Sign-up Form for after Submission 
 $('.rm-btn').click(function(){
    var link = $("#link-field").attr("href");
    $('.content_button').attr('href', link);
});


}); /* end of as page load scripts */

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
	var doc = w.document;
	if( !doc.querySelector ){ return; }
	var meta = doc.querySelector( "meta[name=viewport]" ),
		initialContent = meta && meta.getAttribute( "content" ),
		disabledZoom = initialContent + ",maximum-scale=1",
		enabledZoom = initialContent + ",maximum-scale=10",
		enabled = true,
		x, y, z, aig;
	if( !meta ){ return; }
	function restoreZoom(){
		meta.setAttribute( "content", enabledZoom );
		enabled = true; }
	function disableZoom(){
		meta.setAttribute( "content", disabledZoom );
		enabled = false; }
	function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
		if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );