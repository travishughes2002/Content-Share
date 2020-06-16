@extends('layouts.app')

@section('content')
    <div class="container mt-3">
            <h1 class="mb-3 text-center">Your Uploads</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>URL</th>
                        <th>Acticon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image)
                        <tr>
                            <td style="width: 40%;">
                                <img style="max-width: 100%;" src="{{ url('/', $image->pathname) }}" alt="404">
                            </td>
                            <td style="width: 50%;">
                                <ul>
                                    <li>Full path: <a href="{{ url('/', $image->pathname) }}" target="_blank">{{ url('/', $image->pathname) }}</a></li>
                                    <li>Shortcode: <a href="{{ url('/i', $image->slug) }}" target="_blank">{{ url('/i', $image->slug) }}</a></li>
                                    @foreach ($domains as $domain)
                                        <li>Custom Domain: <a href="{{ 'https', $domain->domain, '/i', $image->slug}}" target="_blank">{{ 'https://', $domain->domain, '/i', $image->slug }}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                            <th style="width: 5%;">
                                <a class="btn btn-danger text-white" href="{{ url('/uploads/delete', $image->id) }}">Delete</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection