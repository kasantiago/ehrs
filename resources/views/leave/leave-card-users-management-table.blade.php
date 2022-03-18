 <div class="table-responsive">
  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
    <thead>
        <tr>
       
            <th><small>Name</small></th>
            <th><small><center>Division Section/Unit</center></small></th>
            <th><small><center>Position</center></small></th>
            <th><small><center>Earned Vacation Leave</center></small></th>
            <th><small><center>Earned Sick Leave</center></small></th>
           <!--  <th>Username</th> -->
            <!-- <th>Email</th> -->

            <th><small>Action</small></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
         
            <th><small>Name</small></th>
            <th><small><center>Division Section/Unit</center></small></th>
            <th><small><center>Position</center></small></th>
            <th><small><center>Earned Vacation Leave</center></small></th>
            <th><small><center>Earned Sick Leave</center></small></th>
           <!--  <th>Username</th> -->
            <!-- <th>Email</th> -->

            <th><small>Action</small></th>
        </tr>
    </tfoot>
    <tbody>

        @foreach ($users as $key => $value)
        <tr class="data">

            <td style="vertical-align:middle;" ><a class="details" data-toggle="modal" data-target="#smallModal-{{$key}}" title="Click to View Details"><small> {{  App\Http\Models\PersonalInformation::get_name($value->id) }}</a></small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->division) }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ strtoupper($value->position) }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ $value->vacation_earned }}</small></td>
            <td style="vertical-align:middle;text-align:center;"><small>{{ $value->sick_earned }}</small></td>
            <td style="vertical-align:middle;text-align:center;width:12%;">
            <center>
                
                 <a class="action-tag" href="{{ url('leave-management/details/'.now()->year.'/'.encrypt($value->id)) }}">
                         <i class="material-icons {{ $color[3] }}" data-toggle="tooltip" data-placement="top" title data-original-title="View">assignment</i>
                 </a>

            </center>
            </td>


        </tr>
        @endforeach

    </tbody>
</table>
</div>