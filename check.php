<?php
 if ( $_POST['act'] == "Display source" ) {
   if ( $_POST['password'] == "password" ) {
     header( "Content-type: text/plain" );
     if ( $_POST['interface'] == 1 ) {
       $file = fopen( "index.php", "r" ) or exit( "Unable to open file!!!!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     elseif ( $_POST['interface'] == 2 ) {
       $file = fopen( "crawler.php", "r" ) or exit( "Unable to open file!!!!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
       echo  ( "\n\n\n============================ crawler.php ============================= \n\n\n" );
       $file = fopen( "check.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
       $file = fopen( "list.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     elseif ( $_POST['interface'] == 3 ) {
       $file = fopen( "list.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     else
       echo  "No such interface: " . $_POST['interface'];

     echo  ( "\n\n\n============================== check.php ============================== \n\n\n" );
     $file = fopen( "check.php", "r" ) or exit( "Unable to open file!" );
     while ( !feof( $file ) )  echo  fgets( $file );
     fclose( $file );
   }
   else {
     header( "Content-type: text/html" );
     echo  "<html><body><h3>Wrong password: <em>";
     echo  $_POST['password'];
     echo  "</em></h3></body></html>";
   }
 }
 elseif ( $_POST['act'] == "Help" ) {
   header( "Content-type: text/html" );
   $file = fopen( "help.html", "r" ) or
     exit( "Unable to open file!" );
   while ( !feof( $file ) )
     echo  fgets( $file );
   fclose( $file );
 }
?>
