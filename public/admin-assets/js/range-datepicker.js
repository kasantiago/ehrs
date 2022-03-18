
    $('.date-range').daterangepicker({
        "autoApply": true,
        "isInvalidDate": function(date) {
          return (date.day() == 0 || date.day() == 6);
        }
    }, function(start, end, label) {
 
        var d1 = start.format('YYYY-MM-DD');                                                                                                                      
        var d2 = end.format('YYYY-MM-DD');

       //getDays(new Date(d1),new Date(d2));
       if(d1 == d2){
            $('input[name="six_c_inclusive_dates"]').val(d1);
            $('input[name="six_c_for"]').val(1);
       }else{
            $('input[name="six_c_for"]').val(calcBusinessDays(new Date(d1),new Date(d2)));
        
       }


    });




 function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
    var iWeeks, iDateDiff, iAdjust = 0;
    if (dDate2 < dDate1) return -1; // error code if dates transposed
    var iWeekday1 = dDate1.getDay(); // day of week
    var iWeekday2 = dDate2.getDay();
    iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
    iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
    if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
    iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
    iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;
 
    // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
    iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)
 
    if (iWeekday1 <= iWeekday2) {
      iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
    } else {
      iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
    }
 
    iDateDiff -= iAdjust // take into account both days on weekend
 
    return (iDateDiff + 1); // add 1 because dates are inclusive
}



//  function getDays(d1, d2) {

//     var one_day=1000*60*60*24;
//     var d1_days = parseInt(d1.getTime()/one_day) - 1;
//     var d2_days = parseInt(d2.getTime()/one_day);
//     var days = (d2_days - d1_days);
//     var weeks = (d2_days - d1_days) / 7;
//     var day1 = d1.getDay();
//     var day2 = d2.getDay();
//     if (day1 == 0) {
//         days--;
//     } else if (day1 == 6) {
//         days-=2;
//     }
//     if (day2 == 0) {
//        days-=2;
//     } else if (day2 == 6) {
//        days--;
//     }
//     days -= parseInt(weeks) * 2;

 
//     $('input[name="six_c_for"]').val(days);

//     // $('input[name="six_c_inclusive_dates"],input[name="six_c_for"]').parent().addClass('focused');

// }
