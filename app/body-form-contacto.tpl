		<div class="container">
		<?php
		if(isset($_GET['enviado'])){
			echo '<div class="row"><div class="alert alert-success">Gracias! su mensaje ha sido recibido!<br> También puedes ponerte en contacto a trvés de: warriol@gmail.com</div></div>';
		}
		if(isset($_GET['error'])){
			echo '<div class="row"><div class="alert alert-danger">Lo siento, ha ocurrido un error al enviar el mensaje, por favor intente nuevamente.<br><em><b>'.$_GET['res'].'</b></em></div></div>';
		}
		?>
			<div class="row">
				<div class="col-md-8">
					<div class="offset-anchor" id="contact-sent"></div>
					<h2 class="short">Ponte en <strong>Contacto</strong></h2>
					<form id="contactFormAdvanced" action="./app/php/envio-form-contacto.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" value="true" name="emailSent" id="emailSent">
						<div class="row">
							<div class="form-group">
								<div class="col-md-6">
									<label>Nombre *</label>
									<input type="text" value="" data-msg-required="Por favor escriba su nombre." maxlength="100" class="form-control" name="name" id="name" required>
								</div>
								<div class="col-md-6">
									<label>Correo *</label>
									<input type="email" value="" data-msg-required="Por favor escriba su correo." data-msg-email="Ingrese un correo válido." maxlength="100" class="form-control" name="email" id="email" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Asunto</label>
									<select data-msg-required="Seleccione el asunto." class="form-control" name="subject" id="subject" required>
										<option value=""></option>
										<option value="Presupuesto">Presupuesto</option>
										<option value="Sugerencia">Sugerencia</option>
										<option value="Consulta">Consulta</option>
										<option value="Otros">Otros</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<label>Producto</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="checkbox-group" data-msg-required="Seleccione al menos una opción.">
												<label class="checkbox-inline">
													<input type="checkbox" name="checkboxes[]" id="inlineCheckbox1" value="Diseño">Diseño
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="checkboxes[]" id="inlineCheckbox2" value="Programacion">Programación
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="checkboxes[]" id="inlineCheckbox3" value="BD">Base de datos
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" name="checkboxes[]" id="inlineCheckbox2" value="otros">Otros
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<label>Cómo me conociste?</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="radio-group" data-msg-required="Seleccione una opción.">
												<label class="radio-inline">
													<input type="radio" name="radios" id="inlineRadio1" value="Amigo">Amigo
												</label>
												<label class="radio-inline">
													<input type="radio" name="radios" id="inlineRadio2" value="Sugerencia">Sugerencia
												</label>
												<label class="radio-inline">
													<input type="radio" name="radios" id="inlineRadio3" value="Google">Google
												</label>
												<label class="radio-inline">
													<input type="radio" name="radios" id="inlineRadio2" value="Facebook">Facebook
												</label>
												<label class="radio-inline">
													<input type="radio" name="radios" id="inlineRadio3" value="Otro">Otro
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Adjuntar archivo</label>
									<input type="file" name="attachment" id="attachment">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Mensaje *</label>
									<textarea maxlength="5000" data-msg-required="Escriba su mensaje." rows="10" class="form-control" name="message" id="message" required></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Verificación *</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<div class="g-recaptcha" data-sitekey="6LcUp8cqAAAAAP1i6DsbtL7PT9quooVQSg6u7zPw" data-action="LOGIN"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<input
										type="submit"
										id="contactFormSubmit"
										value="Enviar Mensaje"
										class="btn btn-primario btn-lg pull-right"
										data-loading-text="Cargando...">
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<h4 class="push-top">Su aporte <strong>me ayuda a crecer!</strong></h4>
					<p>Si tiene alguna sugerencia para modificar y/o mejorar mi sitio, por favor no dude en realizarla, las criticas constrcuticas son justamente eso... constructivas..</p>
					<hr />
					<h4>Mi <strong>Oficina</strong> :)</h4>
					<ul class="list-unstyled">
						<li><i class="fa fa-map-marker"></i> <strong>Dirección:</strong> Egipto 3363 - 12.800 - Montevideo - Uruguay</li>
						<li><i class="fa fa-phone"></i> <strong>Teléfono:</strong> 092.373.973</li>
						<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:warriol@gmail.com">warriol@gmail.com</a></li>
					</ul>
					<hr />
					<h4>Horario de <strong>atención:</strong></h4>
					<ul class="list-unstyled">
						<li><i class="fa fa-time"></i> 24 / 7 - o.O</li>
					</ul>
					<hr />
					<div class="LI-profile-badge"  data-version="v1" data-size="large" data-locale="es_ES" data-type="horizontal" data-theme="dark" data-vanity="wilson-arriola-uy"><a class="LI-simple-link" href='https://uy.linkedin.com/in/wilson-arriola-uy?trk=profile-badge'>Wilson Arriola</a></div>
					<hr />
				</div>
			</div>
		</div>
