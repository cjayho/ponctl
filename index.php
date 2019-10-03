<?php

if( !isset( $_REQUEST['page'] ) )
{
	include 'main.php';
}
else
{
	switch( $_REQUEST['page'] )
	{
		case 'onu':
		case 'onu2':
			include 'main2.php';
		break;

		default:
			include 'main.php';
		break;
	}
}
?>
