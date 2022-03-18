<ul class="menu">
@forelse (App\Http\Models\Notifications::get_mine(Auth::id()) as $value)
<li  class="{{ $value->seen == 0 ? 'unseen' : 'seen' }}">
    <div class="container-fluid">
        <div class="row">

            @if($value->icon == 'card_giftcard')
              <a href="{{ url('notifications') }}" class="waves-effect waves-block">
            @endif
            @if($value->icon == 'star')
              <a href="{{ url('notifications') }}" class="waves-effect waves-block">
            @endif
            @if($value->icon == 'warning')
              <a href="{{ url('manage-accounts/password') }}" class="waves-effect waves-block">
            @endif
            @if($value->icon == 'message')
              <a href="{{ url('messages/inbox') }}" class="waves-effect waves-block">
            @endif
                <div class="col-xs-2" style="padding: 0px;">
                    <img src="{{ $value->photo ? asset('storage/avatars/'.$value->photo) : asset('admin-assets/images/user.png')}}" width="38" height="38" alt="User" style="border-radius: 50%;">
                </div>
                <div class="menu-info col-xs-10" style="padding: 0px;">
                    <h4>{{  html_entity_decode($value->notification) }}</h4>
                    <p>
                        <i class="material-icons" style="color:{!! App\Http\Models\Notifications::icon_color($value->icon) !!};font-size: 15px;">{!! $value->icon !!}</i> {!! App\Http\Models\Notifications::time_elapsed_string($value->created_at) !!} 
                    </p>
                </div>
            </a>
        </div>
    </div>
</li>
@empty

<li>
<br><br>
  <i><center><small style="color: #c1c1c1;"> No Notification Found! </small>
</center>
  </i>
</li>
@endforelse
</ul>