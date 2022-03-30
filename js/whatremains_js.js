document.addEventListener("DOMContentLoaded", function() {



    var videocover = document.getElementById("vimeo-wrapper");
    var iframe = document.getElementById("videoplayer");
  

    if(videocover){
        videocover.style.minHeight = window.innerHeight + "px";

        window.addEventListener('resize', function(event){
            videocover.style.minHeight = 800 + "px";
    
        });
    }

    var playbutton = document.getElementById("playbutton");
    var player = new Vimeo.Player(iframe);


    playbutton.addEventListener('click', function(){
            console.log("click", player);
            playbutton.style.display = "none";
            var data = { method: "play" };
            iframe.contentWindow.postMessage(JSON.stringify(data), "*");
    });

    
    player.on('play', function() {
        playbutton.style.display = "none";

    });

    player.on('pause', function() {
        playbutton.style.display = "block";
    });

    player.on('ended', function(){
        playbutton.style.display = "block";
        cover.style.display = "block";
    });

    player.on('ended', function() {
        console.log('Finished.');
    });







    $('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
      // On-page links
  
      console.log("does jquerz on a click");
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        && 
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            };
          });
        }
      }
    });



});




