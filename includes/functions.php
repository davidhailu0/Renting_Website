<?php include "db.php"; ?>
<?php ob_start(); ?>
<?php session_start() ;?>
<?php 
    if(isset($_REQUEST['location'])){
        getLocation();
    }
    elseif(isset($_REQUEST['delete'])){
        deleteRenter();
    }
    elseif(isset($_REQUEST['imageId'])){
        getImages();
    }
    elseif(isset($_REQUEST['renterId'])){
        getRenterContact();
    }
     elseif(isset($_REQUEST['emailCheck'])){
        getInfoEmailCheck();
    }
    elseif(isset($_REQUEST['phoneCheck'])){
        getInfoPhoneCheck();
    }
    elseif(isset($_REQUEST['email'])){
        getInfoEmail();
    }
    elseif(isset($_REQUEST['phone'])){
        getInfoPhone();
    }
function addRenter(){
            if(isset($_POST['register'])){
                global $connection;
                $_SESSION['showMess'] = 'register';
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $password = password_hash($password,PASSWORD_BCRYPT);
            $city = mysqli_real_escape_string($connection,$_POST['city']);
            $area = mysqli_real_escape_string($connection,$_POST['area']);
            $price = mysqli_real_escape_string($connection,$_POST['rent_range']);
            $beds = (int)mysqli_real_escape_string($connection,$_POST['beds']);
            $phone = (int)mysqli_real_escape_string($connection,$_POST['phone']);
            $image_name = "";
            for($i = 0;$i<sizeof($_FILES['picture']['name']);$i++){
                $image_name .= $_FILES['picture']['name'][$i].",";
                move_uploaded_file($_FILES['picture']['tmp_name'][$i],"../house_images/".$_FILES['picture']['name'][$i]);
            }
            $image_name = substr($image_name,0,strlen($image_name)-1);
            $waterAndElectricity = $_POST['utility'];
            $transport = $_POST['transportation'];
            mysqli_query($connection,"INSERT INTO registrations VALUES(NULL,'$name','$password','$email','$city',$price,'$image_name','$area',$beds,$phone,'$waterAndElectricity','$transport',NULL)");
            header("Location:index.php?registration_successfull");
            }
}
function updateRenter($prevPassword,$previmage){
            if(isset($_POST['update'])){
                global $connection;
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            if(isset($_POST['password'])){
                $password = mysqli_real_escape_string($connection,$_POST['password']);
                $password = password_hash($password,PASSWORD_BCRYPT);
            }
            else{
                $password = $prevPassword;
            }
            $city = mysqli_real_escape_string($connection,$_POST['city']);
            $area = mysqli_real_escape_string($connection,$_POST['area']);
            $price = mysqli_real_escape_string($connection,$_POST['rent_range']);
            $beds = (int)mysqli_real_escape_string($connection,$_POST['beds']);
            $phone = (int)mysqli_real_escape_string($connection,$_POST['phone']);
            $image_name = "";
            if($_FILES['images']['name']){
                    for($i = 0;$i<sizeof($_FILES['images']['name']);$i++){
                    $image_name .= $_FILES['images']['name'][$i].",";
                    move_uploaded_file($_FILES['images']['tmp_name'][$i],"../house_images/".$_FILES['images']['name'][$i]);
                }
            }
            else{
                    $image_name = $previmage;
            }
            $image_name = substr($image_name,0,strlen($image_name)-1);
            $waterAndElectricity = $_POST['utility'];
            $transport = $_POST['transportation'];
            mysqli_query($connection,"UPDATE registrations SET renter_name='$name',renter_email='$email',renter_password='$password',renter_city='$city',renter_area='$area',renter_price=$price,renter_beds=$beds,renter_phone=$phone,renter_infrustructure='$waterAndElectricity',renter_transportation='$transport' WHERE renter_email='{$_GET['email']}'");
            header("Location:login.php?name={$_SESSION['name']}&email={$_SESSION['email']}&success");
        }
}
function deleteRenter(){
    global $connection;
    $id = (int)$_REQUEST['delete'];
    mysqli_query($connection,"DELETE FROM registrations WHERE renter_id=$id");
    $_SESSION['showMess'] = 'delete';
    header("Location:../index.php");
}
function getInfoEmail(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_email='{$_REQUEST['email']}'");
    if(mysqli_num_rows($result)>0){
        echo "true";
    }
    unset($_REQUEST['email']);
}
function getInfoEmailCheck(){
    global $connection;
    $id = (int)$_REQUEST['id'];
    $result = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_email='{$_REQUEST['emailCheck']}' AND NOT renter_id=$id");
    if(mysqli_num_rows($result)>0){
        echo "true";
    }
    unset($_REQUEST['email']);
}
function getInfoPhone(){
    global $connection;
    $request = (int)$_REQUEST['phone'];
    $result = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_phone=$request");
    if(mysqli_num_rows($result)>0){
        echo "true";
    }
     unset($_REQUEST['phone']);
}
function getInfoPhoneCheck(){
    global $connection;
    $request = (int)$_REQUEST['phoneCheck'];
    $id = (int)$_REQUEST['id'];
    $result = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_phone=$request AND NOT renter_id=$id");
    if(mysqli_num_rows($result)>0){
        echo "true";
    }
}
function getLocation(){
    global $connection;
    $suggestion = "";
    $keyword = $_REQUEST['location'];
    $keyword = strtolower($keyword);
    $location_array = mysqli_query($connection,"SELECT renter_city,renter_area FROM registrations WHERE renter_city LIKE '$keyword%' OR renter_area LIKE '$keyword%' LIMIT 50");
    if(!$location){
        echo mysqli_error($connection);
    }
    while($location = mysqli_fetch_assoc($location_array)){
            $suggestion.= $location['renter_area'].",".$location['renter_city'];
            $suggestion.= ";";
    }
    echo $suggestion;
    unset($_REQUEST['location']);
}
function addSuggestion(){
    if(isset($_POST['contact_us'])){
        $_SESSION['showMess'] = 'suggestion';
        global $connection;
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $content = $_POST['Content'];
        mysqli_query($connection,"INSERT INTO suggestions VALUES (NULL,'$name','$email','$content')");
        header("Location:index.php");
    }
}
function verifyUser(){
    if(isset($_POST['login_btn'])){
        global $connection;
        $_SESSION['showMess'] = NULL;
        $flag = true;
        $password = mysqli_query($connection,"SELECT renter_id,renter_name,renter_password,renter_email FROM registrations WHERE renter_email='{$_POST['email']}'");
        while($row = mysqli_fetch_assoc($password)){
            if(password_verify($_POST['password'],$row['renter_password'])){
                $_POST['login_btn'] = NULL;
                 $_SESSION['login'] = true;
                $_SESSION['name'] = $row['renter_name'];
                $_SESSION['email'] = $row['renter_email'];
                $flag = false;
                header("Location:login.php?id={$row['renter_id']}&name={$row['renter_name']}&email={$row['renter_email']}");
            }
        }
        if($flag){
            header("Location:index.php?InvalidUser");
        }
    }
}
function getRenterInfo(){
    global $connection;
    $result = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_email='{$_GET['email']}'");
    return mysqli_fetch_assoc($result);
}
function displayResult(){
    global $connection;
    if(isset($_GET['search-location'])){
        $location = mysqli_real_escape_string($connection,$_GET['search-location']);
    }
    elseif(isset($_GET['q'])){
        $location = mysqli_real_escape_string($connection,$_GET['q']);
    }
    elseif(isset($_GET['location'])){
        $location = mysqli_real_escape_string($connection,$_GET['location']);
    }
    if(isset($_GET['rent_range'])){
        $rent_range = [];
        if(strpos($_GET['rent_range'],"-")!=false){
            array_push($rent_range,(int)substr($_GET['rent_range'],0,strpos($_GET['rent_range'],'-')));
            array_push($rent_range,(int)substr($_GET['rent_range'],strpos($_GET['rent_range'],'-')+1));
            $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_city LIKE '$location%' AND renter_price BETWEEN $rent_range[0] AND $rent_range[1]");
            if(mysqli_num_rows($renters_array)==0){
                $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_area LIKE '$location%' AND renter_price BETWEEN $rent_range[0] AND $rent_range[1]");
            }
        }
        else{
            array_push($rent_range,(int)substr($_GET['rent_range'],strpos($_GET['rent_range'],' ')+1));
            $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_city LIKE '$location%' AND renter_price >=$rent_range[0]");
            if(mysqli_num_rows($renters_array)==0){
                $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_area LIKE '$location%' AND renter_price >=$rent_range[0]");
            }
        }

    }
    else{
        $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_city LIKE '$location%' OR renter_area LIKE '$location%'");
    }
    if(!isset($_GET['p'])){
        $min = 1;
    }else{
        $min = ((int)$_GET['p'])*5-4;
    }
    $max = $min+4;
    $count = 1;
    while($row = mysqli_fetch_assoc($renters_array)){
        if($count>=$min&&$count<=$max){
            ?>
            <div class='card'>
            <img class="house-pic" src="house_images/<?php $image=explode(",",$row['renter_house_picture']); echo $image[0]; ?>" alt="image" onclick="showImages(this)" id='<?php echo $row['renter_id'] ?>'>
            <div>
                <ul class="result-list">
                    <li><strong>House Address:</strong> <?php echo $row['renter_area'].', '.$row['renter_city'];?></li>
                    <li><strong>Number of Beds:</strong> <?php echo $row['renter_beds']; ?></li>
                    <li><strong>Electricity and Water Service Fullfilled:</strong> <img src="images/<?php if($row['renter_infrustructure']=="Yes"){echo "check.png";}else{echo "cancel.png";}?>" alt="status image" style="vertical-align:bottom;margin-left:10px;"> <?php echo $row['renter_infrustructure'];?></li>
                    <li><strong>Easy to get Transportation Service:</strong><img src="images/<?php if($row['renter_transportation']=="Yes"){echo "check.png";}else{echo "cancel.png";}?>" alt="status image" style="vertical-align:bottom;margin-left:10px;"> <?php echo $row['renter_transportation']; ?></li>
                    <li><strong>Montly Rent:</strong> <?php echo $row['renter_price']; ?> Birr</li>
                </ul>
            </div>
            <button class="contact-owner" id='<?php echo $row['renter_id'] ?>' onclick="displayContact(this)">Contact Owner</button>
        </div>
        <?php }
        $count++;
    }
}
function displayPagination(){
    global $connection;
    if(isset($_GET['q'])){
        $keyword = $_GET['q'];
    }
    elseif(isset($_GET['search_btn'])){
        $keyword = $_GET['search-location']; 
    }
    elseif(isset($_GET['location'])){
        $keyword = $_GET['location'];
    }
    if(isset($_GET['q'])||isset($_GET['search_btn'])||isset($_GET['location'])){
        $renters_array = mysqli_query($connection,"SELECT * FROM registrations WHERE renter_city LIKE '$keyword%' OR renter_area LIKE '$keyword%'");
        $number_of_result = mysqli_num_rows($renters_array);
        $number_of_pages = ceil($number_of_result/5);
        if($number_of_pages>1){
            if(isset($_GET['p'])){
                if($_GET['p']==1){
                    $i = 2;
                    echo "<div style='width:100%;text-align:end;'><a href='result.php?p=$i&location=$keyword' class='pagination_link'>Next Page &gt;&gt;</a></div>";
                }
                elseif($_GET['p']>1 && $_GET['p']<$number_of_pages){
                    $i = (int)$_GET['p'];
                    $i--;
                    echo "<div style='width:50%;text-align:start;'><a href='result.php?p=$i&location=$keyword' class='pagination_link'>&lt;&lt; Prev Page</a></div>";
                    $i +=2;
                    echo "<div style='width:50%;text-align:end;'><a href='result.php?p=$i&location=$keyword' class='pagination_link'>Next Page &gt;&gt;</a></div>";
                }
                else{
                    $i = (int)$_GET['p'];
                    $i--;
                    echo "<div style='width:100%;text-align:start;'><a href='result.php?p=$i&location=$keyword' class='pagination_link'>&lt;&lt; Prev Page</a></div>";
                }
            }
            else{
                $i = 2;
                echo "<div style='width:100%;text-align:end;'><a href='result.php?p=$i&location=$keyword' class='pagination_link'>Next Page &gt;&gt;</a></div>";
            }
        }
  }
}
function resetLink(){
    if(isset($_POST['reset_email'])){
        global $connection;
        $simpleGenerated = [];
        for($i = 0;$i<7;$i++){
            array_push($simpleGenerated,strval(rand(1,1000)));
        }
        array_push($simpleGenerated,$_POST['reset_email']);
        $link = password_hash(join("",$simpleGenerated),PASSWORD_BCRYPT);
        mysqli_query($connection,"UPDATE registrations SET renter_resetlink='$link' WHERE renter_email='{$_POST['reset_email']}'");
        mail($_POST['reset_email'],"The Reset Link to your Profile","The reset link to your password is http://www.gojo.com/resetPassword?your_email={$_POST['reset_email']}&link=".$link);
    }
}
function verifyLink(){
    global $connection;
    $password_link_arr = mysqli_query($connection,"SELECT renter_id,renter_name,renter_email,renter_resetlink FROM registrations WHERE renter_email='{$_GET['your_email']}'");
    $password_link = mysqli_fetch_assoc($password_link_arr);
    if($_GET['link']==$password_link['renter_resetlink']){
        header("Location:login.php?id={$password_link['renter_id']}&name={$password_link['renter_name']}&email={$password_link['renter_email']}");
    }
    else{
        header('Location:index.php');
    }
}
function getImages(){
    global $connection;
    $id = (int)$_REQUEST['imageId'];
    $images_array = mysqli_query($connection,"SELECT renter_house_picture FROM registrations WHERE renter_id=$id");
    $images = mysqli_fetch_assoc($images_array);
    echo $images['renter_house_picture'];
}
function getRenterContact(){
    global $connection;
    $id = (int)$_REQUEST['renterId'];
    $renter_contact_array = mysqli_query($connection,"SELECT renter_name,renter_email,renter_phone FROM registrations WHERE renter_id=$id");
    $renter_contact = mysqli_fetch_assoc($renter_contact_array);
    $info = '';
    $info.= $renter_contact['renter_name'].','.$renter_contact['renter_email'].','.'+251'.strval($renter_contact['renter_phone']);
    echo $info;
}
?>