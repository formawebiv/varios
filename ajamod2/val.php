<!DOCTYPE html>
<html lang="gl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="./">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="val.php">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Dropdown
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Something else here</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
					</li>
				</ul>
				<form class="d-flex">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
		</div>
	</nav>



	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
		Enviar mensaxe
	</button>

	<!-- Modal -->
	<div class="modal fade modal-lg" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Pechar</span>
					</button> -->
					<h4 class="modal-title" id="myModalLabel">Formulario de Contato</h4>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>

					<form role="form" class="row g-3 needs-validation" novalidate>
						<div class="form-group">
							<div class="col-md-4">
								<label for="inputName" class="form-label">Nome</label>
								<input type="text" class="form-control" id="inputName" placeholder="Insire teu nome" required>
								<div class="valid-feedback">
									Grazas por presentarte!
								</div>

								<div class="invalid-feedback">
									Danos un nome para coñecernos
								</div>
							</div>
							<div class="col-md-4">
								<label for="validationCustom02" class="form-label">Last name</label>
								<input type="text" class="form-control" id="validationCustom02" value="apelido" required>
								<div class="invalid-feedback">
									Mellor se tamén nos das teu apelido
								</div>
								<div class="valid-feedback">
									Grazas por estar con nos!
								</div>
							</div>
							<div class="col-md-4">
								<label for="validationCustomUsername" class="form-label">Username</label>
								<div class="input-group has-validation">
									<span class="input-group-text" id="inputGroupPrepend">U</span>
									<input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
									<div class="invalid-feedback">
										Please choose a username.
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label for="validationCustom03" class="form-label">Localidade</label>
								<input type="text" class="form-control" id="validationCustom03" required>
								<div class="invalid-feedback">
									En que localidade resides?
								</div>
							</div>
							<div class="col-md-3">
								<label for="validationCustom04" class="form-label">Provincia</label>
								<select class="form-select" id="validationCustom04" required>
									<option selected disabled value="">Elixe...</option>
									<option>Pontevedra</option>
									<option>Lugo</option>
									<option>Ourense</option>
									<option>A Coruña</option>
								</select>
								<div class="invalid-feedback">
									Escolle unha provincia.
								</div>
							</div>
							<div class="col-md-3">
								<label for="validationCustom05" class="form-label">Zip</label>
								<input type="text" class="form-control" id="validationCustom05" required>
								<div class="invalid-feedback">
									Proporcionanos o teu CP.
								</div>
							</div>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
									<label class="form-check-label" for="invalidCheck">
										Agree to terms and conditions
									</label>
									<div class="invalid-feedback">
										You must agree before submitting.
									</div>
								</div>
							</div>
							<!-- Modal Footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modalForm">Pechar</button>
								<button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">ENVIAR</button>
							</div>
						</div>
					</form>



					<!-- Bootstrap bundle -->
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

					<!-- jQuery library -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

					<script>
						// Example starter JavaScript for disabling form submissions if there are invalid fields
						(function() {
							'use strict'

							// Fetch all the forms we want to apply custom Bootstrap validation styles to
							var forms = document.querySelectorAll('.needs-validation')

							// Loop over them and prevent submission
							Array.prototype.slice.call(forms)
								.forEach(function(form) {
									form.addEventListener('submit', function(event) {
										if (!form.checkValidity()) {
											event.preventDefault()
											event.stopPropagation()
										}

										form.classList.add('was-validated')
									}, false)
								})
						})()
					</script>

					<script>
						/* 	$(".nav .nav-link").on("click", function() {
							$(".nav").find(".active").removeClass("active");
							$(this).addClass("active");
						}); */

						$(document).ready(function() {
							$('li.active').removeClass('active');
							$('a[href="' + location.pathname + '"]').closest('li').addClass('active');
						});
					</script>

					<script>
						function submitContactForm() {
							var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
							var name = $('#inputName').val();
							var email = $('#inputEmail').val();
							var message = $('#inputMessage').val();
							if (name.trim() == '') {
								$('.statusMsg').html('<span class="text-danger">Insire o teu nome.</span>');
								$('#inputName').focus();
								return false;
							} else if (email.trim() == '') {
								$('.statusMsg').html('<span class="text-danger">Insire o teu email.</span>');
								$('#inputEmail').focus();
								return false;
							} else if (email.trim() != '' && !reg.test(email)) {
								$('.statusMsg').html('<span class="text-danger">Insire email válido.</span>');
								$('#inputEmail').focus();
								return false;
							} else if (message.trim() == '') {
								$('.statusMsg').html('<span class="text-danger">Insire a túa mensaxe.</span>');
								$('#inputMessage').focus();
								return false;
							} else {
								$.ajax({
									type: 'POST',
									url: 'submit_form.php',
									data: 'contactFrmSubmit=1&name=' + name + '&email=' + email + '&message=' + message,
									beforeSend: function() {
										$('.submitBtn').attr("disabled", "disabled");
										$('.modal-body').css('opacity', '.5');
									},
									success: function(msg) {
										if (msg == 'ok') {
											$('#inputName').val('');
											$('#inputEmail').val('');
											$('#inputMessage').val('');
											$('.statusMsg').html('<span style="color:green;">Grazas por contactar con nos, nos poremos en contacto axiña nos sexa posible (ansp).</p>');
										} else {
											$('.statusMsg').html('<span style="color:red;">Ocorreu algún erro, tentao de novo por favor.</span>');
										}
										$('.submitBtn').removeAttr("disabled");
										$('.modal-body').css('opacity', '');
									}
								});
							}
						}
					</script>
</body>

</html>