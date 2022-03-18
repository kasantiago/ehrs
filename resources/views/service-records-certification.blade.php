@extends('layouts.app')
@section('title','SERVICE RECORD CERTIFICATION')

@section('content')

    <!-- Basic Example | Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CERTIFICATION</h2>
                        </div>
                        <div class="body">
                            <div class="card">
                                <form method="POST" novalidate="novalidate" action="{!! url('reports/certification') !!}" target="_blank">
                                    {!! csrf_field() !!}
                                    <!-- CKEditor -->
                                    <div class="header">
                                        <small>Please edit the information below if necessary.</small>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                            <button type="submit" id="pdf-cert-b" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;">
                                                <i class="material-icons">picture_as_pdf</i> &nbsp; Download PDF &nbsp;  <i class="material-icons">file_download</i> 
                                            </button>
                                            </li>
                                        </ul>
                                        <!-- <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="javascript:void(0);">Action</a></li>
                                                    <li><a href="javascript:void(0);">Another action</a></li>
                                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                                </ul>
                                            </li>
                                        </ul> -->
                                    </div>
                                    <div class="body">
                                        <textarea id="ckeditor" name="certification_content">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to CERTIFY that as per record on file in this Office, <b>{{  App\Http\Models\PersonalInformation::get_name($work->user_id) }}</b>, <b>{!! $work->position_title !!}</b> is a {!! $work->status_of_appointment !!} employee of the Department of Health, Regional Office No. 02  from the period {!! date('F d, Y', strtotime($work->inclusive_date_from)) !!} to {!! strtolower($work->inclusive_date_to) !!} and is currently receiving an annual compensation including benefits and allowances amounting to <b>{!! $service_record_salary !!} (Php {!! number_format($work->service_record_salary ,2,'.', ',') !!})</b>.
                                            <br><br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This certification is issued upon request of <b>(Mr./Ms./Mrs./Dr.)
                                                <?php
                                                $value = App\Http\Models\PersonalInformation::get_name($work->user_id);
                                                echo strtok($value, " "); // Test
                                                ?></b> 
                                                to support his application for ____?.
                                            <br><br>
                                            <br><br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Given this 
                                                <?php
                                                echo date("jS \d\a\y \of F, Y");
                                                ?>.
                                            <br><br><br><br>
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>DOMINGO K. LAVADIA</strong><br />
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Administrative Officer V
                                        </textarea>
                                    </div>
                                    <!-- #END# CKEditor -->
                                </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Example | Vertical Layout -->


@endsection

@section('styles')
  
    

@endsection

@section('scripts')
    
    <!-- Layout -->
    <script src="{!! asset('admin-assets/plugins/jquery-steps/jquery.steps.js') !!}"></script>

    <!-- Ckeditor -->
    <script src="{!! asset('admin-assets/plugins/ckeditor/ckeditor.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
           $('.actions').hide();
        });


        //Vertical form basic
        $('#wizard_vertical').steps({
            headerTag: 'h2',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            stepsOrientation: 'vertical',
            onInit: function (event, currentIndex) {
                setButtonWavesEffect(event);
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
            }
        });


        function setButtonWavesEffect(event) {
            $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
            $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
        }

        $('.steps ul li').removeClass('disabled');
        $('.steps ul li').addClass('done');

        $(function () {
            //CKEditor
            CKEDITOR.replace('ckeditor');
            CKEDITOR.config.height = 400;
        });

    
        // $('#pdf-cert-a').on('click',function(){
        //     $.ajax({
        //         url: "{!! url('reports/flash-data/certification') !!}",
        //         type: "POST",
        //         data: { 'data':$('#ckeditor').val() }, 
        //         success: function(data)
        //             {
        //                 window.location.href = "{!! url('reports/certification-one') !!}";
        //                 // target = "_blank";    
        //             }
        //     });

        //     return false;
        // });

        // $('#pdf-cert-b').on('click',function(){
        //     $.ajax({
        //         url: "{!! url('reports/flash-data/certification') !!}",
        //         type: "GET",
        //         data: { 'data':$('#ckeditortwo').val(),'_token':'{!! csrf_token() !!}' }, 
        //         success: function(data)
        //             {
        //                 window.location.href = "{!! url('reports/certification-two') !!}"; 
        //                 // target = "_blank";   
        //             }

        //     });

        //     return false;
        // });

        $(document).ready(function(){
        $('.wizard .steps .done a').addClass('{{ $color[0] }}');
        $('.wizard .steps .current a').removeClass('{{ $color[0] }}');
        $('.wizard .steps .current a').addClass('{{ $color[2] }}');

        $('.wizard .steps .done a').on('click',function(){
            $('.wizard .steps .done a').addClass('{{ $color[0] }}');
            $(this).removeClass('{{ $color[0] }}');
            $(this).addClass('{{ $color[2] }}');

            $('.wizard > .actions a').addClass('{{ $color[0] }}');
            $('.wizard > .actions .disabled a').removeClass('{{ $color[0] }}');
        });
        
    });

    </script>

@endsection