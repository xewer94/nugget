<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
	
				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div id="zaglavljeDole">
					<div class="omotac">
						<div id="logo">
							<h1><a href="{{ route('home') }}">Nugget</a></h1>
							<p>Watches for men and women</p>
						</div>
						<div id="dugmeMeni">
							<a href="#">Menu <i class="fa fa-chevron-down"></i></a>
						</div>
						<div id="meni">
							<ul>
								<li ><a href="{{ url('/') }}">Home</a></li>
								<li ><a href="{{ route('watches.show', ['slug' => 'Men']) }}">Men</a></li>
								<li ><a href="{{ route('watches.show', ['slug' => 'Women']) }}">Women</a></li>
								<li ><a href="">Contact us</a></li>		
							</ul>
						</div>
						
						<div id="search">
							<form action="{{ route('search') }}" method="POST">
								{{ csrf_field() }}
								<input type="text" name="search" placeholder="Trazi">
								<button type="submit" class="btn btn-primary">Search</button>
							</form>
						</div>
						
						<div class="cistac"></div>
					</div>
				</div>
	
			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					&nbsp;
				</ul>
	
				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@if (Auth::guest())
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>
	
							<ul class="dropdown-menu" role="menu">
								<li><a href="/nugget/public/dashboard">Dashboard</a></li>
								<li>
									<a href="{{ route('logout') }}"
										onclick="event.preventDefault();
												  document.getElementById('logout-form').submit();">
										Logout
									</a>
	
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>