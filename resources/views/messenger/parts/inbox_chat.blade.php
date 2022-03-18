@if($threads)

@forelse($threads as $key => $value)
	<div class="chat_list _{{$value->id}}tId {{str_replace(' ','',strtolower($value->subject)) == 'alluser' ? 'all-user' : ''}} {{ App\Http\Models\Messages::unseen($value->id) }} {{ App\Http\Models\Messages::active_background($value->id) }}" data-id="{{ encrypt($value->id) }}"  id="row-1115{{$value->id}}2018">
	  <div class="chat_people">
	    <div class="chat_img">
	    	<div>
	    	@if($value->photo_count > 3)
	        	
	                <div class="_4ldz" style="height: 50px; width: 50px; position: relative;">
	                    <div class="_4ld-" style="height: 50px; width: 50px; align-items: center; background-color: rgba(0, 0, 0, .05); border-radius: 50%; display: flex; justify-content: center; overflow: hidden;">
	                        <div class="_55lt thread_photo" style="height: 50px; width: 50px;" >
	                        	<div>
		                            <div class="_55lu _57pl" style="width: 33px; border-right: 1px solid #fff; float: left; overflow: hidden;">
		                                <img src="{{ asset($value->photo[2]) }}" width="50" height="50" alt="" class="img" style="margin-left: 0px;">
		                            </div>
		                            <div class="_55lu _57pm" style="width: 17px; border-bottom: 1px solid #fff; height: 25px; float: left; overflow: hidden;"><img src="{{ asset($value->photo[1]) }}" width="25" height="25" alt="" class="img" style="margin-left: 0px;">
		                            </div>
		                            <div class="_55lu" style="width: 17px; height: 25px; float: left; overflow: hidden;"><img src="{{ asset($value->photo[0]) }}" width="25" height="25" alt="" class="img" style="margin-left: 0px;">
		                            </div>
		                        </div>
	                        </div>
	                    </div>
	                </div>
	              
	          @endif

	         @if($value->photo_count == 3)
	        	 
					<div class="_4ldz" style="height: 50px; width: 50px; position: relative;">
					    <div class="_4ld-" style="height: 50px; width: 50px; align-items: center; background-color: rgba(0, 0, 0, .05); border-radius: 50%; display: flex; justify-content: center; overflow: hidden;">
					        <div class="_55lt thread_photo" style="height: 50px; width: 50px;" >
					        	<div>
					                <div class="_55lu" style="width: 25px; box-sizing: border-box; float: left; overflow: hidden;"><img src="{{ asset($value->photo[0]) }}" width="50" height="50" alt="" class="img" style="margin-left: 0px;">
					                </div>
					                <div class="_55lu _57xo" style="width: 25px; border-left: 1px solid #fff; box-sizing: border-box; float: left; overflow: hidden;"><img src="{{ asset($value->photo[1]) }}" width="50" height="50" alt="" class="img" style="margin-left: 0px;">
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
	             
	          @endif

	          @if($value->photo_count == 2)
	        
					<div class="_4ldz" style="height: 50px; width: 50px; position: relative;">
					    <div class="_4ld-" style="height: 50px; width: 50px; align-items: center; background-color: rgba(0, 0, 0, .05); border-radius: 50%; display: flex; justify-content: center; overflow: hidden;">
					        <div class="_55lt thread_photo" style="height: 50px; width: 50px;">
					        	<img src="{{ asset($value->photo[0]) }}" width="50" height="50" alt="" class="img">
					        </div>
					    </div>
					</div>
	              
	          @endif


	          @if($value->photo_count == 1)
	        
					<div class="_4ldz" style="height: 50px; width: 50px; position: relative;">
					    <div class="_4ld-" style="height: 50px; width: 50px; align-items: center; background-color: rgba(0, 0, 0, .05); border-radius: 50%; display: flex; justify-content: center; overflow: hidden;">
					        <div class="_55lt thread_photo" style="height: 50px; width: 50px;">
					        	<img src="{{ asset($value->photo[0]) }}" width="50" height="50" alt="" class="img">
					        </div>
					    </div>
					</div>
	              
	          @endif

	          
	    	</div>
	    </div>
	    
	    <div class="chat_ib">
	      <div class="thread_info">
	        
	        <div class="hilightable" style="float: left; width: 90%;">{!! str_limit($value->subject, $limit = 28, $end = '...') !!}</div>

	  		<div style="float: right;opacity:0;" class="delete-thread" data-id="{{encrypt(Auth::id())}}"  data-msg="Are you sure you want leave this group conversation?" style="z-index:999; width: 10%;"> <a href="#" class="{{ $color[3] }}" style="text-decoration:none;"><i class="material-icons" style="font-size: 17px;">delete</i></a>
	      	</div>

	        <div class="hilightable" style="float: left; font-size: 12px; width: 100%;">{{ str_limit($value->body, $limit = 70, $end = '...') }}</div>

	      </div>
	      <div class="chat_date" style="float: right; font-size: 11px; color: lightgray; width: 100%; text-align: right;">{!! App\Http\Models\Notifications::time_elapsed_string($value->created_at) !!}</div>
	    </div>
	  </div>
	</div>
@empty

	<div class="chat_list">
	  
	    <center>
	      <h5> No Record Found! </h5>
	   	</center>

	</div>

@endforelse


@else
	<div class="chat_listx">
	  
	    <center>
	      <h5> No Record Found! </h5>
	   	</center>

	</div>

 
@endif