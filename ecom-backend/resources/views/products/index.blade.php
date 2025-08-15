@extends( 'Layouts.master')

@section( 'content')


	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row align-items-center">
				<!-- Text -->
				<div class="col-lg-6">
					<div class="hero-text-tablecell">

    @yield('content')

					</div>
				</div>

				<!-- Image -->

			</div>
		</div>
	</div>
@endsection
