<!DOCTYPE html>
<html lang="en">
<head>
  <title>Calculator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Calculator form</h2>
			<form action="" method="post" id="formData">
				<div class="form-group">
					<input type="text" name="numInserted" id="numInserted" class="form-control" placeholder="eg 2+2">
					<span class="error" style="color: red;"></span>
				</div>
				<button id="submit" class="btn btn-success">Save</button>
			</form>
			<h3 class="text-center text-success" id="msg"></h3>
			<div class="table-responsive" id="showResult"></div>
		</div>
		<div class="col-md-6">
			<h2>List Result</h2>
			<div class="table-responsive" id="tableData">
        <h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
      </div>
		</div>
	  
	</div>
</div>
<!--  -->
<script>
	$(document).ready(function(){
		var base_url = "model/action.php";
		showAllResult();
	  //View Record
	  function showAllResult(){
	    $.ajax({
	      url : base_url,
	      type: "POST",
	      data : {action:"view"},
	      success:function(response){
	          $("#tableData").html(response);
	        }
	      });
	    }

		//insert ajax request data
    $("#submit").click(function(e){
      e.preventDefault();
      var numInserted = $("#numInserted").val();
      
      if (numInserted =='') {
      	$(".error").html('Input field is required.');
      	return false;
      }else{
	      $.ajax({
	        url : base_url,
	        type : "POST",
	        data : $("#formData").serialize()+"&action=insert",
	        success:function(response){
	          $("#showResult").html(response);
	          $("#msg").html('Answer');
	          $('#showResult').css({
		          	'text-align':'center', 
		          	'background':'#ccc', 
		          	'width': '120px',
						    'height': '76px',
						    'padding': '22px',
						    'font-size': '21px',
						    'font-weight': '600',
						    'margin': '0px auto',
						    'color': '#16a085',
					  	});
	          console.log(response);
	        }
	      });
	      return false;
    }
    });


    //Delete Record
    $("body").on("click", ".deleteBtn", function(e){
      e.preventDefault();
      var deleteId = $(this).attr('id');
      $.ajax({
        url :  base_url,
        type : "POST",
        data : {deleteId:deleteId},
        success:function(response){
          var data = JSON.parse(response);
          if (data == true) {
          	alert('Record deleted successfully.');
          }
          console.log(data);
        }
      });
    });


	}); //main
</script>
</body>
</html>
