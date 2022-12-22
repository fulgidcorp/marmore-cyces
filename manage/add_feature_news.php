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
    <h1>Feature News<small></small> </h1>
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
  <form action="act_feature_news.php" method="post">
    <div class="container">  
  <p>News 1</p>
  <select id="news1"  name="news1"onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;" >  

  <?php
  $query="SELECT * from tbl_news join tbl_feature_news on tbl_news.id=tbl_feature_news.news1 ORDER BY tbl_feature_news.id DESC limit 1";
  $select_query=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($select_query))
  {
  ?>
 <option value="<?=$row['news1'];?>" ><?=$row['news_name'];?></option>
   <?php }?>
    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT news_name,id FROM tbl_news");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['news_name']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['news_name']; ?></option>
                            <?php
                        }
                    }
                    ?> 
    </select> 
     <br>
    <div class="form-group">
            <p>News 2</p>
            <select id="news2" name="news2" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;" >  

            <?php
              $query="SELECT * from tbl_news join tbl_feature_news on tbl_news.id=tbl_feature_news.news2 ORDER BY tbl_feature_news.id DESC limit 1";
              $select_query=mysqli_query($con,$query);
              while($row=mysqli_fetch_assoc($select_query))
              {
            ?>
    <option value="<?=$row['news2'];?>" ><?=$row['news_name'];?></option>
   <?php }?>
    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT news_name,id FROM tbl_news ");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['news_name']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['news_name']; ?></option>
                            <?php
                        }
                    }
                    ?> 
    </select><br>
    </div>

    <div class="form-group">
    <p>News 3</p>
    <select id="news3" name="news3" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">  

    <?php
      $query="SELECT * from tbl_news join tbl_feature_news on tbl_news.id=tbl_feature_news.news3 ORDER BY tbl_feature_news.id DESC limit 1";
      $select_query=mysqli_query($con,$query);
      while($row=mysqli_fetch_assoc($select_query))
      {
    ?>
    <option value="<?=$row['news3'];?>" ><?=$row['news_name'];?></option>
   <?php }?>
    <?php
                     $ProdArray  = $objTypes->fetchAll("SELECT news_name,id FROM tbl_news");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['news_name']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['news_name']; ?></option>
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
<!-- jQuery <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
<script >  
$(document).ready(function(){
 
 // Initialize select2
// $("#report_1").select2();
$("#news1").select2({
    maximumSelectionLength: 3
});
$("#news2").select2();

$("#news3").select2();

});
</script>
  
  
</body>  
</html> 
