<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_career_jobs WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Career <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_career.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_career.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
			  <div class="form-group">
                <label for="exampleInputEmail1">Position<?=MANDATORY?></label>
                <input type="text" class="form-control " id="position" name="position" value="<?=stripslashes($TypeArray['position'])?>" placeholder="Job Position" style="width:40%;">
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Position Type</label>
                <input type="text" class="form-control " id="position_type" name="position_type" value="<?=stripslashes($TypeArray['position_type'])?>" placeholder="Position Type" style="width:40%;">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Work Type<?=MANDATORY?></label>
                <select class="form-control" name="work_type" id="work_type" style="width: 40%">
                    <option value="">Select Work Type</option>
                    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT * FROM tbl_career_work_type");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['type'] == $TypeArray['work_type']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['type']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
              </div>
             
			   <div class="form-group">
                <label for="exampleInputEmail1">Office Address<?=MANDATORY?></label>
                <textarea class="form-control" placeholder="Office Address" name="office_address" id="office_address" rows="3" style="width:40%;"><?=($TypeArray['office_address'])?></textarea>
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_career.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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

<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
<script src="<?=base_url?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
 
<!-- Bootstrap 3.3.2 JS -->
<script src="<?=base_url?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?=base_url?>dist/js/app.min.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
var sysmsg = "<?=$sysmsg?>";
if(sysmsg==0){
	$(".errorDiv").hide();
}
else{
	$(".errorDiv").show().fadeOut(4000);
}
function validateForm(){
	if($("input#position").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Position is Mandatory");
		$("input#position").focus();
		return false;
	}
	if($("input#position_type").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Position Type is Mandatory");
		$("input#position_type").focus();
		return false;
	}
	if($("select#work_type").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Work Type is Mandatory");
		$("select#work_type").focus();
		return false;
	}
	if($("textarea#office_address").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Office Address is Mandatory");
		$("textarea#office_address").focus();
		return false;
	}
	
	return true;
}

</script>