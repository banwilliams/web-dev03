<?php

$VIDEOURL_B_1  = "%VIDEOURL_B_1%";
$VIDEOIMG_B_1  = "%VIDEOIMG_B_1%";
$LEFT_HEAD  = "%LEFT_HEAD%";
$RIGHT_HEAD  = "%RIGHT_HEAD%";

//get the id number of the vieo URL to use in the lazyYT div tag
$str = $VIDEOURL_B_1 ;
$out = array();
$arr = explode('/', $str);

$result = count($arr);
$videourl =  $arr[$result-1];

?>
<style>

.lazyYT-title {
    z-index: 100!important;
    color: #fff!important;
    font-family: sans-serif!important;
    font-size: 12px!important;
    top: 10px!important;
    left: 12px!important;
    position: absolute!important;
    margin: 0!important;
    padding: 0!important;
    line-height: 1!important;
    font-style: normal!important;
    font-weight: normal!important;

}

.lazyYT-button {
    margin: 0!important;
    padding: 0!important;
 width: 64px!important;
    height: 64px!important;
    z-index: 100!important;
    position: absolute!important;
    top: 50%!important;
    margin-top: -22px!important;
    left: 50%!important;
    margin-left: -30px!important;
    line-height: 1!important;
    font-style: normal!important;
    font-weight: normal!important;
    background-image: url('http://<?php print DOMAIN ?>/site/images/video_play.png')!important;
background-repeat:no-repeat;
}
</style>
<section class="slider-numbers video image">
    <div class="w_row twelve-hun-max">
<!--    <h5 class="section-title small-12 columns fu_video_head1"><?php print $LEFT_HEAD ?></h5>
-->
        <div class="large-12 columns">
            <div class="w_row">
                <ul>
                  <li>
<img src="http://<?php print DOMAIN ?>/images/<?php print $VIDEOIMG_B_1 ?>" alt="" title="" class="fu_video_div_img" />
                    <div class="orbit-caption fu_video_div">
                        <p><a href="#" class="videoModal-1"><img src="/images/video_circle.png" alt="" title="" class="fu_video_circle" /></p><p><span class="fu_video_text"><?php 
$VIDEOS_B_1  = "%VIDEOS_B_1%";
print $VIDEOS_B_1;
?></span></a></p>
                    </div>
                  </li>
                 
                </ul>
            </div>
        </div>
<!--        <a class="section-link" href="<?php print $RIGHT_HEAD ?>" title="">View All Videos</a>
-->
    </div>
</section>
<script>
function changeSource(newSource) {
var height = "100%";
var width = "100%";
document.getElementById('player').innerHTML= ('<iframe width="' + width + '" height="' + height + '" src="//www.youtube.com/embed/<?php echo $videourl?>?rel=0&autoplay=0&autohide=0"  style="position:absolute; top:0; left:0; width:100%; height:100%;" id="video" allowFullScreen></iframe>');

} 
</script>
<div id="videoModal-1" class="reveal-modal large">
        <div class="modal-content">
            <h2>Video 1</h2>
            <div class="flex-video">
            <div class="js-lazyYT" data-youtube-id="<?php print $videourl ?>" ratio="5:4" data-parameters="rel=0" id="player"></div>
<!--<iframe width="70%" height="70%" src="<?php print $VIDEOURL_B_1 ?>" style="border:none;" allowfullscreen></iframe>-->
            </div>

        </div>
<a class="close-reveal-modal" id="close" onclick=changeSource();>x</a>
  </div>
  









  /*! LazyYT (lazy load Youtube videos plugin) - v0.3.4 - 2014-06-30
* Usage: <div class="lazyYT" data-youtube-id="laknj093n" ratio="16:9" data-parameters="rel=0">loading...</div>
* Copyright (c) 2014 Tyler Pearson; Licensed MIT */

;(function ($) {
    'use strict';

    function setUp($el) {
var theclient = "";

               var isMobile = {

                   Android: function () {

                       return navigator.userAgent.match(/Android/i) ? true : false;

                   },

                   BlackBerry: function () {

                       return navigator.userAgent.match(/BlackBerry/i) ? true : false;

                   },

                   iOS: function () {

                       return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;

                   },

                   Windows: function () {

                       return navigator.userAgent.match(/IEMobile/i) ? true : false;

                   },

                   any: function () {

                       return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());

                   }

               };

        var width = $el.data('width'),
            height = $el.data('height'),
            id = $el.data('youtube-id'),
            youtubeParameters = $el.data('parameters') || '';

if (typeof width === 'undefined' || typeof height === 'undefined') {
var ratio = "5:4";
var aspectRatio ="";
var paddingTop ="";
  height = 0;
  width = '100%';
  aspectRatio = (ratio.split(":")[1] / ratio.split(":")[0]) * 100;
aspectRatio = aspectRatio -20;
  paddingTop = aspectRatio + '%' ;
}

        if ( typeof id === 'undefined') {
            throw new Error('lazyYT is missing a required data attribute.');
        }


     
if (isMobile.any()) {

                  $el.html('<iframe width="' + width + '" height="' + height + '" src="//www.youtube.com/embed/' + id + '?&autoplay=1&autohide=0&' + youtubeParameters + '" style="position:absolute; top:0; left:0; width:100%; height:100%;" id="video" allowFullScreen></iframe>')
                    .removeClass('lazyYT-image-loaded')
                    .addClass('lazyYT-video-loaded');

               }

               else {

$el.css({
            'position': 'relative',
            'height': 'height',
            'width': 'width',
            'background': 'url(http://img.youtube.com/vi/' + id + '/0.jpg) center center no-repeat',
            'cursor': 'pointer',
            '-webkit-background-size': 'cover',
            '-moz-background-size': 'cover',
            '-o-background-size': 'cover',
'padding-top': paddingTop,
            'background-size': 'cover'
        })
            .html('<p id="lazyYT-title-' + id + '" class="lazyYT-title"></p><div class="lazyYT-button"></div>')
            .addClass('lazyYT-image-loaded');

                $.getJSON('https://gdata.youtube.com/feeds/api/videos/' + id + '?v=2&alt=json', function (data) {
            $('#lazyYT-title-' + id).text(data.entry.title.$t);
        });

       $el.on('click', function (e) {
            e.preventDefault();

            if (!$el.hasClass('lazyYT-video-loaded') && $el.hasClass('lazyYT-image-loaded')) {



                  $el.html('<iframe width="' + width + '" height="' + height + '" src="//www.youtube.com/embed/' + id + '?&autoplay=1&autohide=0" style="position:absolute; top:0; left:0; width:100%; height:100%;"  id="video" allowFullScreen></iframe>')
                    .removeClass('lazyYT-image-loaded')
                    .addClass('lazyYT-video-loaded');
              }
        });

    }
}


    $.fn.lazyYT = function () {
        return this.each(function () {
            var $el = $(this).css('cursor', 'pointer');
            setUp($el);
        });
    };

}(jQuery));

        $( document ).ready(function() {
           $('.js-lazyYT').lazyYT();



       });













       <table class="form_table" id="tbl_widget_content">
<input type="hidden" value="<?php print $DOMAIN; ?>" id="DOMAIN" />
<tr><td class="label_cell">Left Head</td>
<td class="data_cell"><input id="left_head" value="" size="45" type="text" />
</td>
</tr>

<tr>
<td class="label_cell">Right Head Link</td>
<td class="data_cell"><input id="right_head" value="" size="45" type="text" />
</td>
</tr>

<tr><td colspan="2" bgcolor="#ffffff">
 
</td></tr>


<tr><td class="label_cell">Video text 1</td><td class="data_cell"><input id="videos_b_1" value="" size="45" type="text" /></td></tr>
<tr><td class="label_cell">URL:</td><td class="data_cell"><input id="videourl_b_1" value="" size="45" type="text" /></td></tr>
<tr><td class="label_cell">Image:</td><td class="data_cell"><input type="hidden" id="videoimg_b_1" value="" onchange="$('videoimgi_b_1').src='http://' + DOMAIN + '/images/' + this.value;"  />
<img id="videoimgi_b_1" class="img_preview" src="<?php print $SECURE_JADU_PATH; ?>/images/no_image.gif" />
<input type="button" class="button" value="Image Library" onclick="return loadLightbox('image_manager/image_manager', 'lb2', 'mode=lb2&imagePreviewID=videoimgi_b_1&imageFilenameID=videoimg_b_1'); " /></td></tr>
<tr><td colspan="2" bgcolor="#ffffff"></td></tr>

</table>