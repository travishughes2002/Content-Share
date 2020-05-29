@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>Settings</h1>

        <div class="card mb-5">
            <div class="card-header">
                API Keys
            </div>
            <div class="card-body">
                <p>You can use the API to upload images via programs like ShareX.</p>
                @if (count($apiKeys) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>API Key</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apiKeys as $apiKey)
                                <tr>
                                    <td style="width: 50%">{{ $apiKey->name }}</td>
                                    <td style="width: 40%">{{ $apiKey->key }}</td>
                                    <td style="width: 10%">
                                        <a class="btn btn-danger btn-sm" href="{{ url('/settings/api/delete/'. $apiKey->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <p class="mb-3">Create an API key</p>
                <form class="form" action="{{ url('/settings/api/create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" type="text">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Create Key</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection