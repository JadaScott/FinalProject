<?php include'header.php'?>

<?php include'../../includes/connect.php'?>

<?php

$query = "select * from orders order by id asc";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result))
{
	$resultArr[] = $row;
}
?>



<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    
     <a href="index.php" class="navbar-left"><img src="img/logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="store.php">STORE</a></li>
         <li><a href="cart.php">CART</a></li> <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              Sign In<span class="caret"></span>
            </a>

                    <div class="dropdown-menu" id="formLogin">
                        <div class="row">
                            <div class="container-fluid">
                                <form class="">
                                    <div class="form-group">
                                        <label class="">Username</label>
                                        <input class="form-control" name="username" id="username" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="">Password</label>
                                        <input class="form-control" name="password" id="password" type="password">
                                        <br class="">
                                    </div>
                                     <a href="index.php" type="submit" id="btnLogin" class="btn btn-success btn-sm">Logout</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>   
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="span5">
    <h3>ORDERS</h3>
            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>Username</th>
                      <th>Order Date</th>
                      <th>Price</th>
                      <th>Status</th>                                          
                  </tr>
              </thead>   
              <tbody>

<?php foreach ($resultArr as $output): ?>
                <tr>
		<td><?php echo $output['customerfirst']." ", $output['customerlast']?></td>
		<td><?php echo $output['orderdate']?></td>
		<td>$<?php echo $output['totalprice']?></td>
		<?php if($output['status'] == "shipped"): ?>
		<td><span class="label label-success"><?php echo $output['status']?></span></td>  
		<?php elseif($output['status'] == "cancelled"): ?>
		<td><span class="label label-danger"><?php echo $output['status']?></span></td>  
		<?php else: ?>
		<td><span class="label label-warning"><?php echo $output['status']?></span></td>  
		<?php endif; ?>
                </tr>                                   
<?php endforeach; ?>
              </tbody>
            </table>
            </div>
  </div>
</div>

<?php include'footer.php'?>

