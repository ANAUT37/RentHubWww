<div>
    <div wire:poll.5000ms>
        @foreach ($messages as $message)
            <div>{{ $message->content }}</div>
        @endforeach
    </div>       
</div>
