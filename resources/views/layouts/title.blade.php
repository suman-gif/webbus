@include('layouts.head')
@include('layouts.navbar')

<main class="py-0">
	<div class="header-bg mb-5">
	    <div class="container">
	        
	        <h1 class="page-title"> 
	            <!-- @yield('page-title') -->
	            @yield('title')
	        </h1>

	    </div>
	</div>
			
    @yield('content')
</main>

@include('layouts.footer')