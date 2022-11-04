<?php
// ini_set('display_errors',1);

require_once("admininclude/admin_leftmenu.php");

#==== Object Initialisations

//$POST		= $objTypes->validateUserInput($_POST);
$POST		= ($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$params_img    = array(":data_book_id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_data_book WHERE id = :id", $params);
$TypeArray_images	= $objTypes->fetchAll("SELECT * FROM tbl_databook_images WHERE data_book_id = :data_book_id", $params_img);

//show selected country
if(isset($TypeArray['country_id']))
{
  $getselected_country = $objTypes->fetchAll("SELECT id FROM tbl_country where id=".$TypeArray['country_id']);
  $selected_CountryIds = array_column($getselected_country, 'id');
  
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Data Book<small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_data_book.php"><i class="fa  fa-navicon"></i> List</a></li>
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
          <form role="form" id="productForm"  method="post" action="act_data_book.php" onsubmit="return validateForm();" enctype="multipart/form-data">
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
                  <label for="exampleInputEmail1">Country Name<?=MANDATORY?></label> 
                <select class="form-control" name="country_id" id="country_id" style="width: 40%">
                    <option value="">Select Country</option>
                    <?php
                    $params     = array(":is_active" => '1', ":is_delete" => '1');
                    $ProdArray	= $objTypes->fetchAll("SELECT country_name, id FROM tbl_country WHERE is_active = :is_active AND is_delete = :is_delete", $params);
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if(in_array($prod_v['id'], $selected_CountryIds)){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['country_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
              </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Data Book Name<?=MANDATORY?></label>
                <input type="text" class="form-control " id="data_book_name" name="data_book_name" value="<?=stripslashes($TypeArray['data_book_name'])?>" placeholder="DataBook Name" style="width:40%;">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Main Image</label>
                  <input type="file" class="form-control " id="image" name="image" value="" placeholder="Databook Main image" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['image']){ ?>
                <a href="#"><img src="../uploads/databook_images/<?=stripslashes($TypeArray['image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/databook_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Databook Pdf</label>
                  <input type="file" class="form-control " id="databook_pdf" name="databook_pdf" value="" placeholder="DataBook Pdf" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : PDF <br />MAX File Upload Size : 3MB<br /></div>
                  <?php if($TypeArray['databook_pdf']){ ?>
                <a href="#"><img src="../uploads/files/download.png"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/databook_images/<?=stripslashes($TypeArray['databook_pdf'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } else {?> <p class="alert alert-danger alert-dismissible" style="width:16%">No Pdf Uploaded.</p><?php }?>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Databook Images</label>
                  <input type="file" class="form-control " id="mul_image" name="mul_image[]" value="" placeholder="Databook Multiple Image" style="width:40%;"  multiple="multiple">
				  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php                
					foreach($TypeArray_images as $mu_image){
                      ?>
                      <div class="img-wrap2">
                        <span class="close2">&times;</span>
                        <img src="../uploads/databook_images/<?=stripslashes($mu_image['url'])?>" data-id="<?php echo $mu_image['id'] ?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/databook_images/<?=stripslashes($mu_image['url'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' />
					    <?php
                          if(strtolower(end(explode(".",$mu_image['url']))) =="mp4") { ?>
                        <video data-id="<?php echo $mu_image['id'] ?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/databook_images/<?=stripslashes($mu_image['url'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' controls>
                          <source src="../uploads/databook_images/<?=stripslashes($mu_image['url'])?>" type="video/mp4">
                        </video>
					    <?php } ?>
					  </div>
                      <?php
                  }
                  ?>
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description" name="short_description" id="short_description" rows="3" style="width:40%;"><?=($TypeArray['short_desc'])?></textarea>
              </div>
              <!--<div class="form-group">-->
              <!--  <label for="exampleInputEmail1">Description</label>-->
              <!--  <textarea class="form-control" id="editor1" name="description"  rows="10" cols="80" placeholder="Description" ><?=stripslashes($TypeArray['long_desc'])?></textarea>-->
              <!--</div>-->
              <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" class="form-control " id="slug" name="slug" value="<?=stripslashes($TypeArray['slug'])?>" placeholder="Databook Slug" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">SEO Tile</label>
                <input type="text" class="form-control " id="seo_title" name="seo_title" value="<?=stripslashes($TypeArray['seo_title'])?>" placeholder="SEO Title" style="width:40%;">
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">SEO Description</label>
                <textarea class="form-control" placeholder="SEO Description" name="seo_desc" id="seo_desc" rows="3" style="width:40%;"><?=($TypeArray['seo_desc'])?></textarea>
              </div>
              </div>
              
		
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_data_book.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_data_book.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
           $(this).closest("#productForm").append('<input type="hidden" name="param" value="rimg" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="prodid" value="<?php echo $id ?>" /><input type="hidden" name="pgNo" value="<?=$_REQUEST['pgNo']?>" />');
           $(this).closest("#productForm").submit();
        }
        else{
            return false;
        }
    });
})
</script>
<style>
.img-wrap2 {
    position: relative;
    display: inline-block;
    border: 1px red solid;
    font-size: 0;
}
.img-wrap2 .close2 {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap2:hover .close2 {
    opacity: 1;
}
</style>

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
	if($("input#data_book_name").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Data Book Name is Mandatory");
		$("select#report_category_id").focus();
		return false;
	}
	if($("select#country_id").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Country is Mandatory");
		$("input#report_country_id").focus();
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
    //$(".textarea").wysihtml5();
	//config.enterMode = CKEDITOR.ENTER_DIV;
  });
</script>
</body>
</html>