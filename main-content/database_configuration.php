<?php
    $conn = mysqli_connect( 'localhost', 'root', '', 'park_smart' );
    if ( $conn->connect_error ) {
        die( "Couldn't connect to database" );
    }
?>