<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width,initial-scale-1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    body{ 
        background-color: #fdb91b
    } 
    
    .login{
        width:100%;
        height:100vh;
        align-items: center;
        justify-content: center;
        display: flex;

    }
    </style>
    </head> 
  <body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3>LOGAR</h3>
                            <form action="login.php" method="POST">
                                <div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text"  name ="email" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                    <label>Senha</label>
                                    <input type="password"  name ="senha" class="form-control">
                                </div>
                            </div>
                            <div>    
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-warning">Enviar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
  </body>  


</html>   
