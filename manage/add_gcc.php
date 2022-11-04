<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_gcc WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> GCC<small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_gcc.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_gcc.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                <label for="exampleInputEmail1">GCC Name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="gcc_name" name="gcc_name" value="<?=stripslashes($TypeArray['gcc_name'])?>" placeholder="GCC Name" style="width:40%;">
              </div>
              
              <div class="form-group">
                  <label for="exampleInputEmail1">Book Pdf<?=MANDATORY?></label>
                  <input type="file" class="form-control " id="book_pdf" name="book_pdf" value="" placeholder="Report Pdf" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['book_pdf']){ ?>
                <a href="#"><img src="../uploads/files/icon.pdf"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/book_pdf/<?=stripslashes($TypeArray['book_pdf'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Date<?=MANDATORY?></label>
                <div class="input-group date" style="width:40%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="date" name="date" value="<?=stripslashes($TypeArray['date'])?>"  placeholder="Date">
                </div>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description" name="short_desc" id="short_desc" rows="3" style="width:40%;"><?=($TypeArray['short_desc'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control summernote" name="long_desc"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['long_desc'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="slug" name="slug" value="<?=stripslashes($TypeArray['slug'])?>" placeholder="Slug" style="width:40%;">
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">SEO Tile</label>-->
              <!--  <input type="text" class="form-control " id="seo_title" name="seo_title" value="<?=stripslashes($TypeArray['seo_title'])?>" placeholder="SEO Title" style="width:40%;">-->
              <!--</div>-->
              <!-- <div class="form-group">-->
              <!--  <label for="exampleInputEmail1">SEO Description</label>-->
              <!--  <textarea class="form-control" placeholder="SEO Description..." name="seo_desc" id="seo_desc" rows="3" style="width:40%;"><?=($TypeArray['seo_desc'])?></textarea>-->
              <!--</div>-->
              </div>
              
		
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_gcc.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
$('#date').datepicker({
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
</script>
<script type="text/javascript" language="javascript">
var sysmsg = "<?=$sysmsg?>";
if(sysmsg==0){
	$(".errorDiv").hide();
}
else{
	$(".errorDiv").show().fadeOut(4000);
}

function validateForm(){
	if($("select#language").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Language is Mandatory");
		$("input#language").focus();
		return false;
	}
	if($("input#gcc_name").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("GCC Name is Mandatory");
		$("input#gcc_name").focus();
		return false;
	}
// 	if($("input#file").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("News Image is Mandatory");
// 		$("input#file").focus();
// 		return false;
// 	}
	if($("input#date").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Date is Mandatory");
		$("input#date").focus();
		return false;
	}
	
	return true;
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