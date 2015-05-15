<?php
//GET
if(!empty($_GET['submit'])) {
    $host = $_GET['host'];
    $parameters = $_GET['parameters'];
// Get cURL resource
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => ''.$host.''.$parameters,
        CURLOPT_USERAGENT => 'cURL GET Request'
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Display cURL errors
    if ($resp === false) $resp = curl_error($curl);
// Close request to clear up some resources
    curl_close($curl);
}

//POST
if(!empty($_POST['submit'])) {
    $host = $_POST['host'];
    $parameters = $_POST['parameters'];
    $mstr = explode(",",$parameters);
    $a = array();
    foreach($mstr as $nstr)
    {
        $narr = explode("=>",$nstr);
        $narr[0] = str_replace(" ","",$narr[0]);
        $ytr[1] = $narr[1];
        $a[$narr[0]] = $ytr[1];
    }
    //print_r($a);

// Get cURL resource
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $host,
        CURLOPT_USERAGENT => 'cURL POST Request',
        CURLOPT_POST => count($parameters),
        CURLOPT_POSTFIELDS => http_build_query($a)
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    curl_close($curl);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>API Get and Post Requester</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<fieldset><legend>API Get and Post Requester</legend>
<h1>GET</h1>
<form method="get">
    <label>Host:</label> <input name="host" id="host" type="text" />
    <label>Parameters:</label> <input name="parameters" id="parameters" type="text" />
    <div class="example">Example: (?item1=value1&item2=value2&item3=value3)</div>
    <input name="submit" type="submit" value="Submit">
</form>

<h1>POST</h1>
<form method="post">
    <label>Host:</label> <input name="host" id="host" type="text" />
    <label>Parameters:</label> <input name="parameters" id="parameters" type="text" />
    <div class="example">Example: ('item1' => value, 'item2' => value2)</div>
    <input name="submit" type="submit" value="Submit">
</form>
</fieldset>
<div id="copyright">Built by <a href="http://georgewhitcher.com" target="_blank">George Whitcher</a></div>
<?php
if(!empty($_POST['submit']) OR !empty($_GET['submit'])) {
	// Print results
	print_r($resp);
}
?>
</body>
</html>
