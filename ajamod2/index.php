<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="./">Navbar</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="val.php">Link</a>
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


<!-- Trigger container -->
<div class="container">
		<div class="row">
			<div class="col-3 align-self-center">
				<div class="card card-body">
					<h2>Bootstrap Modal + jQuery + Ajax + send data</h2>
					
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
		Enviar mensaxe
	</button>

	</div>
			</div>
		</div>
	</div>


	<!-- Modal --
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
-->

	<!-- Modal -->
	<div class="modal fade" id="modalForm" role="dialog">
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

					<form role="form">
						<div class="form-group">
							<label for="inputName">Nome</label>
							<input type="text" class="form-control" id="inputName" placeholder="Insire teu nome" />
						</div>
						<div class="form-group">
							<label for="inputEmail">Email</label>
							<input type="email" class="form-control" id="inputEmail" placeholder="Insire teu email" />
						</div>
						<div class="form-group">
							<label for="inputMessage">Mensaxe</label>
							<textarea class="form-control" id="inputMessage" placeholder="Insire teu mensaxe"></textarea>
						</div>
					</form>
				</div>

				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modalForm">Pechar</button>
					<button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">ENVIAR</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap bundle -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
				alert('Insire o teu email.');
				$('#inputEmail').focus();
				return false;
			} else if (email.trim() != '' && !reg.test(email)) {
				alert('Insire email válido.');
				$('#inputEmail').focus();
				return false;
			} else if (message.trim() == '') {
				alert('Insire a túa mensaxe.');
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