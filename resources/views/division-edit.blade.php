@extends('layouts.app')
@section('title','EDIT DIVISION')

@section('content')


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>EDIT DIVISION</h2>
               <!--  <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                 
                    </li>
                </ul> -->
            </div>
            <div class="body">
                <form  method="POST" novalidate="novalidate" action="{{ url('account/division/update/'.encrypt($division->id)) }}">
                 
                    {{ csrf_field() }}

                       <div class="col-md-12">
                           <div class="form-group form-float">
                                <div class="form-line {{ $division->name ? 'focused' : ''}}">
                                    <input type="text" class="form-control all-caps" name="name"  value="{{ $division->name }}" required aria-required="true">
                                    <label class="form-label" >Division <small>(Ex: Division/Section)</small></label>
                                </div>
                                <label id="name-error" class="error" for="name"></label>
                            </div>
                        </div> 

                        <div class="col-md-12">
                           <div class="form-group form-float">
                                <div class="form-line {{ $division->details ? 'focused' : '' }}">
                                    <input type="text" class="form-control all-caps" name="details"  value="{{ $division->details }}" required aria-required="true">
                                    <label class="form-label" >Details</label>
                                </div>
                                <label id="details-error" class="error" for="details"></label>
                            </div>
                         </div> 

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div style="float: left; width: 100%;" class="search-account-selectize-container" style="display: block;">
                                    <input type="text" placeholder="Assign Unit Head" name="unit_head" id="select-to"  style="height: 60px !important;">
                                    </div>
                                    <label class="form-label" >Assign Unit Head</label>
                                </div>
                                <label id="details-error" class="error" for="details"></label>
                            </div> 
                        </div> 


                       <div class="col-md-12" style="display:none;">
                            <div class="form-group">
                                <input type="checkbox" name="leave_approval_setting" id="leave_approval_setting" value="1"  {{ $division->leave_approval_setting ? 'checked' : '' }} class="filled-in" >
                                <label for="leave_approval_setting">Need approval in leave form</label>                                 
                            </div>
                        </div> 

                        <button class="btn {{ $color[2] }} waves-effect" type="submit">SUBMIT</button>
            
                </form>
            </div>
        </div>
    </div>


@endsection
@section('styles')
 <link href="{{ asset('admin-assets/css/selectize.css') }}" rel="stylesheet">  

    
@endsection

@section('scripts')

<script src="{{ asset('admin-assets/dist/js/standalone/selectize.js') }}"></script>
<link href="{{ asset('admin-assets/dist/css/selectize.default.css') }}" rel="stylesheet">  

   <script type="text/javascript">
     


         var formatName = function(item) {
        return $.trim((item.name || ''));
    };

    var accounts = $.parseJSON('{!! $accounts !!}');
  

    $('#select-to').selectize({
            persist: false,
            preload: true,
            maxItems: 1,
            maxOptions: 10,
            valueField: 'uid',
            labelField: 'name',
            searchField: ['name'],
            sortField: [
                {field: 'name', direction: 'asc'}
            ],
            options: accounts,
            create: false,
            openOnFocus: true,
            items: ['{!! $selected_uid !!}'],
            hideSelected: true,
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
            
            var selectize = this;
               console.log(selectize);

        }


        });





$('form').submit(function(e) {

      $('.appriseInner button').click();
      apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
      $('.aButtons').hide();

        var form = $(this);
           $.ajax({
                    headers: (
                      'Content-type: text/html; charset=utf-8'
                     ),
                    url: form.attr("action"),
                    type: form.attr("method"),
                    data: form.serialize(), 
                    success: function(data)
                       {
                        $('.appriseInner button').click();
                        
                          if(data.success == true){
                            window.location = data.url;
                          }else{
                            $.each( data.message, function( key, value ) {
                               $('#'+key+'-error').text(value[0]);
                               $('#'+key+'-error').prev().addClass('error focused');
                            });
                          }
                       }

                });
 
         return false;
        });

   </script>
@endsection