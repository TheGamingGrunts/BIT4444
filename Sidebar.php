<?php

	function containsWord($str, $word){
    	return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
  }

  function getLink($dir){
    $directory = basename(getcwd()); //get current directory name
    $path = "";
    switch ($directory) {
      case 'hours':
        $path = "../manager/".$dir;
        break;
      case 'settings':
        $path = "../manager/".$dir;
        break;
      default:
        $path = "manager/".$dir;
        break;
    }
    return $path;
  }

  if (containsWord($_SESSION["title"], "manager")){
    echo "
  	<li class='nav-item' data-toggle='tooltip' data-placement='right' title='Edit Hours'>
        <a class='nav-link' href='".getLink("hours")."'>
           <i class='fa fa-fw fa-binoculars'></i>
          <span class='nav-link-text'>Edit Hours</span>
        </a>
      </li>
      <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Analytics'>
        <a class='nav-link' href='".getLink("analytics")."'>
          <i class='fa fa-fw fa-bar-chart'></i>
          <span class='nav-link-text'>Analytics</span>
        </a>
      </li>";
  }
?>