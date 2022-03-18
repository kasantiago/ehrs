<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
    <thead>
        <tr>
            <th>Division</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Division</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($division as $key => $value)
        <tr class="data">
            <td>{{ strtoupper($value->name) }}</td>
            <td>{{ ucwords($value->details) }}</td>

            <td><center>
             
                    <a class="edit-function action-tag" href="{{ url('account/division/edit') }}/{{encrypt($value->id)}}">
                         <i class="material-icons {{ $color[3] }}">mode_edit</i>
                        </a>
                
                    <a class="destory-function action-tag"  data-name="{{ $value->name }}"  data-action="{{ url('account/division/destroy/'.encrypt($value->id)) }}" data-id="{{encrypt($value->id)}}">
                        <i class="material-icons {{ $color[3] }}">delete_forever</i>
                     </a>

            </center></td>


        </tr>
        @endforeach
    </tbody>
</table>
</div>