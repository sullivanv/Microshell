<?php
// commandes.php for microshell in /home/vitiel_s/PiscinePHP/Microshell/include
// 
// Made by VITIELLO Sullivan
// Login   <vitiel_s@etna-alternance.net>
// 
// Started on  Fri Oct 23 13:15:10 2015 VITIELLO Sullivan
// Last update Sat Oct 24 12:09:41 2015 VITIELLO Sullivan
//

function my_decoup($line)
{
  $z = 0;
  $i = 0;
  $str[$i] = null;
  while (isset($line[$z]))
    {
      if (ord($line[$z]) == 32)
        {
	  while (ord($line[$z]) == 32)
	    $z++;
          $i++;
          $str[$i] = null;
        }
      $str[$i] = $str[$i] . $line[$z];
      $z++;
    }
  return ($str);
}

function ft_echo($str)
{
  global $_S;

  $z = 1;
  while (isset($str[$z]))
    {
      if (array_key_exists(trim($str[$z], "\$"), $_S) == TRUE)
	echo $_S[trim($str[$z], "\$")];
      else
	{
	  $str[$z] = str_replace("\"", "", $str[$z]);
	  $str[$z] = str_replace("\'", "", $str[$z]);
	  echo trim($str[$z], "\ \"\'");
	  echo " ";
	}
      $z++;
    }
  echo "\n";
}

function ft_exit($str)
{
  return(10);
}

function ft_pwd($str)
{
  //   $ptr = ".";
  // while (ftp_pwd($ptr != "home")
  //   {
  //     echo $_SERVER["PHP_SELF"];
  //     $ptr =  "../" . $ptr;
  //   }
  echo getcwd() . "\n";
}

function ft_cd($str)
{
  static $var = 0;

  $home = "/home/vitiel_s";
  if (isset($str[1]) == FALSE)
    {
      $var = getcwd();
      chdir($home);
    }
  else if ($str[1] == "-")
    {
      $temp = getcwd();
      chdir($var);
      $var = $temp;
    }
  else
    {
      if (file_exists($str[1]) == FALSE)
	echo "cd: " . $str[1] . " : No such file or directory\n";
      else if (is_dir($str[1]) == FALSE)
	echo "cd: " . $str[1] . " : Not a directory\n";
      else if (is_readable($str[1]) == FALSE)
	echo "cd: " . $str[1] . " : Permission denied\n";
      else
	{
	  $var = getcwd();
	  chdir($str[1]);
	}
    }
}