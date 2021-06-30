<!doctype html>
  <html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
      <!-- Toast -->
      <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Toast Bootstrap -->
        <div class="toast-container position-absolute top-0 end-0 p-3">
          <!-- Then put toasts within -->
          <div class="toast" id="systemInfo" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <!-- <img src="" class="rounded me-2" alt=""> -->
              <strong class="me-auto" id="systemInfoTitle">System Info</strong>
              <small class="text-muted">just now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="systemInfoMessage"></div>
          </div>
        </div>
      </div>

      <header><h1>Cadastro</h1></header>
      <div class="row">
        <div class="col">
          <form method="POST" class="mb-5" action="./cadastrar.php">
            <div class="form-group">
              <label> nome </label>
              <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
              <label>sobrenome</label>
              <input type="text" name="sobrenome" class="form-control" required>
            </div>
            <div class="form-group">
              <label>aniversario</label>
              <input type="date" name="aniversario" class="form-control" required>
            </div>

            <div class="form-group mt-3">
              <button type="submit" class="btn btn-success">salvar</button>
            </div>
          </form>
        </div>
      </div>


      <?php
      require_once("./conexao.php");
      $sql = "SELECT * FROM pessoa";
      $result = $pdo->query($sql);
      $result = $result->fetchAll(PDO::FETCH_OBJ);
      if(count($result) > 0):
        ?>
        <div class="row">
          <!-- Form Delete -->
          <form action='./delete.php' method='POST' id='deleteRecord'></form>
          <?php
          foreach ($result as $key => $value) {
            //modal
            echo "<!-- Dinnamyc Modal -->\n";
            echo "<div class='modal fade' id='editModal-$value->id' tabindex='-1' aria-labelledby='ModalLabel' aria-hidden='true'>\n";
            echo "<div class='modal-dialog'>\n";
            echo "<div class='modal-content'>\n";
            echo "<div class='modal-header'>\n";
            echo "<h5 class='modal-title' id='exampleModalLabel'>Editar Registro</h5>\n";
            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>\n";
            echo "</div>\n";
            echo "<div class='modal-body'>\n";
            echo "<form id='form-$value->id' class='form-floating' action='./edit.php' method='POST'>\n";
            echo "<div class='form-floating mb-3'>\n";
            echo "<input type='text' class='form-control' value='$value->nome' name='newName' id='floatingInputName' required>\n";
            echo "<label for='floatingInputName'>Editar Nome</label>\n";
            echo "</div>\n";
            echo "<div class='form-floating mb-3'>\n";
            echo "<input type='text' class='form-control' value='$value->sobrenome' name='newSurname' id='floatingInputSurname' required>\n";
            echo "<label for='floatingInputSurname'>Editar Sobrenome</label>\n";
            echo "</div>\n";
            echo "<div class='form-floating mb-3'>\n";
            echo "<input type='date' class='form-control' value='$value->aniversario' name='newBirthday' id='floatingInputBirthday' required>\n";
            echo "<label for='floatingInputBirthday'>Editar Aniversario</label>\n";
            echo "</div>\n";
            echo "<input type='hidden' name='recordID' value='$value->id'>";
            echo "</form>\n";
            echo "</div>\n";
            echo "<div class='modal-footer'>\n";
            echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>\n";
            echo "<button type='submit' form='form-$value->id' class='btn btn-primary'>Salvar Alterações</button>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
          }
          ?>



          <!-- Table -->
          <div class="col">
            <table class="table table-striped table-hover table-bordered border-secondary">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Sobrenome</th>
                  <th scope="col">Aniversario</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $key => $value) {
                  //echo "$key"."  ".$value->nome;
                  echo "<tr>";
                  echo "<th scope='row'>$value->id</th>";
                  echo "<td>$value->nome</td>";
                  echo "<td>$value->sobrenome</td>";
                  echo "<td>".date_format(date_create($value->aniversario), "d/m/Y")."</td>";
                  echo "<td><button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal-$value->id'>Editar</button> <button type='submit' value=\"$value->id\" name='deleteRecord' form='deleteRecord' class='deleteRecord btn btn-danger btn-sm'>Deletar</button></td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      <?php endif; ?>




    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
          begin = dc.indexOf(prefix);
          if (begin != 0) return null;
        }
        else
        {
          begin += 2;
          var end = document.cookie.indexOf(";", begin);
          if (end == -1) {
            end = dc.length;
          }
        }
        return decodeURI(dc.substring(begin + prefix.length, end));
      }
      window.onload = () => {
        //verifica cookie e exibe toast
        let systemInfoCookie = getCookie('systemInfo');
        let erroInfoCokkie = getCookie('errorInfo');
        let systemInfoTitle = document.querySelector("#systemInfoTitle");
        let systemInfoMessage = document.querySelector("#systemInfoMessage");
        let toastEl = document.querySelector('#systemInfo');
        toastEl = new bootstrap.Toast(toastEl);
        if(systemInfoCookie != null){
          systemInfoMessage.innerText = systemInfoCookie;
          toastEl.show();
          document.cookie = `systemInfo=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        }else if(erroInfoCokkie != null){
          systemInfoMessage.innerText = erroInfoCokkie;
          toastEl.show();
          document.cookie = `errorInfo=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        }
        //exibe prompt para exclusão de registros
        let btnDelete = document.querySelectorAll(".deleteRecord");
        btnDelete.forEach(el => {
          el.addEventListener("click", evt => {
            if(!confirm("Deseja Realmente Excluir?")){
              evt.preventDefault();
            }
          });
        });
      }
    </script>

  </body>
  </html>
