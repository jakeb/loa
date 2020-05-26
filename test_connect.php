<?php
  try {
     $conn = new PDO( "sqlsrv:Server=(MCPFSSWDB002);Database=CashAllocations", NULL, NULL);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  }

  catch( PDOException $e ) {
     die( $e );
  }

  echo "Connected to SQL Server\n";

  $query = 'select top 2 * from Clarity.dbo.Patient';
  $stmt = $conn->query( $query );
  while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
     print_r( $row );
  }
?>
