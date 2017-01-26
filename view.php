<?php
try{
    if(isset($_GET['res_id'])){
        $res_id = $_GET['res_id'];
    }else{
        header("Location: 404.html");
        echo "res_id not set";
        exit();
    }
    require_once "db_login.php";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    //sql for restaurant details
    $sql_res = "SELECT * FROM `restaurants` WHERE `zomato_id` = ". $res_id ;
    if($result_res = mysqli_query($conn,$sql_res)){

    }else{
        echo "unsussful query";
    }
    $res_row_count = mysqli_num_rows($result_res);
    if($res_row_count == 0){
        exit();
    }
    $res_row = mysqli_fetch_assoc($result_res);

    //sql for reviews
    $sql_rev = "SELECT * FROM `reviews` WHERE `zomato_id` = ". $res_id ." ORDER BY time_stamp DESC LIMIT 3";
    if($result_rev = mysqli_query($conn,$sql_rev)){
        $rev_row_count = mysqli_num_rows($result_rev);
    }else{
        $rev_row_count = 0;
        echo "unsussful review query";
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        require_once "head.html";
        ?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">GoMato</a>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form" method="get" action="search.php">
                            <div class="form-group">
                                <select name="city_id" class="form-control" id="cityid" required>
                                    <option value="" disabled selected>Select City</option>
                                    <option value="7">Chennai</option>
                                    <option value="4">Bangalore</option>
                                    <option value="1">Delhi</option>
                                    <option value="3">Mumbai</option>
                                    <option value="5">Pune</option>
                                    <option value="2">Kolkata</option>
                                    <option value="6">Hyderbad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  name="query" type="text" placeholder="Search restaurants and Cuisines..." id="query">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default"  type="submit" name="search">
                                    Search <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-3  col-xs-12 pull-right">
                <img class="img-responsive" alt="thumbnail unvailable" src="<?php echo $res_row['thumb_url']?>"/>
            </div>
            <h3><?php echo $res_row['name']?></h2>
                <p>
                    <strong>Address: </strong>
                    <?php echo $res_row['address']?>
                </p>
                <p>
                    <strong>
                        Cuisines Available:
                    </strong>
                    <?php echo $res_row['cuisines']?>
                </p>
                <p>
                    <strong>Rating :</strong>
                    <span class="badge" style="color:white;background-color:#<?php echo $res_row['rating_color']; ?>">
                        <?php echo $res_row['avg_rating']; ?>
                    </span>
                    <br />(Out of <?php echo $res_row['votes']; ?> votes)
                </p>
            </div>

            <div class="row">
                <br />
                <h4></h>User Reviews</h4>
                <hr />
                <div class="col-sm-12">
                    <ul class="list-group">
                        <?php if($rev_row_count == 0){
                            echo "No User reviews avaliable";
                        }else{?>
                            <?php while($rev_row = mysqli_fetch_assoc($result_rev)){ ?>
                                <li class="list-group-item" style="max-width:50%;">
                                    <strong>
                                        <?php echo $rev_row['username']?>
                                        <span class="badge" style="color:white;background-color:#<?php echo $rev_row['rating_color']; ?>">
                                            <?php echo $rev_row['rating']; ?>
                                        </span>
                                    </strong>
                                    <br />
                                    <p>
                                        <?php echo $rev_row['review_text']?>
                                    </p>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h4>Submit review</h4>
                <hr />
                <p>
                    <strong>
                        Your Rating:<br />
                    </strong>
                </p>
                <div id="rateYo"></div>
                <div class="col-sm-5">

                    <form name="review_form" class="form" id="review_form">
                        <div class="form-group">
                            <label>Name</label>
                            <input id="username" type="text" name="username" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>review text</label>
                            <textarea id="review_text" name="review_text" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <input id="res_id" type="hidden" value="<?php echo $res_row['zomato_id']?>">
                            <input class="btn btn-default" type="submit" name="submit" value="submit" />
                         </div>
                    </form>
                    <div id="submit_response">

                    </div>
                </div>
            </div>
        </div>


    </body>
    </html>

    <?php
}catch(Exception $e){
    echo 'Error: '. $e->getMessage();
}
?>
