@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="mb-4">Settings</h1>

        <div class="card mb-5">
            <div class="card-header">
                <h2 class="mb-0">API Keys</h2>
                <p class="mb-0">You can use the API to upload images via programs like ShareX.</p>
            </div>
            <div class="card-body">
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
                        <input class="form-control" name="name" type="text" placeholder="My cool API Key">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Create Key</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="card mb-5">
            <div class="card-header">
                <h2 class="mb-0">Custom Domains</h2>
                <p class="mb-0">You can use this to add your own domains, for example https://images.jhondoe.net is a custom domain</p>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">
                    <h3>Imporant</h3>
                    <p>In order to use this feature you'll need to create a CNAME on your domain that points to the origin domain. You'll also need to manually route the domain to the correct website.</p>
                </div>
                @if (count($domains) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Domain</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($domains as $domain)
                                <tr>
                                    <td style="width: 50%">{{ $domain->name }}</td>
                                    <td style="width: 40%">{{ $domain->domain }}</td>
                                    <td style="width: 10%">
                                        <a class="btn btn-danger btn-sm" href="{{ url('/settings/domain/delete/'. $domain->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <p class="mb-3">Add a custom domain</p>
                <form class="form" action="{{ url('/settings/domain/add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="My Cool Domain">
                        
                        <label for="domain">Domain (Do not include https:// or http://)</label>
                        <input class="form-control" name="domain" type="text" placeholder="images.jhondoe.com">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection