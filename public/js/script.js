// User Registration
if($('#userRegister').length > 0) {
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 50000,
            values: [ 100, 50000 ],
            slide: function( event, ui ) {
                $( "#annual_income" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
            }
        });

        $( "#annual_income" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
          " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );
    });

    // Select multiple occupation
    $(document).ready(function() {
        $('select[name="occupation"]').multiselect({
            selectedText: "# of # selected"
         });

        var hidValue = $("#hidSelectedOptionsoccupation").val();
        
        var selectedOptions = hidValue.split(",");
        for(var i in selectedOptions) {
            var optionVal = selectedOptions[i];
            $('select[name="occupation"]').find("option[value="+optionVal+"]").prop("selected", "selected");
        }

        $('select[name="occupation"]').multiselect('refresh');
    });

    // Select multiple family type
    $(document).ready(function() {
        $('select[name="family_type"]').multiselect({
            selectedText: "# of # selected"
         });

        var hidValue = $("#hidSelectedOptionsfamily_type").val();
        
        var selectedOptions = hidValue.split(",");
        for(var i in selectedOptions) {
            var optionVal = selectedOptions[i];
            $('select[name="family_type"]').find("option[value="+optionVal+"]").prop("selected", "selected");
        }

        $('select[name="family_type"]').multiselect('refresh');
    });
}