window.onload = function () {
var nVal=0;

	//Get number of wasps from database
	$.get('../php/db_wmany.php', function (nVal) {

					var ginitval=0;
					
					var g=[];
					var sectors = [{
							color : "#ff6600",
						            lo : 0,
						            hi : 24.999
				     			},{
							color : "#ffD700",
							lo : 25,
							hi : 54.999
							},{
							color : "#66ff33",
							lo : 55,
							hi : 100
							}];


		for (let n=1;n<=nVal; n++) {
			//Get wasp names - let wait for get
			
			$.get('../php/db_wdetails.php', { iVal:n } ,function (waspid) {
				//Get battery status;
				$.get('../php/db_bat.php', {wasp_id: waspid}, function (newValue) {  
					g[n-1] = new JustGage({
							//n is always 3?
							id: "g"+n,
							value: ginitval,
							min: 0,
							max: 100,
							symbol: '%',
							title: waspid,
							label: "last seen: \n"+newValue.lastdate+" day(s) ago.",
							pointer: true,
							pointerOptions: {
							toplength: -15,
							bottomlength: 10,
							bottomwidth: 12,
							color: '#8e8e93',
							stroke: '#ffffff',
							stroke_width: 3,
							stroke_linecap: 'round'
							},
							customSectors: sectors,
							gaugeWidthScale: 0.6,
							relativeGaugeSize: true,
							counter: true,
							//donut: true
							});
					g[n-1].refresh(newValue.batlevel);
				} , "json" );
					
			});			
		}	
					//do the tango
	});

// Get bat data
//$.get('./php/db_bat.php');					
// Format table History
$(document).ready(function() {
    $('#hist').DataTable();
} );

/*WaspID needs to looked up in the devices table
setInterval(function() {
	$.get('./php/db_bat.php', 'wasp_id=w01', function (newValue) { g1.refresh(newValue); 
g4.refresh(getRandomInt(0, 50));
        }, 2500);*/
}
