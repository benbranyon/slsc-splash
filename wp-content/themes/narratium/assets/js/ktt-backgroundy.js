/**
* Load background images into an element (div, span, etc)
* use: jQuery( ".ktt-backgroundy" ).ktt_backgroundy();
*/
jQuery.fn.ktt_backgroundy = function() {

    /**
    * We get the thumb version of the image
    */
    var thumb = this.data( "background-thumb");

    /**
    * We get the large version of the image
    */
    var large = this.data( "background-large");

    /**
    * We keep a reference to the parent element
    */
    var this_elem = this;

    /**
    * We put it relative
    */
    this_elem.css("position", "relative");

    /**
    * We are going to put the content of the element in a new div that we will
    * put with absolute position so that the content always appears above
    * the divs that contain the background images
    */
    var content_div = jQuery('<div/>', {'html':this_elem.html()})
    .css("position", "relative")
    .css("width", "100%")
    .css("z-index", "10")
    .css("height", "100%")

    /**
    * We add the div to the elements
    */
    this_elem.html('').prepend(content_div);

    /**
    * First of all we load the tiny image
    */
    var img = jQuery("<img />").attr('src', thumb)
      .load(function() {
          if (this.complete || typeof this.naturalWidth != "undefined" || this.naturalWidth != 0) {

              var thumb_div = jQuery('<div/>')
              .addClass('bg-loady-thumb')
              .css("opacity", "0")
              .css("position", "absolute")
              .css("width", "100%")
              .css("height", "100%")
              .css("z-index", "1")
              .css("background-position", "center center")
              .css("background-size", "cover")
              .css("background-image", "url('" + this.src + "')")

              .css('filter','blur(5px)')
              .css('webkitFilter','blur(5px)')
              .css('mozFilter','blur(5px)')
              .css('oFilter','blur(5px)')
              .css('msFilter','blur(5px)');

              /**
              * We add the div to the elements
              */
              this_elem.prepend(thumb_div);

              /**
              * We encourage the opacity
              */
              thumb_div.fadeTo("fast", 1);


              /**
              * Once we have loaded the thumb we will try to load the larges image
              */
              var img = jQuery("<img />").attr('src', large)
                .load(function() {
                    if (this.complete || typeof this.naturalWidth != "undefined" || this.naturalWidth != 0) {

                        var large_div = jQuery('<div/>')
                        .addClass('bg-loady-large')
                        .css("opacity", "0")
                        .css("position", "absolute")
                        .css("width", "100%")
                        .css("height", "100%")
                        .css("z-index", "2")
                        .css("background-position", "center center")
                        .css("background-size", "cover")
                        .css("background-image", "url('" + this.src + "')")

                        /**
                        * We add the div to the elements
                        */
                        this_elem.prepend(large_div);

                        /**
                        * We encourage the opacity
                        */
                        large_div.fadeTo("slow", 1, function() {
                            thumb_div.remove();
                        });



                    }
                });


          }
      });




};
