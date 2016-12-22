{extends 'layout.tpl'}
{block name=content}
    <h3 class="text-center">Cartões</h3>
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
                    <label class="col-sm-3 control-label">Número do Cartão</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="card" id="card">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Validade do Cartão</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="valid" id="valid">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Número de Segurança</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="secure" id="secure">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button id="adicionar" name="adicionar" type="submit"
                                class="btn btn-primary">Adicionar Cartão
                        </button>
                    </div>
                </div>
            </form>
    </div>
    <h3 class="text-center">Todos Cartões</h3><br/><br/>
    <table class="table table-striped table-hover">
        <tr>
            <th>Nome</th>
            <th>Validade</th>
        </tr>
        {foreach $creditCardList as $creditCard}
            <tr>
                <td>{$creditCard->getName()}</td>
                <td>{$creditCard->getValid()}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="2"><h4 class="text-center">Nada encontrado!</h4></td>
            </tr>
        {/foreach}

    </table>
{/block}
