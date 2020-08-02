@if ($message = Session::get('success'))
<div class="alert alert-default-success alert-dismissible fade show" role="alert">
    <p><strong>{{ $message }}</strong></p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif ($message = Session::get('failure'))
<div class="alert alert-default-danger alert-dismissible fade show" role="alert">
    <p><strong>{{ $message }}</strong></p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif