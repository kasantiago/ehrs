

        @foreach ($leave_card_data as $key => $value)
        <tr class="data">
 
           
            <td><small>{{ $value->period  }}</small></td>
            <td><small>{{ $value->bal_brought_forward }}</small></td>
            <td><small>{{ $value->vacation_earned }}</small></td>
            <td><small>{{ $value->vacation_abs_und_w_pay }}</small></td>
            <td><small>{{ $value->vacation_balance }}</small></td>
            <td><small>{{ $value->vacation_abs_und_wout_pay }}</small></td>
            <td><small>{{ $value->sick_earned }}</small></td>
            <td><small>{{ $value->sick_abs_und_w_pay }}</small></td>
            <td><small>{{ $value->sick_balance }}</small></td>
            <td><small>{{ $value->sick_abs_und_wout_pay }}</small></td>
            <td width="90%"><small>{{ $value->remarks }}</small></td>
            <td width="10%">
                <a class="edit-function action-tag" href="{{ url('account/edit') }}/{{encrypt($value->id)}}">
                 <i class="material-icons {{ $color[3] }}" data-toggle="tooltip" data-placement="top" title data-original-title="Edit User">mode_edit</i>
                </a>

            </td>
        
           

    

        </tr>
        @endforeach

