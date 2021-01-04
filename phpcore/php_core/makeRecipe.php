<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>


 $(function() {
 	var ingCounter = 0;
 	var INGnames = [];
 	var INGamt = [];
 	var INGmeas = [];
 	var stepCounter = 0;
 	var stepCap = [];
 	var stepIns = [];
 	var selingr;
 	var type;
 	var part;
 	var time = [];
 	var file;


 	$('#fish').hide();
 	$('#veg').hide();
 	$('#step2').hide();
 	$('#removeIngr').hide();
 	$('#removeStep').hide();
 	$('#step3').hide();

	$( "#ingr" ).change(function() {
  		selingr = document.getElementById('ingr').value;
    	//var ingr = selingr.options[selingr.selectedIndex].value;
    	$('#part').empty();
    	if(selingr=="Chicken")
    	{	
    		$('#cut').show();
    		$('#fish').hide();
 			$('#veg').hide();
    		$('#part').append('<option value="Full" selected>Full</option>'); 
    		$('#part').append('<option value="Half">Half</option>'); 
    		$('#part').append('<option value="Wing">Wingl</option>'); 
    		$('#part').append('<option value="Thigh">Thigh</option>'); 
    		$('#part').append('<option value="Leg">Leg</option>'); 
    		$('#part').append('<option value="Breast">Breast</option>'); 
    	}
    	else if(selingr=="Beef")
    	{
    		$('#cut').show();
    		$('#fish').hide();
 			$('#veg').hide();
 			$('#part').append('<option value="Chuck" selected>Chuck</option>'); 
    		$('#part').append('<option value="Rib">Rib</option>'); 
    		$('#part').append('<option value="Short Loin">Short Loin</option>'); 
    		$('#part').append('<option value="Sirloin">Sirloin</option>'); 
    		$('#part').append('<option value="Round">Round</option>'); 
    		$('#part').append('<option value="Brisket">Brisket</option>'); 
    		$('#part').append('<option value="Foreshank">Foreshank</option>'); 
    		$('#part').append('<option value="Short Plate">Short Plate</option>'); 
    		$('#part').append('<option value="Flank">Flank</option>'); 
    	}
    	else if(selingr=="Pork")
    	{
    		$('#cut').show();
    		$('#fish').hide();
 			$('#veg').hide();
 			$('#part').append('<option value="Shoulder" selected>Shoulder</option>'); 
    		$('#part').append('<option value="Rib">Rib</option>'); 
    		$('#part').append('<option value="Loin">Loin</option>'); 
    		$('#part').append('<option value="Fillet">Fillet</option>'); 
    		$('#part').append('<option value="Chump">Chump</option>'); 
    		$('#part').append('<option value="Legt">Leg</option>'); 
    		$('#part').append('<option value="Leg">Leg</option>'); 
    		$('#part').append('<option value="Liver">Liver</option>'); 
    		$('#part').append('<option value="Cheek">Cheek</option>'); 
    		$('#part').append('<option value="Crackling">Crackling</option>'); 
    	}
    	else if(selingr=="Fish")
    	{
    		$('#cut').hide();
    		$('#fish').show();
 			$('#veg').hide();
    	}
    	else
    	{
    		$('#cut').hide();
    		$('#fish').hide();
 			$('#veg').show();
    	}
	});

	$( "#firstNext" ).click(function() {
		if(selingr=="Fish")
		{
			part = $("#fishName").val();
		}
		else if(selingr=="Vegetable")
		{
			part = $("#veggie").val();
		}
		else
		{
			part = $("#part").children("option:selected").val();
		}

		selingr = $("#ingr").children("option:selected").val();
  		$("#step1").hide();
  		$("#step2").show();
	});

	$( "#secondNext" ).click(function() {
		
		ingCounter++;
		for(var i=0; i<ingCounter;i++)
  		{
  			var ingName = "ingName" + i;
			var amt = "amt" + i;
			var amount = "amount" + i;
  			INGnames[i] = document.getElementById(ingName).value;
  			INGamt[i] = document.getElementById(amt).value;
  			INGmeas[i] = document.getElementById(amount).value;
  		}

  		
  		$("#step2").hide();
  		$("#step3").show();

	});
	$( "#addingr" ).click(function() {

		
		ingCounter++;
		var div = "divIngr" + ingCounter;
		var ingName = "ingName" + ingCounter;
		var amt = "amt" + ingCounter;
		var amount = "amount" + ingCounter;
		var divString = '<div id="' + div +'">Ingredient: <input id="'+ ingName +'" type="text"> Amount: <input id="'+ amt +'" type="text"> <select id="'+ amount +'"><option value="pinch">pinch</option><option value="tsp">tsp</option><option value="Tbsp">Tbsp</option><option value="cup">cup</option><option value="ml">ml</option><option value="L">l</option><option value="kg">kg</option><option value="g">g</option><option value="pcs">pcs</option></select><br></div>';

  		$("#adding").append(divString);
  		if(ingCounter>0)
  			$("#removeIngr").show();
	});

	$("#removeIngr").click(function() {
		var div = "#divIngr" + ingCounter;
		$(div).remove();
		ingCounter--;

		if(ingCounter==0)
			$("#removeIngr").hide();
	});

		$( "#fin" ).click(function() {
		
		stepCounter++;
		for(var i=0; i<stepCounter;i++)
  		{
  			var capName = "caption" + i;
			var text = "#text" + i;
  			stepCap[i] = document.getElementById(capName).value;
  			stepIns[i] = $(text).val();
  		}

  		var rname = $("#rname").val();
  		var kg = $("#kg").val();
  		
  		
  		/*$("#make").load("insertRecipe.php", {
           rname: rname, 
           type: selingr,
           part: part,
           kg: kg, 
           ingr: INGnames,
           amt: INGamt,
           meas: INGmeas,
           ingCounter: ingCounter,
           stepCap: stepCap,
           stepIns: stepIns,
           timer: time,
           stepCounter: stepCounter,
           file: image

       });*/
       var fd = new FormData();
       file = $('#file')[0].files[0];
       console.log(file);
       fd.append('file',file);
       fd.append('rname',rname);
       fd.append('type',selingr);
       fd.append('part',part);
       fd.append('kg',kg);
       fd.append('ingr',INGnames);
       fd.append('amt',INGamt);
       fd.append('meas',INGmeas);
       fd.append('ingCounter', ingCounter);
       fd.append('stepCap',stepCap);
       fd.append('stepIns',stepIns);
       fd.append('stepCounter', stepCounter);
  		
       $.ajax({
       		url: "insertRecipe.php",
       		type:"post",
       		data: fd,
       		contentType: false,
       		processData: false,
       		success: function(response){
       		$('#make').html(response);
       		}
       });


	});
	$( "#addSteps" ).click(function() {

		
		stepCounter++;
		var step = stepCounter + 1;
		var divStep = "divStep" + stepCounter;
		var capName = "caption" + stepCounter;
		var text = "text" + stepCounter;
		var timer = "timer" + stepCounter;
		var divString = '<div id="' + divStep +'">	Step '+ step +' <br>Caption: <input id="' + capName +'" type="text"><br>Instructions: <textarea id="'+text+'"></textarea><br></div>';

  		$("#procedure").append(divString);
  		if(stepCounter>0)
  			$("#removeStep").show();
	});

	$("#removeStep").click(function() {
		var div = "#divStep" + stepCounter;
		$(div).remove();
		stepCounter--;

		if(stepCounter==0)
			$("#removeStep").hide();
	});

	$("#file").change(function() {
  		readURL(this);
  		//var tmp_name = document.getElementById("file").files[0].tmp_name;
  		//console.log(tmp_name);
	});
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


</script>
</head>
<body>

<div id='make'>
<form method="post" action="" enctype="multipart/form-data">
<div id="step1">	

Dish Name: <input id="rname" type="text"><br>
Dish Type: 
<select id='ingr'>
	<option value="Chicken" selected>Chicken</option>
	<option value="Beef">Beef</option>
	<option value="Pork">Pork</option>
	<option value="Fish">Fish</option>
	<option value="Salad">Salad</option>
</select>


<div id='cut'>
Cut:
<select id='part'>
	<option value="Full" selected>Full</option>
	<option value="Half">Half</option>
	<option value="Wing">Wing</option>
	<option value="Thigh">Thigh</option>
	<option value="Leg">Leg</option>
	<option value="Breast">Breast</option>
</select>
</div>
<div id='fish'>
	Fish Name: <input id="fishName" type="text">
</div>
<div id='veg'>
	Main Ingredient: <input id="veggie" type="text">
</div>
Kilograms: <input id ="kg" type="text"><br>
<img id="blah" src="#" alt="your image" /> <br>
Upload Image:<input type="file" id="file" accept=".jpg, .jpeg, .png"><br>

<input id="firstNext" type="button" value="Next">
</div>

<div id='step2'>
	<div id='adding'>
	Ingredient: <input id='ingName0' type="text"> 
	Amount: <input id='amt0' type="text"> <select id='amount0'>
	<option value="pinch">pinch</option>
	<option value="tsp">tsp</option>
	<option value="Tbsp">Tbsp</option>
	<option value="cup">cup</option>
	<option value="ml">ml</option>
	<option value="L">l</option>
	<option value="kg">kg</option>
	<option value="g">g</option>
	<option value="pcs">pcs</option>
	</select>
	<br>
	</div>

<input id="addingr" type="button" value="Add More"> <input id="removeIngr" type="button" value="Remove"><input id="secondNext" type="button" value="Next">	
</div>
<div id='step3'>
	<div id ='procedure'>
	Step 1 <br>
	Caption: <input id='caption0' type="text"><br>
	Instructions: <textarea id='text0'></textarea><br>
	</div>

	<input id="addSteps" type="button" value="Add More"><input id="removeStep" type="button" value="Remove"><input id="fin" type="button" value="Finish">
</div>
</form>
</div>
</body>
</html>
