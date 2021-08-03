<?php

function getRustStatus($ip, $port, $Query){

  $status = [];

  try
	{
		$Query->Connect( $ip, intval($port), SQ_TIMEOUT, SQ_ENGINE );

		$status = $Query->GetInfo( );
	}
	catch( Exception $e )
	{
	}
	finally
	{
		$Query->Disconnect( );
	}


  return $status;
}

function getRustPlayerCnt($ip, $port, $Query){

  $status = [];

  try
	{
		$Query->Connect( $ip, intval($port), SQ_TIMEOUT, SQ_ENGINE );

		$status = $Query->GetInfo( );
	}
	catch( Exception $e )
	{
	}
	finally
	{
		$Query->Disconnect( );
	}


  return $status['Players'];
}

function getRustMaxPlayerCnt($ip, $port, $Query){

  try
	{
		$Query->Connect( $ip, intval($port), SQ_TIMEOUT, SQ_ENGINE );

		$status = $Query->GetInfo();
	}
	catch( Exception $e )
	{
	}
	finally
	{
		$Query->Disconnect( );
	}


  return $status['MaxPlayers'];
}



?>
