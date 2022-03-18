@extends('layouts.app')
@section('title','Messenger')

@section('content')


<div class="container-fluid" style="padding: 0;">


<div class="row clearfix" style="margin: -30px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 0; border-right: 1px solid rgba(204, 204, 204, 0.35);">
			    <div class="header" style="border-bottom: 0; padding-bottom: 25px;">
			        <h2 class="{{ $color[1] }}">
			          <b> Messenger </b>
			              <ul class="header-dropdown m-r--5" style="margin-top: -5px;">
				            <li class="dropdown">
				                <a href="javascript:void(0);" class="dropdown-toggle compose-message-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				                   <img src="{{ asset('admin-assets/images/new-message-'.$color[4].'.png') }}" alt="User">
				                </a>
				            </li>
			        	  </ul> 
			        </h2>
				      
			    </div>
		    </div>

		    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding: 0; border-left: 1px solid rgba(204, 204, 204, 0.35);">
		    	<div class="search-container-selectize" style="display: none;">
		    		<div style="float: left; width: 96%;" class="search-account-selectize-container" style="display: block;">
				    	<input type="text" placeholder="To: Type the name of a person" name="search2" id="select-to" style="height: 60px !important;">
				    </div>
				    <div style="float: left; width: 96%;" class="all-search-account-selectize-container selected-message-container {{ $color[1] }}" style="display: none;">
		   			  <h2  style="text-align: center;" class="all-name">TO: ALL USERS</h2>
		   			</div>

				    <div style="float: right; width: 4%; padding-top: 18px;">
				    	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons {{ $color[1] }} select-all-button">select_all</i>
						</a><!-- check_box -->
					</div>
		   		</div>
		   		<div class="selected-message-container {{ $color[1] }}" style="display: flex; margin-top: 15px;">
	   			  	<div style="width: 94%; text-align: center; font-size: 14px; line-height: 37px; " class="selected-name hilightable">
	   			  		@if($subject)
	   			  		{!! str_limit($subject, $limit = 80, $end = '...') !!}
	   			  		@endif 
	   			  		&nbsp; &nbsp;
	   			  	</div>
	   			  	<div style="width: 6%;display:block;" class="group-settings-gear">
	   			  		<span class="{{ $color[3] }}" data-toggle="modal" data-target="#largeModal" style=""><i class="material-icons" style="font-size: 20px; line-height: 37px; cursor: pointer;">settings</i></span>
	   			  	</div>
		   		</div>
		    </div>

			<div class="container" style="padding: 0;">
		
				<div class="messaging">
			      <div class="inbox_msg">
			        <div class="inbox_people">
			          <div class="headind_srch">

			            <div class="srch_bar">
			              <div class="stylish-input-group">
			              	<input type="text" placeholder="Search.." name="search2" id="search-threads" >
		  					<button type="button"> <i class="material-icons {{ $color[1] }}">search</i> </button>
			              </div>
			            </div>
			          </div>
			          <div class="inbox_chat">
			          	<div class="new-compose-container"></div>
			          		
			       			 @include('messenger.parts.inbox_chat')  
			          		
			          </div>
			        </div>
			        <div class="mesgs">
			          <div class="msg_history">
			          		@if($messages)
			          		 @include('messenger.parts.msg_history')
			          		@endif 
			          </div>
			          <div class="type_msg">
			            <div class="input_msg_write">

			             <form method="POST" id="compose" novalidate="novalidate" action="{{ url('messages/compose') }}">
			             	{{ csrf_field() }}
							<input type="hidden" name="thread_id" value="{!! $thread_id !!}">
							<input type="hidden" name="user_id_encrypted" value="{!! $user_id_encrypted !!}">
							<input type="text" name="message" class="write_msg" placeholder="Type a message" style="text-indent: 10px; overflow-wrap: break-word;" />
							<button  type="submit" class="msg_send_btn {{ $color{2} }}"><i class="material-icons">send</i></button>
			             </form>

			            </div>
			          </div>
			        </div>
			      </div>
			    </div>
			</div>
        </div>
    </div>
</div>
    <!-- #END# Basic Examples -->

    	<!-- Large Size -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" id="settings" novalidate="novalidate" action="{{ url('messages/add/people') }}">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="thread_id"  value="{!! $thread_id !!}">
	                    <div class="modal-header {{ $color[3] }}" style="padding: 25px 25px 0px 25px;">
	                        <div style="height: 34px; line-height: 34px; margin-top: -3px;" class="col-sm-3">
	                        	<h4>Settings</h4>
	                        </div>
	                        <div style="height: 34px; line-height: 34px; text-align: right;" class="col-sm-9">

	   
	                        	<button type="button" class="btn bg-white waves-effect {{ $color[3] }} leave-thread" data-id="{{encrypt(Auth::id())}}"  data-msg="Are you sure you want leave this group conversation?">
	                                <span>LEAVE GROUP</span>
	                                <i class="material-icons">input</i>
	                            </button>
	                        </div>
	                    </div>

	                    <hr>

	                    <div class="modal-body" style="display: flex; padding: 0px 25px; height: 350px;">
	                    	<div class="aParentleft" style="width: 50%; border-right: 1px solid #eee; margin: 5px;">
	                    		<p class="card-inside-title"><b>Group Name</b></p>
	                    		<div class="col-sm-12" style="">
	                                <div class="form-group">
	                                    <div class="form-line">
	                                        <input type="text" name="group_name" class="form-control" placeholder="Group Name" value="{!! $group_name !!}">
	                                    </div>
	                                </div>

	                                <br>

	                            </div>
								
								<p class="card-inside-title"><b>Add People</b></p>
	                            <div class="col-sm-12" style="">
	                                <div class="form-group">
	                                    <input type="text" id="people" name="people" placeholder="Add People">
	                                </div>
	                            </div>
							</div>

							<div class="aParentright" style="width: 50%; float: right; margin: 5px; overflow: auto;">
	                    		<p class="card-inside-title"><b>People</b></p>
									<div class="aParentright parts_peoples" style="height: 310px; overflow: auto;">
										@include('messenger.parts.people')						
									</div> 
							
							</div>

	                    </div>
						
						<hr>

	                    <div class="modal-footer" style="padding: 0 25px 15px 25px;">
	                    	<button type="button" class="btn bg-white waves-effect {{ $color[3] }} settings-update">
	                            <span>ADD PEOPLE</span>
	                            <i class="material-icons">group_add</i>
	                        </button>
	                        <button type="button" class="btn bg-white waves-effect {{ $color[3] }}" data-dismiss="modal">
	                            <span>CLOSE</span>
	                            <i class="material-icons">close</i>
	                        </button>
	                    </div>
	                 </form>
                </div>
            </div>
        </div>

</div>

@endsection

@section('styles')
 <link href="{{ asset('admin-assets/css/selectize.css') }}" rel="stylesheet">  
 <link href="{{ asset('admin-assets/css/messenger.css') }}" rel="stylesheet">  
	<style type="text/css">
	.active_chat { border-left: 5px solid {{ $color[4] }}; }
	.seen_chat  { border-left: 5px solid #f8f8f8; }
	.unseen_chat  { border-left: 5px solid #f8f8f8; font-weight: bold;}
	.stylish-input-group button:hover { background: {{ $color[0] }}; }
	.chat_list{ cursor:pointer; border-left: 5px solid #f8f8f8; min-height: 80px; }
	.chat_list_new { cursor:pointer; min-height: 80px; border-left: 5px solid {{ $color[4] }}; }
	.chat_list.active_chat { cursor:pointer; border-left: 5px solid {{ $color[4] }}; }
/*	.hover{ background-color:#d8d8d8; border-left: 5px solid {{ $color[4] }}; }*/
	.remove-people { cursor:pointer; display:none; }
	hilight { background-color: #9a9a9a; font-weight: bold; }
	.delete_message { cursor:pointer; }
	.group-settings-gear { display:none; }

    table tr:hover {
          background-color: #ebebeb;
    }

	</style>

	
@endsection

@section('scripts')
<script src="{{ asset('admin-assets/dist/js/standalone/selectize.js') }}"></script>
<link href="{{ asset('admin-assets/dist/css/selectize.default.css') }}" rel="stylesheet">  

<script type="text/javascript">

	rowId = '{{ $thread_id }}';

	//alert(rowId);

	$(function () {
	    $('.js-modal-buttons .btn').on('click', function () {
	        var color = $(this).data('color');
	        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
	        $('#mdModal').modal('show');
	    });
	});
</script>

<script type="text/javascript">
	$( document ).ready(function() {

		
	   // $(".received_withd_msg").mouseenter(function(){
	   	$(".msg_history").on('mouseenter','.received_withd_msg',function(){
	        $(this).find('i').css("opacity", 1);
		});
		$(".msg_history").on('mouseleave','.received_withd_msg',function(){
		 	$(this).find('i').css("opacity", 0);
		});

		//$(".sent_msg").mouseenter(function(){
		$(".msg_history").on('mouseenter','.sent_msg',function(){
	        $(this).find('i').css("opacity", 1);
		});
		//$(".sent_msg").mouseleave(function(){
		$(".msg_history").on('mouseleave','.sent_msg',function(){
		 	$(this).find('i').css("opacity", 0);
		});//HOOOOOOOOOOOOOOOOVERRRRRRRRRR
		$(".inbox_chat").on('mouseenter','.chat_list',function(){
			$(this).find('.delete-thread').css("opacity", 1);
		 	$(this).find('.chat_date').css("color", "white");
			$(this).css({"background-color":"#d8d8d8"});
			$(this).css({"border-left":"5px solid {{ $color[4] }}"});
			/*	.hover{ background-color:#d8d8d8; border-left: 5px solid {{ $color[4] }}; }*/
		});
		$(".inbox_chat").on('mouseleave','.chat_list',function(){
			$(this).find('.delete-thread').css("opacity", 0);
		 	$(this).find('.chat_date').css("color", "lightgray");
		 	$(this).css({"background-color":"#f8f8f8"});
			$(this).css({"border-left":"5px solid #f8f8f8"});
			$('.chat_list.active_chat').css({"border-left":"5px solid {{ $color[4] }}"});
		});
		
		$(".parts_peoples").on('mouseenter','tr',function(){
			$(this).find('.remove-people').show();
		});

		$(".parts_peoples").on('mouseleave','tr',function(){
			$(this).find('.remove-people').hide();
		});


		$('.inbox_chat').on('click','.chat_list',function(){

			$(this).inbox_chat($(this));
			$('.selected-message-container').show();
			$('.input_msg_write').show();
			$('.group-settings-gear').show();
			$('.chat_list').css({"border-left":"5px solid #f8f8f8"});
			$(this,'.chat_list.active_chat').css({"border-left":"5px solid {{ $color[4] }}"});

		});

		// $('.inbox_chat').on('click','.delete-thread',function(){ 
		// 	setTimeout(function() {$('#largeModal').modal('hide');}, 500);
		// });
		// 	uidId = $(this).data("id");
		// 	name = $(this).data("name");
		// 	msg = $(this).data("msg");
		// 	selector = $(this);

		// 	$('#largeModal').modal('hide');

		// 		$('.appriseInner button').click();

		//     	  apprise(msg, {'verify':true,'animate':true}, function(r)
		// 		    {

		// 			 $('.appriseInner button').click();
		//      		apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
		//      		 $('.aButtons').hide();

		// 		    if(r)
		// 		        { 

				        	

		// 					$.ajax({	
		// 						url: '{{ url("messages/remove/people") }}',
		// 						type:'POST',
		// 						data:  {'_token':'{{ csrf_token() }}','uid':uidId,'thread_id':rowId},
		// 						async: false,
		// 						success: function(data)
		// 						    {

		// 			                    if(data.success){

		// 			                        people = $.parseJSON(data.people);

		// 									//$('#people').selectize()[0].selectize.destroy();

		// 									$('#search-threads').add_people(people);

		// 									$('.parts_peoples').parts_people(data.added);
												 
		// 			                    }  	 

		// 									$('.appriseInner button').click();

		// 									$('.msg_history').hide().html('');

		// 									$('.selected-message-container').hide();

		// 									$('.input_msg_write').hide();

		// 									$('.inbox_chat').hide().html('').inbox_refresh(); 

		// 									//$('#largeModal').modal('hide');

		// 									// $('.'+data.rowId).addClass('active_chat');
		// 									// $('.'+data.rowId).addClass('{{$color[0]}}');
		// 									$('.selected-name').html(data.subject);

		// 									$('.'+data.class).addClass('active_chat');
		// 									$('.'+data.class).addClass(data.bg_color);

		// 						    }
		// 					});

				       		
		// 		        }
		// 		    else
		// 		        { 
		// 			        $('.appriseInner button').click();
		// 			       //	$('#largeModal').modal('show');
		// 		        }
		// 		    });
		// });

		$(".chat_list").mouseover(function(){
		    $(this).addClass('hover');
		});
		$(".chat_list").mouseout(function(){
		    $(this).removeClass('hover');
		});


		$('.msg_history').on('click','.delete_message',function(){

			container = $(this);
			

				$('.appriseInner button').click();

		    	  apprise("Are you sure you want to delete this message!", {'verify':true,'animate':true}, function(r)
				    {

					 $('.appriseInner button').click();
		     		apprise("<i><b><font color='grey'>Deleteing message please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
		     		 $('.aButtons').hide();

				    if(r)
				        { 

							$.ajax({	
								url: '{{ url("messages/delete/message") }}',
								type:'POST',
								data:  {'_token':'{{ csrf_token() }}','id':container.data('id') },
								async: false,
								success: function(data)
								    {
								    	// if(container.data('row') == "outgoing_msg"){
								    	// 	container.parent().parent().parent().remove();
								    	// }else{
								    	// 	container.parent().parent().parent().parent().remove();
								    	// }
								    	
					     			// 	$('.appriseInner button').click();

					     			

					                	if(data.success){

					                		//$('.inbox_chat').html('');
											

											//$('.msg_history').html('');
											$('.msg_history').hide().html('').prepend(data.messages).show();

											// console.log(data.messages);


											$('input[name="thread_id"]').val(data.thread_id);

											$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);

											$('input[name="message"].write_msg').val('');

										

											$('.new-compose-container').html('');

											$('.search-container-selectize').hide();
											$('.all-search-account-selectize-container').hide();
											$('.selected-message-container').show();
											$('.group-settings-gear').show();
											$('.selected-name').html(data.subject);

											//people = $.parseJSON(data.people);
											//$('#search-threads').add_people(people);

											// if(jQuery.isEmptyObject(data.people)){
					                         people = $.parseJSON(data.people);
										 	$('#search-threads').add_people(people);
					      //               	}else{
											// 	$('#search-threads').add_people(JSON.stringify([]));
					                    		
					      //               	}

											$('.parts_peoples').parts_people(data.user_id_encrypted);

											$('input[name="group_name"]').val(data.group_name);

											      
									        $('.msg_history').animate({scrollTop: $('.msg_history')[0].scrollHeight}, "slow");

									         $('.appriseInner button').click();

									         //$('.inbox_chat').html('').prepend(data.threads);
											 $('.inbox_chat').hide().html('').prepend(data.threads).show();

											 	$('.'+data.class).addClass('active_chat');
											$('.'+data.class).addClass(data.bg_color);
				
					                	}else{

										   $('.appriseInner button').click();
											// apprise("<i><font color='black'>"+data.errMsg+"</font></i><br><br><center> <img src= '"+public_url+"admin-assets/dist/image/warning.ico' width='20' height='20' /></center>");
			     		

					                	}

					     		


								    }
							});

							return false;
				       		
				        }
				    else
				        { 
					        $('.appriseInner button').click();
					       
				        }
				    });

			return false;
		});


		$('body').on('click','.leave-thread,.delete-thread',function(){
			uidId = $(this).data("id");
			name = $(this).data("name");
			msg = $(this).data("msg");
			selector = $(this);

			$('#largeModal').modal('hide');

				$('.appriseInner button').click();

		    	  apprise(msg, {'verify':true,'animate':true}, function(r)
				    {

					 $('.appriseInner button').click();
		     		apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
		     		 $('.aButtons').hide();

				    if(r)
				        { 

				        	

							$.ajax({	
								url: '{{ url("messages/remove/people") }}',
								type:'POST',
								data:  {'_token':'{{ csrf_token() }}','uid':uidId,'thread_id':rowId},
								async: false,
								success: function(data)
								    {

					                    if(data.success){

					                        //people = $.parseJSON(data.people);

											//$('#people').selectize()[0].selectize.destroy();

											//$('#search-threads').add_people(people);

											//if(jQuery.isEmptyObject(data.people)){
					                       		 people = $.parseJSON(data.people);
												$('#search-threads').add_people(people);
					                    	//}else{
											//	$('#search-threads').add_people(JSON.stringify([]));
					                    		
					                    	//}

											$('.parts_peoples').parts_people(data.added);
												 
					                    }  	 

											$('.appriseInner button').click();

											$('.msg_history').hide();

											$('.selected-message-container').hide();

											$('.input_msg_write').hide();

											$('.inbox_chat').hide().html('').inbox_refresh(); 

											//$('#largeModal').modal('hide');

											// $('.'+data.rowId).addClass('active_chat');
											// $('.'+data.rowId).addClass('{{$color[0]}}');
											$('.selected-name').html(data.subject);

											$('.'+data.class).addClass('active_chat');
											$('.'+data.class).addClass(data.bg_color);

								    }
							});

				       		
				        }
				    else
				        { 
					        $('.appriseInner button').click();
					       //	$('#largeModal').modal('show');
				        }
				    });

		
		});




		$('.parts_peoples').on('click','.remove-people',function(){
			uidId = $(this).data("id");
			name = $(this).data("name");
			msg = $(this).data("msg");
			selector = $(this);

			$('#largeModal').modal('hide');

				$('.appriseInner button').click();

		    	  apprise(msg, {'verify':true,'animate':true}, function(r)
				    {

					 $('.appriseInner button').click();
		     		apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
		     		 $('.aButtons').hide();

				    if(r)
				        { 

							$.ajax({	
								url: '{{ url("messages/remove/people") }}',
								type:'POST',
								data:  {'_token':'{{ csrf_token() }}','uid':uidId,'thread_id':rowId},
								async: false,
								success: function(data)
								    {

										// people = $.parseJSON(data.people);

										// $('#people').selectize()[0].selectize.destroy();

										// $('#search-threads').add_people(people);

										// $('.parts_peoples').parts_people(data.added);


					                    if(data.success){

					                       // people = $.parseJSON(data.people);

											//$('#people').selectize()[0].selectize.destroy();

											//$('#search-threads').add_people(people);

											//if(jQuery.isEmptyObject(data.people)){
					                       		 people = $.parseJSON(data.people);
												$('#search-threads').add_people(people);
					                    	//}else{
												//$('#search-threads').add_people(JSON.stringify([]));
					                    		
					                    //	}

											$('.parts_peoples').parts_people(data.added);
												 
					                    }  	 


										// $('input[name="group_name"]').val(data.group_name);

										// $('input[name="thread_id"]').val(data.thread_id);

										$('.appriseInner button').click();

										//

										$('.inbox_chat').hide().html('').inbox_refresh(); 
										$('#largeModal').modal('show');

								    }
							});

				       		
				        }
				    else
				        { 
					        $('.appriseInner button').click();
					       	$('#largeModal').modal('show');
				        }
				    });

		
		});






		$.fn.inbox_chat = function(selected){

			//$('.inbox_chat').html('');
			// $('.chat_list').removeClass().addClass('chat_list');
			// $('.chat_list_new').removeClass().addClass('chat_list_new');
			$('.chat_list').removeClass('active_chat');
			$('.chat_list').removeClass('{{$color[0]}}');
			$('.chat_list').css({"background-color":"#f8f8f8"});
			$('.chat_list').css({"border-left":"5px solid #f8f8f8"});

			// selected.addClass('active_chat');
			// selected.addClass('{{$color[0]}}');

			selected.removeClass('unseen_chat');
			selected.addClass('seen_chat');

			$('.new-compose-container').html('');

			$('.search-container-selectize').hide();
	
			rowId = selected.data('id');

			// alert(rowId);
			 
			 $.ajax({	
	            url: '{{ url("messages/history") }}',
	            type:'POST',
	            data:  {'_token':'{{ csrf_token() }}','id':rowId},
	            async: false,
	            success: function(data)
	                {

	                	$('.'+data.class).addClass('active_chat');
						$('.'+data.class).addClass(data.bg_color);
	                
						//$('.msg_history').html('');
						//$('.msg_history').hide().empty()a.html).show();
			 			$('.msg_history').hide().html('').prepend(data.html).show();
						$('.selected-name').html(data.subject);
						$('.selected-message-container').show();
						//people = $.parseJSON(data.people);
						//$('#search-threads').add_people(people);

			        	//if(jQuery.isEmptyObject(data.people)){
                       		 people = $.parseJSON(data.people);
							$('#search-threads').add_people(people);
                    	//}else{
						//	$('#search-threads').add_people(JSON.stringify([]));
                    	//	
                    	//}
						$('.parts_peoples').parts_people(data.added);
						$('input[name="group_name"]').val(data.group_name);
						$('input[name="thread_id"]').val(data.thread_id);
						$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);

						
						$('.new-compose-container').html('');
				
	                }
	           });
		};



	$.fn.saveChanges = function(callback, ms){
		var timer = 0;
		var el = $(this);
		$(this).keyup(function(){                   
		clearTimeout (timer);
		timer = setTimeout(function(){
		    callback(el)
		    }, ms);
		});
			return $(this);
	};


	$('input[name="group_name"]').saveChanges(function(el){
		group_name = el.val();
		thread_id = $('input[name="thread_id"]').val();

		 $.ajax({	
            url: '{{ url("messages/group/update") }}',
            type:'POST',
            data:  {'_token':'{{ csrf_token() }}','thread_id':thread_id,'group_name':group_name},
            async: false,
            success: function(data)
                {
                	if(data.success){
                	
                	$('.inbox_chat').hide().html('').inbox_refresh(); 

						$('.chat_list').removeClass('active_chat');
						$('.chat_list').removeClass('{{ $color[0] }}');
						$('.'+data.class).addClass('active_chat');
						$('.'+data.class).addClass(data.bg_color);                		
						$('.'+data.class).next().next().next().remove();
                	}else{

                		$('#largeModal').modal('hide');
						$('.appriseInner button').click();
						apprise("<i><font color='black'>Group name already exists!</font></i><br><br><center> <img src= '"+public_url+"admin-assets/dist/image/warning.ico' width='20' height='20' /></center>");
                	}

                }
           }); 

	},500);


	




		$.fn.delayKeyup = function(callback, ms){
			var timer = 0;
			var el = $(this);
			$(this).keyup(function(){                   
			clearTimeout (timer);
			timer = setTimeout(function(){
			    callback(el)
			    }, ms);
			});
				return $(this);
		};


		$('#search-threads').delayKeyup(function(el){

			keyword = el.val();
			
			 $('.inbox_chat').html("<i><br>&nbsp;&nbsp;<b><font color='grey'>Searching ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");

			 $.ajax({	
	            url: '{{ url("messages/search") }}',
	            type:'POST',
	            data:  {'_token':'{{ csrf_token() }}','keyword':keyword},
	            async: false,
	            success: function(data)
	                {
	                
	                 //$('.inbox_chat').html('');
	                // $('.inbox_chat').html('').prepend(data.html);
	                 $('.inbox_chat').hide().html('').prepend(data.html).show();
	                
	                 $(".hilightable").each(function (i, v) {
                        v.innerHTML = v.innerText.replace(keyword, "<hilight>" + keyword + "</hilight>");
                      });


					 $('.chat_list').removeClass('active_chat');
					 $('.chat_list').removeClass('{{ $color[0] }}');

	                
	                }
	           }); 

		},500);


	});
</script>

<script type="text/javascript">
		// <select id="select-to"></select>

		// var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
		//                   '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
	

	var formatName = function(item) {
		return $.trim((item.name || ''));
	};

	var accounts = $.parseJSON('{!! $accounts !!}');
	var count_all_accounts = "{!! $count_all_accounts !!}";

	$('#select-to').selectize({
			persist: false,
			maxItems: null,
			maxOptions: 5,
   			preload: 0,
			valueField: 'uid',
			labelField: 'name',
			searchField: ['name'],
			sortField: [
				{field: 'name', direction: 'asc'}
			],
			options: accounts,
			delimiter: ',',
			persist: false,
			create: true,
			openOnFocus: false,
			items: [''],
			render: {
				item: function(item, escape) {
					var name = formatName(item);
					return '<div>' +
						(name ? '<span class="name">' + escape(name) + '</span>' : '') +
					'</div>';
				},
				option: function(item, escape) {
					var name = formatName(item);
					var label = name || item.photo;
					var caption = name ? item.photo : null;
					return '<div>' +
						'<img src="{{ asset("/") }}'+escape(item.photo)+'" style="border-radius: 50px;" width="30" height="30" alt="User">' +
						(caption ? '<span class="caption" style="margin-left: 10px;">' + escape(name) + '</span>' : '') +
					'</div>';
				}
			},
			createFilter: function(input) {
			
			},
			create: function(input) {
	
					var name       = $.trim(match[1]);
					var pos_space  = name.indexOf(' ');
					var first_name = name.substring(0, pos_space);
					var last_name  = name.substring(pos_space + 1);

					return {
						uid: match[2],
						first_name: first_name,
						last_name: last_name
					};
			
				return false;
			},
			 onChange: function(value) {

			 	var numbersArray = value.split(',');
			 	count = 0;
				$.each(numbersArray, function(index, value) { 
					count++;
				});

				if(count == count_all_accounts){ 
					$('.select-all-button').text('check_box');
				}else{
					$('.select-all-button').text('select_all');
			    }

			   $('.chat_list').removeClass('active_chat');
			   $('.chat_list').removeClass('{{$color[0]}}');

				  $.ajax({
		            url: '{{ url("messages/inbox") }}',
		            type:'POST',
		            data:  {'_token':'{{ csrf_token() }}','selected':value},
		            async: false,
		            success: function(data)
		                {

		                	// console.log(data);

							//$('.msg_history').html('');
							$('.msg_history').hide().html('').prepend(data.html).show();
							$('input[name="thread_id"]').val(data.threads_id);
							$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);
						
							$('.chat_list').removeClass(data.bg_color);
							$('.'+data.class).addClass('active_chat');
							$('.'+data.class).addClass(data.bg_color);
							$('.new-compose-container').hide().html('');
							$('.chat_list').insertAfter('.active_chat');



							// $('.search-container-selectize').hide();
							// $('.all-search-account-selectize-container').hide();
							// $('.selected-message-container').show();
							// $('.group-settings-gear').show();
							// $('.selected-name').html(data.subject);

							// // //$('.msg_history').html('');
							// // $('.msg_history').html(data.html);

							// // $('.selected-name').html(data.subject);
							// // //$('.selected-message-container').show();

							// people = $.parseJSON(data.people);
							// $('#search-threads').add_people(people);
							// // $('.parts_peoples').parts_people(data.user_id_encrypted);

							// // $('input[name="group_name"]').val(data.group_name);



							// $('.search-container-selectize').hide();
							// $('.all-search-account-selectize-container').hide();
							// $('.selected-message-container').show();

							//$('input[name="thread_id"]').val(data.thread_id);
							//$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);
							//$('.'+data.class).addClass('active_chat');
							//$('.'+data.class).addClass(data.bg_color);
							//$('.new-compose-container').html('');
							//$('.selected-name').html(data.subject);
							//$('.selected-message-container').show();
							//$('.search-container-selectize').hide();

		                 // $('.task-container').html('');
		                 // $('.task-container').html(data.html);
		                 // $('.task-label').text(data.count);
		                 // if(data.count == 0){
		                 //    $('.task-label').hide();
		                 // }
		                }
		            });

			
          },
		load: function(query, callback) {
			  // // $.get("/api/selected_cities.php", function( data ) {
		   //      selectize.addOption(all_accounts); // This is will add to option
		   //      var selected_items = [];
		   //      $.each(all_accounts, function( i, obj) {
		   //          selected_items.push(obj.id);
		   //      });
		   //      selectize.setValue(selected_items); //this will set option values as default
		   // // });
		    // if (!query.length) return callback();
		    // $.ajax({
		    //     url: '/api/all_cities.php',
		    //     type: 'GET',
		    //     dataType: 'json',
		    //     data: {
		    //         name: query,
		    //     },
		    //     error: function() {
		    //         callback();
		    //     },
		    //     success: function(res) {
		    //         callback(res);
		    //     }
		    // });
		},
		onInitialize: function(){
		   //  var selectize = this;
		   // // $.get("/api/selected_cities.php", function( data ) {
		   //      selectize.addOption(all_accounts); // This is will add to option
		   //      var selected_items = [];
		   //      $.each(all_accounts, function( i, obj) {
		   //          selected_items.push(obj.id);
		   //      });
		   //      selectize.setValue(selected_items); //this will set option values as default
		   // // });
		}


		});


	var people = JSON.parse('{!! $add_people !!}');

	$.fn.add_people = function(people){

		
		$('#people').selectize()[0].selectize.destroy();

		$('#people').selectize({
				persist: false,
				maxItems: null,
				valueField: 'uid',
				labelField: 'name',
				searchField: ['name'],
				sortField: [
					{field: 'name', direction: 'asc'}
				],
				options: people,
				delimiter: ',',
				persist: false,
				create: false,
			    items: [''],
				 openOnFocus: false,
				render: {
					item: function(item, escape) {
						var name = formatName(item);
						return '<div>' +
							(name ? '<span class="name">' + escape(name) + '</span>' : '') +
						'</div>';
					},
					option: function(item, escape) {
						var name = formatName(item);
						var label = name || item.photo;
						var caption = name ? item.photo : null;
						return '<div>' +
							'<img src="{{ asset("/") }}'+escape(item.photo)+'" style="border-radius: 50px;" width="30" height="30" alt="User">' +
							(caption ? '<span class="caption" style="margin-left: 10px;">' + escape(name) + '</span>' : '') +
						'</div>';
					}
				},
				createFilter: function(input) {
				
				},
				create: function(input) {
		
						var name       = $.trim(match[1]);
						var pos_space  = name.indexOf(' ');
						var first_name = name.substring(0, pos_space);
						var last_name  = name.substring(pos_space + 1);

						return {
							uid: match[2],
							first_name: first_name,
							last_name: last_name
						};
				
					return false;
				},
				 onChange: function(value) {

					
		        },
				load: function(query, callback) {
				
				},
				onInitialize: function(){
				  
				}
		});

		
	};

	$.fn.parts_people = function(thread_id){
		container = $(".parts_peoples");
		// console.log(thread_id);
		$.ajax({
			url: '{{ url("messages/added/peoples") }}',
			type:'POST',
			data:  {'_token':'{{ csrf_token() }}','thread_id':thread_id},
			async: false,
			success: function(data)
			    {
					container.html('');
					container.html(data.html);
			    }
		});

	};


	$('#people').add_people(people);


    $('button.settings-update').on('click',function(e){

        form = $('form#settings');

    	$('#largeModal').modal('hide');

    	 $('.appriseInner button').click();
    	  apprise('Do you want to add participants to people?', {'verify':true,'animate':true}, function(r)
		    {

			 $('.appriseInner button').click();
     		apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
     		 $('.aButtons').hide();

		    if(r)
		        { 

				     $.ajax({	
			        	url: form.attr("action"),
	                    type: form.attr("method"),
	                    data: form.serialize(), 
			            async: false,
			            success: function(data)
			                {

			                	//console.log(data);
			                    $('.appriseInner button').click();

			                    if(data.success){

			                    	//if(jQuery.isEmptyObject(data.people)){
			                       		 people = $.parseJSON(data.people);
										$('#search-threads').add_people(people);
			                    	//}else{
									//	$('#search-threads').add_people(JSON.stringify([]));
			                    		
			                    	//}



									$('.parts_peoples').parts_people(data.added);

									 $('.inbox_chat').hide().html('').inbox_refresh();
				                    //$('#largeModal').modal('hide');


									// $('.'+data.rowId).addClass('active_chat');
									// $('.'+data.rowId).addClass('{{$color[0]}}');
									//alert(1);
									 $('#largeModal').modal('show'); 

									$('.'+data.class).addClass('active_chat');
									$('.'+data.class).addClass(data.bg_color);

			                   	 // alert(1);
										 
			                    }else{

									

									$('.appriseInner button').click();
									apprise("<i><font color='black'>Please select participants to be added!</font></i><br><br><center> <img src= '"+public_url+"admin-assets/dist/image/warning.ico' width='20' height='20' /></center>");

									
										$('#largeModal').modal('hide');
									
			                    }  	 

				                 
			                		
			                }
			           });
			       	
		     	  //	$('#largeModal').modal('show');

		     	  	return false;
		       		
		        }
		    else
		        { 
			        $('.appriseInner button').click();
			       	$('#largeModal').modal('show');
		        }
		    });

    
    	e.preventDefault();
    });



    $.fn.inbox_refresh = function(){
    	$('.inbox_chat').html('');
    	keyword = $('#search-threads').val();

		//$(this).fadeOut('slow', function(){

			//alert(rowId);
			
		     $.ajax({	
		        url: '{{ url("messages/refresh") }}',
		        type:'POST',
		        data:  {'_token':'{{ csrf_token() }}','rowId':rowId,'keyword':keyword},
		        async: false,
		        success: function(data)
		            {

		            	// console.log(data);

						//$('.inbox_chat').html('');
						

						$('.chat_list').removeClass('active_chat');
						$('.chat_list').removeClass('{{ $color[0] }}');

						// $('.'+data.rowId).addClass('active_chat');
						// $('.'+data.rowId).addClass('{{$color[0]}}');

						
						$('.'+data.class).addClass('active_chat');
						$('.'+data.class).addClass(data.bg_color);

						$('.selected-name').html(data.subject);

						$('.inbox_chat').hide().html('').prepend(data.html).show();

						// $('input[name="thread_id"]').val(data.thread_id);
					

		            }
		       });


		

		   // $(this).show();
		//});
    };

   $('.select-all-button').on('click',function(){

   		if($(this).text() == 'select_all'){
   			
   			$(this).text('check_box');

			$('.search-account-selectize-container').hide();
			$('.all-search-account-selectize-container').show();
			$('input[name="user_id_encrypted"]').val('ALL USER');
		
			  $.ajax({
	            url: '{{ url("messages/all-user") }}',
	            type:'POST',
	            data:  {'_token':'{{ csrf_token() }}'},
	            async: false,
	            success: function(data)
	                {

						//$('.msg_history').html('');
						$('.msg_history').hide().html('').prepend(data.html).show();
						$('input[name="thread_id"]').val(data.threads_id);
						//$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);
						
						$('.chat_list').removeClass('active_chat');
						$('.chat_list').removeClass('{{$color[0]}}');

						$('.all-user').addClass('active_chat');
						$('.all-user').addClass('{{$color[0]}}');
						$('.new-compose-container').html('');
						$('.chat_list').insertAfter('.active_chat');
						$('.active_chat').css({"background-color":"#d8d8d8"});
						$('.active_chat').css({"border-left":"5px solid {{ $color[4] }}"});
					 
	                }
	            });

			  

   		}else{

   			$(this).text('select_all');

			$('.chat_list').removeClass('active_chat');
			$('.chat_list').removeClass('{{$color[0]}}');
			$('.new-compose-container').html('');

   			$('input[name="user_id_encrypted"]').val('');
   			

			var $select = $('#select-to').selectize();
			var control = $select[0].selectize;
			control.clear();
			$('.search-account-selectize-container').show();
			$('.all-search-account-selectize-container').hide();



   		}
   });

	
	

		</script>

		<script type="text/javascript">
  // new compose
			$('.compose-message-btn').on('click',function(){


				$('.search-container-selectize').show();
				$('.all-search-account-selectize-container').hide();
				$('.selected-message-container').hide();
				$('.msg_history').html('').show();
				$('.selected-name').html('');
				$('.input_msg_write').show();
				$('.group-settings-gear').hide();

				if($('.select-all-button').text() == "check_box"){
					$('.select-all-button').trigger('click');
				}

				var $select = $('#select-to').selectize();
				var control = $select[0].selectize;
				control.clear();

				$('.chat_list').removeClass('active_chat');
				$('.chat_list').removeClass('{{ $color[0] }}');

				$('.chat_list').css({"border-left":"5px solid #f8f8f8"});
				$('.chat_list.active_chat').css({"border-left":"5px solid {{ $color[4] }}"});


				 $.ajax({	
		            url: '{{ url("messages/new") }}',
		            type:'POST',
		            data:  {'_token':'{{ csrf_token() }}'},
		            async: false,
		            success: function(data)
		                {
		                
		                 //  //$('.inbox_chat').html('');
		                 // console.log(data.html);
		                 $('.new-compose-container').hide().html('').prepend(data.html).show();
		                 // $('.new-compose-container').html(data.html);
		                 $('input[name="thread_id"]').val('');
		                 $('input[name="user_id_encrypted"]').val('');


		                 // $(".hilightable").each(function (i, v) {
	                  //       v.innerHTML = v.innerText.replace(keyword, "<hilight>" + keyword + "</hilight>");
	                  //     });
		               
		                }
		           });



			});

			$('.new-compose-container').on('click','#compose_new',function(){
				$('.compose-message-btn').trigger('click');
			});

			$('.new-compose-container').on('click','#delete-thread-new',function(){
				$('.new-compose-container').html('');
			});


			$(document).on('submit','form#compose',function(){

			//form = $(this);

			$('.appriseInner button').click();
			apprise("<i><b><font color='grey'>Sending message please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
			//$(this).prop("disabled", true);

			$('.aButtons').hide();


				form = $(this);
			     $.ajax({	
		        	url: form.attr("action"),
                    type: form.attr("method"),
                    data: form.serialize(), 
		            async: false,
		            success: function(data)
		                {

		                	if(data.success){

		                		//$('.inbox_chat').html('');
								//$('.msg_history').html('');
								

								$('input[name="thread_id"]').val(data.thread_id);

								$('input[name="user_id_encrypted"]').val(data.user_id_encrypted);

								$('input[name="message"].write_msg').val('');

								
								$('.new-compose-container').html('');

								$('.search-container-selectize').hide();
								$('.all-search-account-selectize-container').hide();
								$('.selected-message-container').show();
								$('.group-settings-gear').show();
								$('.selected-name').html(data.subject);

								// people = $.parseJSON(data.people);
								// $('#search-threads').add_people(people);

								   // if(jQuery.isEmptyObject(data.people)){
			                       		 people = $.parseJSON(data.people);
										$('#search-threads').add_people(people);
			                    	//}else{
									//	$('#search-threads').add_people(JSON.stringify([]));
			                    		
			                    	//}

								$('.parts_peoples').parts_people(data.user_id_encrypted);

								$('input[name="group_name"]').val(data.group_name);

								rowId = data.thread_id;


						       // $('.inbox_chat').html('').prepend(data.threads);

						        $('.inbox_chat').hide().html('').prepend(data.threads).show();
						        $('.msg_history').hide().html('').prepend(data.messages).show();
						        $('.msg_history').animate({scrollTop: $('.msg_history')[0].scrollHeight}, "slow");

						        $('.'+data.class).addClass('active_chat');
								$('.'+data.class).addClass(data.bg_color);


								      
						       
								$('.appriseInner button').click();
								 
	
		                	}else{

		                	//alert(data.errMsg);
								$('.appriseInner button').click();
								apprise("<i><font color='black'>"+data.errMsg+"</font></i><br><br><center> <img src= '"+public_url+"admin-assets/dist/image/warning.ico' width='20' height='20' /></center>");
     		

		                	}
		                	//form.prop("disabled", false);
		                	//$('.appriseInner button').click();
		                }
		           });
			     return false;
			});


		$('.chat_list:first').addClass('active_chat');
		$('.chat_list:first').addClass('{{$color[0]}}');
		@if($threads)
			$('.group-settings-gear').show();
		@else
			$('.group-settings-gear').hide();
		@endif
		$('.chat_list:first').removeClass('unseen_chat');
		$('.chat_list:first').addClass('seen_chat');

		$('.msg_history').animate({scrollTop: $('.msg_history')[0].scrollHeight}, "slow");
		</script>
@endsection