<?php
//ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_client_stories WHERE id = :id", $params);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Client Stories <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_client_story.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_client_story.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                <label for="exampleInputEmail1">Story Title<?=MANDATORY?></label>
                <input type="text" class="form-control " id="story_title" name="story_title" value="<?=stripslashes($TypeArray['story_title'])?>" placeholder="Story Title" style="width:40%;">
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Category Name<?//=MANDATORY?></label>-->
              <!--  <input type="text" class="form-control " id="client_category" name="client_category" value="<?=stripslashes($TypeArray['client_category'])?>" placeholder="Category Name" style="width:40%;">-->
              <!--</div>-->
            <div class="form-group">
                <label for="exampleInputEmail1">Client Industry<?=MANDATORY?></label>
                <select class="form-control" name="client_industry_id" id="client_industry_id" style="width: 40%">
                    <option value="">Select Client Industry</option>
                    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT id,title FROM tbl_industry");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $TypeArray['client_industry_id']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['title']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
              </div>

			  <div class="form-group">
                  <label for="exampleInputEmail1">Client Image</label>
                  <input type="file" class="form-control " id="image" name="image" value="" placeholder="Client Images" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['image']){ ?>
                <a href="#"><img src="../uploads/client_images/<?=stripslashes($TypeArray['image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/client_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Thumbnail Image</label>
                  <input type="file" class="form-control " id="thumnail_image" name="thumnail_image" value="" placeholder="Thumbnail Images" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['thumnail_image']){ ?>
                <a href="#"><img src="../uploads/client_images/<?=stripslashes($TypeArray['thumnail_image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/client_images/<?=stripslashes($TypeArray['thumnail_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Short Description</label>-->
              <!--  <textarea class="form-control" placeholder="Short Description" name="story_desc" id="story_desc" rows="3" style="width:40%;"><?//=($TypeArray['story_desc'])?></textarea>-->
              <!--</div>-->
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Title 1<?//=MANDATORY?></label>-->
              <!--  <input type="text" class="form-control " id="title_1" name="title_1" value="<?//=stripslashes($TypeArray['title_1'])?>" placeholder="Title(Scope of work)" style="width:40%;">-->
              <!--</div>-->
	          <div class="form-group">
                <label for="exampleInputEmail1">Description 1(Scope of work)</label>
                <textarea class="form-control summernote" name="long_desc"  rows="10" cols="80" placeholder="Description" ><?=($TypeArray['long_desc'])?></textarea>
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Title 2<?//=MANDATORY?></label>-->
              <!--  <input type="text" class="form-control " id="title_2" name="title_2" value="<?//=stripslashes($TypeArray['title_2'])?>" placeholder="Title(Solution)" style="width:40%;">-->
              <!--</div>-->
	          <div class="form-group">
                <label for="exampleInputEmail1">Description 2(Solution)</label>
                <textarea class="form-control summernote" name="long_desc_2"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['long_desc_2'])?></textarea>
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Title 3<?//=MANDATORY?></label>-->
              <!--  <input type="text" class="form-control " id="title_3" name="title_3" value="<?//=stripslashes($TypeArray['title_3'])?>" placeholder="Title(Impact)" style="width:40%;">-->
              <!--</div>-->
	          <div class="form-group">
                <label for="exampleInputEmail1">Description 3(Impact)</label>
                <textarea class="form-control summernote" name="long_desc_3"  rows="10" cols="80" placeholder="Description..." ><?=($TypeArray['long_desc_3'])?></textarea>
              </div>
              <div class="form-group">
                  <?php if($TypeArray['is_popular']==1){ 
                     $checked = 'checked';
                  }else{ $checked='';}
                  ?>
                <input type="checkbox"  id="is_popular" name="is_popular" $checked>
                <label for="exampleInputEmail1">Is Popular</label>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="slug" name="slug" value="<?=stripslashes($TypeArray['slug'])?>" placeholder="Slug" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">SEO Tile</label>
                <input type="text" class="form-control " id="seo_title" name="seo_title" value="<?=stripslashes($TypeArray['seo_title'])?>" placeholder="SEO Title" style="width:40%;">
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">SEO Description</label>
                <textarea class="form-control" placeholder="SEO Description" name="seo_desc" id="seo_desc" rows="3" style="width:40%;"><?=($TypeArray['seo_desc'])?></textarea>
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_client_story.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
</body>
</html>
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_client_story.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
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
	if($("input#language").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Language is Mandatory");
		$("input#title").focus();
		return false;
	}
	if($("input#story_title").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Title is Mandatory");
		$("input#title").focus();
		return false;
	}
	if($("input#client_industry_id").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Client Industry is Mandatory");
		$("input#title").focus();
		return false;
	}
// 	if($("input#title_1").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Scope of work is Mandatory");
// 		$("input#title").focus();
// 		return false;
// 	}
// 	if($("input#title_2").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Solution is Mandatory");
// 		$("input#title").focus();
// 		return false;
// 	}
// 	if($("input#title_3").val()==""){
// 		$(".errorDiv").show().fadeOut(4000);
// 		$('#errormessage').text("Impact is Mandatory");
// 		$("input#title").focus();
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
