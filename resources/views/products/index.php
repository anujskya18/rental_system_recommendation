<?php
require_once 'recommend.php';
require_once 'content_based.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rental_system";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $url = $_SERVER['REQUEST_URI']; // Get the current URL
    $newUrl = str_replace('/products/single-product/', '', $url);
    // echo $newUrl;

    $sql = "SELECT * FROM products WHERE id = $newUrl; ";
    $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $r_id=$row['category_id'];
            $r_price=$row['price'];
            // $r_address=$row['address'];
            $r_rating=$row['rating'];
        }
        $id=Auth::id();
        echo "Recommendation with user_id :".$id;
    $sql = "SELECT * FROM users WHERE id = $id ";
    $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $r_address=$row['address'];
        }


    $sql = "SELECT * FROM products WHERE category_id = $r_id; ";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $pname=$row['name'];
            $price=$row['price'];
            $r_address=$row['address'];
            $rating=$row['rating'];
            // echo "price: " . $row["price"]. "\t address: " . $row["address"]. " rating: " . $row["rating"]. "<br>";
            
            $objects[$pname] = [$price, $r_address, $rating ];
        }
    } else {
        echo "0 results";
    }

    // $path = $_SERVER['REQUEST_URI'];
    // echo $path;
   



    
// $r_price=120;$r_address="patan";$r_rating=4; 


$user = [$r_price, $r_address, $r_rating ];
$engine = new ContentBasedRecommend($user, $objects);

$response = "";
// print_r($engine->getRecommendation());
$a=array();
   foreach ($engine->getRecommendation() as $key => $value) {
        if($value>0.3){
            // print($key . " , ");
           
            array_push($a,$key); 
            //var_dump($a);
            
        }  
    }
    ?>
        <div class="product-carousel owl-carousel">
    <?php
    foreach($a as $item){

    //echo ('SELECT * FROM products WHERE name ="'. $item .'"<br>');

    $sql = 'SELECT * FROM products WHERE name ="'. $item .'"';
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        // echo($row['name']. '</br>');
        ?>
        <div class="item">
            <div class="card card-product">
                <div class="card-badge">
                    <?php 
                        $assetPath = 'assets/img/' . $row['image'];
                        $assetUrl = asset($assetPath);
                        // echo $assetUrl;
                    //    echo" http://127.0.0.1:8000/assets/img/Wireless Earbuds.jpg";
                        
                    ?>
                <img src="<?php echo $assetUrl ?>" alt="Card image 2" class="card-img-top">
            </div>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="detail-product.html"> <?php echo($row['name']) ?></a>
                </h4>
                <div class="card-price">
                    <!-- {{-- <span class="discount">Rp. 300.000</span> --}} -->
                    <span class="reguler">Rs.  <?php echo($row['price']) ?></span>
                </div>
                <a href="<?php  $routeName = 'single.product';
                $productId = $row['id'];
                $url = route($routeName, ['id' => $productId]);
                echo $url; ?>" class="btn btn-block btn-primary">
                    View Detail
                </a>

            </div>
        </div>
        
    </div>


<?php
}
    }

    mysqli_close($conn);

?>