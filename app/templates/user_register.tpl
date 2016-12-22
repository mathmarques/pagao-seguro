{extends 'layout.tpl'} {block name=content}
    <h3 class="text-center">Cadastro</h3>
    <div class="register">
        {if isset($sucess) }
        <div class="alert alert-success">
            <strong>Sucesso!</strong> Cadastro realizado!. <a href="{path_for name="login"}">Clique aqui para fazer Login.</a>
        </div>
        {else}
            {if isset($error)}
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Erro!</strong>

                    <p>{$error}</p>
                </div>
            {/if}
            <form name="add" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nome</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" {if isset($newUser)}value="{$newUser->getName()}"{/if}>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">E-mail</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="email" {if isset($newUser)}value="{$newUser->getEmail()}"{/if}>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Senha</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button id="cadastrar" name="cadastrar" type="submit"
                                class="btn btn-primary">Cadastrar
                        </button>
                    </div>
                </div>
            </form>
        {/if}
    </div>
{/block}
