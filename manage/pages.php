<?php
// ini_set('display_errors',1);
require_once("admininclude/admin_leftmenu.php");
$title_page='Pages';
// echo '<pre>';
// print_r($_GET);
// exit;
//include("manager.php");
// if(isset($_SESSION['role']) && $_SESSION['role']>0){

//     echo '';
// }else{
    
//     require("login.php");
//     exit;
// }



$page_tbl='tbl_pages';

$errors_event=[];
$success_event=[];

function getpagestbl($parent,$level,$conn,$lang){
    $queryp="SELECT `title`,`id`,`post_id` from `tbl_pages` where language='$lang' and parent_id=".$parent." order by `orderby` asc";
    $resultp = mysqli_query($conn,$queryp);
    echo '<ul class="'.$level.'">';
    while($rowp = mysqli_fetch_array($resultp)){
        echo '<li><i class="far fa-folder-open ic-w mr-1"></i><span class="site"><a href="?view='.$rowp['id'].'" >'.$rowp['title'].'</a> <a href="?add='.$rowp['id'].'" ><i class="far fa-plus-square ic-w mr-1 plusicon"></i></a> <a href="?copy='.$rowp['id'].'" ><i class="far fa-copy ic-w mr-1"></i></a> <a href="?delete='.$rowp['id'].'" ><i class="far fa-trash-alt ic-w mr-1 delicon"></i></a></span></li>';
        getpagestbl($rowp['post_id'],"nested",$conn,$lang);
    }
    echo '</ul>';
}

function getpages($parent,$level,$edata,$con){
    $queryp="SELECT `title`,`id`,`post_id` from `tbl_pages` where language='en' and parent_id=".$parent." order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $leveltxt=str_repeat("--",$level);
    while($rowp = mysqli_fetch_array($resultp)){
        if($rowp['post_id']==$edata){
            $selected="selected";
        }else{
            $selected="";
        }
        echo '<option value="'.$rowp['id'].'" '.$selected.'>'.$leveltxt.$rowp['title'].'</option>';
        getpages($rowp['id'],$level+1,$edata,$con);
    }
}

function slugify($text)
{
    // Swap out Non "Letters" with a -
    $text = preg_replace('/[^\\pL\d]+/u', '-', $text); 

    // Trim out extra -'s
    $text = trim($text, '-');

    // Convert letters that we have left to the closest ASCII representation
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Make text lowercase
    $text = strtolower($text);

    // Strip out anything we haven't been able to convert
    $text = preg_replace('/[^-\w]+/', '', $text);

    return $text;
}



if(isset($_GET["delete"]))
{
    //if($_GET["delete"]!='' && $_SESSION['role']==3)
    if($_GET["delete"]!='')
    {
        $iddd=mysqli_real_escape_string($con, $_GET["delete"]);
        mysqli_query($con,"DELETE FROM `$page_tbl` WHERE `$page_tbl`.`id`=$iddd");
        $success_event['eventadded']='Page Deleted';
    }
}

if(isset($_POST["adddata"])){
    // echo '<pre>';
    // print_r($_POST);
    // exit;
    $POST=[];
    foreach($_POST as $name => $value){
        $POST[mysqli_real_escape_string($con, $name)]=mysqli_real_escape_string($con, $value);
    }
    $id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
    $ip			= $_SERVER['REMOTE_ADDR'];
    $agent		= addslashes($_SERVER['HTTP_USER_AGENT']);
	$params = array(
        'user_agent'             => $agent,
        'ip' => $ip,
    );
    $params= array_merge($POST,$params);
    unset($params['adddata']);
    unset($params['upload_banner_img']);
    if(!isset($params['is_published'])){
        $params['is_published']=0;
    }
    if($params['name']==''){
        $params['name']=slugify($params['title']);
    }else{
        $params['name']=slugify($params['name']);
    }
    if($params['parent_id']==''){
      $params['parent_id']=0;
    }
    
	if($id > 0){
		$update_params = array(
            'updated_at'		=> date("Y-m-d H:i:s"),
            'updated_by'          => $_SESSION['email']
        );
        $params = array_merge($params, $update_params);
        $first=1;
        $insert_query="UPDATE `$page_tbl` ";
        foreach($params as $name => $value){
            if($first){
            $insert_query.="SET `".$name."` = '".$value."'";
            $first=0;
            }
            else{
            $insert_query.=",`".$name."` = '".$value."'";
            }
        }
        $insert_query.=" WHERE `$page_tbl`.`id` ='".$id."'";

        // echo $insert_query;exit;



        if(mysqli_query($con, $insert_query)){
            $success_event['eventadded']='Record Updated Successfully';
        }else{
            $errors_event['errorevent']='Record not Updated.';
        }
        $post_id = $id;
}
	else{
        $update_params = array(
            'added_at'		=> date("Y-m-d H:i:s"),
            'added_by'          => $_SESSION['email']
        );
        $params = array_merge($params, $update_params);
        $insert_query="INSERT INTO `$page_tbl` (";
        $first=1;
        foreach($params as $name => $value){
            if($first){
            $insert_query.='`'.$name.'`';
            $first=0;
            }
            else{
              $insert_query.=', `'.$name.'`';
            }
          }
          $insert_query.=") VALUES (";
          $first=1;
          foreach($params as $name => $value){
            if($first){
            $insert_query.="'".$value."'";
            $first=0;
            }
            else{
              $insert_query.=", '".$value."'";
            }
          }
          $insert_query.=")";
          $insert_query= stripcslashes($insert_query);
          if(mysqli_query($con, $insert_query)){
            $success_event['eventadded']='Record added Successfully';
          }else{
            $errors_event['errorevent']='Record not added.';
          }
		if(mysqli_insert_id($con)){
			$post_id = mysqli_insert_id($con);
        }
        
    }
    if($post_id!=0 && $post_id!=''){
        //file Upload Script
        
        
        
      
      if(!isset($_POST['post_id'])){
        $query="UPDATE `$page_tbl` SET post_id='$post_id' WHERE `$page_tbl`.`id`=".$post_id;
        mysqli_query($con, $query);
        $newslug=slugify($params['name']);
        $newreleas=$POST['parent_id'];
        $query="UPDATE `$page_tbl` SET `name`='$newslug',`parent_id`='$newreleas' WHERE `post_id`=".$post_id;
        mysqli_query($con, $query);
      }else{
        $query4="SELECT `name`, `parent_id` FROM `$page_tbl` where language='en' and post_id=".mysqli_real_escape_string($con,$_POST['post_id']);
        $result4 = mysqli_query($con,$query4);
        $row4 = mysqli_fetch_array($result4);
        $slugg= $row4['name'];
        $releas= $row4['parent_id'];
        $query="UPDATE `$page_tbl` SET `name`='$slugg',`parent_id`='$releas' WHERE `$page_tbl`.`id`=".$post_id;
        mysqli_query($con, $query);
      }
      
    $target_dir = "../uploads/pages/";
      $supported_files= array("jpg","png","jpeg","gif","pdf","doc","docx","txt","csv","mp4","3gp","mov","wmv","avi","xlsx","xls","rtf","xla","ppt","pptx","aac","mp3");
      
      
      $data_check='';
      $filess=array();
    if(isset($_FILES["upload_banner_img"]['name'])){
        $prefix=("upload_banner_img"=="upload_banner_img")?'banner_':'';
        $target_file = $target_dir .$prefix.basename($_FILES["upload_banner_img"]["name"]);
        $target_file = str_replace(' ', '_', $target_file);
        $fFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(in_array($fFileType,$supported_files) ) {
            if(move_uploaded_file($_FILES["upload_banner_img"]["tmp_name"], $target_file)){
              if(!isset($filess[$target_file])){
              $filess[substr($target_file,2)]="upload_banner_img";
              }
            }
        }
    }
     foreach($filess as $name => $type){
      $query="UPDATE `$page_tbl` SET $type='$name' WHERE `$page_tbl`.`id`=".$post_id;
      mysqli_query($con, $query);
    }
    }
    $_GET['view']=$post_id;
}













//include("includes/header.php");






?>















<?php if(isset($_GET['add']) || isset($_GET['view']) || isset($_GET['copy'])) {
if(isset($_GET['view']) && $_GET['view']!=0 && $_GET['view']!=''){
    $query="SELECT * FROM $page_tbl WHERE id=".mysqli_real_escape_string($con, $_GET['view']);
    $result = mysqli_query($con,$query);
    $viewdata = mysqli_fetch_array($result);
    // echo '<pre>';
    // print_r($viewdata);exit;
}else if(isset($_GET['copy']) && $_GET['copy']!=0 && $_GET['copy']!=''){
    $query="SELECT * FROM $page_tbl WHERE id=".mysqli_real_escape_string($con, $_GET['copy']);
    $result = mysqli_query($con,$query);
    $viewdata = mysqli_fetch_array($result);
    $viewdata['id']='';
}else{
    $query="SHOW COLUMNS FROM marmore.`$page_tbl`";
    $result = mysqli_query($con,$query);
    while($temp = mysqli_fetch_array($result)){
        $viewdata[$temp['Field']]='';
    }
    $viewdata['parent_id']=($_GET['add'])?$_GET['add']:$viewdata['parent_id'];
}

?>

<style>
    .picup {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
.removeold {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.removeold:hover {
  background: white;
  color: black;
}

</style>












<div class="content-viewport">
<?php
foreach($errors_event as $message){
  echo '<div class="alert alert-danger" role="alert">
  <b>Error:</b> '.$message.'</div>';
}
foreach($success_event as $message){
  echo '<div class="alert alert-success" role="alert">
  <b>Success:</b> '.$message.'</div>';
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Pages<small></small> </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                           <div class="row">
              <div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Add New <?=$title_page ?></p>
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="" method="post" enctype="multipart/form-data">
                      <?php
                      $query2="SELECT * FROM tbl_fields WHERE page='pages'";
                      $result2 = mysqli_query($con,$query2);
                      while($row2 = mysqli_fetch_array($result2)){
                        if($row2['type']=="text"){
                            $required = ($row2['field']=='title')?'required':'';
                            $required = ($row2['field']=='name')?'id="page_name"':$required;
                            echo '
                            <div class="form-group">
                            <label>'.$row2['fieldname'].'</label>
                            <input name="'.$row2['field'].'" placeholder="'.$row2['placeholder'].'" value="'.$viewdata[$row2['field']].'" '.$required.' type="text" class="form-control" placeholder="Enter your password">
                          </div>';
                            }
                        else if($row2['type']=="richtext"){
                            ?>
                            <h3 class="mb-3">Contents</h3>
                            <div class="container">
		<!-- main content area -->

		<div id="main_saved_contents">
		</div>

		<!-- line just to diff -->
		<hr />

		<div id="elements_menu_holder" class="d-block">
		</div>

		<!-- modal to get input from user based on element -->
		<div id="element_input_modal" class="modal" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Enter Element Config</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="element_input_form">
							<!-- loaded dynamically by js -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="element_input_save">
							Save changes
						</button>
					</div>
				</div>
			</div>
		</div>

	</div>
                            <?php
                        }
                        else if($row2['type']=="date"){
                            $datee=($viewdata[$row2['field']]!='')?$viewdata[$row2['field']]:date("Y-m-d");
                            echo '
                            <div class="form-group">
                            <label>'.$row2['fieldname'].'</label>
                            <input name="'.$row2['field'].'" placeholder="'.$row2['placeholder'].'" value="'.$datee.'" type="date" class="form-control" >
                          </div>';
                            }
                        else if($row2['type']=="checkbox"){
                            $checkedd=($viewdata[$row2['field']]==0)?'':'checked';
                            echo '
                            <div class="form-group">
                            <label>'.$row2['fieldname'].'</label>
                            <input name="'.$row2['field'].'" placeholder="'.$row2['placeholder'].'" value="1" type="checkbox"  '.$checkedd.'>
                          </div>';
                        }
                        else if($row2['type']=="file" && $viewdata['parent_id']==38){
                            echo '
                            <div class="form-group">
                            <label>'.$row2['fieldname'].'</label>
                            ';
                            if($viewdata[$row2["field"]]!=''){echo '<p>Uploaded File:</p><ul><li><a href="'.$viewdata[$row2['field']].'" target="_blank">'.$viewdata[$row2['field']].'</a></li></ul>';}
                            echo '<p>Selected file:</p>
                              <div id="'.$row2["field"].'view"></div>
                            <input name="'.$row2['field'].'" type="file"  class="form-control" onchange="javascript:updateList(this,\''.$row2["field"].'view\')">
                          </div>';
                            }
                        else if($row2['type']=="drop"){
                            if($row2['field']=="language"){
                            echo '<div class="form-group" >
                            <label for="inputPassword1">'.$row2['fieldname'].'</label>
                            <select name="'.$row2['field'].'" id="lang_group" class="form-control" onchange="checklang(this)">';
                            $query3="SELECT * FROM tbl_language";
                            $result3 = mysqli_query($con,$query3);
                            while($row3 = mysqli_fetch_array($result3)){
                                if($row3['code']==$viewdata[$row2['field']]){
                                    $selected="selected";
                                }else{
                                    $selected="";
                                }
                                echo '<option value="'.$row3['code'].'" '.$selected.'>'.$row3['language'].'</option>';
                            }
                            echo '</select></div>';
                            }else if($row2['field']=="post_id"){
                            echo '<div class="form-group" id="select_group" style="display:none">
                            <label for="inputPassword1">'.$row2['fieldname'].'</label>
                            <select id="post_select" name="'.$row2['field'].'" class="form-control" disabled>';
                            $nameof=$row2['field'];
                            $query3="SELECT `title`,`id`,`post_id`,COUNT(*) from `$page_tbl` GROUP BY `post_id` HAVING COUNT(*)=1";
                            if($viewdata[$row2['field']]!=''){
                                $query3="SELECT `title`,`id`,`post_id`,COUNT(*) from `$page_tbl` GROUP BY `post_id` HAVING COUNT(*)=1 UNION SELECT `title`,`id`,`post_id`,COUNT(*) from `$page_tbl` WHERE `language`='en' and `post_id`=".$viewdata[$row2['field']];
                            }
                            $result3 = mysqli_query($con,$query3);
                            while($row3 = mysqli_fetch_array($result3)){
                                if($row3['post_id']==$viewdata[$row2['field']]){
                                    $selected="selected";
                                }else{
                                    $selected="";
                                }
                                echo '<option value="'.$row3['post_id'].'" '.$selected.'>'.$row3['title'].'</option>';
                            }
                            echo '</select></div>';
                            }else if($row2['field']=="parent_id"){
                            echo '<div class="form-group" id="select_group" style="display:none">
                            <label for="inputPassword1">'.$row2['fieldname'].'</label>
                            <select id="releasedrop" name="'.$row2['field'].'" class="form-control" disabled>
                            <option value="">No Parent</option>';
                            
                            getpages(0,0,$viewdata[$row2['field']],$con);
                            echo '</select></div>';
                            }
                        }
                      }
               ?>
             <div id="editor"></div>
            <input type="hidden" name="id" value="<?=($viewdata['id']!='')?$viewdata['id']:0?>" />
            <input type="submit" name="adddata" class="btn btn-primary float-right" value="Submit" />
                      </form>
                    </div>
                  </div>
                </div>
              </div>
</div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="../assets/css/app_main.css"> -->
<script>
		// this data is loaded from the BE on page render
		let saved_elements_data = [
    <?php 
    $idjs = ($viewdata['id']!='')?$viewdata['id']:0;
    $resjson = mysqli_query($con,"SELECT * FROM tbl_page_contents where page_id=".$idjs." order by indx ASC");
    while($dataa = mysqli_fetch_row($resjson)){
      $json=json_decode($dataa[4],true);
      $json['id']=$dataa[0];
      echo json_encode($json);
      echo ",";
    }
    ?>
    ]
    // console.log(saved_elements_data);
    // return false;
</script>

<?php } else {?>

<div class="content-viewport">
<style>
.site i {display:none;}
.site:hover i {display:inline-block;}
.site:hover {display:inline-block;}
.delicon {color:red;}
.plusicon {color:green;}
</style>
<?php
foreach($errors_event as $message){
  echo '<div class="alert alert-danger" role="alert">
  <b>Error:</b> '.$message.'</div>';
}
foreach($success_event as $message){
  echo '<div class="alert alert-success" role="alert">
  <b>Success:</b> '.$message.'</div>';
}
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<style>
.container2 {
  width: 100%;
  height: 100%px;
  margin: auto;
}

.one {
  width: 50%;
  float: left;
}

.two {
  margin-left: 50%;
}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Pages<small></small> </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                <div class="container2">
                    <div class="one">
                    <div class="treeview w-20 border">
                      <h6 class="pt-3 pl-3">Site-Map (English)</h6>
                      <hr>
                      <?php getpagestbl(0,"mb-4 pl-4 pb-4",$con,"en"); ?>
                    </div>
                    </div>
                    <div class="two">
                    <div class="treeview w-20 border">
                      <h6 class="pt-3 pl-3">Site-Map (Arabic)</h6>
                      <hr>
                      <?php getpagestbl(0,"mb-4 pl-4 pb-4",$con,"ar"); ?>
                    </div>
                    </div>
                </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>


<?php } ?>


























<script>
function checklang(elem){
    if(elem.value=="en"){
        document.getElementById('select_group').setAttribute("style","display:none");
        document.getElementById('post_select').setAttribute("disabled","disabled");
        document.getElementById('page_name').removeAttribute("disabled");
        document.getElementById('page_name').parentNode.style="";
        document.getElementById('releasedrop').removeAttribute("disabled");
        document.getElementById('releasedrop').parentNode.style="";
    }else{
        document.getElementById('select_group').removeAttribute("style");
        document.getElementById('post_select').removeAttribute("disabled");
        document.getElementById('page_name').setAttribute("disabled","disabled");
        document.getElementById('page_name').parentNode.style="display:none;";
        document.getElementById('releasedrop').setAttribute("disabled","disabled");
        document.getElementById('releasedrop').parentNode.style="display:none;";
    }
}

function delpress(idd){
    var k = confirm("Are you sure ?");
    if(k==true){
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+idd+"&delete=1");
        document.getElementById('row_'+idd).remove();
    }
}

updateList = function(elementin,disp) {
    var input = elementin;
    var output = document.getElementById(disp);
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<ul>'+children+'</ul>';
}
//  $(document).ready(function() {
//   if (window.File && window.FileList && window.FileReader) {
//     $("#files").on("change", function(e) {
//       var files = e.target.files,
//         filesLength = files.length;
//       for (var i = 0; i < filesLength; i++) {
//         var f = files[i]
//         var fileReader = new FileReader();
//         fileReader.onload = (function(e) {
//           var file = e.target;
//           $("<span class=\"pip\">" +
//             "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//             "<br/><span class=\"remove\">Remove image</span>" +
//             "</span>").insertAfter("#files");
//           $(".remove").click(function(){
//             var k = confirm("Are you sure ?");
//              if(k==true){
//             $(this).parent(".pip").remove();
//             }
//           });
          
//           // Old code here
//           /*$("<img></img>", {
//             class: "imageThumb",
//             src: e.target.result,
//             title: file.name + " | Click to remove"
//           }).insertAfter("#files").click(function(){$(this).remove();});*/
          
//         });
//         fileReader.readAsDataURL(f);
//       }
//     });
//   } else {
//     alert("Your browser doesn't support to File API")
//   }
// });
checklang(document.getElementById('lang_group'));
</script>
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
  <!--<link rel="stylesheet" href="../style.css">-->
<!-- jQuery 2.1.4 -->
<!--<script src="<?=base_url?>plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?=base_url?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/js/app_helpers.js"></script>
<script src="../assets/js/app_main.js"></script>
<script src="<?=base_url?>assets/forms/editors.js"></script>
<script src="<?=base_url?>assets/js/ckeditor/ckeditor.js"></script>
<?php require_once("admininclude/admin_footer.php"); ?>
