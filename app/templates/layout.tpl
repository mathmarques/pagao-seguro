<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Pagão Seguro</title>
    <meta name="Description" content="Pagão Seguro"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap css -->
    <link href="{base_url}/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- carrent css -->
    <link href="{base_url}/css/pagaoseguro.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
                <a class="navbar-brand" href="{base_url}/">Pagão Seguro</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if $loggedUser == null}
                    <li><a href="{path_for name="home"}">Home</a></li>
                    <li><a href="{path_for name="home"}">Cadastrar</a></li>
                {else}
                    <li><a href="{path_for name="home"}">Home</a></li>
                    <li><a href="{path_for name="credit_card"}">Cartões</a></li>
                    <li><a href="{path_for name="apis"}">APIs</a></li>
                    <li><a href="{path_for name="token"}">Tokens</a></li>
                {/if}
            </ul>
            {if $loggedUser != null}
                <div class="navbar-right btn-group loginInfo">
                    <button type="button" class="btn btn-primary dropdown-toggle"
                            data-toggle="dropdown">
                        Olá, {$loggedUser->getName()}! <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Menu</a></li>
                        <li class="divider"></li>
                        <li><a href="{base_url}/logout">Logout</a></li>
                    </ul>
                </div>
            {/if}
        </div>
    </div>
</div>

<div class="container content">
    {block name=content}{/block}
</div>

<!-- jQuery -->
<script src="{base_url}/js/jquery-2.1.0.min.js"></script>
<!-- Bootstrap js -->
<script src="{base_url}/js/bootstrap.min.js"></script>
{block name=javascript}{/block}
</body>
</html>