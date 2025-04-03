@extends('indexTemplate.profileUser.profile-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Notifications</h3>
            <div class="list-group">
                @forelse($notifications as $notification)
                    <div class="list-group-item {{ $notification->read_at ? '' : 'list-group-item-primary' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $notification->data['message'] }}</h6>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(!$notification->read_at)
                                <span class="badge bg-primary">New</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="list-group-item text-center">
                        <p class="mb-0">No notifications</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection