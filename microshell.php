<?php
// microshell.php for microshell in /home/vitiel_s/PiscinePHP/Microshell
// 
// Made by VITIELLO Sullivan
// Login   <vitiel_s@etna-alternance.net>
// 
// Started on  Fri Oct 23 11:24:21 2015 VITIELLO Sullivan
// Last update Sat Oct 24 13:55:01 2015 VITIELLO Sullivan
//

require_once('include/commandes.php');
require_once('include/commandes2.php');
require_once('include/env.php');

$fd = fopen('php://stdin', 'r');
if ($fd !== false)
  {
    echo "$> ";
    while (($line = rtrim(fgets($fd))) !== false)
      {
	$str = my_decoup($line);
	$ptr = 'ft_' . $str[0];
	if (isset($str[2]) == true && ($str[2] == ">" || $str[2] == ">>"))
	  {	  
	    if (isset($str[3]) == false)
	      echo "Usage : ./redirection.php 'string' '[> >>]' 'File'\n";
	    else if (is_dir($str[3]))
	      echo "redirection.php: " . $str[3] . ": Is a directory\n";
	    else if ((is_readable($str[3]) == FALSE) && (file_exists($str[3])))
	      echo "redirection.php: " . $str[3] . ": Permission denied\n";
	    else
	      {
		if (($str[2] == ">") && (fopen($str[3], "w")))
		  {
		    $atr = fopen($str[3], "w");
		    $ptr = fwrite($atr, $str[1] . "\n", 9999999);
		    fclose($atr);
		  }
		else if (($str[2] == ">>") && (fopen($str[3], "a")))
		  {
		    $atr = fopen($str[3], "a");
		    $ptr = fwrite($atr, $str[1] . "\n", 9999999);
		    fclose($atr);
		  }
		else
		  echo "redirection.php: " . $str[3] . ": Cannot open file\n";
	      }
	  }
	else
	  { 
	    if (function_exists($ptr))
	      {
		if ($ptr($str) == 10)
		  return ;
	      }
	    else
	      echo $str[0] . ": Command not found\n";
	  }
	echo "$> ";
      }
    fclose($fd);
  }