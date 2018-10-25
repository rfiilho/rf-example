<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
	
</head>
<body>
    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Cadastro</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Formulário</div>
                        <div class="card-body card-block">
                            <form action="run.php" method="POST" id="formulario">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="nome" name="nome" placeholder="Nome" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" id="cpf" name="cpf" placeholder="CPF" class="form-control">
                                    </div>
                                </div>
								<input type="submit" value="Enviar" style="visibility:hidden;">
                            </form>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">Últimos Cadastros</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th scope="col">Nome</th>
                                          <th scope="col">Sobrenome</th>
                                          <th scope="col">CPF</th>
                                      </tr>
                                  </thead>
                                  <tbody>
								  <?php
								  include('connect.php');
								  $query = mysqli_query($link, "SELECT * FROM people");
								  while($data = mysqli_fetch_assoc($query)):
								  ?>
                                    <tr>
                                        <td><?php echo $data["nome"]?></td>
                                        <td><?php echo $data["sobrenome"]?></td>
                                        <td><?php echo $data["cpf"]?></td>
                                    </tr>
									<?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div><!-- .content -->

    <div class="clearfix"></div>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(){
		//console.log("pronto!")
	});
	
	$("form:first").submit(function(event){
				var fnome = $("#nome").val();
				var fsobrenome = $("#sobrenome").val();
				var fcpf = $("#cpf").val();
				
				event.preventDefault();
				
				if(validarCPF()){
					$.ajax({
						url: "run.php",
						type: "POST",
						data: $(this).serialize(),
						dataType: "json",
						success:function(data){
							console.log(data);
							$("form:first")[0].reset();
							//alert(fnome + fsobrenome + cpf);
							$("tr:last").after("<tr><td>" + fnome +"</td><td>" + fsobrenome + "</td><td>"+ fcpf +"</td></tr>");
							
							
							//$("#nome").val(data[0].nome);
							
							if(data == "completo"){
								alert("okay");
							}
						}, error: function(data){
							alert("Erro desconhecido. Tente novamente.");
						}
						
					});
				}else{
					alert("CPF inválido");
				}
	});
	function validarCPF() {
		cpf = $("#cpf").val();
		cpf = cpf.replace(/[^\d]+/g,'');	
		if(cpf == '') return false;	
		// Elimina CPFs invalidos conhecidos	
		if (cpf.length != 11 || 
			cpf == "00000000000" || 
			cpf == "11111111111" || 
			cpf == "22222222222" || 
			cpf == "33333333333" || 
			cpf == "44444444444" || 
			cpf == "55555555555" || 
			cpf == "66666666666" || 
			cpf == "77777777777" || 
			cpf == "88888888888" || 
			cpf == "99999999999")
				return false;		
		// Valida 1o digito	
		add = 0;	
		for (i=0; i < 9; i ++)		
			add += parseInt(cpf.charAt(i)) * (10 - i);	
			rev = 11 - (add % 11);	
			if (rev == 10 || rev == 11)		
				rev = 0;	
			if (rev != parseInt(cpf.charAt(9)))
				return false;		
		// Valida 2o digito	
		add = 0;	
		for (i = 0; i < 10; i ++)		
			add += parseInt(cpf.charAt(i)) * (11 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)	
			rev = 0;	
		if (rev != parseInt(cpf.charAt(10)))
			return false;
		return true;
}
</script>
</body>
</html>
