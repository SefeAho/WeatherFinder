"use strict";
function HTMLtoPDF(){
	var pdf = new jsPDF('p', 'pt', 'letter');
	var source = $('#HTMLtoPDF')[0];
	var specialElementHandlers = {
		'#bypassme': function(element, renderer){
			return true
		}
	};
	var margins = {
	    top: 20,
	    left: 20,
	    width: 545
	  };
	pdf.fromHTML(
	  	source // HTML string or DOM elem ref.
	  	, margins.left // x coord
	  	, margins.top // y coord
	  	, {
	  		'width': margins.width // max width of content on PDF
	  		, 'elementHandlers': specialElementHandlers
	  	},
	  	function (dispose) {
	  	  // dispose: object with X, Y of the last line add to the PDF
	  	  //          this allow the insertion of new lines after html
	        pdf.save('weather.pdf');
	      }
	  )
}
