{extends 'layout.tpl'}
{block name=content}
    <h3 class="text-center">APIs</h3>
    <div class="register">
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
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button id="adicionar" name="adicionar" type="submit"
                                class="btn btn-primary">Criar
                        </button>
                    </div>
                </div>
            </form>
    </div>
    <h3 class="text-center">Todas APIs</h3><br/><br/>
    <table class="table table-striped table-hover">
        <tr>
            <th>Nome</th>
            <th>Public</th>
            <th>Private</th>
        </tr>
        {foreach $apisList as $api}
            <tr>
                <td>{$api->getName()}</td>
                <td>{$api->getPublicHash()}</td>
                <td>{$api->getPrivateHash()}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="3"><h4 class="text-center">Nada encontrado!</h4></td>
            </tr>
        {/foreach}

    </table>
{/block}
