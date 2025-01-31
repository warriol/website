
	<!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=250895068282603";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	<!-- Load Facebook SDK for JavaScript -->
    
			<header id="header">
				<div class="container">
					<h1 class="logo"><img src="<?php echo $_URLBASE_; ?>app/img/logos/wilsondenisarrioal.png" /></h1>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<!-- buscador -->
						<div class="search" id="headerSearch">
							<a href="#" id="headerSearchOpen"><i class="fa fa-search"></i></a>
							<div class="search-input">
								<form id="headerSearchForm" action="#" method="get">
									<div class="input-group">
										<input type="text" class="form-control search" name="q" id="q" placeholder="Search..." required>
										<span class="input-group-btn">
											<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<!-- buscador -->
						<!-- navegador -->
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">
								<li>
									<a href="<?php echo $_URLBASE_; ?>index.php">Inicio</a>
								</li>
								<li>
									<a href="<?php echo $_URLBASE_; ?>blog/">Blog</a>
								</li>
								<li>
									<a href="<?php echo $_URLBASE_; ?>acercade.php">Portafolio</a>
								</li>
                                <!--
                                
								<li class="dropdown mega-menu-item mega-menu-fullwidth">
									<a class="dropdown-toggle" href="#">
										Portafolio
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Main Features</span>
																<ul class="sub-menu">
																	<li><a href="feature-pricing-tables.html">Pricing Tables</a></li>
																	<li><a href="feature-icons.html">Icons</a></li>
																	<li><a href="feature-animations.html">Animations</a></li>
																	<li><a href="feature-typography.html">Typography</a></li>
																	<li><a href="feature-grid-system.html">Grid System</a></li>
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Headers</span>
																<ul class="sub-menu">
																	<li><a href="index-header-1.html">Header Version 1</a></li>
																	<li><a href="index-header-2.html">Header Version 2</a></li>
																	<li><a href="index-header-3.html">Header Version 3</a></li>
																	<li><a href="index-header-4.html">Header Version 4</a></li>
																	<li><a href="index-header-5.html">Header Version 5 (Big Logo)</a></li>
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Shop</span>
																<ul class="sub-menu">
																	<li><a href="shop-full-width.html">Shop - Full Width</a></li>
																	<li><a href="shop-sidebar.html">Shop - Sidebar</a></li>
																	<li><a href="shop-product-full-width.html">Shop - Product Full Width</a></li>
																	<li><a href="shop-product-sidebar.html">Shop - Product Sidebar</a></li>
																	<li><a href="shop-cart.html">Shop - Cart</a></li>
																	<li><a href="shop-login.html">Shop - Login</a></li>
																	<li><a href="shop-checkout.html">Shop - Checkout</a></li>
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Blog</span>
																<ul class="sub-menu">
																	<li><a href="blog-full-width.html">Blog Full Width</a></li>
																	<li><a href="blog-large-image.html">Blog Large Image</a></li>
																	<li><a href="blog-medium-image.html">Blog Medium Image</a></li>
																	<li><a href="blog-timeline.html">Blog Timeline</a></li>
																	<li><a href="blog-post.html">Single Post</a></li>
																</ul>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>

								-->
								<li>
									<a href="<?php echo $_URLBASE_; ?>contacto.php">Contacto</a>
								</li>
                                
								<li>
									<a href="<?php echo $_URLBASE_; ?>admin.php">Administración</a>
								</li>

							</ul>
						</nav>
						<!-- buscador -->
					</div>
				</div>
			</header>
<?php
/*
    $ip[0] //Dirección IP pública (declarada)
    $ip[1] //Dirección IP tras el proxy (pueden ser direcciones privadas)
    $ip[2] //Array con todos los proxies detectados y las IPs declaradas
    $ip[3] //La ip declarada por el proxy es restringida
    $ip[4] //Nombre del host
    $ip[5] //Nombre del host del proxy (si lo hay)

$ipd = detecta_ip();

//No hay proxy

if (!$ipd[2]) {

	echo '<script>console.log("sin proxy");</script>';
    */
?>
            <div class="container-red-social">
            	<div class="contenedor">
                    <!-- Your like button code -->
					<div class="fb-like" data-href="http://wilsonarriola.byethost6.com/" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            	</div>
                
                <div class="contenedor">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wilsonarriola.byethost6.com/" data-via="WilsonArriolaUY" data-size="large" data-hashtags="DPwarriola" data-dnt="true">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                
                <div class="contenedor">
                	<a href="https://twitter.com/WilsonArriolaUY" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false" data-dnt="true">Follow @WilsonArriolaUY</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                
                <div class="contenedor">
                	<!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
<div class="g-plus" data-action="share" data-annotation="none" data-height="24" data-href="http://wilsonarriola.byethost6.com/"></div>

                    <!-- Inserta esta etiqueta después de la última etiqueta de compartir. -->
                    <script type="text/javascript">
                      window.___gcfg = {lang: 'es'};
                    
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/platform.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                </div>

            </div>
<?php
/*
}else{
	echo '<script>';
    echo 'console.log("PROXY DETECTADO");';
    foreach($ipd[2] as $i){
        $infop = explode("|", $i);
        echo 'console.log("Tipo de proxy: '.$infop[0].'");';
        echo 'console.log("IP tras el proxy: ';
        echo ($infop[2]) ? $infop[2] : 'No declarada");';
        if ($infop[1]) echo 'console.log("(IP no enrutable en Internet)");';
    }
	
    echo '</script>';
}
*/
?>