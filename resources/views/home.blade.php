@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center drop-container" style="height: 91.8vh;">


    <div class="drop-upload enabled" style="text-align: center;">
        <i class="fas fa-file-download icon" style="font-size: 5rem; color: lightgray;"></i>
        <h1>Drop Image Here</h1>
        <form style="display: none;" id="form" method="POST" action="{{ url('/upload') }}" enctype="multipart/form-data">
            <input id="image-input" name="image" type="file">
            @csrf
        </form>
    </div>


    <div class="upload-form">
        <h1 class="text-center mb-2">Upload an image</h1>
        <form method="POST" action="{{ url('/upload') }}" enctype="multipart/form-data">
            <input name="image" type="file">
            @csrf
            <button class="btn btn-primary" type="submit">Upload</button>
        </form>
    </div>


    <div class="upload-switch">
        <button id="upload-type-toggle" class="btn btn-primary btn-sm">Toggle Form Mode</button>
    </div>
    <script>
        $(document).ready(function() {

            // This stops the browsr from loading the image
            // when you drop it into the window
            window.addEventListener("dragover",function(e) {
                e.preventDefault();
            });

            window.addEventListener("drop",function(e) {
                e.preventDefault();
            });

            // This adds the hover effect
            $('.drop-container').on('dragover', function(e){
                $(this).find('.icon').addClass('on-drag');
            });

            $('.drop-container').on('dragleave', function(e){
                $(this).find('.icon').removeClass('on-drag');   
            });

            // This detects when the image has been dropped, adds the data to the form input and submits it.
            $('.drop-container').on('drop', function(e) {
                e.preventDefault();
                var image = e.originalEvent.dataTransfer.files;

                $(this).find('#image-input').css('background', 'blue');
                $(this).find('#image-input').prop("files", image);

                $(this).find('#form').submit();
		    });



            // This toggles between drag and form mode.
            $( "#upload-type-toggle" ).click(function() {
                $('.drop-upload').toggleClass('enabled');
                $('.upload-form').toggleClass('enabled');

                if($(this).text() == 'Toggle Form Mode') {
                    $(this).text('Toggle Drop Mode');
                } else {
                    $(this).text('Toggle Form Mode');
                }
            });
        });
    </script>
    <style>
        .on-drag {
            color: #3490dc !important;
        }

        .upload-switch {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 1rem
        }

        .upload-form, .drop-upload {
            display: none;
        }

        .enabled {
            display: block;
        }

    </style>
</div>
@endsection
