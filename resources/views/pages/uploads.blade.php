@extends('layouts.app')

@section('title')
    Uploads
@endsection

@section('content')
    <main class="uploads">
        @if (count($uploads) > 0)
            <div class="header-spacer"></div>
            <div class="wrapper">
            @foreach ($uploads as $upload)


                    <div class="uploads__item">
                        <div class="div-img" style="background-image: url('{{'storage/' . $upload->path_name }}')"></div>
                        <div class="uploads__item-overlay">

                            <div class="uploads__item-overlay-inner">
                                <small>some text</small>
                                <div class="uploads__item-overlay-actions">
                                    <a href="{{ url('storage/' . $upload->path_name) }}" target="_blank">View</a>
                                    <a class="clipboard-copy-btn" href="{{ url( 's', $upload->slug) }}">Copy</a>
                                    <a href="{{ url('/upload/delete', $upload->id) }}" onclick="event.preventDefault(); document.getElementById('upload-item-{{ $upload->id }}').submit();">Delete</a>
                                    
                                    <form id="upload-item-{{ $upload->id }}" action="{{ url('/upload/delete', $upload->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                @endforeach
            </div>
        @else
            <div class="uploads__no-content">
                <div class="uploads__no-content-inner">
                    <i class="fas fa-file-excel"></i>
                    <h1>You have not uploaded anything yet</h1>
                </div>
            </div>
        @endif
    </main>

    @include('includes.file-drop')
@endsection