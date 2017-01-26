$(function () {
    console.log( "ready!" );

    $("#rateYo").rateYo({

        rating    : 0,
        spacing   : "5px",
        halfStar : true,
        multiColor: {

            "startColor": "#FF0000", //RED
            "endColor"  : "#00FF00"  //GREEN
        }
    });

    $( "#review_form" ).submit(function( event ) {
        try{

            console.log("submit for ovvereide");
            var color = $("#rateYo").rateYo("option", "ratedFill").slice(1);
            console.log(color);
            var username1 = $("#username").val();
            var rating1 = $("#rateYo").rateYo("option", "rating");
            var review_text1 = $("#review_text").val();
            var res_id1 = $("#res_id").val();
            // $.get("submitreview.php",{'username':username,'rating_color':color,'rating':rating,'review_text':review_text,'res_id':res_id},
            // function(resp ){
            //     $("#submit_response").html(resp );
            // });
            $.get( "submitreview.php",
            {
                username: username1,
                review_text: review_text1,
                rating : rating1,
                res_id: res_id1,
                rating_color : color,
            } )
            .done(function( data ) {
                console.log( "Data Loaded: " + data );
                location.reload();
            });
            event.preventDefault();
        }catch(err){
            console.log(err);
        }
    });

});
