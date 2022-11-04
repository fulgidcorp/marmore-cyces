<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_home_companies WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Home Company <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_home_company.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_home_company.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
			  <div class="form-group">
                <label for="exampleInputEmail1">Company name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="company_name" name="company_name" value="<?=stripslashes($TypeArray['company_name'])?>" placeholder="Title" style="width:40%;">
              </div>
			  
              <div class="form-group">
                  <label for="exampleInputEmail1">Company Image<?=MANDATORY?></label>
                  <input type="file" class="form-control " id="company_img" name="company_img" value="" placeholder="Blog Author Name" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['company_img']){ ?>
                <a href="#"><img src="../uploads/company_images/<?=stripslashes($TypeArray['company_img'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/blog/<?=stripslashes($TypeArray['blog_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              
	          
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_home_company.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<?php require_once("../admininclude/admin_footer.php"); ?>
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
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
</body>
</html>
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_home_company.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
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
	if($("input#title").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Title is Mandatory");
		$("input#title").focus();
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
<script>
  $(function () {	  
	//config.enterMode = CKEDITOR.ENTER_BR;
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
	CKEDITOR.config.autoParagraph = false;

	
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
	//config.enterMode = CKEDITOR.ENTER_DIV;
  });
</script>