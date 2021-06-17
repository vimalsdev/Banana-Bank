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
                color: orange;
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
            }
            .tabrow
            {
                background-color: blue;
            }
            .tabdat{
                background-color: black;
                color: white;
                font-weight: bold;
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
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                        <h1>CUSTOMER DETAILS</h1>
                            <table class="table table-hover">
                                <thead style="color : white;" class="tabrow">
                                    <tr>
                                        <th scope="col" class="text-center py-2">SerNo</th>
                                        <th scope="col" class="text-center py-2">Name</th>
                                        <th scope="col" class="text-center py-2">E-mail</th>
                                        <th scope="col" class="text-center py-2">Phone Number</th>
                                        <th scope="col" class="text-center py-2">Balance</th>
                                        <th scope="col" class="text-center py-2">Operation</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        while($rows=mysqli_fetch_assoc($result)){
                                    ?>

                                    <tr class="tabdat">
                                        <td class="tabdat"><?php echo $rows['ser_no'] ?></td>
                                        <td class="tabdat"><?php echo $rows['name']?></td>
                                        <td class="tabdat"><?php echo $rows['email']?></td>
                                        <td class="tabdat"><?php echo $rows['ph_no']?></td>
                                        <td class="tabdat"><?php echo $rows['balance']?></td>
                                        <td class="tabdat"><a href="userdet.php?id= <?php echo $rows['ser_no'] ;?>"> <button class="btn btn-outline-danger"><b>Transfer</b></button></a></td> 
                                    </tr>

                                    <?php
                                        }
                                    ?>            
                                </tbody>
                            </table>
                    </div>
                </div>
            </div> 
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
