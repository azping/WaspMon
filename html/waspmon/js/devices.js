window.onload = function () {
//	$(document).ready(function() {
//		$('#users').DataTable();
//

var table = $('#devices').DataTable( {
	//"processing": true,
        //"serverSide": true,
        //"ajax": "../php/db_wdevices.php",
        //"ajax": "data/arrays.txt",
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button id='b1'>Modify</button><button id='b2'>Delete</button>"
        } ]
    } );


//var table = $('#devices').DataTable();

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

$('#devices tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
	var button_id = this.id;
	if (button_id=='b1'){
		//alert( data[0] +"'s role is: "+ data[3] );
		$("#modifyD").modal();
		//var $modal = $(this);
		//$('input[name="dnamem"]', $modal).val(data[0]);
		document.getElementById("delheader").innerHTML = '<span class="glyphicon glyphicon-cog"></span>'+' Update device?';
		$('#opdevm').val('Update');
		$('#iddevm').val(data[0]);
		$('#dnamem').val(data[1]);
		$('#ddescm').val(data[2]);
		$('#dimgm').val(data[3]);
		$('#dstatusm').val(data[4]);
		$('#dt_regm').val(data[5]);
		document.getElementById("dokm").innerHTML = "Update";
		$('#iddevm').attr('readonly',false);
		$('#dnamem').attr('readonly',false);
		$('#ddescm').attr('readonly',false);
		$('#dimgm').attr('readonly',false);
		$('#dstatusm').attr('readonly',false);
		$('#dt_regm').attr('readonly',false);
		
	}
	if (button_id=='b2'){
		//alert( data[0] +"'s role is: "+ data[3] );
		$("#modifyD").modal();
		//var $modal = $(this);
		//$('input[name="dnamem"]', $modal).val(data[0]);
		document.getElementById("delheader").innerHTML = '<span class="glyphicon glyphicon-cog"></span>'+' Delete device?';
		$('#opdevm').val('Delete');
		$('#iddevm').val(data[0]);
		$('#dnamem').val(data[1]);
		$('#ddescm').val(data[2]);
		$('#dimgm').val(data[3]);
		document.getElementById("dokm").innerHTML = "Delete";
		$('#iddevm').attr('readonly',true);
		$('#dnamem').attr('readonly',true);
		$('#ddescm').attr('readonly',true);
		$('#dimgm').attr('readonly',true);
		$('#dstatusm').attr('readonly',true);
		$('#dt_regm').attr('readonly',false);
	}
} );


$('#scanD').on('show.bs.modal', function() {
	var nVal=0;
	var iVal=0;
	var kVal=0;
	var nwVal=0;

	
	setTimeout(function() { $('#sprobar').css('width', '40%'); 
	//no of wasps hist
	for (let i=0;i<1; i++) {
		$.get('../php/db_wmany.php', function (nVal){//Make sure $.get returns
								$('#sfw').val(nVal);
								
	$('#slist').empty();	
	//no of wasps reg
	for (let i=0;i<1; i++) {$.get('../php/db_d_wmany.php', function (kVal){//Make sure $.get returns
	wreg='reg';							$('#skw').val(kVal);

		//name of wasps hist
		for (let n=1;n<=nVal; n++) {
			$.get('../php/db_wdetails.php', { iVal:n } ,function (waspid){
//-----If device table is empty
			if (kVal==0) {
				for (let i=0;i<1; i++) { $.get('../php/db_d_ins.php', { waspid } , function (err){//Make sure $.get returns
						//$('#snw').val(waspid);
						$("#slist").append("<li class='list-group-item'>"+err+"</li>");
						console.log('Na base: '+err+' '+wreg);
						});
				}
			}
//-----if wasps in hist are greater than in devices
			if (nVal>kVal) {			
			//name os wasps reg
			for (let j=1;j<=kVal; j++) {
			
				$.get('../php/db_d_wdetails.php', { kVal:j } ,function (name){
					if ( waspid == name ) {
						
					} else {

						for (let i=0;i<1; i++) { $.get('../php/db_d_ins.php', { waspid } , function (err){//Make sure $.get returns
								$("#slist").append("<li class='list-group-item'>"+err+"</li>");
								});
						}


						wreg='reg';
						console.log('wreg comp: '+waspid+' '+name+' '+wreg);
					}
	

				});
			}//name os wasps reg
			}
//TODO if wasps are equal in hist and devices / if devices are more than in hist but the same?..

		}); }//name of wasps hist
	}); } //no of wasps reg end
	}); } //no of wasps hist end
		
				setTimeout(function() { $('#sprobar').css('width', '100%'); 
						setTimeout(function() {
	                				$('#sprobar').css('display', 'none');
	                				$('#scomp').css('display', 'block');
	            				}, 500);
				}, 750);
		}, 500);
		//new wasps
        	//table.row('.active').remove().draw( false );
} );


$('#scanD').on('hidden.bs.modal', function () {
	$('#slist').empty();
	
  $(this).removeData('bs.modal');

});




$('#sok').click( function () {
$('#sprobar').css('width', '0%');
$('#sprobar').css('display', 'block');
$('#scomp').css('display', 'none');
var nVal=0;
var kVal=0;
var nwVal=0;

} );

$('#groupD').modal('show');
}
