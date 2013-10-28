	var doPrintAir = function(e) {
		// create PrintJob object
		var myPrintJob = new window.runtime.flash.printing.PrintJob;
		var invoiceDom = Y.one("#invoice_container");
		
		var contentHeight = invoiceDom.getStyle('height').replace(/px/, '');
		var contentWidth = 800; //invoiceDom.getStyle('width').replace(/px/, '');
		
		myPrintJob.paperArea.width = '612px';
		myPrintJob.paperArea.height = '792px';
		
		//////////////////////////////////////////////////////
		// Create options to pass in later when adding pages
		//////////////////////////////////////////////////////
		var poptions 			= new window.runtime.flash.printing.PrintJobOptions;
		poptions.printMethod 	= window.runtime.flash.printing.PrintMethod.VECTOR;
		poptions.pixelsPerInch 	= 300;
		poptions.printAsBitmap 	= false;
		
		/////////////////////////////////////////////////////////////////
		// Create the HTML Loader object and set some properties on it
		/////////////////////////////////////////////////////////////////
		var html	= new window.runtime.flash.html.HTMLLoader;
		var htmlStr	= invoiceDom.get('innerHTML');
		html.width 	= contentWidth;
		html.height = contentHeight;
		air.Introspector.Console.log("contentHeight: " + contentHeight); //debug
		air.Introspector.Console.log("htmlHeight: " + html.height); //debug

		html.scaleX = .75;
		html.scaleY = .75;
		
		/////////////////////////////////////////////////////////////////
		// Load the html we want to print into a new HTMLLoader object
		/////////////////////////////////////////////////////////////////
		html.loadString(htmlStr);
		
		//////////////////////////////////////////////////////////////////////////
		// Determine number of pages we need to print and set top of first page
		//////////////////////////////////////////////////////////////////////////
		var pageHeight	= Y.one('#top1').get('value') || 921; //792
		air.Introspector.Console.log("pageHeight: " + pageHeight); //debug
		var pages 		= Math.ceil(contentHeight / pageHeight);
		var top 		= 0;
			
		/////////////////////////////////////////////////////////////////
		// Wait for the HTML to be loaded before we try to print it
		/////////////////////////////////////////////////////////////////
		html.addEventListener("complete", function(){
			if (myPrintJob.start()) {
				myPrintJob.selectPaperSize('letter');
				for ( var y=0; y<pages; y++){
					// Create a rectangle which will act as a viewport on our HTML page, essentially a window showing the printable area.
					// Move the window around on top of the HTML to print different parts of it
					air.Introspector.Console.log("adding page at top: " + top); //debug
					var myRectangle = new window.runtime.flash.geom.Rectangle(0,top,contentWidth,pageHeight);
					myPrintJob.addPage(html, myRectangle, poptions);
					
					// For the next page move our viewport down a page by setting the top
					top += pageHeight;
				}
				myPrintJob.send();
			}
		});
	}
