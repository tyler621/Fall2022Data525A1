<?php

$URL      = $argv[1];
$choice   = $argv[2];
$username = "tyler.franzen@undcsmysql";
$database = "tyler_franzen";
$password = "tyler8629";
$host     = "undcsmysql.mysql.database.azure.com";
$conn     = new mysqli( $host,  $username, $password, $database );

if ( $conn->connect_error )
  die( 'Could not connect: ' . $conn->connect_error );

    ############ HERE IS THE TITLE ################
    system("rm page.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("touch page.txt /home/tyler.franzen/public_html/cgi-bin/1A5251");
    system("chmod 777 page.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    $cmd = "lynx -dump -source -nolist \"" . $URL . "\" > page.txt";
    system($cmd);

    $title = "title";
    $x = "\"<";
    $y = ">\"";
    $z = "$x$title$y";
    system("rm title.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("touch title.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("chmod 777 title.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    $cmd = "grep -i $z page.txt > title.txt";
    system($cmd);


    ######## HERE IS THE KEYWORD START #############
    $desc = "meta name=\\\"keywords\\\" content=\\\"\"";
    $x = "\"<";
    $z = "$x$desc";
    system("rm keyword.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("touch keyword.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("chmod 777 keyword.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    $cmd = "grep -i $z page.txt > keyword.txt";
    system($cmd);


    ######## HERE IS THE DESCRIPTION START #############
    $desc = "meta name=\\\"Description\\\" content=\"";
    $x = "\"<";
    $z = "$x$desc";
    system("rm description.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("touch description.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    system("chmod 777 description.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
    $cmd = "grep -i $z page.txt > description.txt";
    system($cmd);



echo "URL CRAWLED: \n";
echo $URL;
echo "\n\n";

# Dump the source code to the file result.txt.
system("rm result.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
system("touch result.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
system("chmod 777 result.txt /home/tyler.franzen/public_html/cgi-bin/1A525");
$cmd = "lynx -dump -listonly '" . $URL . "' | grep '" . $URL . "' > result.txt";
#system( "chmod 777 result.txt " );
system( $cmd );
system( "chmod 755 result.txt " );

echo "\n\n";
echo $cmd;
echo "\n\n";

# Find the url/title/desc/keyword.
$file    = file_get_contents( "result.txt" );
$title   = file_get_contents( "title.txt" );
$desc    = file_get_contents( "description.txt" );
$keyword = file_get_contents( "keyword.txt" );


#$sql = "INSERT INTO url (urlID, url2, title, keywords, description) VALUES (" . $urlID . ", " . $file . ", " . $title . ", " . $keyword . ", " . $desc . ")";
#$sql = "INSERT INTO url (urlID, url2) VALUES ((urlID),'$file')";


$open = fopen('result.txt','r');
 
while (!feof($open)) 
{
	$getTextLine = fgets($open);
	$explodeLine = explode(",",$getTextLine);
	
	list($urls) = $explodeLine;

	$sql = "insert into url (urlID,url2,title,keywords,description) values ('urlID','$urls','$title','$keyword','$desc')";
	$conn->query($sql);
}
 
fclose($open);

#$sql = "INSERT INTO url (urlID, url2) VALUES ((urlID),'$file')";
#$result = $conn->query( $sql );

$conn->close( );

#file_put_contents("result.txt", "");

?>
