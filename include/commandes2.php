<?php
// commandes2.php for microshell in /home/vitiel_s/PiscinePHP/Microshell/include
// 
// Made by VITIELLO Sullivan
// Login   <vitiel_s@etna-alternance.net>
// 
// Started on  Fri Oct 23 15:46:15 2015 VITIELLO Sullivan
// Last update Sat Oct 24 11:51:42 2015 VITIELLO Sullivan
//

function ft_ls($str)
{
  if (isset($str[1]) == FALSE)
    {
      $x = scandir(".");
      $c = ".";
    }
  else if (file_exists($str[1]) == FALSE)
    echo "ls: " . $str[1] . " : No such file or directory\n";
  else if (is_dir($str[1]) == FALSE)
    echo "ls: " . $str[1] . " : Not a directory\n";
  else if (is_readable($str[1]) == FALSE)
    echo "ls: " . $str[1] . " : Permission denied\n";
  else
    {
      $c = $str[1];
      $x = scandir($str[1]);
    }
  if (isset($x))
    my_ls2($x, $c);
}

function my_ls2($x, $c)
{
  $i = 0;
  while (isset($x[$i]))
    {
      if ($x[$i][0] == ".")
	$i++;
      else
	{
	  echo $x[$i];
	  $x[$i] = ($c . "/" . $x[$i]);
	  if (is_dir($x[$i]))
	    echo "/";
	  if ((is_executable($x[$i])) && (is_dir($x[$i]) == FALSE))
	    echo "*";
	  if (is_link($x[$i]))
	    echo "@";
	  echo "\n";
	  $i++;
	}
    }
}

function ft_cat($str)
{
  $i = 1;
  if (isset($str[1]) == FALSE)
    echo "cat: Invalid arguments\n";
  else if (file_exists($str[1]) == FALSE)
    echo "cat: " . $str[1] . " : No such file or directory\n";
  else if (is_file($str[1]) == FALSE)
    echo "cat: " . $str[1] . " : Is a directory\n";
  else if (is_readable($str[1]) == FALSE)
    echo "cat: " . $str[1] . " : Permission denied\n";
  else
    while (isset($str[$i]))
      {
	if (fopen($str[$i], "r"))
	  {
	    $x = fopen($str[$i], "r");
	    $ptr = fread($x, filesize($str[$i]));
	    echo $ptr;
	    fclose($x);
	  }
	else
	  echo "cat: " . $str[$i] . ": Cannot open file\n";
	$i++;
      }
}

function ft_cp($str)
{
  if (file_exists($str[1]) == FALSE)
    echo "cp: " . $str[1] . ": No such file or directory\n";
  else if (is_dir($str[1]))
    echo "cp: " . $str[1] . ": Is a directory\n";
  else if (is_dir($str[2]) == FALSE)
    echo "cp: " . $str[2] . ": Not a directory\n";
  else if (is_readable($str[1]) == FALSE)
    echo "cp: " . $str[1] . ": Permission denied\n";
  else
    {
      $cf = $str[2] . "/" .$str[1];
      if (fopen($cf, "w+"))
	{
	  $xxx = fopen($cf, "w+");
	  $str = fopen($str[1], "r");
	  $ptr = fread($str, 99999999);
	  fwrite($xxx, $ptr);
	  fclose($xxx);
	}
      else
	echo "cp: " . $str[1] . ": Cannot open file\n";
    }
}

function ft_help($str)
{
echo  "Les commandes disponibles sont :\n";
echo  "-exit : Permet de quitter le microshell\n";
echo  "-echo : Fonction d'affichage\n";
echo  "-pwd : Permet de se situer dans l'arborescence du microshell\n";
echo  "-cd : Change de repertoire\n";
echo  "-ls : Liste le contenu du repertoire passe en argument\n";
echo  "-cat : Affiche le contenu des fichier passe en arguments\n";
echo  "-env : Affiche les variables d'environnements\n";
echo  "-setenv : Change ou ajoute une variable d'environnement\n";
echo  "-unsetenv : Efface une variable d'environnement\n";
echo  "-cp : Copie le fichier passe en parametre dans le repertoire voulu\n";
}