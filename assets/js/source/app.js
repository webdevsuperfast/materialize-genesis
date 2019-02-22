'use strict';

(function($){
    $(document).ready(function(){
        // main dropdown initialization
        // $('.dropdown-trigger.main-menu-item').dropdown({
        //     inDuration: 300,
        //     outDuration: 225,
        //     constrain_width: true, // Does not change width of dropdown to that of the activator
        //     hover: true, // Activate on hover
        //     belowOrigin: true, // Displays dropdown below the button
        //     alignment: 'left' // Displays dropdown with edge aligned to the left of button
        // });
        // nested dropdown initialization
        // $('.dropdown-trigger.sub-menu-item').dropdown({
        //     inDuration: 300,
        //     outDuration: 225,
        //     constrain_width: false, // Does not change width of dropdown to that of the activator
        //     hover: true, // Activate on hover
        //     // gutter: ($('.dropdown-content').width() * 3) / 3.05 + 3, // Spacing from edge
        //     belowOrigin: true, // Displays dropdown below the button
        //     alignment: 'right' // Displays dropdown with edge aligned to the left of button
        // });
        $('.dropdown-trigger').dropdown({
            hover: true,
            coverTrigger: false,
            alignment: 'left',
            constrainWidth: true
        });
        $('.sidenav').sidenav();
    });
})(jQuery);