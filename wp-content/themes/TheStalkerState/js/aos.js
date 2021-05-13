// Custom scripts file

jQuery( document ).ready(function( $ ) {

  'use strict';

var playCounter = 0;
var textCounter = 0;

var $video1 = $("#video1");
var $text1 = $('#infographic__text-intro');
var imagebg = new Image();
imagebg.src = "/wp-content/themes/TheStalkerState/assets/images/loading.png";

var timerID;

var $canvas = $("#videoCanvas");
var ctx = $canvas[0].getContext("2d");


if (imagebg.complete) {
  ctx.drawImage(imagebg, 0, 0);
} else {
  imagebg.onload = function () {
    ctx.drawImage(imagebg, 0, 0);    
  };
}

function stopTimer() {
  window.clearInterval(timerID);
}

$('.aos-infographic__display').animate({'opacity': 0}, 1000, function () {
  $(this).html($text1.html());
}).animate({'opacity': 1}, 1000);

$('#infographicNext').click(function(event) {
  event.preventDefault();
  stopTimer();
  playCounter ++;
  textCounter ++;
  if(playCounter == 20) {
    $('.aos-infographic__info').slideUp('slow');
    $('.aos-infographic__animation').animate({    
      width: "100%"
    }, 4000, function() {
      $('#finalShot')[0].play();
      timerID = window.setInterval(function() {
        drawImage($('#finalShot')[0]);
      }, 30);  
    });  
  }
  else {
    if($('#infographicPrev').css('visibility') == 'hidden'){
      $('#infographicPrev').addClass("m-fadeIn");
    }
    $('#video'+playCounter)[0].play();
    timerID = window.setInterval(function() {
      drawImage($('#video'+playCounter)[0]);
    }, 30);
    $('.aos-infographic__display').animate({'opacity': 0}, 1000, function () {
      $(this).html($('#infographic__text'+textCounter).html());
    }).animate({'opacity': 1}, 1000);
  }
});

$('#infographicPrev').click(function(event) {
  event.preventDefault();
  stopTimer();
  textCounter --;
  var video = $('#video'+playCounter)[0];
  video.playbackRate = 1.0;
  var intervalRewind = setInterval(function(){
         video.playbackRate = 1.0;
         if(video.currentTime == 0){
             clearInterval(intervalRewind);
             video.pause();
         }
         else{
             video.currentTime += -.1;
         }
  },100);
  timerID = window.setInterval(function() {
    drawImage(video);
  }, 100);
  playCounter --;
  $('.aos-infographic__display').animate({'opacity': 0}, 1000, function () {
    $(this).html($('#infographic__text'+textCounter).html());
  }).animate({'opacity': 1}, 1000);
});

function drawImage(video) {
  //last 2 params are video width and height
  ctx.drawImage(video, 0, 0, 1180, 640);
}

});