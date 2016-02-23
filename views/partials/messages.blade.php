@if (session('message'))
<div class="alert bg-success">
    {{ session('message') }}
</div>
@endif
<div class="text-center">
    <div class="alert bg-danger" id="alertError" style="display: none"></div>
</div>