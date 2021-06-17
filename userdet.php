<?php
    include 'conn.php';

    if(isset($_POST['submit'])){
        $from = $_GET['id'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        $sql = "SELECT * from cust_details where ser_no=$from";
        $query = mysqli_query($conn,$sql);
        $sql1 = mysqli_fetch_array($query); 

        $sql = "SELECT * from cust_details where ser_no=$to";
        $query = mysqli_query($conn,$sql);
        $sql2 = mysqli_fetch_array($query);

        // Check value entered by user is negative 
        if (($amount)<0)
        {
           
            echo '<script type="text/javascript">';
            echo ' alert("Sorry! Negative values cannot be transferred")';
            echo '</script>';
        }

        // To check insufficient balance.
        else if($amount > $sql1['balance']) 
        {
            echo '<script type="text/javascript">';
            echo ' alert("Bad Luck! Insufficient Balance")';  
            echo '</script>';
        }
    
        // To check zero values
        else if($amount == 0)
        {
            echo "<script type='text/javascript'>";
            echo "alert('Sorry! Zero value cannot be transferred')";
            echo "</script>";
        }


        else 
        {
            // amount deduction from sender's account
            $newbalance = $sql1['balance'] - $amount;
            $sql = "UPDATE cust_details set balance=$newbalance where ser_no=$from";
            mysqli_query($conn,$sql);
            
            // adding amount to reciever's account
            $newbalance = $sql2['balance'] + $amount;
            $sql = "UPDATE cust_details set balance=$newbalance where ser_no=$to";
            mysqli_query($conn,$sql);
                
            $sender = $sql1['name'];
            $receiver = $sql2['name'];
            $sql = "INSERT INTO `transac_hist` (`sender`, `receiver`, `amt_trans`) VALUES ('$sender', '$receiver', '$amount')";
            $query = mysqli_query($conn, $sql);
        
            if ($query) {
              echo "<script> alert('Transaction Successful');
                     window.location='transhist.php';
                     </script>";
            }
        

            $newbalance= 0;
            $amount =0;
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
	
        <title>Banana Bank</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width , initial-scale=1"> 

        <link rel="stylesheet" type="text/css" href="css/styles.css">

        <!--Bootstrap CSS-->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!--Google Fonts-->

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital@1&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

        <!--Table Style-->
        <style>
         table{
                text-align: center;
                border:3px solid black;
                border-collapse: collapse;
                width: 100%;
                height: 90px;
             }

            th{
                border-collapse: collapse;
                border: 2px solid black;
                font-family: 'Oxygen', serif;
                font-weight: 35px;
                font-size: 25px;
                height: 45px;
                width: 60px;
                color: black;
            }
    
             td{
                border-collapse: collapse;
                border: 2px solid white;
                width: 60px;
                height: 45px;
                font-size:20px;
                font-weight: 67px;
                font-family: 'Oxygen', serif;
                background-color: white;
                color: black;
                font-weight: bold;
            }
            .tabrow
            {
                background-color: #00ff80;
            }
            .tabdat{
                background-color: black;
                color: white;
                font-weight: bold;
            }
            h1
            {
                text-align: center;
            }
        </style>
        <!--Table Style End-->
    </head>
<body>

     <!--Header-->

     <header class="p-3 bg-warning text-white">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            <img src="images/logo.png" class="imagelink" width="200" height="70">
          </a>
    
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 nav-pills">
            <li><a href="index.html" class="nav-link active px-2 text-white" aria-current="page">Home</a></li>
            <li><a href="custdata.php" class="nav-link px-2 text-dark">Customers</a></li>
            <li><a href="custdata.php" class="nav-link px-2 text-dark">Transfer Money</a></li>
            <li><a href="transhist.php" class="nav-link px-2 text-dark">Transaction History</a></li>
            <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
          </ul>
    
          <div class="col-md-3 text-end">
            <a href="custdata.php">
            <button type="button" class="btn btn-outline-success me-2">Transfer</button>
          </a> 
          </div>
        </div>
        </header>

        <!--Header End-->
         
        <!--Marquee-->

        <div class="Marq">
          <marquee direction="left" scrolldelay=1>We are always updating our website so that users can get a better experience and that's very important for us and also customer privacy is the utmost priority for us!!!</marquee>
        </div><br>

        <!--Marquee End-->

        <!--Php Config-->
        <?php
        include 'conn.php';
            $sql = "SELECT * FROM cust_details";
            $result = mysqli_query($conn,$sql);
        ?>
           
        <!-- PHP CONFIG END -->


        <!-- TABLE -->    
           
        <div class="container">
            <br><h1>MAKE A TRANSFER</h1>
                <?php
                    include 'conn.php';
                    $sid=$_GET['id'];
                    $sql = "SELECT * FROM  cust_details where ser_no=$sid";
                    $result=mysqli_query($conn,$sql);
                    if(!$result)
                    {
                        echo "Error : ".$sql."<br>".mysqli_error($conn);
                    }
                    $rows=mysqli_fetch_assoc($result);
                ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
                <div>
                    <table class="table table-striped table-hover">
                        <tr style="color : white;" class="table-secondary">                            
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">E-Mail</th>                            
                            <th scope="col" class="text-center py-2">Balance</th>
                        </tr>
                        
                        <tr style="text-align : center" class="table-dark">                        
                            <td class="table-dark"><?php echo $rows['name']?></td>
                            <td class="table-dark"><?php echo $rows['email']?></td>                        
                            <td class="table-dark"><?php echo $rows['balance']?></td>
                        </tr>
                    </table>
                </div>
                <br><br><br>
                <label style="color : white;"><b>Transfer To:</b></label>
                <select name="to" class="form-control" required>
                    <option value="" disabled selected>Choose</option>

                    <?php
                        include 'conn.php';
                        $sid=$_GET['id'];
                        $sql = "SELECT * FROM cust_details where ser_no!=$sid";
                        $result=mysqli_query($conn,$sql);
                        if(!$result)
                        {
                            echo "Error ".$sql."<br>".mysqli_error($conn);
                        }
                        while($rows = mysqli_fetch_assoc($result)) {
                    ?>
            
                    <option class="table" value="<?php echo $rows['ser_no'];?>" >
                        <?php echo $rows['name'] ;?> - Balance: 
                        <?php echo $rows['balance'] ;?>  
                    </option>

                    <?php 
                        } 
                    ?>
                </select>
                <br>
                        
                <label style="color : white;"><b>Amount:</b></label>
                    <input type="text" class="form-control" name="amount" required>   
                    <br><br>
                <div class="text-center" >
                    <button class="btn btn-outline-warning" name="submit" type="submit" id="myBtn" >Transfer</button>
                </div>
            </form>
        </div>

        <!--Table End--> 

        <!--Branch-->
        <div class="branch">
                      <p>Our Branches</p>
                      <table>
                        <tbody>
                      <tr>
                      <ul>
                        <th class="tabrow"><li>India</li></th>
                        <td class="tabdat"><ol>
                          <li>Mumbai</li>
                          <li>Chennai</li>
                          <li>Delhi</li>
                          <li>Kolkata</li>
                      </ol></td>
                      </ul> 
                    <ul>
                      <th class="tabrow"><li>United Arab Emirates</li></th>
                        <td class="tabdat"><ol>
                          <li>Dubai</li>
                          <li>Abu Dhabi</li>
                          <li>Sharjah</li>
                        </ol></td>
                  </ul>
              </td>
                  </tbody>
                  </table>
                    </div>

                    <!--Branch End-->

            <!--Footer-->

            <footer class="text-muted py-5">
    <div class="footer">
        <div class="Contact">
            <div class="container">
                <p class="float-end mb-1">
                    Contact Us On: &nbsp;
                    <a class="imagelink" href="#" target="_blank">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png" width="50" height="50">
                    </a>
                    <a class="imagelink" href="https://www.linkedin.com/in/vimal-s-dev-854b07212" target="_blank">
                      <img src="linkedin1.webp" width="50" height="50">
                    </a>
                    <a class="imagelink" href="https://github.com/vimalsdev" target="_blank">
                      <img src="images/github.png" width="50" height="50">
                    </a>
                </p>
                <p class="mb-1">&copy; A VSD Production. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
        <!--Footer End-->

</body>
</html>
