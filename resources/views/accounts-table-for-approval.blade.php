 <div class="table-responsive">
  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
    <thead>
        <tr>
            <th><small>Photo</small></th>
            <th><small>Name</small></th>
            <th><small><center>Level</center></small></th>
            <th><small><center>Employee<br>Status</center></small></th>
            <th><small><center>Division<br> Section/Unit</center></small></th>
            <th><small><center>Position</center></small></th>
           <!--  <th>Username</th> -->
           <!--  <th>Email</th> -->

            <th><small>Action</small></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><small>Photo</small></th>
            <th><small>Name</small></th>
            <th><small><center>Level</center></small></th>
            <th><small><center>Employee Status</center></small></th>
            <th><small><center>Division Section/Unit</center></small></th>
            <th><small><center>Position</center></small></th>
           <!--  <th>Username</th> -->
            <!-- <th>Email</th> -->

            <th><small>Action</small></th>
        </tr>
    </tfoot>
    <tbody>

        @foreach ($users as $key => $value)
        <tr class="data">
            <td><center>
                <div class="media-left">
                    <a href="{!! url('personal-data-sheet').'/'.encrypt($value->id) !!}"   title="Click to View PDS"> <!-- target="_blank" -->
                        <img class="media-object" src="{!! $value->photo ? asset('storage/avatars/'.$value->photo) : asset('admin-assets/images/user.png') !!}" width="64" height="64">
                    </a>
                </div>
                </center>
            </td>
            <td style="vertical-align:middle;" ><a class="details" data-toggle="modal" data-target="#smallModal-{{$key}}" title="Click to View Details"><small> {{  App\Http\Models\PersonalInformation::get_name($value->id) }}</a></small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->level) }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->employee_status) }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->division) }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->position) }}</small></td>
           <!--  <td>{{ $value->username }}</td> -->
           <!--  <td>{{ $value->email }}</td> -->


            <td style="vertical-align:middle;text-align:center;width:12%;">
            <center>
                
                    <a class="status-change-function action-tag" data-action="{{ url('account/status-change/approved') }}" data-id="{{encrypt($value->id)}}" data-name="{{ $value->name }}" data-status="2">
                         <i class="material-icons {{ $color[3] }}" data-toggle="tooltip" data-placement="top" title data-original-title="Activate User">block</i>
                    </a>
              

            </center>
            </td>


        </tr>
        @endforeach

    </tbody>
</table>
</div>