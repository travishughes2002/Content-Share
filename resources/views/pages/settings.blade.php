@extends('layouts.app')

@section('title')
    Settings
@endsection

@section('content')
    <main class="settings">
        <div class="header-spacer"></div>
        <div class="wrapper">
            <div class="settings__head">
                <h1>Settings</h1>
            </div>
            <div class="settings__body">


                <!-- API Keys -->
                <section class="settings-api">
                    <h2>API Keys</h2>
                    <p>You can use the API feature to upload files using an external program (i.e ShareX For example).</p>
                    @if (count($apiKeys) > 0)
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($apiKeys as $apiKey)
                                <tr>
                                    <td>{{ $apiKey->id }}</td>
                                    <td>{{ $apiKey->name }}</td>
                                    <td>
                                        <a href="{{ url('/api/delete', $apiKey->id) }}" onclick="event.preventDefault(); document.getElementById('api-key-item-{{ $apiKey->id }}').submit();">Delete</a>
                                    
                                        <form id="api-key-item-{{ $apiKey->id }}" action="{{ url('/api/delete', $apiKey->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <h3>Create API Key</h3>
                    <form action="{{ url('api/create') }}" method="post">
                        @csrf

                        <div class="field-group">
                            <input name="name" type="text" placeholder="Name">
                        </div>
                        <div class="field-group">
                            <button class="btn-primary" type="submit">Create Key</button>
                        </div>
                    </form>

                    @if(\Session::has('success'))
                        <div class="msg-box-lg__wrap">
                            <div class="msg-box-lg">
                                <div class="msg-box-lg__content">
                                    <i class="fas fa-check"></i>
                                    <h2>Success</h2>
                                    <p>Your API key has been created Successfully. Note for security reasons we will only show you this key once so we advise you save it to a safe location.</p>
                                    <div class="msg-box-lg__copy-box">
                                        <input class="msg-box-lg__copy-box-input" type="text" value="{!! \Session::get('success') !!}">
                                        <button class="msg-box-lg__copy-box-btn"><i class="far fa-copy"></i></button>
                                    </div>
                                </div>
                                <button class="msg-box-lg__btn msg-box-lg-close">Close</button>
                            </div>
                        </div>
                    @endif
                    @error('name')
                        <div class="msg-box-lg__wrap">
                            <div class="msg-box-lg">
                                <div class="msg-box-lg__content">
                                    <i class="fas fa-times"></i>
                                    <h2>Name Already Taken</h2>
                                    <p>The name of your API key must be unique.</p>
                                </div>
                                <button class="msg-box-lg__btn msg-box-lg-close">Close</button>
                            </div>
                        </div>
                    @enderror
                </section>
                <!-- /API Keys -->


            </div>
        </div>
    </main>
@endsection