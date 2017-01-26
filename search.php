<?php
try{
    require_once "db_login.php";
    if(isset($_GET['query'])){
        $squery = "'%".$_GET['query']."%'";
        $scuisine = "'%".$_GET['query']."%'";
    }else{
        $squery = "";
        $scuisine = "";
    }
    $cityid = $_GET['city_id'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    $sql = "SELECT * FROM restaurants where `city_id` = ". $cityid ." AND (`name` LIKE ". $squery ." OR  `cuisines` LIKE ". $scuisine. ") LIMIT 10" ;
    $result = mysqli_query($conn,$sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        require_once "head.html";
        ?>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">GoMato</a>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <form id="search-form" class="navbar-form">
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
                                <button class="btn btn-default"  type="submit">
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
        <h2>Showing Results for : <?php $_GET['query']?></h2>
        <hr />
        <div class="row" id="results">
            <ul class="list-group">
                <?php

                while($row = mysqli_fetch_assoc($result)){ ?>

                    <li class="list-group-item">
                        <h3>
                            <a href="view.php?res_id=<?php echo $row['zomato_id']?>">
                                <?php echo $row['name']; ?>
                            </a>

                            <span class="badge" style="color:white;background-color:#<?php echo $row['rating_color']; ?>">
                                <?php echo $row['avg_rating']; ?>
                            </span>
                        </h3>

                        <p>
                            <?php echo $row['locality']; ?>
                        </p>
                    </li>
                    <?php }?>


                </ul>

            </div>
        </div>
    </body>
    </html>
    <?php

}catch(Exception $e){
    echo 'Error: '. $e->getMessage();
}
?>
