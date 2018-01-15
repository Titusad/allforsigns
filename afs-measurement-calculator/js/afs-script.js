// Output width_total_inches x height_total_inches = sqf_total

jQuery(document).ready(function($) {
    
    showField();

    $(".number_input").keyup(calculate_sqf);
    $(".finishing-options").change(calculate_sqf);


    function calculate_sqf(){
    	
        //CALCULATE SQF2 TOTAL BASED ON USER INPUT VALUES

        var w_f_to_inches = ($("#width_ft").val())*12;
    	var width_in 	  = parseInt($("#width_in option:selected").val());
    	var h_f_to_inches = ($("#height_ft").val())*12;
        var height_in     = parseInt($("#height_in option:selected").val());

    	var width_total_inches    = w_f_to_inches + width_in;
        var height_total_inches   = h_f_to_inches + height_in;

    	($("#width_total_inches").text(width_total_inches)) + '"';
        ($("#height_total_inches").text(height_total_inches)) + '"';

        var widht_total_to_feet     = ((width_total_inches) / 12); 
        var height_total_to_feet    = ((height_total_inches) / 12);

        var sqf_total_1   = (widht_total_to_feet * height_total_to_feet);
        var sqf_total   = (widht_total_to_feet * height_total_to_feet).toFixed(2);

        $("#sqf_total").text(sqf_total);


        //CALCULATE SQF TOTAL BASED ON SIZE

        if (sqf_total_1 <= 100) {
            var per_sqf_price = localize_script.value1;
        }
        else if(sqf_total_1 >100 && sqf_total_1 <=199){
            var per_sqf_price = localize_script.value2;
        }
        else if(sqf_total_1 >200 && sqf_total_1 <=499){
            var per_sqf_price = localize_script.value3;
        }
        else if(sqf_total_1 >500 && sqf_total_1 <=999){
            var per_sqf_price = localize_script.value4;
        }
        else if(sqf_total_1 >1000 && sqf_total_1 <=1000000){
            var per_sqf_price = localize_script.value5;
        }
        var grand_total = (sqf_total_1*per_sqf_price);
        

        // CALCULATE FINISHING OPTIONS ADDINGS

        // ADD DOUBLE SIDE 
        var n_s_product = parseInt($("#n_s_product option:selected").val());
        

            if (n_s_product == 2) {
              
                var d_side_add = grand_total;

            }else{
                var d_side_add = 0;
            }
    

            // ADD DOUBLE SIDE 
            var d_s_image = parseInt($("#d_s_image option:selected").val());

            if (d_s_image == 2) {
                var d_s_image = (sqf_total_1 * localize_script.value7);
            }else{
                var d_s_image = 0;
            }

            // ADD POCKET + HEM
            var pp_h = parseInt($("#pp_h option:selected").val());

            if (pp_h == 1) {
                var pp_h = 0;
                
            }else if(pp_h == 2 || pp_h == 3 || pp_h== 4 || pp_h== 5 || pp_h== 6 || pp_h== 7){
               var pp_h = (sqf_total_1 * localize_script.value8);

            }

            // ADD GROMMET
            var gmm = parseInt($("#gmm option:selected").val());

            if (gmm == 1) {
                var gmm = 0;
                
            }else if(gmm == 2 || gmm == 3 || gmm== 4 || gmm== 5 || gmm== 6 || gmm== 7){
               var gmm = (sqf_total_1 * localize_script.value8);
               
            }

            // ADD WINDLIST
            var windlist = parseInt($("#windlist option:selected").val());

            if (windlist == 2) {
                var windlist = (sqf_total_1 * localize_script.value10);
                
            }else{
                var windlist = 0;
            }

            // ADD WEBBING
            var webbing = parseInt($("#webbing option:selected").val());

            if (webbing == 1) {
                var webbing = 0;
                
            }else if(webbing == 2){
                var webbing = (sqf_total_1 * localize_script.value11);
            
            }else if(webbing == 3){
                var webbing = (sqf_total_1 * localize_script.value12);
           
            }else if(webbing == 4){
                var webbing = (sqf_total_1 * localize_script.value13);

            }

            // ADD WINDLIST
            var corners = parseInt($("#corners option:selected").val());

            if (corners == 2) {
                var corners = (sqf_total_1 * localize_script.value14);

            }else{
                var corners = 0;
            }

             // ADD ROPE
            var rope = parseInt($("#rope option:selected").val());

            if (rope == 1) {
                var rope = 0;
                
            }else if(rope == 2){
                var rope = (sqf_total_1 * localize_script.value15);
            
            }else if(rope == 3){
                var rope = (sqf_total_1 * localize_script.value16);
           
            }else if(rope == 4){
                var rope = (sqf_total_1 * localize_script.value17);

            }else if(rope == 5){
                var rope = (sqf_total_1 * localize_script.value18);

            }

            // ADD SILICONE EDGES
            var s_e = parseInt($("#s_e option:selected").val());

            if (s_e == 1) {
                var s_e = 0;

            }else{
                var s_e = (sqf_total_1 * localize_script.value19);
               
            }

            // ADD LAMINATION
            var lam = parseInt($("#lam option:selected").val());

            if (lam == 2) {
                var lam = (sqf_total_1 * localize_script.value20);

            }else{
                var lam = 0;
            }

            // ADD SHAPE CUTOUT
            var s_c = parseInt($("#s_c option:selected").val());

            if (s_c == 2) {
                var s_c = (sqf_total_1 * localize_script.value21);
               
            }else{
                var s_c = 0;
            }

            // ADD H STAKE
            var h_stake = parseInt($("#h_stake option:selected").val());

            if (h_stake == 2) {
                var h_stake = (sqf_total_1 * localize_script.value22);
               
            }else{
                var h_stake = 0;
            }

            // ADD HOLES
            var holes = parseInt($("#holes option:selected").val());

            if (holes == 2) {
                var holes = (sqf_total_1 * localize_script.value23);
               
            }else{
                var holes = 0;
            }


        // CALCULATE FINAL TOTALS 
        var grand_final_totals = (grand_total + d_side_add + d_s_image + pp_h + gmm + windlist + webbing + corners + rope + s_e + lam + s_c + h_stake + holes);


        // CALCULATE FINAL TOTALS + TURNAROUND + DESIGN PROOF

            // ADD TURNAROUND
                var turn_around = parseInt($("#turn_around option:selected").val());

                if (turn_around == 2) {
                    var turn_around = grand_final_totals;
                 
                }else{
                    var turn_around = 0;
                }

            //  ADD DESIGN PROOF
                var design_proof = parseInt($("#design_proof option:selected").val());

                if (design_proof == 2) {
                    var design_proof = 5;
                   
                }else{
                    var design_proof = 0;
                }


            var grand_final_totals_plus_adds = (grand_final_totals + turn_around + design_proof).toFixed(2);
            $("#grand_total").val(grand_final_totals_plus_adds);


            // GET THE RADIO BUTTON VALUE CHECKED
            // $("input:radio[name='choices']:checked").val();

    };
    
    // // window.onload
    // window.onload = function() {
    //   showField("window onload");
    // };
    
    function showField(){
        
        var option1  = localize_script.value1;  
        var option2  = localize_script.value2;
        var option3  = localize_script.value3;
        var option4  = localize_script.value4;
        var option5  = localize_script.value5;
        var option6  = localize_script.value6;
        var option7  = localize_script.value7;  
        var option8  = localize_script.value8;
        var option9  = localize_script.value9;
        var option10 = localize_script.value10;
        var option11 = localize_script.value11;
        var option12 = localize_script.value12;
        var option13 = localize_script.value13;
        var option14 = localize_script.value14;
        var option15 = localize_script.value15;
        var option16 = localize_script.value16;
        var option17 = localize_script.value17;
        var option18 = localize_script.value18;
        var option19 = localize_script.value19;
        var option20 = localize_script.value20;
        var option21 = localize_script.value21;
        var option22 = localize_script.value22;
        var option23 = localize_script.value23;

        if ((option1 || option2 || option3 || option4 || option5) > 0 ){
            $(".field1").css("display","block");
        }

        if (option6 > 0){
            $("#field2").css("display","block"); //double-sided-product
        }

        if (option7 > 0) {
            $("#field3").css("display","block"); //2-sided-image
        }

        if (option8 > 0) {
            $("#field4").css("display","block"); //pole-pocket-hem-price
        }

        if (option9 > 0) {
            $("#field5").css("display","block"); //grommet-price
        }

        if (option10 > 0) {
            $("#field6").css("display","block"); //windlist-price
        }

        if ((option11 || option12 || option13) > 0) {
            $("#field7").css("display","block"); //webbing
        }

        if (option14 > 0) {
            $("#field8").css("display","block");
        }

        if ((option15 || option16 || option17 || option18) > 0) {
            $("#field9").css("display","block");
        }

        if (option19 > 0) {
            $("#field10").css("display","block");
        }

        if (option20 > 0) {
            $("#field11").css("display","block");
        }

        if (option21 > 0) {
            $("#field12").css("display","block");
        }

        if (option22 > 0) {
            $("#field13").css("display","block");
        }

        if (option23 > 0) {
            $("#field14").css("display","block");
        }
    }; 
});









