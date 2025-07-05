@extends('tools.auth_head')

@section('title')
    | Messages
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Your Messages</h2>
        <ul class="nav nav-tabs mt-4" id="messageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button"
                    role="tab">Received ({{ count($receivedMessages) }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button"
                    role="tab">Sent ({{ count($sentMessages) }})</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="messageTabsContent">
            <div class="tab-pane fade show active" id="received" role="tabpanel">

                <div class="card mb-3">
                    @foreach ($receivedMessages as $message)
                        <?php
                        // Putting the status of read to true
                        App\Models\Message::where('receiver_id', Auth::id())
                            ->where('is_read', false)
                            ->update(['is_read' => true]);
                        ?>
                        <div class="card mb-3 @if (!$message->is_read) border-primary @endif">
                            <div class="card-body">
                                <p>"{{ $message->body }}"</p>
                                <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="sent" role="tabpanel">
                <div class="card mb-3">
                    @foreach ($sentMessages as $sentMessage)
                        <?php
                        // Defining the user by the reciever_id for each message
                        $receiver = App\Models\User::find($sentMessage->receiver_id);
                        ?>
                        <div class="card-body">
                            <p class="card-text">"{{ $sentMessage->body }}"</p>
                            <p class="card-text"><small class="text-muted">Sent to <a href="/profile/{{ $receiver->id }}"
                                        class="text-muted">{{ $receiver->username }}</a> -
                                    {{ $sentMessage->created_at->diffForHumans() }}</small></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @section('footer')
    @include('tools.footer')
    @endsection
@endsection
