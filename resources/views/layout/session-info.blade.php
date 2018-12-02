@if (session('alert_msg'))
   <div class="messages show {{ session('alert_class') }}">
       <p><i class="fas fa-info-circle"></i> {{ session('alert_msg') }}</p>
   </div>
@endif
