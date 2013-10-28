function doPrintAir() 
{
    var pjob = new window.runtime.flash.printing.PrintJob;
    if ( pjob.start() )
    {
        var poptions = new window.runtime.flash.printing.PrintJobOptions;
        poptions.printAsBitmap = true;
        try
        {
            pjob.addPage(window.htmlLoader, null, poptions);
            pjob.send();
        }
        catch (err)
        {
            alert("exception: " + err);
        }
    }
    else
    {
        alert("PrintJob couldn't start");
    }
}
//comment the line below if you do not want to mess with existing
//window.print
window.print = doPrintAir;