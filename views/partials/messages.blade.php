@if (count($errors) > 0)
<div class="alert bg-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('message'))
<div class="alert bg-success">
    {{ session('message') }}
</div>
@endif
<div class="text-center">
    <div class="alert bg-danger" id="alertError" style="display: none"></div>
</div>