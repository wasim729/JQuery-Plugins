<!DOCTYPE html>
<html>
  <head>
		<meta charset="UTF-8" />

		<title>jQuery Waiting - jQuery powered waiting spinners, progress bars, and animations</title>

		<meta name="Description" content="jQuery Waiting - jQuery powered waiting spinners, progress bars, and animations, compatible with the most common browsers" />
		<meta name="Keywords" content="jquery, javascript, waiting, gif, animation, progress, spinner" />
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="jquery-litelighter.js"></script>
		<script type="text/javascript" src="jquery-waiting.js"></script>

		<style type="text/css"> 
			body,img,p,h1,h2,h3,h4,h5,h6,form,table,td,ul,ol,li,dl,dt,dd,pre,blockquote,fieldset,label{
				margin:0;
				padding:0;
				border:0;
			}
			body{ background-color: #f8f7ec; border-top: solid 10px #777; font: 90% Helvetica, sans-serif; padding: 20px; }
			h1,h2,h3,h4{ margin: 10px 0; font-family: Plantin, "Plantin std", "Plantin", "Baskerville", Georgia, "Times New Roman", serif; font-weight: normal; }
			h1{font-size: 2.2em;margin: 0 0 20px 0; }
			h2{ background-color: #D95656; line-height: 18px; font-size: 18px; letter-spacing: 1px; padding: 5px 10px; margin: 10px 0 10px -60px; color: #fff; display: inline-block; border-radius: 4px; -moz-border-radius: 4px;-webkit-border-radius: 4px; }
			h3{ color: #D95656; font-size: 18px; letter-spacing: 1px;  margin: 15px 0 15px -20px; }
			h4{ color: #777; font-size: 18px; letter-spacing: 1px; }
			p{ margin: 10px 0; line-height: 150%; }
			a{ color: #7b94b2; }
			ul,ol{ margin: 10px 0 10px 40px; }
			li{ margin: 4px 0; }
			dl{ margin: 10px 0; }
			dl dt{ font-weight: bold; line-height: 20px; margin: 10px 0 0 0; }
			dl dd{ margin: -20px 0 10px 120px; padding-bottom: 10px; border-bottom: solid 1px #eee;}
			pre{ font-size: 12px; line-height: 16px; padding: 5px 5px 5px 10px; margin: 10px 0; border-left: solid 5px #9EC45F; overflow: auto; }

			.wrapper{ background-color: #ffffff; width: 600px; border: solid 1px #eeeeee; padding: 20px 20px 20px 40px; margin: 0 auto; border-radius: 6px; -moz-border-radius: 6px;-webkit-border-radius: 6px; }
			.header{ text-align: center;position: relative; margin: 0 -20px 0 -40px; }
			.header ul{ margin: 10px 0; display: block; }
			.header ul li{ display: inline-block; list-style: none; margin: 10px 0; width: 100px; }
			.header ul li a{ text-transform: uppercase; color: #777; text-decoration: none; font-size: 12px; }
			.header ul li a:hover{ color: #555; }
			.header .tour{ color: #fff; background-color: #9ec45f; padding: 4px 10px; margin: 10px 0; font-size: 18px; line-height: 18px; text-decoration: none;border-radius: 4px; -moz-border-radius: 4px;-webkit-border-radius: 4px;}
			.header .tour:hover{ background-color: #8eb44f; }
			.header ul.scrollnav{ position: fixed; top: 0px; left: 50%; background-color: #777; display: none; margin: 0 0 0 -185px; border-radius: 0 0 0 6px; -moz-border-radius: 0 0 0 6px;-webkit-border-radius: 0 0 0 6px;}
			.header ul.scrollnav li a{ color: #fff; }
			.header ul.scrollnav.scrolled{ display: inline; }
			.clear{ clear: both; }

			.waiting{ padding: 0; display: inline-block; }
			.waiting-element{ margin: 0 2px 2px 0; background-color: #ccc; 
				width: 10px; height: 20px; display: inline-block;}
			.waiting-play-0{ margin-bottom: 0; background-color: #999; }
			.waiting-play-1{ margin-bottom: 1px; background-color: #aaa; }
			.waiting-play-2{ margin-bottom: 2px; background-color: #bbb; }

			.waiting-blocks{ padding: 0; display: inline-block; }
			.waiting-blocks-element{ background-color: #caddfb; border: solid 1px #c9ccdb;
				margin: 0 2px 0 0; width: 10px; height: 10px; display: inline-block; 
				-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
			.waiting-blocks-play-0{ background-color: #b0c5ee; }
			.waiting-blocks-play-1{ background-color: #caddfb; }

			.waiting-nonfluid{ padding: 0; display: inline-block; }
			.waiting-nonfluid-element{ margin: 0 2px 0 0; background-color: #ccc; 
				width: 10px; height: 20px; display: inline-block;}
			.waiting-nonfluid-play-0,
			.waiting-nonfluid-play-1,
			.waiting-nonfluid-play-2,
			.waiting-nonfluid-play-3,
			.waiting-nonfluid-play-4,
			.waiting-nonfluid-play-5{ background-color: #999; }

			.waiting-circles{ padding: 0; display: inline-block; position: relative; width: 60px; height: 60px;}
			.waiting-circles-element{ margin: 0 2px 0 0; background-color: #e4e4e4; border: solid 1px #f4f4f4;
				width: 10px; height: 10px; display: inline-block; 
				-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
			.waiting-circles-play-0{ background-color: #9EC45F; }
			.waiting-circles-play-1{ background-color: #aEd46F; }
			.waiting-circles-play-2{ background-color: #bEe47F; }

		</style>
		
		<script type="text/javascript">

			$(document).ready(function(){
				// quick routine for scrolling nav
				var $nav = $('.header ul'),
					navoffset = $nav.offset(),
					$navclone = $nav.clone().addClass('scrollnav').appendTo('.header'),
					$window = $(window);
				$window.scroll(function(e){
					if((navoffset.top+50) < $window.scrollTop()){
						if(!$navclone.hasClass('scrolled'))
							$navclone.addClass('scrolled');
					}
					else $navclone.removeClass('scrolled');
				}).scroll();

				// highlight the code
				$('pre.code').litelighter();

				// run the examples
				$('.example-container > pre.ex').each(function(i){
					eval($(this).data('llcode'));
				});
			});
		</script>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<h1>jQuery Waiting - spinners and progress bars</h1>

				<ul class="nav">
					<li><a href="#Get_Started" title="Get Started">Get Started</a></li>
					<li><a href="#Examples" title="Examples">Examples</a></li>
					<li><a href="#Options" title="Options">Options</a></li>
					<li><a href="#Methods" title="Methods">Methods</a></li>
					<li><a href="#Events" title="Events">Events</a></li>
				</ul>
		
			</div>

			<div class="content">

				<h2 id="Get_Started">Get Started</h2>
					
					<h3>Highly Recommended</h3>
					<p>Subscribe to <a href="http://trentrichardson.com/category/impromptu/" title="TrentRichardson.com">my newsletter</a> and follow me <a href="http://twitter.com/practicalweb" title="Follow me on Twitter">@practicalweb</a>.</p>
					
					<p>It is important to let your users know what they're doing, waiting! For the developer they need support in every browser, easy customization, and efficiency.  Even though all this is possible with fancy CSS transformation, many browsers won't support it (IE < 10).  jQuery Waiting uses standard, widely accepted css to style your waiting spinner, and a little jQuery to make it function.</p>
					
					<h3>Donation</h3>
					<a href="http://carbounce.com" title="Car Bounce" style="float: right; display: inline-block;width:300px;padding: 10px;background-color: #fbfbfb;border: dotted 4px #e8e8e8;color: #9EC45F;font-size: 14px;text-decoration:none;letter-spacing:1px;"><img src="http://carbounce.com/img/logo_small.png" alt="Car Bounce" align="left" style="margin-right: 20px;"/>Try my new app to keep you informed of your car's financing status and value.</a>	
					<p>Has Waiting been helpful to you?</p>
					<div class="donation">					
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="ZBNQYNC8VHBBS">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
					
					<h3 id="Download">Download</h3>
					<ul>
						<li><a href="https://github.com/trentrichardson/jQuery-Waiting" title="Fork it on Github">Download or Fork on Github</a></li>
					</ul>

					<h3>Version</h3>
					<p>Version 0.2</p>
					<p>Last updated on 05/28/2013</p>

					<p>jQuery Waiting is currently available for use in all personal or commercial projects under both MIT and GPL licenses. This means that you can choose the license that best suits your project, and use it accordingly. </p>
					<ul>
						<li><a href="http://trentrichardson.com/Impromptu/GPL-LICENSE.txt" title="GPL License">GPL License</a></li>
						<li><a href="http://trentrichardson.com/Impromptu/MIT-LICENSE.txt" title="MIT License">MIT License</a></li>
					</ul>

				<h2 id="Examples">Examples</h2>

				
						<!-- ============= example -->
						<div class="example-container">
							<h3>Basic Initialization</h3>
							<p>Create a waiting animation, '#waiting1' is a simple empty div:</p>
							<div>
						 		<div id="waiting1"></div>
							</div>
<pre class="ex code" data-lllanguage="js">
/* CSS:
.waiting{ padding: 0; display: inline-block; }
.waiting-element{ margin: 0 2px 2px 0; background-color: #ccc; 
	width: 10px; height: 20px; display: inline-block;}
.waiting-play-0{ margin-bottom: 0; background-color: #999; }
.waiting-play-1{ margin-bottom: 1px; background-color: #aaa; }
.waiting-play-2{ margin-bottom: 2px; background-color: #bbb; }
*/

$('#waiting1').waiting({ 
	elements: 10, 
	auto: true 
});
</pre>
						</div>


						<!-- ============= example -->
						<div class="example-container">
							<h3>Styling</h3>
							<p>Here we specify only three elements and change the class to match our css:</p>
							<div>
						 		<div id="waiting2"></div>
							</div>
<pre class="ex code" data-lllanguage="js">
/* CSS: Notice 'waiting-blocks' className matches waiting option
.waiting-blocks{ padding: 0; display: inline-block; }
.waiting-blocks-element{ background-color: #caddfb; border: solid 1px #c9ccdb;
	margin: 0 2px 0 0; width: 10px; height: 10px; display: inline-block; 
	-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
.waiting-blocks-play-0{ background-color: #b0c5ee; }
.waiting-blocks-play-1{ background-color: #caddfb; }
*/

$('#waiting2').waiting({ 
	className: 'waiting-blocks', 
	elements: 3, 
	speed: 300, 
	auto: true 
});
</pre>
						</div>

						<!-- ============= example -->
						<div class="example-container">
							<h3>Non-Fluid</h3>
							<p>Create a spinner that is not fluid, meaning once the lead play frame reaches the end it starts over, it does not fluidly wrap around:</p>
							<div>
						 		<div id="waiting3"></div>
							</div>
<pre class="ex code" data-lllanguage="js">
/* CSS:
.waiting-nonfluid{ padding: 0; display: inline-block; }
.waiting-nonfluid-element{ margin: 0 2px 0 0; background-color: #ccc; 
	width: 10px; height: 20px; display: inline-block;}
.waiting-nonfluid-play-0,
.waiting-nonfluid-play-1,
.waiting-nonfluid-play-2,
.waiting-nonfluid-play-3,
.waiting-nonfluid-play-4,
.waiting-nonfluid-play-5{ background-color: #999; }
*/

$('#waiting3').waiting({ 
	className: 'waiting-nonfluid',
	elements: 5, 
	fluid: false,
	auto: true 
});
</pre>
						</div>

						<!-- ============= example -->
						<div class="example-container">
							<h3>Circles</h3>
							<p>By using the radius option you can create a circle:</p>
							<div>
						 		<div id="waiting4"></div>
							</div>

<pre class="ex code" data-lllanguage="js">
/* CSS: notice position: relative, width, and height are set for circles
.waiting-circles{ padding: 0; display: inline-block; 
	position: relative; width: 60px; height: 60px;}
.waiting-circles-element{ margin: 0 2px 0 0; background-color: #e4e4e4; 
	border: solid 1px #f4f4f4;
	width: 10px; height: 10px; display: inline-block; 
	-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
.waiting-circles-play-0{ background-color: #9EC45F; }
.waiting-circles-play-1{ background-color: #aEd46F; }
.waiting-circles-play-2{ background-color: #bEe47F; }
*/

$('#waiting4').waiting({ 
	className: 'waiting-circles', 
	elements: 8, 
	radius: 20, 
	auto: true 
});
</pre>
						</div>

						<!-- ============= example -->
						<div class="example-container">
							<h3>Using Methods and Events</h3>
							<p>Use some methods to start, stop, disable:</p>
							<div>
						 		<div id="waiting5"></div>
						 		<a href="#" id="waiting5_play">Play</a> | <a href="#" id="waiting5_pause">Pause</a> | <a href="#" id="waiting5_enable">Enable</a> | <a href="#" id="waiting5_disable">Disable</a> | <a href="#" id="waiting5_option">Option</a>
							</div>

<pre class="ex code" data-lllanguage="js">
var $el = $('#waiting5');
$el.waiting({ elements: 10 });

// clicking the links to play/pause/enable/disable
$('#waiting5_play').click(function(e){
	$el.waiting('play');
	return false;
});
$('#waiting5_pause').click(function(e){
	$el.waiting('pause');
	return false;
});
$('#waiting5_enable').click(function(e){
	$el.waiting('enable');
	return false;
});
$('#waiting5_disable').click(function(e){
	$el.waiting('disable');
	return false;
});
$('#waiting5_option').click(function(e){
	if($el.waiting('option','className') == 'waiting')
		$el.waiting('option',{ className: 'waiting-blocks', elements: 5 });		
	else $el.waiting('option',{ className: 'waiting', elements: 10 });
	return false;
});

// open your console to watch these events
$el.bind('play.waiting pause.waiting enable.waiting disable.waiting', function(e){
	if(window.console)
		console.log(e.type);
});
</pre>
						</div>

						<!-- ============= example -->
						<div class="example-container">
							<h3>Progress bar</h3>
							<p>Use the percent option and events to create an interactive progress bar.</p>
							<div>
						 		<div id="waiting6"></div>
						 		<a href="#" id="waiting6_25">25%</a> | <a href="#" id="waiting6_50">50%</a> | <a href="#" id="waiting6_75">75%</a> | <a href="#" id="waiting6_100">100%</a>
							</div>

<pre class="ex code" data-lllanguage="js">
var $el = $('#waiting6');
$el.waiting({ 
	className: 'waiting-blocks',
	elements: 10, 
	auto: true 
});

// clicking the links to 25, 50, 75, 100%
$('#waiting6_25').click(function(e){
	e.preventDefault();
	$el.waiting('option',{ percent: 25 });	
});
$('#waiting6_50').click(function(e){
	e.preventDefault();
	$el.waiting('option',{ percent: 50 });	
});
$('#waiting6_75').click(function(e){
	e.preventDefault();
	$el.waiting('option',{ percent: 75 });	
});
$('#waiting6_100').click(function(e){
	e.preventDefault();
	$el.waiting('option',{ percent: 100 });	
});
</pre>
						</div>


				<h2 id="Options">The Options</h2>

<pre class="code" data-lllanguage="js">
// string - which tag type to use
tag: 'div',

// string - class name to use
className: 'waiting',

// integer - number of items to create
elements: '5',

// hash - hash of css properties for the parent element
// stylesheets are suggested but this is useful for size adjustments
css: {},

// hash - hash of css properties for each child element
// stylesheets are suggested but this is useful for size adjustments
elementsCss: {},

// integer - radius specifies to position in a circle
// defaults to false, indicating no circular position
radius: false,

// boolean - allows scene to roll over before completing
fluid: true,

// integer - speed to animate
speed: 100,

// the limit to allow, integer 0-100 for percent
percent: 100,

// boolean - whether to auto play
auto: false
</pre>

				<h2 id="Methods">The Methods</h2>

<pre class="code" data-lllanguage="js">
// Initialize a waiting instance
$el.waiting({});

// Enable a waiting, only begins playing if auto: true
$el.waiting('enable');

// Play the animation
$el.waiting('play');

// Pause the animation, leaves all animations styles in place
$el.waiting('pause');

// Disable a waiting, removes all animation styles
$el.waiting('disable');

// Destroy a waiting
$el.waiting('destroy');

// Get or set an option. When value is provided a Set takes place
// If only the key is provided the value will be retrieved
$el.waiting('option', key, value);

// if an object is passed each setting will be applied
$el.waiting('option', { speed: 500 });

// set global defaults
$.waiting.setDefaults({ auto: true });
</pre>
				
				<h2 id="Events">The Events</h2>
<pre class="code" data-lllanguage="js">
// when the control is enabled/created
$el.bind('enable.waiting', function(e){});

// when the control starts playing
$el.bind('play.waiting', function(e){});

// when the control is paused
$el.bind('pause.waiting', function(e){});

// when the control is disabled
$el.bind('disable.waiting', function(e){});

// when the control is destroyed
$el.bind('destroy.waiting', function(e){});
</pre>

			</div>
		</div>

		<script type="text/javascript"> /*
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		*/</script> 
		<script type="text/javascript"> /*
		try {
		var pageTracker = _gat._getTracker("UA-7602218-1");
		pageTracker._trackPageview();
		} catch(err) {}*/</script>

	</body>
</html>
