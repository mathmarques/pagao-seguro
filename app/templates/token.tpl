{extends 'layout.tpl'}
{block name=content}
    <h3 class="text-center">Token</h3>
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
                    <label class="col-sm-3 control-label">Cartão</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="creditCard" name="creditCard">
                            {foreach $creditCardList as $creditCard}
                                <option value="{$creditCard->getId()}">{$creditCard->getName()}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Limite</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="limit" id="limit" placeholder="Deixe em branco para ilimitado">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button id="adicionar" name="adicionar" type="submit"
                                class="btn btn-primary">Criar Token
                        </button>
                    </div>
                </div>
            </form>
    </div>
    <h3 class="text-center">Todos Tokens</h3><br/><br/>
    <table class="table table-striped table-hover">
        <tr>
            <th>Código</th>
            <th>Cartão</th>
            <th>Expira</th>
            <th>Limite</th>
            <th>Status</th>
        </tr>
        {foreach $tokenList as $tokenCard}
            <tr class="{$tokenCard->getStatusClass()}">
                <td>{token_hash id=$tokenCard->getId()}</td>
                <td>{$tokenCard->getCreditCard()->getName()}</td>
                <td>{$tokenCard->getExpires()|date_format:"%d/%m/%y ás %H:%M:%S"}</td>
                <td>{if $tokenCard->getLimite() == 0}Ilimitado{else}{$tokenCard->getLimite()}{/if}</td>
                <td>{$tokenCard->getStatusMessage()}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="4"><h4 class="text-center">Nada encontrado!</h4></td>
            </tr>
        {/foreach}

    </table>
{/block}
