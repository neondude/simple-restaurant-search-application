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
                <a class="navbar-brand" href="index.php">GoMato</a>
            </div><!--
                <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>-->
        </div>
    </nav>

    <div class="container">
        <h3>Welcome to GoMato</h3>
        <div class="row">
            <form id="search-form" method="get" action="search.php">
                <div class="form-group">
                    <div class="col-sm-3">
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
                    <div class="col-sm-6">
                        <input class="form-control"  name="query" type="text" placeholder="Search restaurants and Cuisines..." id="query">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-default"  type="submit" name="search">
                            Search <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr />

    </div>
</body>
</html>
