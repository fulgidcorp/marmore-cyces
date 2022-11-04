<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_blogs WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Blog <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_blogs.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_blog.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
			  			 <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <select class="form-control" name="category_name" id="category_name" style="width: 40%" required="required">
                    <option value="">Select Category</option>
                    <?php
                    $params     = array(":is_active" => '1', ":is_delete" => '1');
                    $ProdArray	= $objTypes->fetchAll("SELECT category_name, id FROM tbl_blogs_category WHERE is_active = :is_active AND is_delete = :is_delete", $params);
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['category_id']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['category_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
              </div>

			  <div class="form-group">
                <label for="exampleInputEmail1">Title<?=MANDATORY?></label>
                <input type="text" class="form-control " id="title" name="blog_title" value="<?=stripslashes($TypeArray['blog_title'])?>" placeholder="Title" style="width:40%;">
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="slug" name="slug" value="<?=stripslashes($TypeArray['slug'])?>" placeholder="Slug(Auto Generated)" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Author Name</label>
                <input type="text" class="form-control " id="blog_author_name" name="blog_author_name" value="<?=stripslashes($TypeArray['blog_author_name'])?>" placeholder="Author Name" style="width:40%;">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Author Image</label>
                  <input type="file" class="form-control " id="blog_author_img" name="blog_author_img" value="" placeholder="Blog Author Image" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['blog_author_img']){ ?>
                <a href="#"><img src="../uploads/blog_author_images/<?=stripslashes($TypeArray['blog_author_img'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/blog/<?=stripslashes($TypeArray['blog_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
            
			
              <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description..." name="short_description" id="short_description" rows="3" style="width:40%;"><?=($TypeArray['short_desc'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <!--<div id="summernote" name="description"><?//=($TypeArray['long_desc'])?></div>-->
                <textarea class="form-control summernote" name="description"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['long_desc'])?></textarea>
              </div>
	          <div class="form-group">
                <label for="exampleInputEmail1">Read Time</label>
                <input type="text" class="form-control " id="read_time" name="read_time" value="<?=stripslashes($TypeArray['read_time'])?>" placeholder="Blog Read Time(In mins)" style="width:40%;">
              </div>
             			  
			   <div class="form-group">
                  <label for="exampleInputEmail1">Blog Image<?=MANDATORY?></label>
                  <input type="file" class="form-control " id="image" name="image" value="" placeholder="Blog Image" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['blog_img']){ ?>
                <a href="#"><img src="../uploads/blog_images/<?=stripslashes($TypeArray['blog_img'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/blog_images/<?=stripslashes($TypeArray['blog_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">SEO Title</label>
                <input type="text" class="form-control " id="seo_title" name="seo_title" value="<?=stripslashes($TypeArray['seo_title'])?>" placeholder="SEO Title" style="width:40%;">
              </div>
			   <div class="form-group">
                <label for="exampleInputEmail1">SEO Description</label>
                <textarea class="form-control" placeholder="SEO Description" name="seo_description" id="seo_description" rows="3" style="width:40%;"><?=($TypeArray['seo_desc'])?></textarea>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Media Image</label>
                  <input type="file" class="form-control " id="media_image" name="media_image" value="" placeholder="Media Image" style="width:40%;">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['media_image']){ ?>
                <a href="#"><img src="../uploads/blog_images/<?=stripslashes($TypeArray['media_image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/blog_images/<?=stripslashes($TypeArray['media_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
                  </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_blogs.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_blog.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
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
// 	if($("input#image").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Blog Image is Mandatory");
// 		$("input#image").focus();
// 		return false;
// 	}
	
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
    