<?php include'header.php'?>
<?php include'../../includes/connect.php'?>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php include'navigation.php'?>
<div class="container">
  <div class="page-header">
    <h1>Checkout </h1>
  </div>
<!-- Start Customer Info form -->
<form method="post" action="thanks.php" type="submit" name="submit" role="form" class="" id="customerinfo">
        <div class="list-group-item">
          <div class="list-group-item-heading">          
              <div class="row">
               
                <div class="col-xs-9">                      
                    <div class="form-group">
                      <label for="inputname">First Name</label>
                      <input type="text"  name="customerfirst" class="form-control form-control-large" id="inputname" placeholder="First">
                      </div>
                      <div class="form-group">
                      <label for="inputname">Last Name</label>
                      <input type="text" name="customerlast" class="form-control form-control-large" id="inputname" placeholder="Last">
                    </div>
                       <div class="form-group">
                      <label for="inputname">Email</label>
                      <input type="text" name="email" class="form-control form-control-large" id="inputemail" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress1">Street address 1</label>
                      <input type="text" name="streetone" class="form-control form-control-large" id="inputAddress1" placeholder="Enter address">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Street address 2</label>
                      <input type="text" name="streettwo" class="form-control form-control-large" id="inputAddress2" placeholder="Enter address">
                    </div>
                    <div class="row">
                      <div class="col-xs-3">
                        <div class="form-group">
                          <label for="inputZip">ZIP Code</label>
                          <input type="text" name="zip" class="form-control form-control-small" id="inputZip" placeholder="Enter zip">
                        </div>
                      </div>
                      <div class="col-xs-9">
                        <div class="form-group">
                          <label for="inputCity">City</label>
                          <input type="text" name="city" class="form-control" id="inputCity" placeholder="Enter city">
                        </div>
                      </div>
<div class="col-xs-3">
                        <div class="form-group">
                          <label for="inputCity">State</label>
                          <input type="text" name="state" class="form-control" id="inputCity" placeholder="Enter state">
                        </div>
                    </div>
                  </form>
                  
                </div>
              </div>
          </div>
        </div>
      
</form>
<!-- End Customer Info Form -->
<!-- Gift Message -->
  <h3 class="label1">Payment</h3>
      <div class="list-group">
        <div class="list-group-item">
          <div class="list-group-item-heading">          
              <div class="row radio">
                <div class="col-xs-2">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                    A New Credit Card
                  </label>
                </div>
                <div class="col-xs-5">
                  
                      <dl class="dl-small">
                        <dt>Credit Card Number</dt>
                        <dd><input type="textbox" name="cc" class="form-control form-control-small" id="CreditCardNumber" required="true"></dd>
                      </dl>
          </div>
                    <div class="col-xs-3">
                      <dl class="dl-small">
                        <dt>Expiration</dt>
                        <select name="month">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
              <option value="September">September</option>
              <option value="October">October</option>
              <option value="November">November</option>
              <option value="December">December</option>
              
              </select>
              <select name="Year">
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
                <option value="2030">2030</option>
                <option value="2031">2031</option>
                <option value="2032">2032</option>
                <option value="2033">2033</option>
                <option value="2034">2034</option>
                <option value="2035">2035</option>
              
              </select>
                      </dl>
                    </div>
                  </div>
                </div>
              </div>
          </div>
  <h3 class="label1">Total Price</h3>
    <div class="list-group">
        <div class="list-group-item">
          <div class="list-group-item-heading"> 
    <?php $totalPrice = $_SESSION['totalprice']; ?>
    <span>$<?php echo money_format('%i', $totalPrice += ($totalPrice * .047)); ?></span>
    <?php $_SESSION['totalprice'] = $totalPrice; ?>
       </div>
  </div>
  </div>
      <div class="well">
      <div class="row">
        <div class="col-md-6">
          <button class="btn btn-primary btn-lg btn-block" id="edit"> <a href="cart.php">Edit Cart</a></button>
        </div>
        <div class-"col-md-6">
        <button onclick="redirect()" type="submit" form="customerinfo"  class="btn btn-primary btn-lg btn-block" id="placeorder">Place Order</button>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

  <script src="jquery-2.1.0.min.js"></script>
  <script src="app.js"></script>

<?php include'footer.php'?>