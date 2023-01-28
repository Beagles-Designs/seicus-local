jQuery(document).ready(function () {
    headerMobile();

    $('.mobile-search input[name="s"]').attr('placeholder', 'Search');

    $('.desktop-search input[name="s"]').attr('placeholder', 'Enter Your Search Term').attr('autocomplete', 'off');

    $('#load-more-news').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.loading-wrap').addClass('loading');
        load_more_posts('#news-wrapper','post');
    });

    /*$('.load-more-resources').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.loading-wrap').addClass('loading');
        load_more_resources($(this).attr('data-box-id'));
    });*/

    $('#load-more-resources').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.loading-wrap').addClass('loading');
        load_more_filtered_resources();
    });

    $('.load-more-ptype').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.loading-wrap').addClass('loading');
        load_more_ptype($(this).attr('data-ptype'), $(this).attr('data-args'), $(this));
    });

    $('.taxonomy_filter').on('change', function(e) {
        e.preventDefault();
        load_more_posts('#news-wrapper','post', null, true);
    });

    $('.resources_taxonomy_filter').on('change', function(e) {
        e.preventDefault();
        filter_resources($('#resources-wrapper .resource-body'), $(this).val());
    });

    toggleDesktopSearchBar();

    $('.match-height').matchHeight();
    $('.select2').select2();

    setIssuesInteraction();
});

$(window).bind('resizeEnd', function() {
    $('.page-template-page-news .individual-news-post').each(function(){
        var height = $(this).find('img').height();
        $(this).find('.thumb-container').height(height);
    });
    $('.match-height').matchHeight();
});

$(window).resize(function() {
    if(this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {
        $(this).trigger('resizeEnd');
    }, 300);
});



function toggleDesktopSearchBar() {
    $('#main-nav.desktop-only .search-button').on('click', function(e) {
        e.preventDefault();
        $(this).stop().toggleClass('active');
        $('.desktop-search form').stop().slideToggle(300);
    });
}

function headerMobile() {
    var hamburger = jQuery('.hamburger'),
        menu = jQuery('#mobile-nav');

    hamburger.stop().on('click', function() {
        if ( hamburger.hasClass('is-active') ) {
            hamburger.removeClass('is-active');
            menu.removeClass('is-active');
        } else {
            hamburger.addClass('is-active');
            menu.addClass('is-active');
        }
    });

    menu.find('.opener').click(function() {
        if( jQuery(this).parent().find('.sub-menu').is(':visible') ) {
            jQuery(this).parent().find('.sub-menu').slideUp('fast');
            jQuery(this).removeClass('expanded');
        }
        else {
            jQuery(this).parent().find('.sub-menu').slideDown('fast');
            jQuery(this).addClass('expanded');
        }
        return false;
    });
}


function load_more_posts(content,posttype,resourcetype,resetpagination) {
    var $content = $(content);
    var offset = !resetpagination ? $(content + ' .individual-news-post').length : 1;
    var loading = true;
    var term = $('.taxonomy_filter').val();

    $.ajax({
        type       : 'GET',
        data       : {
            posttype : posttype,
            resourcetype: resourcetype,
            action: 'load_more_posts',
            term_id : (term && term != 'all') ? term : '',
            paged: resetpagination ? 1 : $('.paged').val(),
        },
        dataType   : 'json',
        url        : siecus.ajax_url,
        success    : function(response){

            $data = response.html;

            $('.loading-wrap').removeClass('loading');

            if (resetpagination) {
                $('.paged').val(2);
                $content.html($data);
            } else {
                var paged = $('.paged').val();
                $('.paged').val(parseInt(paged) + 1);
                $content.append($data);
            }
            if (response.show_next_page) {
                $('.loading-container').show();
            } else {
                $('.loading-container').hide();
            }


            if (window.stButtons){stButtons.locateElements();} // Parse ShareThis markup

            $('.select2').select2();

            $('.match-height').matchHeight();

            $content.find('.newly-loaded').each(function(){
                $(this).fadeIn(300).removeClass('newly-loaded');
            });

            setTimeout(function () {
                $(window).trigger('resizeEnd');
            }, 300);

        },
        error     : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }
    });
}

function filter_resources(container, boxID) {
    $('.paged').val(1);
    $.ajax({
        type       : 'GET',
        data       : {
            action: 'load_more_resources',
            term_id : boxID,
            paged: 1,
        },
        dataType   : 'json',
        url        : siecus.ajax_url,
        success    : function(response){

            $data = response.html;
            container.html($data);

            $('.paged').val(2);

            $('.loading-wrap').removeClass('loading');

            if (response.show_next_page) {
                $('.loading-container').show();
            } else {
                $('.loading-container').hide();
            }

            container.find('.newly-loaded').each(function(){
                $(this).fadeIn(300).removeClass('newly-loaded');
            });
        }
    });
}

function load_more_filtered_resources() {
    var paged = $('.paged').val();
    $.ajax({
        type       : 'GET',
        data       : {
            action: 'load_more_resources',
            term_id : $('.resources_taxonomy_filter').val(),
            paged: paged,
        },
        dataType   : 'json',
        url        : siecus.ajax_url,
        success    : function(response) {

            var contentWrapper = $('.resource-body');

            $data = response.html;
            contentWrapper.append($data);

            $('.loading-wrap').removeClass('loading');

            $('.paged').val(parseInt(paged) + 1);

            if (response.show_next_page) {
                $('.loading-container').show();
            } else {
                $('.loading-container').hide();
            }

             contentWrapper.find('.newly-loaded').each(function(){
                $(this).fadeIn(300);
            });
        }
    });
}

function load_more_resources(boxID) {
    $.ajax({
        type       : 'GET',
        data       : {
            action: 'load_more_resources',
            term_id : boxID,
            paged: $('#resource-' + boxID + ' .paged').val(),
        },
        dataType   : 'json',
        url        : siecus.ajax_url,
        success    : function(response){

            $data = response.html;

            $('.loading-wrap').removeClass('loading');
            var contentWrapper = $('#resource-' + boxID + ' .resource-body');

            contentWrapper.append($data);

            if (response.show_next_page) {
                $('#resource-' + boxID + ' .loading-container').show();
            } else {
                $('#resource-' + boxID + ' .loading-container').hide();
            }

            var paged = $('#resource-' + boxID + ' .paged').val();
            $('#resource-' + boxID + ' .paged').val(parseInt(paged) + 1);

            if (window.stButtons){stButtons.locateElements();} // Parse ShareThis markup

            //$('.match-height').matchHeight();

            contentWrapper.find('.newly-loaded').each(function(){
                $(this).fadeIn(300).removeClass('newly-loaded');
            });

       /*     setTimeout(function () {
                $(window).trigger('resizeEnd');
            }, 300);*/

        },
        error     : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }
    });
}


function load_more_ptype(ptype, args, thisLoadMore) {

    var loadingContainer = thisLoadMore.parents('.loading-container');
    var thisPaged = loadingContainer.find('.paged');
    var argsArray = jQuery.parseJSON(args);

    $.ajax({
        type       : 'GET',
        data       : {
            action                 : 'load_more_ptype',
            args                   : JSON.stringify(argsArray, null),
            paged                  : thisPaged.val(),
            hide_date              : thisLoadMore.attr('data-hide-date'),
            enable_social_share    : thisLoadMore.attr('data-social-share')
        },
        dataType   : 'json',
        url        : siecus.ajax_url,
        success    : function(response) {

            $data = response.html;

            $('.loading-wrap').removeClass('loading');
            var contentWrapper = loadingContainer.parent().find('ul');

            contentWrapper.append($data);

            if (response.show_next_page) {
                loadingContainer.show();
            } else {
                loadingContainer.hide();
            }

            var paged = thisPaged.val();
            thisPaged.val(parseInt(paged) + 1);

            if (window.stButtons){stButtons.locateElements();} // Parse ShareThis markup

            contentWrapper.find('.newly-loaded').each(function(){
                $(this).fadeIn(300).removeClass('newly-loaded');
            });


        },
        error     : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }
    });
}

function setIssuesInteraction() {
    var maxHeight = 0;
    $('.issue-box .issue-title').each(function(){
        maxHeight = ($(this).height() > maxHeight) ? $(this).height() : maxHeight;
    });
    $('.issue-box .issue-title').height(maxHeight);

    $('.issue-box .issue-title').stop().on('click', function(){
        var thisBox = $(this).parents('.issue-box');
        thisBox.stop().toggleClass('expanded').find('.issue-content').stop().slideToggle();
    });
}
