<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="{{route('front.home')}}">MyApp</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{route('front.home')}}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="#">Find Jobs</a>
					</li>										
				</ul>	
		
				@if (Auth::check())
						
				<a class="btn btn-outline-primary me-2" href="#" type="submit">Account</a>
				@else
					
				<a class="btn btn-outline-primary me-2" href="{{route('account.login')}}" type="submit">Login</a>
				@endif		
				
				<a class="btn btn-primary" href="#" type="submit">Post a Job</a>

			</div>
		</div>
	</nav>
</header>
