<div class="file-drop">
    <div class="file-drop__inner">
        <i class="fas fa-file"></i>
        <h1>Drop File Here</h1>
    </div>
    <form id="file-drop-form" method="POST" action="{{ url('/upload/store') }}" enctype="multipart/form-data">
        @csrf
        <input id="file-input" name="file" type="file">
    </form>
</div>