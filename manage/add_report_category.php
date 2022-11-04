<?php
require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_report_category WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Report Category <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_report_category.php"><i class="fa  fa-navicon"></i> List</a></li>
    </ol>
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
          <form role="form" id="productForm"  method="post" action="act_report_category.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Language<?=MANDATORY?></label>
                <select class="form-control" name="language" id="language" style="width: 40%">
                    <option value="">Select Language</option>
                    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT language,code FROM tbl_language");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['code'] == $TypeArray['language']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['code'] ?>" <?=$selected?>><?php echo $prod_v['language']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Report Category Name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="report_category_name" name="report_category_name" value="<?=stripslashes($TypeArray['report_category_name'])?>" placeholder="Report Category Name" style="width:40%;">
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Report Category Name Slug</label>
                <input type="text" class="form-control " id="slug_report_category_name" name="slug_report_category_name" value="<?=stripslashes($TypeArray['slug_report_category_name'])?>" placeholder="Slug(Auto Generated)" style="width:40%;">
              </div>
              
              <div class="form-group">
                <label for="exampleInputEmail1">SEO Title</label>
                <input type="text" class="form-control " id="seo_title" name="seo_title" value="<?=stripslashes($TypeArray['seo_title'])?>" placeholder="SEO Title" style="width:40%;">
              </div>
			   <div class="form-group">
                <label for="exampleInputEmail1">SEO Description</label>
                <textarea class="form-control" placeholder="SEO Description" name="seo_description" id="seo_description" rows="3" style="width:40%;"><?=($TypeArray['seo_desc'])?></textarea>
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_report_category.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<script type="text/javascript" language="javascript">
var sysmsg = "<?=$sysmsg?>";
if(sysmsg==0){
	$(".errorDiv").hide();
}
else{
	$(".errorDiv").show().fadeOut(4000);
}
</script>
<script type="text/javascript" language="javascript">
function validateForm(){
    if($("select#language").val()==""){
		$(".errorDiv").show().fadeOut(8000);
		$('#errormessage').text("Language is Mandatory");
		$("select#language").focus();
		return false;
	}
	if($("input#report_category_name").val()==""){
		$(".errorDiv").show().fadeOut(8000);
		$('#errormessage').text("Category is Mandatory");
		$("input#report_category_name").focus();
		return false;
	}
	
	return true;
}

</script>

</body>
</html>