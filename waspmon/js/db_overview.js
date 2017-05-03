window.onload = function () {

//Get number of wasps from database

	$.get('./php/db_wdetails.php', function (nVal, wname) { 
					//do the tango
					//g1.refresh(newValue);
					});

//Get name of wasps from database

ginitval=0;

	$.get('./php/db_bat.php', 'wasp_id=w01', function (newValue) { g1.refresh(newValue); });
	$.get('./php/db_bat.php', 'wasp_id=w02', function (newValue) { g2.refresh(newValue); });  
	$.get('./php/db_bat.php', 'wasp_id=w03', function (newValue) { g3.refresh(newValue); });
	$.get('./php/db_bat.php', 'wasp_id=w04', function (newValue) { g4.refresh(newValue); });

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

  var g1 = new JustGage({
        id: 'g1',
        value: ginitval,
        min: 0,
        max: 100,
        symbol: '%',
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
        counter: true
      });

var g2 = new JustGage({
        id: 'g2',
        value: ginitval,
        min: 0,
        max: 100,
        symbol: '%',
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
        counter: true
      });
var g3 = new JustGage({
        id: 'g3',
        value: ginitval,
        min: 0,
        max: 100,
        symbol: '%',
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
        gaugeWidthScale: 0.6,
	relativeGaugeSize: true,
        counter: true
      });
var g4 = new JustGage({
        id: 'g4',
        value: ginitval,
        min: 0,
        max: 100,
        symbol: '%',
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
        gaugeWidthScale: 0.6,
	relativeGaugeSize: true,
        counter: true
      });
/*WaspID needs to looked up in the devices table*/
setInterval(function() {
	$.get('./php/db_bat.php', 'wasp_id=w01', function (newValue) { g1.refresh(newValue); });
	$.get('./php/db_bat.php', 'wasp_id=w02', function (newValue) { g2.refresh(newValue); });  
	$.get('./php/db_bat.php', 'wasp_id=w03', function (newValue) { g3.refresh(newValue); });
	$.get('./php/db_bat.php', 'wasp_id=w04', function (newValue) { g4.refresh(newValue); });    
	}, 30000);
 

}
