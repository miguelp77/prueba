<?php
  require_once('includes/misfunciones.php');

 //     <script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	//		<script type="text/javascript" SRC="mathjax/MathJax.js"></script>


//\[
//\frac{-b\pm\sqrt{b^2-4ac}}{2a}
//\]
?>
<html>
<head>
<title>MathJax Dynamic Math Test Page</title>
<!-- Copyright (c) 2010 Design Science, Inc. -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" >

<script src="mathjax/MathJax.js">
 MathJax.Hub.Config({
 extensions: ["tex2jax.js"],
 jax: ["input/TeX","output/HTML-CSS"],
 tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
 });
</script>

</head>
<body>

<script>
 //
 // Use a closure to hide the local variables from the
 // global namespace
 //
 (function (){
		var QUEUE = MathJax.Hub.queue; // shorthand for the queue
		var math = null; // the element jax for the math output.

 //
 // Get the element jax when MathJax has produced it.
 //
		 QUEUE.Push(function () {
			math = MathJax.Hub.getAllJax("MathOutput")[0];
 			});

 //
 // The onchange event handler that typesets the
// math entered by the user
 //
 window.UpdateMath = function (TeX) {
 QUEUE.Push(["Text",math,"\\displaystyle{"+TeX+"}"]);
 }
 })();
</script>

Type some TeX code and press RETURN:<br/>
<input id="MathInput" size="50" onchange="UpdateMath(this.value)" />
<p>

<div id="MathOutput">
You typed: ${}$
</div>

<script>
//
// IE doesn't fire onchange events for RETURN, so
// use onkeypress to do a blur (and refocus) to
// force the onchange to occur
//
if (MathJax.Hub.Browser.isMSIE) {
 window.MathInput.onkeypress = function () {
 if (window.event && window.event.keyCode === 13) {this.blur(); this.focus()}
 }
}
</script>

</body>
</html> 
