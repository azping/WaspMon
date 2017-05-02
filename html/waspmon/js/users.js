window.onload = function () {
//	$(document).ready(function() {
//		$('#users').DataTable();
//	

var table = $('#users').DataTable( {
        //"ajax": "data/arrays.txt",
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button id='b1'>Modify</button><button id='b2'>Delete</button>"
        } ]
    } );


var table = $('#users').DataTable();

 /* On table row active (or selected if !bootstrap) enable buttons 
    $('#users tbody').on( 'click', 'tr', function () {
	var table = $('#users').DataTable();
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
		$('#Update').addClass('disabled');
		$('#Delete').addClass('disabled');
        }
        else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
		$('#Update').removeClass('disabled');
		$('#Delete').removeClass('disabled');
		//Selected row and data
		//console.log( $(this).data() );
 		//var rows = table.row( this ).data();
    		//alert( 'Nome '+ rows[3]);
	}
	} );
*/

	$('#users tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
	var button_id = this.id;
	if (button_id=='b1'){
		//alert( data[0] +"'s role is: "+ data[3] );
		$("#modifyU").modal();
		//var $modal = $(this);
		//$('input[name="usernamem"]', $modal).val(data[0]);
		document.getElementById("delheader").innerHTML = '<span class="glyphicon glyphicon-user"></span>'+' Update user?';
		$('#opusersm').val('Update');
		$('#idusersm').val(data[0]);
		$('#usernamem').val(data[1]);
		$('#namem').val(data[2]);
		$('#typem').val(data[3]);
		document.getElementById("uokm").innerHTML = "Update";
		$('#idusersm').attr('readonly',false);
		$('#usernamem').attr('readonly',false);
		$('#passwordm').attr('readonly',false);
		$('#namem').attr('readonly',false);
		$('#typem').attr('readonly',false);
	}
	if (button_id=='b2'){
		//alert( data[0] +"'s role is: "+ data[3] );
		$("#modifyU").modal();
		//var $modal = $(this);
		//$('input[name="usernamem"]', $modal).val(data[0]);
		document.getElementById("delheader").innerHTML = '<span class="glyphicon glyphicon-user"></span>'+' Delete user?';
		$('#opusersm').val('Delete');
		$('#idusersm').val(data[0]);
		$('#usernamem').val(data[1]);
		$('#namem').val(data[2]);
		$('#typem').val(data[3]);
		document.getElementById("uokm").innerHTML = "Delete";
		$('#idusersm').attr('readonly',true);
		$('#usernamem').attr('readonly',true);
		$('#passwordm').attr('readonly',true);
		$('#namem').attr('readonly',true);
		$('#typem').attr('readonly',true);
	}
	} );


/*
$('#Delete').on("click", ".open-deletedial", function () {

   //Selected row and data
		//console.log( $(this).data() );
 		var rows = table.row( this ).data();
    		console.log( rows[0] );


    // var musernamed = $(this).data();
     $(".modal-body #usernamed").text( rows[0] );


} );
*/



 	
//$("#Delete").on('click', function() {
//		var selectedRows = users.rows( $('#users tr.active') ).data().to$();
//		console.log(selectedRows[0]);
//     });

  //  $('#deleteU').on('show.bs.modal', function(e) {

// 	var $modal = $(this);
//        usernamed = $(e.relatedTarget).data[0];
//	$('input[name="usernamed"]', $modal).val(usernamed);
  //	var data = e.relatedTarget.dataset.data;
  // Do some stuff w/ it.

	
	

//	$('#dusername').val(data[0]); 

//	$('#dname').val(data[2]);
//	$('#dtype').val(data[3]);
	
	$('#uokm').click( function () {
		
		if (document.getElementById("uokm").innerHTML == "Update") { 
			console.log( "Update");
			



		} else {
			console.log( "Delete");
			
		};
        	//table.row('.active').remove().draw( false );
    		} );


	//} );
}
