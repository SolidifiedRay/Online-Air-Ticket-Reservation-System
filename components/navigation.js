var header = document.createElement('header');

var inner = '<nav class="navbar navbar-default navbar-fixed-top navbar-shadow" role="navigation">';
inner += '		<div class="container-fluid">';
inner += '    			<div class="navbar-header">';
inner += '     				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">';
inner += '    					<span class="icon-bar"></span>';
inner += '    					<span class="icon-bar"></span>';
inner += '    					<span class="icon-bar"></span>';
inner += '    				</button>';
inner += '        			<a class="navbar-brand" href="#">';
inner += '        				<font class="navbar-title"><b>Onelin Air Ticket</b> Reservation System</font>';
inner += '        			</a>';
inner += '    			</div>';
inner += '    			<div class="collapse navbar-collapse" id="navbar-menu">';
inner += '        			<ul class="nav navbar-nav">';
inner += '        				<li class="cative"><a href="index.html" class="navbar-subtitle">Main</a></li>';
inner += '        				<li class="cative"><a href="view.php" class="navbar-subtitle">View</a></li>';
inner += '        				<li class="cative"><a href="search.php" class="navbar-subtitle">Search</a></li>';
inner += '        				<li class="cative"><a href="https://github.com/SolidifiedRay/Online-Air-Ticket-Reservation-System" class="navbar-subtitle" target="_blank">About</a></li>';
inner += '        				<li class="cative"><a href="login.html" class="navbar-subtitle">Login</a></li>';
inner += '        				<li class="cative"><a href="user.php" class="navbar-subtitle">My Page</a></li>';
inner += '        			</ul>';
inner += '    			</div>';
inner += '    		</div>';
inner += '		</nav>';


header.innerHTML = inner;

var publicHeader = document.body.querySelector('public-header');
publicHeader.parentNode.replaceChild(header, publicHeader);