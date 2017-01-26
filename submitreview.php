<?php
try{

    if(isset($_GET['username']) && isset($_GET['review_text']) && isset($_GET['rating']) && isset($_GET['res_id']) && isset($_GET['rating_color'])){
        $username = $_GET['username'];
        $review_text = $_GET['review_text'];
        $rating = $_GET['rating'];
        $res_id = $_GET['res_id'];
        $rating_color =$_GET['rating_color'];
        $cur_time = time();
    }else{
        echo "parameters unavailable";
        die();
    }

    require_once "db_login.php";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $sql = "INSERT INTO reviews (zomato_id,username,rating,rating_color,review_text,time_stamp) VALUES";
    $sql .= "(" ;
    $sql .= $res_id.",";
    $sql .= "'". $username."',";
    $sql .= $rating.",";
    $sql .= "'". $rating_color."',";
    $sql .= "'". $review_text."',";
    $sql .=  $cur_time.")";

    if($result = mysqli_query($conn,$sql)){
        echo "review submitted succesfully";

    }else{
        echo "unsussful query";
        echo " ".$sql;
    }


    //update the the restaurant rating
    $sql_res_get = "SELECT votes,avg_rating FROM restaurants WHERE zomato_id= ". $res_id;
    if($result_get = mysqli_query($conn,$sql_res_get)){
        $row_read = mysqli_fetch_assoc($result_get);
        $votes = $row_read['votes'];
        $avg_rating  = $row_read['avg_rating'];
        $new_votes = $votes + 1;
        $new_avg_rating = (($avg_rating * $votes) + $rating)/$new_votes;
        echo " read success ";
    }else{
        echo " unsussful read ". "<br />";
        echo " ".$sql;
    }
    $sql_update = "UPDATE `restaurants` SET `votes` = ".$new_votes . ", `avg_rating` = ".$new_avg_rating . " WHERE zomato_id =".$res_id;
    if($result_update = mysqli_query($conn,$sql_update)){
        echo "vote update success";
    }else{
        echo " vpte update failed ";
        echo $sql_update;

    }

}catch(Exception $e){
    echo 'Error: '. $e->getMessage();
}
?>
