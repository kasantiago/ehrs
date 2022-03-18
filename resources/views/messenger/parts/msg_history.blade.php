@forelse($messages as $key => $value)
  
  @if($value->owner == Auth::id())


    <div class="outgoing_msg">
      <div class="sent_msg">
        <div style="float: right;"><a class="close_icon delete_message" data-row="outgoing_msg" style="text-decoration:none;" data-id="{{ $value->id }}"> <i class="material-icons">close</i> </a></div>
        <div class="msg_content">
          <p class="{{ $color[0] }} hilightable">{!! $value->body !!}</p>
        </div>
        <div style="float: right;">
          <span class="time_date"> {!! date('h:i a | M d, Y', strtotime($value->created_at)) !!} </span>
        </div>
      </div>
    </div>
     
       
  @else

    <div class="incoming_msg">
      <div class="incoming_msg_img"> <img src="{{ asset(App\Http\Models\Accounts::profile($value->owner)) }}" alt="sunil"> </div>
      <div class="received_msg">
        <div class="received_withd_msg">
          <div style="float: right;"><a class="delete_message close_icon_received {{ $color[3] }}" data-row="incoming_msg" style="text-decoration:none;" data-id="{{ $value->id }}"> <i class="material-icons">close</i> </a></div>
          <div class="msg_content_received">
            <p class="hilightable">{!! $value->body !!}</p>
          </div>
          <div style="float: left;">
            <span class="time_date"> {!! date('h:i a | M d, Y', strtotime($value->created_at)) !!} </span>
          </div>
        </div>
      </div>
    </div>

   
  @endif

@empty


@endforelse

<div class="seen_incoming" style="display: inline-block;width: 100%;"> 


@forelse($who_seen as $key => $value)
  @if($value->user_id != Auth::id())
    @if(isset($value->last_read))
     @if($value->owner != $value->user_id)
      <img  style="border-radius:50%;height:15px;float:right;" src="{{ asset($value->photo) }}" alt="sunil">
     @endif
    @endif
  @endif
@empty
@endforelse


</div>
