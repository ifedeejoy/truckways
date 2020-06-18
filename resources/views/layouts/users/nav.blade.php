<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-light lighten-5">
	<a class="navbar-brand col-sm-3 text-center" href="#">
		<strong class="title">{{ config('app.name') }}</strong class="title">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
	  aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
	  	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent-555">
		<ul class="navbar-nav mr-auto">
		</ul>
		<ul class="navbar-nav mx-auto nav-flex-icons">
			<li class="nav-item hidden-nav">
				<a href="#" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="#" class="nav-link">Loads</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="#" class="nav-link">Trucks</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="#" class="nav-link">Bids</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="#" class="nav-link">Payment History</a>
			</li>
			<li class="nav-item avatar ml-2">
				<a class="nav-link p-0" href="#">
					<img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg" class="rounded-circle z-depth-0"
					alt="avatar image" height="40">
				</a>
			</li>
			<li class="nav-item dropdown ml-2">
				<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}
				</a>
				<div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
					<a href="{{ url('/logout') }}" class="dropdown-item">Logout</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
 <!--/.Navbar -->