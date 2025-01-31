				<div class="container">
<?php
if(isset($_GET['enviado'])){
	echo '<div class="row"><div class="alert alert-success">Gracias! su mensaje ha sido recibido!<br> También puedes ponerte en contacto a trvés de: warriol@gmail.com</div></div>';
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
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox1" value="option1">Diseño
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox2" value="option2">Programación
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox3" value="option3">Base de datos
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox2" value="option4">Otros
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
										<div class="col-md-4">
											<div class="captcha form-control">
												<div class="captcha-image">

													<img src="app/php/simple-php-captcha/simple-php-captcha.php/index0711.html?_CAPTCHA&amp;t=0.92369900+1467942340" alt="1234">                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" value="" maxlength="6" data-msg-captcha="Código de verificación equivocado." data-msg-required="Por favor, escriba el código de verificación." placeholder="Escriba el código de verificación." class="form-control input-lg captcha-input" name="captcha" id="captcha" required>
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
										<input type="submit" id="contactFormSubmit" value="Enviar Mensaje" class="btn btn-primario btn-lg pull-right" data-loading-text="Cargando...">
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
                            
                            <div class="fb-page" 
                              data-href="https://www.facebook.com/wilsonarriolaDYP/"
                              data-width="380" 
                              data-hide-cover="false"
                              data-show-facepile="false">
                             </div>
                            <!-- Facebook Like Badge START -<div style="width: 100%;"><div style="background: #3B5998; padding: 5px;"><img src="https://www.facebook.com/images/fb_logo_small.png" alt="Facebook" /><img src="https://badge.facebook.com/badge/1110968728946732.1285216351.1516252001.png" width="0" height="0" alt="" /></div><div style="background: #EDEFF4;display: block;border-right: 1px solid #D8DFEA;border-bottom: 1px solid #D8DFEA;border-left: 1px solid #D8DFEA;margin: 0px;padding: 0px 0px 5px 0px;"><div style="background: #EDEFF4;display: block;padding: 5px;"><table cellspacing="0" cellpadding="0" border="0"><tr><td valign="top"><img src="https://www.facebook.com/images/icons/fbpage.gif" alt="" /></td><td valign="top"><p style="color: #808080;font-family: verdana;font-size: 11px;margin: 0px 0px 0px 0px;padding: 0px 8px 0px 8px;"><a href="https://www.facebook.com/wilsondenis.arriola" title="Wilson Denis Arriola" style="color: #3B5998;font-family: verdana;font-size: 11px;font-weight: normal;margin: 0px;padding: 0px 0px 0px 0px;text-decoration: none;" target="_TOP">Wilson Denis Arriola</a> likes </p></td></tr></table></div><div style="background: #FFFFFF;clear: both;display: block;margin: 0px;overflow: hidden;padding: 5px;"><table cellspacing="0" cellpadding="0" border="0"><tr><td valign="middle"><a href="https://www.facebook.com/DyProgramacionWeb" title="D&amp;P - Wilson Arriola" style="border: 0px;color: #3B5998;font-family: verdana;font-size: 12px;font-weight: bold;margin: 0px;padding: 0px;text-decoration: none;" target="_TOP"><img src="https://scontent.fgig1-3.fna.fbcdn.net/v/t1.0-1/c15.0.50.50/p50x50/13320005_1111068522270086_716038834005516104_n.png?oh=2821239e91a2e0c6ea9a136b652ce4d5&amp;oe=581C5D4B" style="border: 0px;margin: 0px;padding: 0px;" alt="D&amp;P - Wilson Arriola" /></a></td><td valign="middle" style="padding: 0px 8px 0px 8px;"><a href="https://www.facebook.com/DyProgramacionWeb" title="D&amp;P - Wilson Arriola" style="border: 0px;color: #3B5998;font-family: verdana;font-size: 12px;font-weight: bold;margin: 0px;padding: 0px;text-decoration: none;" target="_TOP">D&amp;P - Wilson Arriola</a></td></tr></table></div></div><div style="display: block;float: right;margin: 0px;padding: 4px 0px 0px 0px;"></div></div><!-- Facebook Like Badge END -->
						</div>
					</div>

				</div>