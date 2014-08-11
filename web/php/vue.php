<!DOCTYPE html>
<html class="csstransforms no-csstransforms3d csstransitions"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style><link href="Fichiers_Web/css.css" rel="stylesheet" type="text/css"><style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}</style>
		<title>Faitout - Social</title>
		
		<meta charset="utf-8">
		<meta name="description" content="Faitout - Social.">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<link rel="icon" href="http://mercandalli.com/faitout_web/Faitout_web_fichiers/favicon-57x57.png">
		<link rel="stylesheet" href="Fichiers_Web/main.css">
	<script style="" src="Fichiers_Web/commonmaputilmarker.js" charset="UTF-8" type="text/javascript"></script><script src="Fichiers_Web/onion.js" charset="UTF-8" type="text/javascript"></script><script src="Fichiers_Web/controlsstats.js" charset="UTF-8" type="text/javascript"></script></head>
	
	<body class="bg-blur bg-blur7">
		<div style="display: block;" id="bg" class="bg"></div>
		
		<div style="display: none;" id="loader" class="loader"><div><span></span><p>Please wait, page is loading...</p></div></div>
		
		<div style="position: relative; overflow: hidden; height: 2170px;" id="page" class="page isotope loaded">
			<!-- avatar item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 30px);" data-sort="1" class="item item-small item-avatar isotope-item">
				<?php print '<img src="'.$utilisateur->url_image_profil.'" alt="" />'; ?>
			</div>
			<!-- avatar item -->
			
			<!-- wellcome item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 30px);" data-sort="2" class="item item-large item-wellcome isotope-item">
				<h1>Salut <strong><?php echo $utilisateur->pseudo; ?></strong> !</h1>
				<p>Description : <?php echo $utilisateur->description; ?></p>
			</div>
			<!--/ wellcome item -->
			
			<!-- nav item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 150px);" data-sort="3" class="item item-large item-nav isotope-item">
				<ul id="item-nav">
					<li><a href="#page=home" class="active"><i class="icon-home"></i>TouT</a></li>
					<li><a class="" href="#page=skills"><i class="icon-magic"></i>Rangs</a></li>
					<li><a class="" href="#page=portfolio"><i class="icon-briefcase"></i>Photos</a></li>
					<li><a class="" href="#page=reviews"><i class="icon-comments-alt"></i>Messages</a></li>
					<li><a class="" href="#page=blog"><i class="icon-file"></i>Blog</a></li>
					<li><a href="#page=contacts"><i class="icon-phone"></i>Proches</a></li>
				</ul>
			</div>
			<!--/ nav item -->
			
			<!-- back item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: translate(0px, 280px) scale(0.001);" href="#page=portfolio" id="item-back-portfolio" class="item item-small item-color-red item-back isotope-item isotope-hidden">
				<i class="icon-remove-sign"></i>
				<p>Back to portfolio items list</p>
			</a>
			<!--/ back item -->
			
			<!-- back item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" href="#page=blog" id="item-back-blog" class="item item-small item-color-red item-back isotope-item isotope-hidden">
				<i class="icon-remove-sign"></i>
				<p>Back to blog items list</p>
			</a>
			<!--/ back item -->
			
			<!-- portfolio item (1) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 280px) scale(1); opacity: 1;" class="item item-visible item-portfolio isotope-item">
				<div>
					<img class="" src="Fichiers_Web/port1-1.jpg" data-src="Fichiers_Web/port1-1.jpg" alt="">
					<img class="" src="Fichiers_Web/port1-2.jpg" data-src="Fichiers_Web/port1-2.jpg" alt="">
					<img src="Fichiers_Web/port1-3.jpg" alt="" class="active">
				</div>
				<span class="prev icon-chevron-left"></span>
				<a href="#page=portfolio&amp;id=1" class="zoom icon-fullscreen"></a>
				<span class="next icon-chevron-right"></span>
				<p>Project with 3 previews and 3 images</p>
			</div>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: translate(240px, 280px) scale(0.001);" id="item-portfolio1" class="item item-large item-portfolio-details isotope-item isotope-hidden">
				<div class="slideshow">
					<div>
						<img src="Fichiers_Web/port1-1.jpg" data-src="Fichiers_Web/port1-1.jpg" alt="">
						<img src="Fichiers_Web/port1-2.jpg" data-src="Fichiers_Web/port1-2.jpg" alt="">
						<img src="Fichiers_Web/port1-3.jpg" data-src="Fichiers_Web/port1-3.jpg" alt="" class="active">
					</div>
					<span class="prev icon-chevron-left"></span>
					<span class="next icon-chevron-right"></span>
				</div>
				<div class="text">
					<h1>Project with 3 previews and 3 images</h1>
					<h4>Working demo: <a href="#">www.projectwith3images.com</a></h4>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h2>Example of h2 header</h2>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h3>Example of h3 header</h3>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
				</div>
			</div>
			<!--/ portfolio item (1) -->
			
			<!-- post item (with image and comments) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 280px) scale(1); opacity: 1;" href="#page=blog&amp;id=1" class="item item-visible item-post isotope-item">
				<h3>Blog post with image and comments</h3>
				<img src="Fichiers_Web/post1-thumb.jpg" alt="">
				<p><span><em class="icon-comment-alt"></em>&nbsp; 3 comments</span><em class="icon-time"></em>&nbsp; 2 hours ago</p>
			</a>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" id="item-post1" class="item item-large item-post-details isotope-item isotope-hidden">
				<div class="pic"><img src="Fichiers_Web/post1.jpg" data-src="pics/post1.jpg" alt=""></div>
				<div class="text">
				<h1>Blog post with image and comments</h1>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h2>Example of h2 header</h2>
					<p>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
					<h3>Example of h3 header</h3>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
				</div>
				<dl>
					<dt>
						<img src="Fichiers_Web/review1.jpg" alt="">
						Jenna Williams
						<span>5 days ago</span>
					</dt>
					<dd>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In 
vitae nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum
 ut sapien. Proin nisi neque, facilisis semper rutrum.</dd>
					<dt class="lv2">
						<img src="Fichiers_Web/review3.jpg" alt="">
						Mark Klarkson
						<span>3 hours ago</span>
					</dt>
					<dd class="lv2">Justo, rutrum eu ornare a, mattis ut leo. In vitae 
nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Proin nisi neque, facilisis semper.</dd>
					<dt>
						<img src="Fichiers_Web/review2.jpg" alt="">
						Jonh Richards
						<span>13 days ago</span>
					</dt>
					<dd>Ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.
 Proin nisi neque.</dd>
				</dl>
				<form action="">
					<h3>Leave a comment</h3>
					<input maxlength="30" placeholder="Enter your name (max 30 characters)" type="text">
					<input maxlength="50" placeholder="Enter your e-mail (max 50 characters)" type="text">
					<textarea name="" cols="1" rows="1" placeholder="Enter your comment"></textarea>
					<button type="submit">Submit</button>
				</form>				
			</div>
			<!--/ post item (with image and comments) -->
			
			<!-- skill item (html) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(960px, 280px) scale(1); opacity: 1;" class="item item-visible item-small item-color-red item-skill isotope-item">
				<div>
					<em class=<?php echo '"value'.$utilisateur->rang_chat_pourcent_round.'"';?>></em>
					<span><?php echo $utilisateur->rang_chat_pourcent;?>%</span>
				</div>
				<p>Chat Rang</p>
			</div>
			<!--/ skill item (html) -->
			
			<!-- social item (twitter) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 520px) scale(1); opacity: 1;" href="https://twitter.com/vokycomua" target="_blank" class="item item-visible item-small item-color-cyan item-social isotope-item">
				<i class="icon-twitter"></i>
				<p>Follow me on Twitter</p>
			</a>
			<!--/ social item (twitter) -->
			
			<!-- review item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 520px) scale(1); opacity: 1;" class="item item-visible item-review isotope-item">
				<i class="icon-quote-right"></i>
				<img src="Fichiers_Web/review2.jpg" alt="">
				<dl>
					<dt>Jonh Richards</dt>
					<dt>Project:</dt>
					<dd><a href="#">brand design</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">TMS international</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi 
neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Suspendisse augue tellus, sollicitudin 
ut tristique, nullam viverra vestibulum interdum. Suspendisse augue 
tellus, sollicitudin ut tristique ac, ornare in leo.</p>
			</div>
			<!--/ review item -->
			
			<!-- post item (with image and columns) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(720px, 520px) scale(1); opacity: 1;" href="#page=blog&amp;id=4" class="item item-visible item-post isotope-item">
				<h3>Blog post with image and columns</h3>
				<img src="Fichiers_Web/post4-thumb.jpg" alt="">
				<p><span><em class="icon-comment-alt"></em>&nbsp; 0 comments</span><em class="icon-time"></em>&nbsp; 3 days ago</p>
			</a>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" id="item-post4" class="item item-large item-post-details isotope-item isotope-hidden">
				<div class="pic"><img src="Fichiers_Web/post4.jpg" data-src="pics/post4.jpg" alt=""></div>
				<div class="text">
					<h1>Blog post with image and columns</h1>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>				
					<div class="columns">
						<div class="column column2">
							<h3>Column 2/6</h3>
							<p>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc lacus.</p>	
						</div>
						<div class="column column2">
							<h3>Column 2/6</h3>
							<p>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc lacus.</p>	
						</div>
						<div class="column column2">
							<h3>Column 2/6</h3>
							<p>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc lacus.</p>	
						</div>
					</div>					
					<div class="columns">
						<div class="column column3">
							<h3>Column 3/6</h3>
							<p>Proin nisi neque, facilisis semper rutrum ut sapien fermentum.
 Nulla ac velit non est sollicitudin facilis. Nullam viverra vestibulum.</p>	
						</div>
						<div class="column column3">
							<h3>Column 3/6</h3>
							<p>Proin nisi neque, facilisis semper rutrum ut sapien fermentum .
 Nulla ac velit non est sollicitudin facilis. Nullam viverra vestibulum.</p>	
						</div>
					</div>					
					<div class="columns">
						<div class="column column4">
							<h3>Column 4/6</h3>
							<p>Nulla ac velit non est sollicitudin facilisis. Nullam viverra 
vestibulum interdum. Suspendisse augue tellus, sollicitudin ut tristique
 ac, ornare in leo. Semper rutrum a, fermentum ut sapien.</p>
						</div>
						<div class="column column2">
							<h3>Column 2/6</h3>
							<p>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc lacus.</p>	
						</div>
					</div>
				</div>
				<dl>
					<dt></dt>
					<dd></dd>
				</dl>
				<form action="">
					<h3>Leave a comment</h3>
					<input maxlength="30" placeholder="Enter your name (max 30 characters)" type="text">
					<input maxlength="50" placeholder="Enter your e-mail (max 50 characters)" type="text">
					<textarea name="" cols="1" rows="1" placeholder="Enter your comment"></textarea>
					<button type="submit">Submit</button>
				</form>	
			</div>
			<!--/ post item (with image, no comments) -->
			
			<!-- skill item (css) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 760px) scale(1); opacity: 1;" class="item item-visible item-small item-color-green item-skill isotope-item">
				<div>
					<em class="value100"></em>
					<span>100%</span>
				</div>
				<p>CSS2 &amp; CSS3</p>
			</div>
			<!--/ skill item (css) -->
			
			<!-- post item (with lists) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 760px) scale(1); opacity: 1;" href="#page=blog&amp;id=2" class="item item-visible item-small item-post isotope-item">
				<h3>Post with lists</h3>
				<img src="Fichiers_Web/post2-thumb.jpg" alt="">
				<p><span><em class="icon-comment-alt"></em>&nbsp; 6</span><em class="icon-time"></em>&nbsp; 7 days ago</p>
			</a>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" id="item-post2" class="item item-large item-post-details isotope-item isotope-hidden">
				<div class="pic"><img src="Fichiers_Web/post2.jpg" data-src="Fichiers_Web/post2.jpg" alt=""></div>
				<div class="text">
					<h1>Blog post with lists</h1>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<div class="columns">
						<div class="column column3">
							<h3>Simple unordered list</h3>
							<ul>
								<li>Roin nisi neque interdum, facilisis semper rutrum interdum, ornare in leo.</li>
								<li>Ipsum justo, rutrum eu ornare a, mattis ut sollicitudin ut tristique.</li>
								<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare.</li>
								<li>Nisi neque est sollicitudin.</li>
							</ul>
						</div>
						<div class="column column3">
							<h3>Simple ordered list</h3>
							<ol>
								<li>Roin nisi neque interdum, facilisis semper rutrum interdum, ornare in leo.</li>
								<li>Ipsum justo, rutrum eu ornare a, mattis ut sollicitudin ut tristique.</li>
								<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare.</li>
								<li>Nisi neque est sollicitudin.</li>
							</ol>
						</div>
					</div>
					<div class="columns">
						<div class="column column3">
							<h3>Nested unordered list</h3>
							<ul>
								<li>Roin nisi neque interdum, facilisis semper rutrum interdum, ornare in leo.</li>
								<li>
									Ipsum justo, rutrum eu ornare a, mattis ut sollicitudin ut tristique;
									<ul>
										<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare;</li>
										<li>Nisi neque est sollicitudin.</li>
									</ul>
								</li>
								<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare;</li>
								<li>Nisi neque est sollicitudin.</li>
							</ul>
						</div>
						<div class="column column3">
							<h3>Nested ordered list</h3>
							<ol>
								<li>roin nisi neque interdum, facilisis semper rutrum interdum, ornare in leo;</li>
								<li>
									Ipsum justo, rutrum eu ornare a, mattis ut sollicitudin ut tristique;
									<ol>
										<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare;</li>
										<li>Nisi neque est sollicitudin.</li>
									</ol>
								</li>
								<li>Roin nisi neque, facilisis semper rutrum a, fermentum ut sapien facilisis ornare;</li>
								<li>Nisi neque est sollicitudin.</li>
							</ol>
						</div>
					</div>
				</div>
				<dl>
					<dt>
						<img src="Fichiers_Web/review1.jpg" alt="">
						Jenna Williams
						<span>5 days ago</span>
					</dt>
					<dd>Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In 
vitae nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum
 ut sapien. Proin nisi neque, facilisis semper rutrum.</dd>
					<dt class="lv2">
						<img src="Fichiers_Web/review3.jpg" alt="">
						Mark Klarkson
						<span>3 hours ago</span>
					</dt>
					<dd class="lv2">Justo, rutrum eu ornare a, mattis ut leo. In vitae 
nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Proin nisi neque, facilisis semper.</dd>
				</dl>
				<form action="">
					<h3>Leave a comment</h3>
					<input maxlength="30" placeholder="Enter your name (max 30 characters)" type="text">
					<input maxlength="50" placeholder="Enter your e-mail (max 50 characters)" type="text">
					<textarea name="" cols="1" rows="1" placeholder="Enter your comment"></textarea>
					<button type="submit">Submit</button>
				</form>
			</div>
			<!--/ post item (with lists) -->
			
			<!-- portfolio item (2) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 760px) scale(1); opacity: 1;" class="item item-visible item-portfolio isotope-item">
				<div>
					<img src="Fichiers_Web/port2-1.jpg" alt="" class="active">
					<img src="Fichiers_Web/port2-2.jpg" data-src="Fichiers_Web/port2-2.jpg" alt="">
					<img src="Fichiers_Web/port2-3.jpg" data-src="Fichiers_Web/port2-3.jpg" alt="">
					<img src="Fichiers_Web/port2-4.jpg" data-src="Fichiers_Web/port2-4.jpg" alt="">
					<img src="Fichiers_Web/port2-5.jpg" data-src="Fichiers_Web/port2-5.jpg" alt="">
				</div>
				<span class="prev icon-chevron-left"></span>
				<a href="#page=portfolio&amp;id=2" class="zoom icon-fullscreen"></a>
				<span class="next icon-chevron-right"></span>
				<p>Project with 5 previews and 5 images</p>
			</div>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" id="item-portfolio2" class="item item-large item-portfolio-details isotope-item isotope-hidden">
				<div class="slideshow">
					<div>
						<img src="Fichiers_Web/port2-1.jpg" alt="" class="active">
						<img src="Fichiers_Web/port2-2.jpg" data-src="Fichiers_Web/port2-2.jpg" alt="">
						<img src="Fichiers_Web/port2-3.jpg" data-src="Fichiers_Web/port2-3.jpg" alt="">
						<img src="Fichiers_Web/port2-4.jpg" data-src="Fichiers_Web/port2-4.jpg" alt="">
						<img src="Fichiers_Web/port2-5.jpg" data-src="Fichiers_Web/port2-5.jpg" alt="">
					</div>
					<span class="prev icon-chevron-left"></span>
					<span class="next icon-chevron-right"></span>
				</div>
				<div class="text">
					<h1>Project with 5 previews and 5 images</h1>
					<h4>Working demo: <a href="#">www.projectwith5images.com</a></h4>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h2>Example of h2 header</h2>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h3>Example of h3 header</h3>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
				</div>
			</div>
			<!--/ portfolio item (2) -->
			
			<!-- skill item (javascript) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(960px, 760px) scale(1); opacity: 1;" class="item item-visible item-small item-color-cyan item-skill isotope-item">
				<div>
					<em class="value75"></em>
					<span>75%</span>
				</div>
				<p>JavaScript &amp; jQuery</p>
			</div>
			<!--/ skill item (javascript) -->
			
			<!-- review item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1000px) scale(1); opacity: 1;" class="item item-visible item-visible item-review isotope-item">
				<i class="icon-quote-right"></i>
				<img src="Fichiers_Web/review4.jpg" alt="">
				<dl>
					<dt>Lina Newman</dt>
					<dt>Project:</dt>
					<dd><a href="#">front-end development</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">Lina and Co</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi 
neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Suspendisse augue tellus, sollicitudin 
ut tristique, nullam viverra vestibulum interdum. Suspendisse augue 
tellus, sollicitudin ut tristique ac, ornare in leo.</p>
			</div>
			<!--/ review item -->
			
			<!-- review item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 1000px) scale(1); opacity: 1;" class="item item-visible item-small item-review isotope-item">
				<i class="icon-quote-right"></i>
				<dl>
					<dt>Top Summer</dt>
					<dt>Project:</dt>
					<dd><a href="#">package design</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">undesputed</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi 
neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit.</p>
			</div>
			<!--/ review item -->
			
			<!-- social item (facebook) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(720px, 1000px) scale(1); opacity: 1;" href="http://www.facebook.com/voky.com.ua" target="_blank" class="item item-visible item-small item-color-blue item-social isotope-item">
				<i class="icon-facebook"></i>
				<p>Visit my Facebook page</p>				
			</a>
			<!--/ social item (facebook) -->
			
			<!-- portfolio item (small, single image) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(960px, 1000px) scale(1); opacity: 1;" class="item item-visible item-small item-portfolio isotope-item">
				<div>
					<img src="Fichiers_Web/port3-1-thumb.jpg" alt="" class="active">
				</div>
				<a href="#page=portfolio&amp;id=3" class="zoom icon-fullscreen"></a>
				<p>Project with single image</p>
			</div>
			
			<div style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" id="item-portfolio3" class="item item-large item-portfolio-details isotope-item isotope-hidden">
				<div class="pic"><img src="Fichiers_Web/port3-1.jpg" alt="" height="316" width="660"></div>
				<div class="text">
					<h1>Project with single image</h1>
					<h4>Working demo: <a href="#">www.projectwith1image.com</a></h4>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h2>Example of h2 header</h2>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<h3>Example of h3 header</h3>
					<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi
 neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Nullam viverra vestibulum interdum. 
Suspendisse augue tellus, sollicitudin ut tristique ac, ornare in leo. 
Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae nunc 
lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
					<p>Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien. Aliquam ipsum justo, rutrum eu ornare a, mattis ut leo. In vitae
 nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut 
sapien.</p>
				</div>
			</div>
			<!--/ portfolio item (small, single image) -->
			
			<!-- social item (dribbble) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1240px) scale(1); opacity: 1;" href="http://dribbble.com/voky" target="_blank" class="item item-visible item-small item-color-pink item-social isotope-item">
				<i class="foundicon-dribbble"></i>
				<p>Explore my Dribbble shots</p>
			</a>
			<!--/ social item (dribbble) -->
			
			<!-- skill item (photoshop) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 1240px) scale(1); opacity: 1;" class="item item-visible item-small item-color-blue item-skill isotope-item">
				<div>
					<em class="value50"></em>
					<span>50%</span>
				</div>
				<p>Photoshop</p>
			</div>
			<!--/ skill item (photoshop) -->
			
			<!-- skill item (fireworks) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 1240px) scale(1); opacity: 1;" class="item item-visible item-small item-color-yellow item-skill isotope-item">
				<div>
					<em class="value50"></em>
					<span>50%</span>
				</div>
				<p>Fireworks</p>
			</div>
			<!--/ skill item (fireworks) -->
			
			<!-- review item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(720px, 1240px) scale(1); opacity: 1;" class="item item-visible item-review isotope-item">
				<i class="icon-quote-right"></i>
				<img src="Fichiers_Web/review1.jpg" alt="">
				<dl>
					<dt>Jenna Williams</dt>
					<dt>Project:</dt>
					<dd><a href="#">corporate website</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">industrial media</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi 
neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Suspendisse augue tellus, sollicitudin 
ut tristique, nullam viverra vestibulum interdum. Suspendisse augue 
tellus, sollicitudin ut tristique ac, ornare in leo.</p>
			</div>
			<!--/ review item -->
			
			<!-- skill item (illustrator) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1480px) scale(1); opacity: 1;" class="item item-visible item-small item-color-orange item-skill isotope-item">
				<div>
					<em class="value25"></em>
					<span>25%</span>
				</div>
				<p>Illustrator</p>
			</div>
			<!--/ skill item (illustrator) -->
			
			<!-- social item (rss) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 1480px) scale(1); opacity: 1;" class="item item-visible item-small item-color-orange item-social isotope-item">
				<i class="foundicon-rss"></i>
				<p>Grab my RSS feed</p>
			</a>
			<!--/ social item (rss) -->
			
			<!-- review item -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 1480px) scale(1); opacity: 1;" class="item item-visible item-review isotope-item">
				<i class="icon-quote-right"></i>
				<img src="Fichiers_Web/review3.jpg" alt="">
				<dl>
					<dt>Mark Klarkson</dt>
					<dt>Project:</dt>
					<dd><a href="#">website design</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">Klarkson promotions</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi 
neque, facilisis semper rutrum a, fermentum ut sapien. Nulla ac velit 
non est sollicitudin facilisis. Suspendisse augue tellus, sollicitudin 
ut tristique, nullam viverra vestibulum interdum. Suspendisse augue 
tellus, sollicitudin ut tristique ac, ornare in leo.</p>
			</div>
			<!--/ review item -->
			
			<!-- social item (youtube) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(960px, 1480px) scale(1); opacity: 1;" href="#" class="item item-visible item-small item-color-red item-social isotope-item">
				<i class="foundicon-youtube"></i>
				<p>Watch my YouTube videos</p>
			</a>
			<!--/ social item (youtube) -->
			
			<!-- skill item (php) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1720px) scale(1); opacity: 1;" class="item item-visible item-small item-color-pink item-skill isotope-item">
				<div>
					<em class="value25"></em>
					<span>25%</span>
				</div>
				<p>PHP4 &amp; PHP5</p>
			</div>
			<!--/ skill item (php) -->
			
			<!-- skill item (mysql) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 1720px) scale(1); opacity: 1;" class="item item-visible item-small item-color-purple item-skill isotope-item">
				<div>
					<em class="value25"></em>
					<span>25%</span>
				</div>
				<p>MySQL</p>
			</div>
			<!--/ skill item (mysql) -->
			
			<!-- social item (google) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(480px, 1720px) scale(1); opacity: 1;" href="#" class="item item-visible item-small item-color-green item-social isotope-item">
				<i class="icon-google-plus"></i>
				<p>View my Google Plus profile</p>
			</a>
			<!--/ social item (google) -->
			
			<!-- social item (skype) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(720px, 1720px) scale(1); opacity: 1;" class="item item-visible item-small item-color-cyan item-social isotope-item">
				<i class="foundicon-skype"></i>
				<p>MarkusFisher</p>
			</a>
			<!--/ social item (skype) -->
			
			<!-- social item (phone) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(960px, 1720px) scale(1); opacity: 1;" class="item item-visible item-small item-color-yellow item-social isotope-item">
				<i class="icon-phone"></i>
				<p>Phone number</p>
			</a>
			<!--/ social item (phone) -->
			
			<!-- review item (small, Bob Smith) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1960px) scale(1); opacity: 1;" class="item item-visible item-small item-review isotope-item">
				<i class="icon-quote-right"></i>
				<dl>
					<dt>Bob Smith</dt>
					<dt>Project:</dt>
					<dd><a href="#">logo design</a></dd>
					<dt>Company:</dt>
					<dd><a href="#" class="external">websurfers</a></dd>
				</dl>
				<p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
			</div>
			<!--/ review item -->
			
			<!-- social item (map) -->
			<a style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 1960px) scale(1); opacity: 1;" id="item-map" class="item item-visible item item-color-orange item-social item-map isotope-item">
				<i class="icon-map-marker"></i>
				<p><span>close</span>250 Elizabeth Street, Melbourne, Australia</p>
				<div style="background-color: rgb(229, 227, 223); overflow: hidden;" id="map" class="map"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 20px; top: -101px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 20px; top: 155px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -236px; top: -101px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -236px; top: 155px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 276px; top: -101px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 276px; top: 155px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 20px; top: -101px;"><canvas width="384" height="384" style="-moz-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;" draggable="false"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 20px; top: 155px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -236px; top: -101px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -236px; top: 155px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 276px; top: -101px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 276px; top: 155px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 460px; height: 220px;"><img src="Fichiers_Web/StaticMapService.png" style="width: 460px; height: 220px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 20px; top: 155px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt_005.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 20px; top: -101px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt_002.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -236px; top: -101px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 276px; top: -101px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt_006.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -236px; top: 155px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt_004.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 276px; top: 155px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="Fichiers_Web/vt_003.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Cliquez ici pour afficher cette zone sur Google&nbsp;Maps" href="http://maps.google.com/maps?ll=-37.812611,144.962604&amp;z=15&amp;t=m&amp;hl=fr&amp;gl=US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img draggable="false" src="Fichiers_Web/google_white2_hdpi.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 283px; bottom: 0px; width: 128px;" class="gmnoprint"><div class="gm-style-cc" style="-moz-user-select: none;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer;">Données cartographiques</a><span style="display: none;">Données cartographiques ©2014 Google</span></div></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 80px; top: 20px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Données cartographiques</div><div style="font-size: 13px;">Données cartographiques ©2014 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="Fichiers_Web/mapcnt3.png" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Données cartographiques ©2014 Google</div></div><div draggable="false" style="z-index: 1000001; position: absolute; -moz-user-select: none; right: 168px; bottom: 0px;" class="gmnoprint gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_blank" href="http://www.google.com/intl/fr_US/help/terms_maps.html" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Conditions d'utilisation</a></div></div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 0px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="http://maps.google.com/maps?ll=-37.812611,144.962604&amp;z=15&amp;t=m&amp;hl=fr&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" title="Signaler à Google une erreur dans la carte routière ou les images" target="_new">Signaler une erreur cartographique</a></div></div><div controlheight="39" controlwidth="20" draggable="false" style="margin: 5px; -moz-user-select: none; position: absolute; left: 0px; top: 0px;" class="gmnoprint"><div controlheight="0" controlwidth="0" style="opacity: 0.6; display: none; position: absolute;" class="gmnoprint"><div title="Faire pivoter la carte à 90°" style="width: 22px; height: 22px; overflow: hidden; position: absolute; cursor: pointer;"><img draggable="false" src="Fichiers_Web/mapcnt3_hdpi.png" style="position: absolute; left: -38px; top: -360px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; left: 0px; top: 0px;" controlheight="39" controlwidth="20" class="gmnoprint"><div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img draggable="false" src="Fichiers_Web/mapcnt3_hdpi.png" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div title="Zoom avant" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div><div title="Zoom arrière" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div></div></div><div style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; text-align: left; width: 85px; right: 0px; top: 0px;" class="gmnoprint gm-style-mtc" id="maptype"><div title="Changer le style de carte" draggable="false" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 6px; border-radius: 2px; background-clip: padding-box; border: 1px solid rgba(0, 0, 0, 0.15); box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); font-weight: 500;">Plan<img style="-moz-user-select: none; border: 0px none; padding: 0px; margin: -2px 0px 0px; position: absolute; right: 6px; top: 50%; width: 7px; height: 4px;" draggable="false" src="Fichiers_Web/arrow-down.png"></div><div style="background-color: white; z-index: -1; padding-top: 2px; background-clip: padding-box; border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); position: relative; text-align: left; display: none;"><div title="Afficher un plan de ville" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px; font-weight: 500;">Plan</div><div title="Afficher les images satellite" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px;">Satellite</div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235);"></div><div title="Afficher le relief sur la carte" draggable="false" style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="Fichiers_Web/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Relief</label></div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235); display: none;"></div><div title="Pour afficher la vue à 45°, effectuez un zoom avant." draggable="false" style="color: rgb(184, 184, 184); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="Fichiers_Web/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">45°</label></div><div title="Afficher les images satellite avec le nom des rues" draggable="false" style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img draggable="false" src="Fichiers_Web/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Légendes</label></div></div></div></div></div>
			</a>
			<!--/ social item (map) -->			
						
			<!-- social item (email) -->
			<div style="position: absolute; left: 0px; top: 0px; transform: translate(720px, 1960px) scale(1); opacity: 1;" id="item-email" class="item item-visible item-color-purple item-social item-email isotope-item">
				<p>Drop me a Line</p>
				<i class="icon-envelope"></i>
				<form action="">
					<input name="name" maxlength="30" placeholder="Enter your name" type="text">
					<input name="email" maxlength="50" placeholder="Enter your e-mail" type="text">
					<textarea name="message" cols="1" rows="1" placeholder="Enter your message"></textarea>
					<button type="submit">Submit</button>
					<button type="button">Close</button>
					<div class="error"></div>
					<div class="success"></div>
				</form>
			</div>
			<!--/ social item (email) -->	
						
			<!-- load more works -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: translate(0px, 520px) scale(0.001);" href="#" data-page="2" data-sort="10" id="load-more-works" class="item item-portfolio item-more isotope-item isotope-hidden">
				<i class="icon-download-alt"></i>
				<p>Load more works</p>
			</a>
			<!--/ load more item -->
						
			<!-- load more posts -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: translate(0px, 520px) scale(0.001);" href="#" data-page="2" data-sort="10" id="load-more-posts" class="item item-post item-more isotope-item isotope-hidden">
				<i class="icon-download-alt"></i>
				<p>Load more posts</p>
			</a>
			<!--/ load more item -->
			
			<!-- next work item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" href="#" data-sort="10" id="item-next" class="item item-small item-color-green item-next isotope-item isotope-hidden">
				<i class="icon-circle-arrow-up"></i>
				<p>View next work</p>
			</a>
			<!--/ next work item -->
			
			<!-- prev work item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: translate(960px, 280px) scale(0.001);" href="#page=portfolio&amp;id=2" data-sort="100" id="item-prev" class="item item-small item-color-green item-prev isotope-item isotope-hidden">
				<i class="icon-circle-arrow-down"></i>
				<p>View previous work</p>
			</a>
			<!--/ prev work item -->
			
			<!-- newer post item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" href="#" data-sort="10" id="item-newer" class="item item-small item-color-green item-newer isotope-item isotope-hidden">
				<i class="icon-circle-arrow-up"></i>
				<p>View newer post</p>
			</a>
			<!--/ newer post item -->
			
			<!-- older post item -->
			<a style="position: absolute; left: 0px; top: 0px; opacity: 0; transform: scale(0.001);" href="#" data-sort="10" id="item-older" class="item item-small item-color-green item-older isotope-item isotope-hidden">
				<i class="icon-circle-arrow-down"></i>
				<p>View older post</p>
			</a>
			<!--/ older post item -->
		</div>
		
		<script src="Fichiers_Web/jquery-1.js"></script>
		<script src="Fichiers_Web/jquery.js"></script>
		<script src="Fichiers_Web/jquery_002.js"></script>
		<!--[if lt IE 10]><script src="js/jquery.placeholder.min.js"></script><![endif]-->
		<script src="Fichiers_Web/main.js"></script>
	
<script src="Fichiers_Web/js" type="text/javascript"></script><script src="Fichiers_Web/main_002.js"></script></body></html>