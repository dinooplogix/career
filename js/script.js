jQuery(function ($) {
    var mySlider = function ($) {
        var slides = $(".fadeslider img");
        var slideLen = slides.length; //4
        var transitionTime = 2000;


        if (slideLen > 1) {
            setInterval(function () {
                var firstSlider = $(".fadeslider img:first-child");
                firstSlider.fadeOut(transitionTime, function () {
                    firstSlider.appendTo(".fadeslider").fadeIn();

                });
            }, transitionTime + 3000);
        }
    }

    mySlider($);

});