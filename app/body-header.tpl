			<header id="header">
				<div class="container">
					<h1 class="logo"><img src="<?php echo $_URLBASE_; ?>app/img/logos/wilsondenisarrioal.png" /></h1>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<!-- navegador -->
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">
								<li>
									<a href="index.php">Inicio</a>
								</li>
								<li>
									<!-- a href="./blog">Blog</a -->
									<a href="blog.php">Blog</a>
								</li>
								<li>
									<a href="acercade.php">Portafolio</a>
								</li>
								<li>
									<a href="contacto.php">Contacto</a>
								</li>
								<li>
									<a href="admin/admin.php">Administración</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>
            <div class="container-red-social hidden-xs">
                
            	<div class="contenedor">
                    <!-- Your like button code -->
					<div class="fb-like" data-href="<?php echo $_URLBASE_; ?>" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            	</div>
                
                <div class="contenedor">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $_URLBASE_; ?>" data-via="WilsonArriolaUY" data-size="large" data-hashtags="DPwarriola" data-dnt="true">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                
                <div class="contenedor">
                	<a href="https://twitter.com/WilsonArriolaUY" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false" data-dnt="true">Follow @WilsonArriolaUY</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                
                <div class="contenedor">
                	<!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
				<div class="g-plus" data-action="share" data-annotation="none" data-height="24" data-href="<?php echo $_URLBASE_; ?>"></div>

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
