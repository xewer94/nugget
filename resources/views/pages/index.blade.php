@extends ('layouts.app')

@section ('content')
	</div>
	<!--// Zaglavlje -->
	<!-- Slajder -->
	<div id="slajder">
		<div class="omotac">
			<div id="slajderTekst">
				<h2>Collection 2018</h2>
				<p>	Only few stand the test of evolution, and yet the classic timepiece has done exactly that.
					With a vision to be relevant today, tomorrow and beyond, our focus is to make simple yet spectacular timepieces for the everyday gent. For us, watch is not just a reference of style - it is the journey to becoming it. The journey (life) will take you through eventful moments and memorable days to occasions that change your whole perspective. We hope that one day your watch will make you look back at it all.
				</p>
				<a href="/nugget/public/watches" id="btnKolekcija">Go to collection <i class="fa fa-angle-double-right"></i> </a>
			</div>
		</div>
	</div>

<div class="omotac sekcija">
	<div class="naslov">
		<div class="linija"></div>
		<h3>Categories</h3>
		<div class="linija"></div>
		<div class="cistac"></div>
	</div>
	<div id="kategorije">
		<div class="kategorija" id="zenskiSatovi">
			<div class="kategorijaTekst">
				<div class="kategorijaOpis">
					<p>Ladies' watches</p>
				</div>
				<div class="dugmeShop">
					<a href="women.html">Shop now <i class="fa fa-angle-double-right"></i></a>
				</div>
				<div class="cistac"></div>
			</div>
		</div>
		<div class="kategorija" id="muskiSatovi">
			<div class="kategorijaTekst">
				<div class="kategorijaOpis">
					<p>Men's watches</p>
				</div>
				<div class="dugmeShop">
					<a href="men.html">Shop now <i class="fa fa-angle-double-right"></i></a>
				</div>
				<div class="cistac"></div>
			</div>
		</div>
		<div class="cistac"></div>
	</div>
</div>

@endsection