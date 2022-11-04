<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_webinar WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Webinar<small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_webinar.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_webinar.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                <label for="exampleInputEmail1">Webinar Name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="webinar_name" name="webinar_name" value="<?=stripslashes($TypeArray['webinar_name'])?>" placeholder="Webinar Name" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Webinar Video Url<?=MANDATORY?></label>
                <input type="text" class="form-control " id="webinar_video_url" name="webinar_video_url" value="<?=stripslashes($TypeArray['webinar_video_url'])?>" placeholder="Weninar youtube video link" style="width:40%;">
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Date<?=MANDATORY?></label>
                <div class="input-group date" style="width:40%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="webinar_date" name="webinar_date" value="<?=stripslashes($TypeArray['webinar_date'])?>"  placeholder="Date">
                </div>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description" name="webinar_sort_content" id="webinar_sort_content" rows="3" style="width:40%;"><?=($TypeArray['webinar_sort_content'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control summernote" name="webinar_long_content"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['webinar_long_content'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="webinar_slug" name="webinar_slug" value="<?=stripslashes($TypeArray['webinar_slug'])?>" placeholder="Slug" style="width:40%;">
              </div>
              
              </div>
              
		
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_webinar.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$('#webinar_date').datepicker({
  format: "yyyy-mm-dd",
	//startDate: '-d',
	todayHighlight: true,
	 pickTime:true,
	autoclose: true
});
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_report.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
           $(this).closest("#productForm").append('<input type="hidden" name="param" value="rimg" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="prodid" value="<?php echo $id ?>" /><input type="hidden" name="pgNo" value="<?=$_REQUEST['pgNo']?>" />');
           $(this).closest("#productForm").submit();
        }
        else{
            return false;
        }
    });
})
function validateForm(){
	if($("select#language").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Language is Mandatory");
		$("input#language").focus();
		return false;
	}
	if($("input#webinar_name").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Webinar Name is Mandatory");
		$("input#webinar_name").focus();
		return false;
	}
	if($("input#webinar_video_url").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Video URL is Mandatory");
		$("input#webinar_video_url").focus();
		return false;
	}
	if($("input#webinar_date").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Date is Mandatory");
		$("input#webinar_date").focus();
		return false;
	}
	
	return true;
}

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
 <script type="text/javascript">
    $(document).ready(function () {
		$('.summernote').summernote({
			height: 250,
			popover: {},
			toolbar: [
				['style', ['style']],
    			['fontsize', ['fontsize']],
    			['font', ['bold', 'italic', 'underline', 'clear']],
    			['fontname', ['fontname']],
    			['color', ['color']],
    			['para', ['ul', 'ol', 'paragraph']],
    			['height', ['height']],
    			['table', ['table']],
    			['insert', ['link', 'picture', 'video']],
    			['view', ['fullscreen', 'codeview']],
    			['help', ['help']],
			],
		});
     });
    </script>

</body>
</html>