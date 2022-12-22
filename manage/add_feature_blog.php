<?php
require_once("admininclude/admin_leftmenu.php");

?>
<html lang="en">  
<head>  
  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> 
  <!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
  <style>
 
  </style>
</head>  
<body>  
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>POPULAR INSIGHTS<small></small> </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!--Table Start-->
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <p>
        	<div class="callout callout-danger errorDiv" <?php $objSystemMsg->createStyle($sysmsg);?> >
        		<span id="errormessage"><?php echo $objSystemMsg->displayError($sysmsg); ?></span>
        	</div>
          </p>
  <form action="act_feature_blog.php" method="post">
    <div class="container">  
  <p>Blog 1</p>
  <select id="blog1"  name="blog1" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;" >  

  <?php
  $query="SELECT * from tbl_blogs join tbl_feature_blogs on tbl_blogs.id=tbl_feature_blogs.blog1 ORDER BY tbl_feature_blogs.id DESC limit 1";

  $select_query=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($select_query))
  {
  ?>
 <option value="<?=$row['blog1'];?>" ><?=$row['blog_title'];?></option>
   <?php }?>
    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT blog_title,id FROM tbl_blogs");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['blog_title']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['blog_title']; ?></option>
                            <?php
                        }
                    }
                    ?> 
    </select> 
     <br>
    <div class="form-group">
            <p>Blog 2</p>
            <select id="blog2" name="blog2"  onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">  

            <?php
              $query="SELECT * from tbl_blogs join tbl_feature_blogs on tbl_blogs.id=tbl_feature_blogs.blog2 ORDER BY tbl_feature_blogs.id DESC limit 1";
              $select_query=mysqli_query($con,$query);
              while($row=mysqli_fetch_assoc($select_query))
              {
            ?>
    <option value="<?=$row['blog2'];?>" ><?=$row['blog_title'];?></option>
   <?php }?>
    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT blog_title,id FROM tbl_blogs ");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['blog_title']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['blog_title']; ?></option>
                            <?php
                        }
                    }
                    ?> 
    </select><br>
    </div>

    <div class="form-group">
    <p>Blog 3</p>
    <select id="blog3" name="blog3" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">  

    <?php
      $query="SELECT * from tbl_blogs join tbl_feature_blogs on tbl_blogs.id=tbl_feature_blogs.blog3 ORDER BY tbl_feature_blogs.id DESC limit 1";
      $select_query=mysqli_query($con,$query);
      while($row=mysqli_fetch_assoc($select_query))
      {
    ?>
    <option value="<?=$row['blog3'];?>" ><?=$row['blog_title'];?></option>
   <?php }?>
    <?php
                     $ProdArray  = $objTypes->fetchAll("SELECT blog_title,id FROM tbl_blogs");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['blog_title']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['blog_title']; ?></option>
                            <?php
                        }
                    }
                    ?> 
    </select><br>

    </div>

<div class="form-group">
    <!-- <input type="submit" name="submit" id="submit"> -->
<button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
</div>
</form>
</div>
        <!-- /.box -->
      </div>
    </div>
    <!--Table End-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once("admininclude/admin_footer.php"); ?>
<div class='control-sidebar-bg'></div>
</div>
<?php require_once("admininclude/admin_common_js.php"); ?>

 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
<script >  
$(document).ready(function(){
 
 // Initialize select2
// $("#report_1").select2();
$("#blog1").select2({
    //maximumSelectionLength: 3
});
$("#blog2").select2();

$("#blog3").select2();

});
</script>
  
  
</body>  
</html> 
