@extends('layouts.app')

@section('title')
    Uploads
@endsection

@section('content')
    <div class="header-spacer"></div>
    <main class="uploads">
        <div class="wrapper">
            @if (count($uploads) > 0)
                @foreach ($uploads as $upload)


                    <div class="uploads__item">
                        <img src="{{ $upload->path_name }}">
                        <div class="uploads__item-overlay">

                            <div class="uploads__item-overlay-inner">
                                <small>some text</small>
                                <div class="uploads__item-overlay-actions">
                                    <a href="{{ url($upload->path_name) }}" target="_blank">View</a>
                                    <a href="">Copy Link</a>
                                    <a href="{{ url('/upload/delete', $upload->id) }}" onclick="event.preventDefault(); return confirm('Are you sure?'); document.getElementById('upload-item-{{ $upload->id }}').submit();">Delete</a>
                                    
                                    <form id="upload-item-{{ $upload->id }}" action="{{ url('/upload/delete', $upload->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                @endforeach
            @else
                <h1>You don't have any uploads at this current time.</h1>
            @endif
        </div>
    </main>

    @include('includes.file-drop')
@endsection