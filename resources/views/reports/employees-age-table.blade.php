<div class="table-responsive">
<table class="table table-bordered table-striped table-hover data-table-report  dataTable" id="data-table-report"  style="width:100%">
<thead>
    <tr>
       <th >Name</th>
       <th >Level</th>
        <th >Status</th>
        <th >Division/Unit</th> 
        <th >Position</th>
        <th >Gender</th>
        <th >Birthday</th>
        <th >Age</th>
 
       <!--  <th>Username</th> -->
       <!--  <th>Email</th> -->

      
    </tr>
</thead>
<tfoot>
    <tr>
        <th >Name</th>
        <th >Level</th>
        <th >Status</th>
        <th >Division/Unit</th> 
        <th >Position</th>
        <th >Gender</th>
        <th >Birthday</th>
        <th >Age</th>
       <!--  <th>Username</th> -->
        <!-- <th>Email</th> -->

       
    </tr>
</tfoot>
    <tbody>
       
            
        
           @foreach ($report_data as $key => $value)
            <tr class="data">
                <td><small>{!! App\Http\Models\PersonalInformation::get_name($value->id) !!}</small></td>
                <td><small>{!! $value->level !!}</small></td>
                <td><small>{!! strtoupper($value->employee_status) !!}</small></td>
                <td><small>{!! strtoupper($value->division) !!}</small></td> 
                <td><small>{!! strtoupper($value->position) !!}</small></td>
                <td><small>{!! $value->gender == 1 ? 'Male' : '' !!}{!! $value->gender == 2 ? 'Female' : '' !!}</small></td>
                <td><small>{!! date('m/d/Y', strtotime($value->birthday)) !!}</small></td>
                <td><small>{!! $value->age !!}</small></td>

            </tr>
            @endforeach
        
 

    </tbody>
</table>
</div>
