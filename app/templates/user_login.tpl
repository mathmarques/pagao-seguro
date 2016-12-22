{extends 'layout.tpl'}
{block name=content}
    <h3 class="text-center">Seja Bem Vindo ao Pagão Seguro!</h3>

    <div class="login">
        <h4 class="text-center" style="padding-bottom: 10px;">Login</h4>
        {if isset($error)}
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                <strong>Erro!</strong>
                <p>{$error}</p>
            </div>
        {/if}
        <form name="login" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password"
                           id="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button id="login" name="login" type="submit"
                            class="btn btn-primary">Login</button>
                    <a href="#" class="btn btn-primary" role="button">Recuperar senha</a>
                    <a href="{path_for name="register"}" class="btn btn-success"
                       role="button">Criar Conta</a>
                </div>
            </div>
        </form>
    </div>
{/block}
