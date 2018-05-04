<?php include'header.php'?>

<?php include'../../includes/connect.php'?>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Redirect back to home page after 5 seconds -->
<meta http-equiv="refresh" content="5; url=index.php" />

<?php include'navigation.php'?>

<?php
if(isset($_POST)){ 

	//Prepare statement
	$stmt = $conn->prepare("insert into orders (customerfirst, customerlast, email, streetone, streettwo, zip, city, state, totalprice, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssissds", $customerfirst, $customerlast, $email, $streetone, $streettwo, $zip, $city, $state, $totalprice, $status);
	$customerfirst = $_POST['customerfirst'];
	$customerlast = $_POST['customerlast'];
	$email = $_POST['email'];
	$streetone = $_POST['streetone'];
	$streettwo = $_POST['streettwo'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$totalprice = $_SESSION['totalprice'];
	$status = "pending";	


	$stmt->execute();
	$stmt->close();
	$conn->close();
	
	unset($_SESSION['cart']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $customerfirst = strip_tags(trim($_POST["customerfirst"]));
        $customerfirst = str_replace(array("\r","\n"),array(" "," "),$customerfirst);
        $customerlast = strip_tags(trim($_POST["customerlast"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $totalprice = trim($_POST["totalprice"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "jadalscott@gmail.com, $email";

        // Set the email subject.
        $subject = "New order for $name";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank you for your order.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }



?>



<div class="container">
	<h2>Thanks for your order!</h2>
</div>

<?php include'footer.php'?>

