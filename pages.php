<?php


if($path[1]=='blog'){
    include("blog.php");
}else if($path[1]=='report'){
    include("report.php");

}else{
    render_app();
 } ?>