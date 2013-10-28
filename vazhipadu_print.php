<html>
  <head>
    <title>AIR Print Test</title>
    <script src="AIRAliases.js" type="text/javascript"></script>
    <script src="printing-air.js" type="text/javascript">
    </script>
  </head>
  <body style="border: 5px double grey;margin:20px 20px 20px 20px;background-color:#333;color:#fff;">
    <div style="margin: 20px 20px 20px 20px;">
      <h1> AIR - Printing from HTML / Javascript </h1>
           <p>Sample Text: The Sprite class is a basic display list building block: 
	a display list node that can display graphics and can also
	contain children.</p>
      
      <p>A Sprite object is similar to a movie clip, but does not have a
	timeline. Sprite is an appropriate base class for objects that do not
	require timelines. For example, Sprite would be a logical base class
	for user interface (UI) components that typically do not use the
	timeline.This is lots of text</p>

      <p style="text-align:center;">
      <!-- point to any png here -->
	<img src="deskworld.png" />
      </p>
      
      <input type="button" value="Print" onClick="window.print()"/>
      <input type="button" value="Exit" onClick="window.nativeWindow.close()"/>      
    </div>
  </body>
</html>