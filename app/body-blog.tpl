<div class="container">
					<div class="row">
						<div class="col-md-9">
							<div class="blog-posts">
								<article class="post post-large">
									<div class="post-image single">
										<img class="img-thumbnail" src="app/imgblog/blog-image-2.jpg" alt="">
									</div>

									<div class="post-date">
										<span class="day">30</span>
										<span class="month">Ene</span>
									</div>

									<div class="post-content">

										<h2><a href="blog-post.html">Mantenimiento</a></h2>
										<p>El Blog se encuentra en mantenimiento, disculpe las molestias. [...]</p>

										<div class="post-meta">
											<span><i class="fa fa-user"></i> By <a href="#">Wilson Arriola</a> </span>
											<span><i class="fa fa-comments"></i> <a href="#">0 Comentarios</a></span>
											<a href="#" class="btn btn-xs btn-primary pull-right">Leer noticia completa...</a>
										</div>

									</div>
								</article>

								<article class="post post-large">
									<div class="post-image single">
										<div class="banner">Guía Interactiva de Linux y MySQL</div>
									</div>

									<div class="post-date">
										<span class="day">15</span>
										<span class="month">Oct</span>
									</div>

									<div class="post-content">

										<h2><a href="blog-post.html">Guía Interactiva de Linux y MySQL</a></h2>
										<p>Explora los fundamentos de Linux y MySQL con esta guía interactiva. Aprende comandos esenciales, administración de bases de datos y mucho más. [...]</p>

										<div class="post-meta">
											<span><i class="fa fa-user"></i> By <a href="#">Wilson Arriola</a> </span>
											<span><i class="fa fa-comments"></i> <a href="#">0 Comentarios</a></span>
											<button class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modalGILM">Leer noticia completa...</button>
										</div>

									</div>
								</article>
							</div>
						</div>

						<div class="col-md-3">
							<aside class="sidebar">
							</aside>
						</div>
					</div>

				</div>


				<!-- Modal -->
				<div class="modal fade" id="modalGILM" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="customModalLabel">Título del Modal</h4>
							</div>
							<div class="modal-body">
								<div id="modalContent">
									<!-- Contenido dinámico o estático -->
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

				<!-- JavaScript para cargar contenido en el modal -->
				<script>
					// JavaScript para cargar contenido en el modal
					document.addEventListener('DOMContentLoaded', () => {
						const modalContent = document.getElementById('modalContent');

						fetch('blog/pages/guia_interactiva_linux_mysql.html')
								.then(response => {
									if (!response.ok) {
										throw new Error('Error al cargar el archivo');
									}
									return response.text();
								})
								.then(html => {
									modalContent.innerHTML = html;
								})
								.catch(error => {
									modalContent.innerHTML = `<p>Error: ${error.message}</p>`;
								});
					});
				</script>

				<!-- CCS -->
				<style>
					.banner {
						width: 800px;
						height: 50px;
						line-height: 50px;
						text-align: center;
						font-size: 18px;
						font-weight: bold;
						color: white;
						background: linear-gradient(90deg, #4e73df, #1cc88a);
						border-radius: 5px;
						animation: gradientAnimation 5s infinite;
					}

					@keyframes gradientAnimation {
						0% {
							background-position: 0% 50%;
						}
						50% {
							background-position: 100% 50%;
						}
						100% {
							background-position: 0% 50%;
						}
					}
				</style>
