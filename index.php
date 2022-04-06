<?php
require_once 'vendor/autoload.php';

use App\DataManager;

$dataManager = new DataManager;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($dataManager->post($_POST)){
        echo "<script>alert('Sucesso!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>JobAssistant</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    
    <link href="assets/main.css" rel="stylesheet">
    <script src="assets/main.js"></script>
</head>

<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 23h-24v-13.275l2-1.455v-7.27h20v7.272l2 1.453v13.275zm-2-2v-7.416l-10 6.953-10-6.953v7.416h20zm-18-8.472v-9.528h16v9.527l-8 5.473-8-5.472zm8.181-7.948c-.094-.286.12-.58.418-.58.184 0 .356.117.417.302l2.587 6.493c.077.232-.048.481-.278.558-.231.077-.48-.048-.557-.279 0 0-1.633-.547-3.57.096l1.273 1.979c.133.194.04.46-.18.533l-.865.288-.182.03c-.163 0-.321-.069-.433-.195l-1.75-1.93c-.952.3-2.031-.047-2.391-.944-.082-.206-.125-.426-.125-.646 0-.64.358-1.292 1.133-1.673 3.882-1.906 4.503-4.032 4.503-4.032zm2.758.415c.69.291 1.268.848 1.572 1.598.304.751.276 1.555-.015 2.246l.67.284c.189-.448.289-.933.289-1.428 0-1.439-.852-2.787-2.233-3.372l-.283.672zm-.484 1.147c.398.167.731.488.906.92.175.432.159.894-.008 1.292l.653.277c.238-.566.262-1.223.013-1.837-.249-.614-.722-1.069-1.287-1.308l-.277.656z"/></svg>
      &nbsp;JobAssistant
    </a>
  </div>
</nav>
<br>
<div class="container">
    <h4>Enviar curriculos em massa</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formNovoEmail">
    Cadastrar novo
    </button>
    <button type="button" class="btn btn-danger" onclick="sendMailAll();">
    Enviar todos
    </button>
    <div id="loading" class="lds-ellipsis" style="display:none;"><div></div><div></div><div></div><div></div></div>
    <hr>
</div>
<div class="container">
    <table class="table">
        <thead>
            <th>Email</th>
            <th>Assunto</th>
            <th>Status</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php
            $result = $dataManager->get();
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['assunto']; ?></td>
                        <td><?php echo $row['enviado'] == 1 ? 'Enviado' : 'Não enviado'; ?></td>
                        <td><button class="btn btn-sm btn-warning" onclick="sendMailOne('<?php echo $row['id'] ?>')">Enviar</button></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="formNovoEmail" tabindex="-1" aria-labelledby="formNovoEmailLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formNovoEmailLabel">Nova oportunidade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="novalinha" method="POST" action="/">
            
            <div class="mb-3">
                <label for="assuntoTxt" class="form-label">Assunto</label>
                <input type="text" class="form-control" name="assuntoTxt" id="assuntoTxt">
            </div>

            <div class="mb-3">
                <label for="emailEmpresa" class="form-label">Email</label>
                <input type="email" class="form-control" name="emailEmpresa" id="emailEmpresa">
            </div>

            <input type="hidden" name="novo" value="1" />

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('novalinha').submit();">Salvar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>