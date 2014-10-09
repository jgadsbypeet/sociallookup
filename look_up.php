<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Look up Tool Demo</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
	<div class="row-fluid">

<?php 
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
$email_address = $_POST['email_address'];
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://person-stream.clearbit.co/v1/people/email/'.$email_address,
	CURLOPT_USERPWD => '36a00d6c755a350c65ac8ed177942390'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
$json_output = json_decode($resp, true);     
$image_url = $json_output[avatar];
$facebook_url = $json_output[facebook][handle];
$twitter_url = $json_output[twitter][handle];
$linkedin_url = $json_output[linkedin][handle];
$googleplus_url = $json_output[googleplus][handle];

echo '<div class="col-lg-6">';
echo '<h1>This is what we know</h1>';
echo '<img src="'.$image_url.'" class="profile_img">';
echo '<h1>@';
print_r($json_output[twitter][handle]);
echo '</h1>';
echo '<h1>';
print_r($json_output[fullName]);
echo '<h2>';
print_r($json_output[location]);
echo '</h2>';
echo '<p>';
if ($json_output[bio] != NULL){
	print_r($json_output[bio]);
}
echo '</p>';
if ($json_output[facebook][handle] != NULL){
echo '<p><a href="http://www.facebook.com/';
echo $facebook_url;
echo '">';
echo 'http://www.facebook.com/';
echo $facebook_url;
echo '</a></p>';
}
if ($json_output[twitter][handle] != NULL){
echo '<p><a href="http://www.twitter.com/';
echo $twitter_url;
echo '">';
echo 'http://www.twitter.com/';
echo $twitter_url;
echo '</a></p>';
}
if ($json_output[linkedin][handle] != NULL){
echo '<p><a href="http://www.linkedin.com/';
echo $linkedin_url;
echo '">';
echo 'http://www.linkedin.com/';
echo $linkedin_url;
echo '</a></p>';
}
if ($json_output[googleplus][handle] != NULL){
echo '<p><a href="https://plus.google.com/';
echo $googleplus_url;
echo '">';
echo 'https://plus.google.com/';
echo $googleplus_url;
echo '</a></p>';
}
?>
</div>
</div>
</body>
</html>