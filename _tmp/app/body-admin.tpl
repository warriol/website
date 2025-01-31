				<div class="container">

					<div class="row">

                        <?php
                            if(isset($_GET['failure']))
                            {
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                    	<strong>ERROR!</strong> NO se pudo registrar!!
                                    </div>
                                </div>
                                <?php
                            }
                        ?>


                        <?php
                            if(isset($_GET['inserted']))
                            {
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                    	<strong>Exito!</strong> Registrado!!
                                        <p>Ahora puede iniciar sesion ennuestro sitio, la primera vez que inici sesion deberá completar su perfil, hasta que no realice este proceso no podrá acceder al sitio de forma normal.</p>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                                              
						<div class="col-md-12">

							<div class="row featured-boxes login">
								<div class="col-sd-12">
									<div class="featured-box featured-box-primary default">
										<div class="box-content">
											<h4>Usuarios Registrados</h4>
											<form action="#" id="" method="post">
                                            
                                                <?php
                                                    if(isset($_GET['errorup']))
                                                    {
                                                        ?>
                                                        <div class="alert alert-warning">
                                                        <strong>ERROR!</strong> Correo o contraseña inválida!</a>!
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Correo</label>
															<input type="email"  onKeyUp="revisar_correo('i_correo','ie_correo')" id="i_correo" name="correo_usuario" value="" class="form-control input-lg" placeholder="Correo">
                                                            <div class="alert-danger" id="ie_correo" style='display:none;'>(*) correo inválido.</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<a class="pull-right" href="#">(Olvidaste la contraseña?)</a>
															<label>Contraseña</label>
															<input type="password" name="pass" value="" class="form-control input-lg" placeholder="Contraseña">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="rememberme" name="rememberme">Recordarme
															</label>
														</span>
													</div>
													<div class="col-md-6">
														<input type="submit" name="btn-entrar" value="Entrar" class="btn btn-primary pull-right push-bottom" data-loading-text="Cargando...">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
                                
                                <!--
								<div class="col-md-6">
									<div class="featured-box featured-box-primary default">
										<div class="box-content">
											<h4>Formulario de registro</h4>
											<form action="admin.php" name="registro" id="" method="post">
                                            
                                                <?php
                                                    if(isset($_GET['errorexiste']))
                                                    {
                                                        ?>
                                                        <div class="alert alert-warning">
                                                        <strong>ERROR!</strong> El correo ya esta registrado!</a>!
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                                
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Correo</label>
															<input type="email" onKeyUp="revisar_correo('r_correo','e_correo')" id="r_correo" name="r_correo" value="" class="form-control input-lg">
                                                            <div class="alert-danger" id="e_correo" style='display:none;'>(*) correo inválido.</div>
														</div>
													</div>
												</div>
                                                
                                                <?php
                                                    if(isset($_GET['passno']))
                                                    {
                                                        ?>
                                                        <div class="alert alert-warning">
                                                        <strong>ERROR!</strong> Las contraseñas no coinciden!</a>!
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                                
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Contraseña</label>
															<input type="password" id="r_pass1" onKeyUp="revisar_pass('r_pass','r_pass1','e_cant','e_pass')" name="r_pass1" value="" class="form-control input-lg">
                                                            <div class="alert-info" id="info_cant" style='display:none;'>Carácteres: 0.</div>
                                                            <div class="alert-danger" id="e_cant" style='display:none;'>(*) Contraseñas muy corta (8 - 12).</div>
														</div>
														<div class="col-md-6">
															<label>Repetir Contraseña</label>
															<input type="password" id="r_pass" onKeyUp="revisar_pass('r_pass','r_pass1','e_cant','e_pass')" name="r_pass" value="" class="form-control input-lg">
                                                            <div class="alert-danger" id="e_pass" style='display:none;'>(*) Contraseñas no coinciden.</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" id="btn-registrar" name="btn-registrar" value="Registrar" class="btn btn-primary pull-right push-bottom" data-loading-text="Cargando..." disabled="disabled">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
                                -->
							</div>

						</div>
					</div>

				</div>
                
                <script type="text/javascript">
					function valida_envia(){
						var div0 = $('#e_correo');
						var div1 = $('#e_pass');
						var div2 = $('#e_cant');
						var correo = document.getElementById("r_correo").value;
						var p1 = document.getElementById("r_pass1").value;
						
						if (div0.is(':visible') || div1.is(':visible') || div2.is(':visible'))
							{document.getElementById("btn-registrar").disabled=true; // !document.getElementById("btn-registrar").disabled
						}else{
							document.getElementById("btn-registrar").disabled=false; // !document.getElementById("btn-registrar").disabled
						}

					}
					
					function revisar_pass(r_p,r_p1,e_c,e_p) {
						var p1 = document.getElementById(r_p1);
						var p2 = document.getElementById(r_p);
						
						var length = (p1.textContent || p1.innerText || p1.innerHTML || p1.value).length;
						
						// alert(length);
						document.getElementById("info_cant").innerHTML = "Carácteres: " + length + ".";
								
						if ( length <= 6 || length >= 12) {
							document.getElementById(e_c).style.display = 'block';
						}else{
							document.getElementById(e_c).style.display = 'none';
							valida_envia();
						}
						
					
						if (p1.value === p2.value) {
							document.getElementById(e_p).style.display = 'none';
							valida_envia();
						}else{
							document.getElementById(e_p).style.display = 'block';
						}
					}
					
					function revisar_correo(r, e) {
						var correo = document.getElementById(r);
						
						// alert(correo);
					   
						emailRegex = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
						
						if (emailRegex.test(correo.value)) {
							document.getElementById(e).style.display = 'none';
						}else{
							document.getElementById(e).style.display = 'block';
						}

					}
				</script>