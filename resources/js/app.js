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
        $('body').css('overflow', 'hidden');
    });
    
    $('.drop-container').on('dragleave', function(e) {
        $('.file-drop').removeClass('file-drop-toggled');
        $('body').css('overflow', 'hidden');
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

    /*
        Component: Message Box Large
    */
    
    // Close box
    $('.msg-box-lg-close').click(function(e) {
        $(this).closest('.msg-box-lg').toggle();
        $(this).closest('.msg-box-lg__wrap').toggle();
    });

    // Copy Button
    $('.msg-box-lg__copy-box-btn').click(function(e) {
        $('.msg-box-lg__copy-box-input').select();
        document.execCommand("copy");
    });
});