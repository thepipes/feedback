/* Author:

*/

jQuery(function($) {
  // HELPER FUNCTIONS
  $('#back-to-top').on('click', function(e){
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
  /** 
   * Module: Clickable
   * Description: Make an entire container clickable
   */
  $('[data-module=clickable]').on('click', function (e) {
    var $target = $(e.target)
        $parent = $target.closest('[data-module=clickable]')
      , url = $parent.attr('data-url');
    
    if (url && !$target.closest('a').length) {
      if(e.metaKey) {
        window.open(url);
      } else {
        window.location = url;
      }
    }
  });
  
  /** 
   * Module: Video
   * Description: Show video player popup
   */
  $('body').on('click', 'a[data-module=video]', function (e) {
    var upgradeFlash = false;
    if(FlashDetect.installed){
      if (FlashDetect.major < 9) {
        upgradeFlash = true;
      }
    } else {
      upgradeFlash = true;
    }
    if (supports_h264_baseline_video() != false) {
      //upgradeFlash = false;
    }
    if (upgradeFlash) {
      var $target = $(e.target)
      $parent = $target.length && $target.closest('[data-module=video]')
        , template = '<div class="video-modal reveal-modal">\
            <h3>Please install the latest version of flash.</h3>\
            <div class="grid8 flash-msg">\
              <p>\
              We recommend using at least Flash version 10.0.0\
              <br/><a href="http://get.adobe.com/flashplayer/" target="_blank"><img src="/wp-content/themes/roots/img/flash-msg_btn.png" /></a>\
            <ul>\
              <li>Save the Flash installer to your computer</li>\
              <li>Quit any and all web browsers you\'re running</li>\
              <li>Run the Flash installer</li>\
          </ul>\
            </p>\
          </div>\
            <a class="close-reveal-modal">&#215;</a>\
            <img src="/images/public-site-spacer.gif?ref=no-flash-video" width="0" height="0" class="yj-hide" />\
          </div>';

        var title, $video;
        // don't follow click
        e.preventDefault();
        // display title if defined
        title = $parent.attr('title') || '';
        // create video modal and show
        $video = $(Mustache.to_html(template, { title: title }));
        $(document.body).append($video); // attach to document
        $video.on('reveal:close', function () {
          $video.remove(); // remove video modal (this will stop the video if it's still playing)
        });
        $video.reveal(); // show popup

      } else {
      var $target = $(e.target)
          $parent = $target.length && $target.closest('[data-module=video]')
        , url = $parent.length && $parent.attr('href')
        , template = '<div class="video-modal reveal-modal">\
            {{#title}}<h3>{{title}}</h3>{{/title}}\
            <iframe src="{{url}}?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="600" height="338" frameborder="0" \
              webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>\
            <a class="close-reveal-modal">&#215;</a>\
            <img src="{{track}}" width="0" height="0" class="yj-hide" />\
          </div>';

      if (url) {
        var track = $('#yamalytics').attr('src');
        if(track.indexOf('?') == -1)
          track = track+"?ref=video";
        else
          track = track+"&ref=video";
        var title, ref_title, $video;
        // don't follow click
        e.preventDefault();
        // display title if defined
        title = $parent.attr('title') || '';
        ref_title = ($parent.attr('title') ? $parent.attr('title').replace(' ','_') : '');
        // create video modal and show
        $video = $(Mustache.to_html(template, { url: url, title: title, ref_title: ref_title, track: track}));
        $(document.body).append($video); // attach to document
        $video.on('reveal:close', function () {
          $video.remove(); // remove video modal (this will stop the video if it's still playing)
        });
        $video.reveal(); // show popup
      }
    }
  });

  /** 
   * Module: Inline Video
   * Description: Show video player inline
   */
  $('body').on('click', 'a[data-module=inline-video]', function (e) {
      var $target = $(e.target)
        , $parent = $target.length && $target.closest('[data-module=inline-video]')
        , $grandparent = $parent.length && $parent.closest('div')
        , url = $parent.length && $parent.attr('href')
        , theclass =  $parent.attr('data-attr')
        , template = '<iframe class="inline-video {{theclass}}" src="{{url}}?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="650" height="376" frameborder="0" \webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
      if (url) {
        var track = $('#yamalytics').attr('src');
        if(track.indexOf('?') == -1)
          track = track+"?ref=video";
        else
          track = track+"&ref=video";
        var title, ref_title, $video;
        // don't follow click
        e.preventDefault();
        // display title if defined
        title = $parent.attr('title') || '';
        ref_title = ($parent.attr('title') ? $parent.attr('title').replace(' ','_') : '');
        // create video modal and show
        $video = $(Mustache.to_html(template, { url: url, title: title, ref_title: ref_title, track: track, theclass: theclass }));
        $($grandparent).append($video); // attach to document
        $($parent).remove();
      }
  });

  /**
   * Module: Toggle Content
   * Description: toggle block of text. Hide link's must be inside of the toggle box. Support mutilple toggles per page.
   */ 
  $('[data-toggle=text-show]').on('click', function (e) {
    var id = $(e.target).attr('href');
    $(id).show().find('[data-toggle=text-hide]').on('click', function (e) {
      var id = $(e.target).attr('href');
      $(id).hide();
      return false
    });
    return false;
  })

  /**
   * Module: Toggle pricing feature bullets
   * Description:
   */
  $('.pricing-feature').click(function () {
      var $el = $(this);
      $el.siblings('.pricing-subfeatures').toggle();
      $el.find('.arrow').toggleClass('arrow-right arrow-down');
  })
  
  jQuery.fn.exists = function () {
    return this.length !== 0;
  }

  if(jQuery("#dismiss-announcement").exists() == true) {
    jQuery("#dismiss-announcement").click(function() {
      jQuery.cookie("announcement", "hidden", { expires: 1, path: '/' });
      jQuery(".announcement").slideUp();
    });
  }

});

jQuery(document).ready(function(){
  if(jQuery("#dismiss-announcement").exists() == true) {
    var announcement = jQuery.cookie('announcement');
    if(announcement == 'hidden') {
      jQuery(".announcement").hide();
    }
    else {
      jQuery(".announcement").show();
    }
  }
});

function supports_video() {
  return !!document.createElement('video').canPlayType;
}
function supports_h264_baseline_video() {
  if (!supports_video()) { return false; }
  var v = document.createElement("video");
  return v.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"');
}

function validateSearchForm(formObj) {
  if (jQuery('#s').val() == '' && jQuery('#s404').val() == '') {
    jQuery('#s').focus();
    return false;
  } else {
    return true;
  }  
}