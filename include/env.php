<?php
// env.php for Microshell in /home/vitiel_s/PiscinePHP/Microshell/include
// 
// Made by VITIELLO Sullivan
// Login   <vitiel_s@etna-alternance.net>
// 
// Started on  Fri Oct 23 18:52:57 2015 VITIELLO Sullivan
// Last update Sat Oct 24 11:05:45 2015 VITIELLO Sullivan
//

global $_S;
$_S = $_SERVER;

function ft_env($str)
{
  global $_S;
  $_S['PWD'] = getcwd();
  unset($_S['OLDPWD']);
  unset($_S['argv']);
  unset($_S['argc']);
  $tmp = $_S;
  while (list($key, $value) = each($tmp))
    {
      echo $key . "=" . $value . "\n";
    }
}

function ft_setenv($str)
{
  global $_S;

  if (isset($str[2]) == TRUE)
    {
      if (isset($_S[$str[1]]) == FALSE)
	$_S[$str[1]] = $str[2];
      else
	$_S[$str[1]] = $str[2];
    }
  else
    echo "setenv : needs 2 arguments\n";
}

function ft_unsetenv($str)
{
  global $_S;
  
  if (isset($str[1]) == TRUE)
    {
      if (isset($_S[$str[1]]) == TRUE)
	unset($_S[$str[1]]);
    }
}