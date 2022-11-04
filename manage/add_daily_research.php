<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_daily_research WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Daily Research<small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_daily_research.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_daily_research.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                  <label for="exampleInputEmail1">Type of Upload<?=MANDATORY?></label> 
                <select class="form-control" name="daily_research_id" id="daily_research_id" style="width: 40%">
                    <option value="">Select Type</option>
                    <?php
                    // $params     = array(":is_active" => '1', ":is_delete" => '1');
                    $ProdArray	= $objTypes->fetchAll("SELECT type, id FROM tbl_daily_research_type");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['type_of_upload']){
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
                  <label for="exampleInputEmail1">Daily Reaserch Pdf<?=MANDATORY?></label>
                  <input type="file" class="form-control " id="daily_research_pdf" name="daily_research_pdf" value="" placeholder="Daily Research Pdf" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['pdf']){ ?>
                <a href="#"><img src="../uploads/files/icon.png"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/daily_research_pdf/<?=stripslashes($TypeArray['pdf'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } else { ?><p class="alert alert-danger alert-dismissible" style="width:16%">No Pdf Uploaded.</p> <?php } ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Date of Upload<?=MANDATORY?></label>
                <div class="input-group date" style="width:40%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="date_of_upload" name="date_of_upload" value="<?=stripslashes($TypeArray['date_of_upload'])?>"  placeholder="Date of Upload">
                </div>
              </div>
              
              </div>
              
		
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_daily_research.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<!--<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>-->
<!-- bootstrap datepicker -->
<script src="<?=base_url?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
//Date picker
$('#date_of_upload').datepicker({
  format: "yyyy-mm-dd",
	//startDate: '-d',
	todayHighlight: true,
	 pickTime:true,
	autoclose: true
});
</script>
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_daily_research.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
           $(this).closest("#productForm").append('<input type="hidden" name="param" value="rimg" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="prodid" value="<?php echo $id ?>" /><input type="hidden" name="pgNo" value="<?=$_REQUEST['pgNo']?>" />');
           $(this).closest("#productForm").submit();
        }
        else{
            return false;
        }
    });
})
</script>
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
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Language is Mandatory");
		$("select#language").focus();
		return false;
	}
	if($("select#report_category_id").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Category is Mandatory");
		$("select#report_category_id").focus();
		return false;
	}
	if($("input#report_country_id").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Country is Mandatory");
		$("input#report_country_id").focus();
		return false;
	}
	if($("input#report_name").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Report Name is Mandatory");
		$("input#report_name").focus();
		return false;
	}
// 	if($("input#report_image").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Report Image is Mandatory");
// 		$("input#report_image").focus();
// 		return false;
// 	}
// 	if($("input#report_pdf").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Report pdf is Mandatory");
// 		$("input#report_pdf").focus();
// 		return false;
// 	}
	if($("input#release_pub_date").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Release Date is Mandatory");
		$("input#release_pub_date").focus();
		return false;
	}
	
	return true;
}

function Checkfile(){
	var fup = document.getElementById('image');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#image").focus();
		$("input#image").val("");
		return false;
	}
}
</script>
 
</body>
</html>