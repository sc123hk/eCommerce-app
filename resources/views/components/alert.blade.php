@if (session('message'))
    <div class="alert alert-success session-alert">
        {{session('message')}}
    </div>
@endif