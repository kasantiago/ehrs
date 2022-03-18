<table style="width: 100%;">
	@forelse($people as $key => $value)
	<tr style="height: 30px;">
		<td style="width: 15%;">
			<div class="_4ldz" style="height: 25px; width: 25px; margin-left: 20%;">
				    <div class="_4ld-" style="height: 25px; width: 25px; align-items: center; background-color: rgba(0, 0, 0, .05); border-radius: 50%; display: flex; justify-content: center; overflow: hidden;">
				        <div class="_55lt thread_photo" style="height: 25px; width: 25px;">
				        	<img src="{{ asset($value->photo)}}" width="25" height="25" alt="" class="img">
				        </div>
				    </div>
				</div>
		</td>
		<td style="width: 80%;" valign="middle">
			{!! $value->name !!}
		</td>
		<td style="width: 5%;" valign="middle">
		  @if($owner == Auth::id())
			@if(Auth::id() == $value->id)
			 <a></a>
			@else
				<a class="remove-people" data-id="{{encrypt($value->id)}}" data-name="{{$value->name}}" data-msg="Do you want remove {!! $value->name !!} in this group conversation?">
			
	             <i class="material-icons {{ $color[3] }}" data-toggle="tooltip" data-placement="top" title data-original-title="Delete" style="font-size: 15px;">close</i>
	            </a>
	        @endif
	       @endif
		</td>
	</tr>
	@empty
	
	@endforelse
</table>