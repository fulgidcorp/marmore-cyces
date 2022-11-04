<?php
// ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_report_data WHERE id = :id", $params);
//show selected country && subcategory in dropdown
if(isset($_GET['id']))
{
  $getselected_country = $objTypes->fetchAll("SELECT country_id FROM tbl_report_country_mapping WHERE report_id ='".$_GET['id']."'");
  $selected_CountryIds = array_column($getselected_country, 'country_id');
  
  $getselected_subcategory = $objTypes->fetchAll("SELECT report_subcategory_id FROM tbl_report_subcategory_mapping WHERE report_id ='".$_GET['id']."'");
  $selected_SubCategoryIds = array_column($getselected_subcategory, 'report_subcategory_id');
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Report<small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_report.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_report.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                <label for="exampleInputEmail1">Report Name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="report_name" name="report_name" value="<?=stripslashes($TypeArray['report_name'])?>" placeholder="Report Name" style="width:40%;">
              </div>
              <div class="form-group">
               <label for="exampleInputEmail1">Short Description</label>
               <textarea class="form-control" placeholder="Short Description" name="report_short_description" id="report_short_description" rows="3" style="width:40%;"><?=($TypeArray['report_short_description'])?></textarea>
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Description</label>-->
              <!--  <textarea class="form-control summernote" name="report_description"  rows="10" cols="80" placeholder="Description..." ><?//=($TypeArray['report_description'])?></textarea>-->
              <!--</div>-->
              <div class="form-group">
                <label for="exampleInputEmail1">Report Page Count</label>
                <input type="text" class="form-control " id="report_pages_count" name="report_pages_count" value="<?=$TypeArray['report_pages_count']?>" placeholder="Report Name" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Date<?=MANDATORY?></label>
                <div class="input-group date" style="width:40%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="report_date" name="report_date" value="<?=stripslashes($TypeArray['report_date'])?>"  placeholder="Release date">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Category1</label>
                <input type="text" class="form-control " id="report_category1" name="report_category1" value="<?=stripslashes($TypeArray['report_category1'])?>" placeholder="Report Category1" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Category2</label>
                <input type="text" class="form-control " id="report_category2" name="report_category2" value="<?=stripslashes($TypeArray['report_category2'])?>" placeholder="Report Category2" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Category3</label>
                <input type="text" class="form-control " id="report_category3" name="report_category3" value="<?=stripslashes($TypeArray['report_category3'])?>" placeholder="Report Category3" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Country</label>
                <input type="text" class="form-control " id="report_country" name="report_country" value="<?=stripslashes($TypeArray['report_country'])?>" placeholder="Report Country" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Industry</label>
                <input type="text" class="form-control " id="report_industry" name="report_industry" value="<?=stripslashes($TypeArray['report_industry'])?>" placeholder="Report Industry" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Report Tags</label>
                <input type="text" class="form-control " id="report_tags" name="report_tags" value="<?=stripslashes($TypeArray['report_tags'])?>" placeholder="Report Tags" style="width:40%;">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Report Image</label>
                  <input type="file" class="form-control " id="report_image" name="report_image" value="" placeholder="Report Image" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['report_images']){ 
                        $blog_image = pathinfo($TypeArray['report_images']);
                     if(isset($TypeArray['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                      {
                          $img = '../uploads/report_images/'.$TypeArray['report_images'];
                      }
                      else if(isset($TypeArray['report_images']) && isset($blog_image['dirname']))
                      {
                          $img = $TypeArray['report_images'];
                      }
                      else
                      {
                          $img = base_url.'uploads/blog_images/Group 160532.png';
                      }
                  
                  ?>
                <a href="#"><img src="<?=$img?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("<?=$img?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Executive Summary</label>
                <textarea class="form-control summernote" name="report_executive_summary"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_executive_summary'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">FAQ</label>
                <textarea class="form-control summernote" name="report_faq"  rows="10" cols="80" placeholder="FAQ" ><?=($TypeArray['report_faq'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Key Questionaed Answered</label>
                <textarea class="form-control summernote" name="report_key_questions_addressed"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_key_questions_addressed'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Added Value to</label>
                <textarea class="form-control summernote" name="report_add_value_to"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_add_value_to'])?></textarea>
              </div>
              <!-- <div class="form-group">
                <label for="exampleInputEmail1">Customize Report</label>
                <textarea class="form-control summernote" name="customize_report"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['customize_report'])?></textarea>
              </div> -->
              <div class="form-group">
                <label for="exampleInputEmail1">Table of Content</label>
                <textarea class="form-control summernote" name="report_table_of_contents"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_table_of_contents'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Customize Report</label>
                <textarea class="form-control summernote" name="report_chart_reports"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_chart_reports'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Related Report</label>
                <textarea class="form-control summernote" name="report_related_reports"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_related_reports'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Added Value to</label>
                <textarea class="form-control summernote" name="report_add_value_to"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['report_add_value_to'])?></textarea>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Report Executive Summary Pdf</label>
                  <input type="file" class="form-control " id="report_pdf_executive_summary" name="report_pdf_executive_summary" value="" placeholder="Report Executive Summary Pdf" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['report_pdf_executive_summary']){ ?>
                   <!--<iframe src="../uploads/report_pdf/<?//=stripslashes($TypeArray['report_pdf'])?>" height="80" width="100" title="<?=$TypeArray['report_pdf']?>"></iframe> -->
                <a href="#"><img src="../uploads/report_images/<?=stripslashes($TypeArray['report_pdf_executive_summary'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/report_pdf/<?=stripslashes($TypeArray['report_pdf_executive_summary'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Report Free Pdf</label>
                  <input type="file" class="form-control " id="report_pdf_free_report" name="report_pdf_free_report" value="" placeholder="Report Free Pdf" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['report_pdf_free_report']){ ?>
                   <!--<iframe src="../uploads/report_pdf/<?//=stripslashes($TypeArray['report_pdf'])?>" height="80" width="100" title="<?=$TypeArray['report_pdf']?>"></iframe> -->
                <a href="#"><img src="../uploads/report_images/<?=stripslashes($TypeArray['report_pdf_free_report'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/report_pdf/<?=stripslashes($TypeArray['report_pdf_free_report'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Pdf Download Url</label>
                <input type="text" class="form-control " id="report_pdf_download_url" name="report_pdf_download_url" value="<?=stripslashes($TypeArray['report_pdf_download_url'])?>" placeholder="Pdf Download Url" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="wp_slug" name="wp_slug" value="<?=stripslashes($TypeArray['wp_slug'])?>" placeholder="Report Slug" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">SEO Tile</label>
                <input type="text" class="form-control " id="report_seo_title" name="report_seo_title" value="<?=stripslashes($TypeArray['report_seo_title'])?>" placeholder="SEO Title" style="width:40%;">
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">SEO Description</label>
                <textarea class="form-control" placeholder="SEO Description" name="report_seo_description" id="report_seo_description" rows="3" style="width:40%;"><?=($TypeArray['report_seo_description'])?></textarea>
              </div>
              </div>
              
		
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_report.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
//Date picker
$('#report_date').datepicker({
  format: "yyyy-mm-dd",
	//startDate: '-d',
	todayHighlight: true,
	 pickTime:true,
	autoclose: true
});
    $(document).ready(function(){
	var edit_id =	'<?php echo $id; ?>';
	//console.log(edit_id);
// 	if(edit_id > 0){
// 		$('#product_type_div').show();
// 		//console.log('kjjjkjk'); 
// 	}else{
	$("#report_category_id").change(function(){
		var id=$(this).val();
		if(id){
			$.ajax({
				type: 'POST',
				url: '<?=base_url?>ajax_get_sub_category.php',
				data:  'id='+id,		
				success:function(response){
					if(response){
						$("#product_type_div").html(response);
						$("#product_type_div").show();	
						$("#product_type_err").hide();
					}else{
						$("#product_type_div").hide();	
						$("#product_type_err").show();
					}						
				}
			});
		}else{
			$("#product_type_err").hide();
			$("#product_type_div").hide();	
		}		
		
	});	
	//}
	
    });
</script>
<script>
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
	if($("input#report_date").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Release Date is Mandatory");
		$("input#report_date").focus();
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