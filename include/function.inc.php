<?php
function convertDate($OldDate,$typeD)
  {
    
	switch($typeD)
    {
      case 0 : $format = '#^[0-3][0-9]/[0-1][0-9]/[0-9]{4}$#';
	           if (preg_match( $format , $OldDate )) //on vérifie que la date à bien un format de type jj/mm/aaaa
	           {
				   $TabDate=explode('/',$OldDate);      //On convertit PHP->Mysql
                   $DateBase=$TabDate[2].'-'.$TabDate[1].'-'.$TabDate[0];
			   }
			   else
	           {
	              $DateBase= date("Y-m-d");//date de ce jour;
	           }
               break;
      case 1 : $TabDate=explode('-',$OldDate);      //On convertit Mysql->PHP
               $DateBase=$TabDate[2].'/'.$TabDate[1].'/'.$TabDate[0];
               break;
      default : $DateBase=$OldDate;
    }
    return $DateBase;
  }
?>