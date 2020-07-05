<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
	exit();
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
require_once("includes/utility.php"); 
$postingServiceObj=new PostingService();
									
$imageBasePath="uploads/gallery/";
										
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Videos</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/adminlte.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
		<style>
			.checkbox .simple{
				background-position: 0px 0px;
				display: inline-block;
				vertical-align: middle;
				margin-left:20px;
				margin: 0px;
				padding: 0px;
				width: 18px;
				height: 18px;
				background: url('css/iCheck/minimal/minimal.png') no-repeat scroll 0% 0% rgba(255, 255, 255, 0.7);
				border: medium none;
				cursor: pointer;
			}
			.box {
				margin-bottom: 0px;
			}
		</style>

<script src="js/facebox.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
		
   function addPosting(){
        // Get form
        var form = $('#fileUploadForm')[0];
		// Create an FormData object
        var data = new FormData(form);
		// If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");
		// disabled the submit button
        $("#btnSubmit").prop("disabled", true);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "/api/upload/multi",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
                $("#result").text(data);
                console.log("SUCCESS : ", data);
                $("#btnSubmit").prop("disabled", false);
            },
            error: function (e) {
                $("#result").text(e.responseText);
                console.log("ERROR : ", e);
                $("#btnSubmit").prop("disabled", false);
            }
        });
    }

</script>

	</head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
       <?php include('includes/header.php'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php include("includes/inc_menu.php"); ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Videos
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add Videos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<!-- start of col (left) -->
                        <div class="col-md-6">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title"> Add Video URL</h3>
									<div class="pull-right box-tools">                                        
									</div>
								</div><!-- /.box-header -->
								<div class="box-body" id="addVideo">
									<form action="addvideoposting_action.php" method="POST" enctype="multipart/form-data" id="fileUploadForm">
										<input type="hidden" id="vidPostingId" name="postingId" value="0">
										<div class="form-group ">
											<label for="Address">Title </label>
											<input type="text" class="form-control" required id="txtVideoTitle" name="txtVideoTitle" placeholder="Content Title" >
										</div>	
										<div class="form-group ">	
											<label for="City">Description </label>
											<input type="text" class="form-control" required id="txtVideoDescription" name="txtVideoDescription" placeholder="Content Description" >
										</div>
										<div class="form-group ">	
											<label for="City">Video URL </label>
											<input type="text" class="form-control" required id="txtVideoUrl" name="txtVideoUrl" placeholder="Video URL" >
										</div>
										<div class="form-group" style="text-align:center;">																					
											<input  type="submit" class="btn btn-info btn-sm"  id="btnSubmit" value="Submit" /> 												
											<input onClick="clearVideo();" type="button" class="btn btn-info btn-sm"  id="btnClear" value="Clear" /> 												
											</div>														
									</form>
								</div><!-- /.box-body -->
							</div>
											
							<!-- /.box -->
                        </div>
						<!-- end of col (left) -->
						
						<!-- right column -->
						<div class="col-md-6">
							<!-- Top right start-->	
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Videos</h3>
									<div class="pull-right box-tools"></div>
								</div>
								<div class="box-body">	
									<?php
									$results=$postingServiceObj->getPostingList("Video");
									while($row=mysqli_fetch_array($results)){
										$postingid=$row["postingid"];	
										$videoRefId=getVideoNameFromYouTubeURL($row["videourl"]);
										?>												
										<div style="height:130px; width:220px; border:1px solid #ccc;display:inline-block;">
											<div style="padding:10px; width:100%; height:100px; float:left; border-bottom:1px solid #ccc;">
				<iframe  src="http://www.youtube.com/embed/<?php echo $videoRefId; ?>?feature=player_detailpage&wmode=transparent" frameborder="0" allowfullscreen="" style="width:100%;height:100%;">
				</iframe>
											</div>
											<div  style="float:left; height:10px; width:100%; text-align:center;">																	
<span id="<?php echo $row["postingid"]; ?>" class="editToDo">
<a href="javascript:void(0);" onClick="editVideo(<?php echo $row["postingid"].",".quote($row["title"]).",".quote(str_replace("'", "",$row["description"])).",".quote($row["videourl"]); ?>);"><i class="fa fa-edit"></i></a>
</span>
													&nbsp;&nbsp;											
												<a href="javascript:void(0);"><span id="<?php echo $postingid; ?>" class="delete-galery">
													<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Video"></i>
												</span></a>
											</div>
										</div>			
								<?php 
									}
								?>												

								</div>										
							</div>						
                           <!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
       
	<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
       
        <!-- AdminLTE App -->
<script type="text/javascript">
			
            $(function() {
				/*** Function to delete photogallery **/					
				$('.delete-galery').click(function(e){
						var postingId = this.id;	
					var answer = confirm("Are you sure you want to delete this Video "+postingId+"?");						
					if (answer){									
						var post_data = {'act':'deletePosting','postingId':postingId};							
						//Ajax post data to server
						 $.post('commonaction.php', post_data, function(response){									
								location.reload();
						}).fail(function(err) {alert(err)});			
					} else {		
						return false;
					}						
				});

				$("[data-widget='collapse']").click();
                //Datemask mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

				$('#selQuickFactsTitle').change(function(e){
					var selectedString=e.target.value;
					$('#contentTitle1').val(selectedString);
				});
            });
			
	
	function readImageURL(input,divname,width) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#'+divname)
					.attr('src', e.target.result)
					.width(width)
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	

</script>
    
    </body>
</html>
