
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Airheads Candy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="img/favicon.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/custom.css" type="text/css">
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
     <a href="/" class="navbar-left"><img src="img/logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">

        <li><a href="/">HOME</a></li>
        <li><a href="store">STORE</a></li>
         <li><a href="cart"><span class="glyphicon glyphicon-shopping-cart"></span>CART</a></li>
                                        <br class="">
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="span5">
   <div class="title m-b-md">
                    Hello, Customer!
                </div>


            </div>
  </div>
</div>


<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal"><a class="group inner list-group-item-heading">LOGIN</a></button>

                <!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->

     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">ADMIN LOGIN</h4>
         
      </div>
      <div class="modal-body">
       <div class="formLogin" id="formLogin">
                        <div class="row">
                            <div class="container-fluid">
                                <form method="post" action="admin" id="login">
                                    <div class="form-group">
                                        <label class="">Username</label>
                                        <input class="form-control" name="username" id="username" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="">Password</label>
                                        <input class="form-control" name="password" id="password" type="password">
                                        <br class="">
                                    </div>
                 
                                </form>
                            </div>
                        </div>
                    </div>
               
     <div class="modal-footer">
        <a href="admin"><button type="submit" class="btn btn-default" >LOGIN</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




</footer>


<script type="text/javascript" src="js/main.js"></script>

</body>
</html>