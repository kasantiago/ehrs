    
     var HOLIDAYS = {  
        // 2019: {
        //     1: { 1: "New Year's Day"},
        //     2: { 20: "Family Day" },
        //     4: { 17: "Easter Monday" },
        //     5: { 22: "Victoria Day" },
        //     7: { 1: "Canada Day" },
        //     8: { 7: "Civic Holiday" },
        //     9: { 4: "Labour Day" },
        //     10: { 9: "Thanksgiving" },
        //     12: { 25: "Christmas", 26: "Boxing Day"}
        // }
    };

    function filterNonWorkingDays(date) {
        // Is it a weekend?
        if ([ 0, 6 ].indexOf(date.getDay()) >= 0)
            return { enabled: false, classes: "weekend" };
        // Is it a holiday?
        var h = HOLIDAYS;
        $.each(
            [ date.getYear() + 1900, date.getMonth() + 1, date.getDate() ], 
            function (i, x) {
                h = h[x];
                if (typeof h === "undefined")
                    return false;
            }
        );
        if (h)
            return { enabled: false, classes: "holiday", tooltip: h };
        // It's a regular work day.
        return { enabled: true };
    }

    $(".date-range").datepicker({ 
      beforeShowDay: filterNonWorkingDays,
      multidate: true,
    }).on('changeDate', function(ev){
        

             var dates = jQuery.trim($('input[name="six_c_inclusive_dates"]').val());

              if ((dates.length == 0))
              {
                  
                     $('input[name="six_c_for"]').val('');
                     $('input[name="six_c_for"]').parent().removeClass('focused');

              }else{

                  var getNumbers = $(this).val().split('').filter(function(item) {
                    return item === ','
                  }).length;
                   getNumbers = getNumbers+1;

                    
                 $('input[name="six_c_for"]').val(getNumbers);
                     
                     // $('input[name="six_c_for"]').parent().addClass('focused');
                
              }


    });





// $(".date-range").on('change',function(){

 
//   var dates = jQuery.trim($('input[name="six_c_inclusive_dates"]').val());

//   if ((dates.length == 0))
//   {
      
//          $('input[name="six_c_for"]').val('');
//          $('input[name="six_c_for"]').parent().removeClass('focused');

//   }else{

//       var getNumbers = $(this).val().split('').filter(function(item) {
//         return item === ','
//       }).length;
//        getNumbers = getNumbers+1;

        
//      $('input[name="six_c_for"]').val(getNumbers);
         
//          // $('input[name="six_c_for"]').parent().addClass('focused');
    
//   }

//  });
