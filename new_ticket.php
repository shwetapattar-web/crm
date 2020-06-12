<?php
require_once "submitForm.php";
require_once "functions.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
    
    //Fetching the Token from SESSION RESULT

    //GET API TO FETCH ALL DEPARTMENTS
    $ch = curl_init();
    $oauthtoken_dept = "";  //Get the oauth token using the api "https://accounts.zoho.com/oauth/v2/token" passing the client id client secret etc.
    $authorization = 'Authorization: Zoho-oauthtoken '.trim($oauthtoken_dept);
    $orgid = 'orgId:2389290';
    $header = [
                    'Content-Type: application/json',
                    $authorization,
                    $orgid
    ];

    $data = array(
        'isEnabled' => true,
        'chatStatus' => 'AVAILABLE'

    );
    $postdata = json_encode($data);
    curl_setopt($ch, CURLOPT_URL,"https://desk.zoho.com/api/v1/departments");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);
    print_r($server_output);
    echo 'HIEEE';
    // Further processing ...
    if ($server_output == "OK") {
        echo "SUCESS";
     }else{
         echo "ERROR";
      }
    
     // die;


    //GET API'S TO FETCH ALL CATEGORIES

    $ch = curl_init();
    $oauthtoken = "";  //Get the oauth token using the api "https://accounts.zoho.com/oauth/v2/token" passing the client id client secret etc.
    $authorization = 'Authorization: Zoho-oauthtoken '.trim($oauthtoken);
    $orgid = 'orgId:2389290';
    $header = [
                    'Content-Type: application/json',
                    $authorization,
                    $orgid
    ];

    $data = array(
        'isEnabled' => true,
        'chatStatus' => 'AVAILABLE'

    );
    $postdata = json_encode($data);
    curl_setopt($ch, CURLOPT_URL,"https://desk.zoho.com/api/v1/kbCategory");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);
    print_r($server_output);
    echo 'HIEEE';
    // Further processing ...
    if ($server_output == "OK") {
        echo "SUCESS";
     }else{
         echo "ERROR";
      }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h4>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h4>
        <h4>Submit a Ticket</h4><a href="logout.php" class="btn btn-danger" style="float:right;margin-top:10px;">Sign Out of Your Account</a>
    </div>
      
        
    
    <!-- CREATE NEW TICKETS CODE -->
    <form action="submitForm.php" method="post">
       <div class="container">
       <div class="col-sm-12"> 
                <b><h4>Contact Information</h4></b><br/>
        </div>

        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Contact Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>">
            </div>
        
            <div class="col-sm-4 form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['username']; ?>">
            </div>
        </div>

        <div class="col-sm-12"> 
                <b><h4>Ticket Information</h4></b><br/>
        </div>

<!-- ALL DEPARTMENTS FETCHED FROM API NEED TO PASS TO DEPARTMENT DROPDOWN -->
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Department</label>
                <input type="text" name="department" class="form-control" value="<?php foreach ($results as $dept){ ?>
                    <option value='<?php echo $dept["id"];?>'><?php echo $city["name"];?>
                        </option> 
               <?php } ?>">
            </div>

<!-- ALL DEPARTMENTS FETCHED FROM API NEED TO PASS TO Category DROPDOWN -->      
            <div class="col-sm-4 form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control" value="<?php foreach ($results1 as $category){ ?>
                    <option value='<?php echo $category["id"];?>'><?php echo $category["name"];?>
                        </option> 
               <?php } ?>">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" value="">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="col-sm-8 form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" value="" rows="4" cols="50"></textarea>
            </div>
        </div> 


        <div class="col-sm-12"> 
                <b><h4>Additional Information</h4></b><br/>
        </div>

        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Priority</label>
                <input type="text" name="priority" class="form-control" value="">
            </div>
        </div>

        <div class="col-sm-12">
                <div class="col-sm-4 form-group">
                    <button type="submit" name="submit" class="btn btn-success"> Submit Ticket</button>
                </div>
        </div>

    </div>

    </form>

</body>
</html>