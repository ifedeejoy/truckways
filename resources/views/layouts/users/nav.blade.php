<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-light lighten-5">
	<a class="navbar-brand col-sm-3 text-center" href="/">
		<strong class="title"><img src="/images/logo-black.png" alt="Truckways" class="logo-img"></strong class="title">
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
				<a href="/users/home" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="/users/loads" class="nav-link">Open Loads</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="/users/active-loads" class="nav-link">Active Loads</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="/users/trucks" class="nav-link">Trucks</a>
			</li>
			<li class="nav-item hidden-nav">
				<a href="/users/payment-history" class="nav-link">Payment History</a>
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
                    <a class="dropdown-item" href="/users/profile">Profile</a>
					<a href="{{ url('/logout') }}" class="dropdown-item">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
 <!--/.Navbar -->