@if ($message = session('message'))
    <div class="alert alert-{{ $message['success'] ? 'success my-bg text-white' : 'danger' }}" role="alert">
        <i class="fa fa-fw fa-{{ $message['success'] ? 'check-circle' : 'ban' }}"></i> {{ $message['message'] }}
    </div>
@endif
