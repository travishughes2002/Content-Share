// require('./bootstrap');

$(document).ready(function() {

    /*
        File Drop
    */
    // This stops the browsr from loading the image
    // when you drop it into the window
    window.addEventListener("dragover",function(e) {
        e.preventDefault();
        $('.file-drop').addClass('file-drop-toggled');
    });
    
    $('.drop-container').on('dragleave', function(e) {
        $('.file-drop').removeClass('file-drop-toggled');
    });

    // This detects when the image has been dropped, adds the data to the form input and submits it.
    $('.file-drop').on('drop', function(e) {
        e.preventDefault();
        var file = e.originalEvent.dataTransfer.files;
        $(this).find('#file-input').prop("files", file);
        $(this).find('#file-drop-form').submit();
    });


    /*
        Copy to Clipboard
    */
    $('.clipboard-copy-btn').click(function(e) {
        e.preventDefault();
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(this).prop('href')).select();
        document.execCommand("copy");
        $temp.remove();
    });
});