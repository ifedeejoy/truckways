<nav class="navbar navbar-expand-lg navbar-dark fixed-top @if(request()->is('/')) scrolling-navbar @else navdark-bg @endif">
    <div class="container">

    	<!-- Brand -->
		<a class="navbar-brand" href="/">
			<strong class="title">{{ config('app.name') }}</strong class="title">
		</a>

		<!-- Collapse -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

      <!-- Links -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto"></ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="/" class="nav-link {{ setActive(['/']) }} waves-effect waves-light"> Home</a>
				</li>
				<li class="nav-item ml-3">
					<a href="/find-truck" class="nav-link {{ setActive(['find-truck']) }} waves-effect waves-light">Find Truck</a>
				</li>
				<li class="nav-item ml-3">
					<a href="/market-place" class="nav-link {{ setActive(['market-place']) }} waves-effect waves-light">Market Place</a>
				</li>
				<li class="nav-item ml-3">
					<a href="/drivers" class="nav-link {{ setActive(['drivers']) }} waves-effect waves-light">Drivers</a>
				</li>
				<li class="nav-item ml-3">
					<a href="/contact-us" class="nav-link {{ setActive(['contact-us']) }} waves-effect waves-light">Contact Us</a>
				</li>
				<li class="nav-item ml-4">
					<a href="/login" class="nav-link waves-effect waves-dark long-btn black-text">Login</a>
				</li>
			</ul>
		</div>

    </div>
</nav>