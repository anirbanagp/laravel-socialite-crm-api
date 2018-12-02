@if ($errors->any())
    <div class="messages show danger">
        @foreach ($errors->getMessages() as $error)
            <p><i class="fas fa-info-circle"></i> {{ $error[0] }}</p>
        @endforeach
    </div>
@endif
