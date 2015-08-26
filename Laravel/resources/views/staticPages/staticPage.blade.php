
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Den Tube :: @yield('title')</title>
    <script src="/js/jquery.min.js"></script>


    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="/js/bootstrap.min.js"></script>




    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Den Tube</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beheer Categori&euml;n <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/activiteit">Activiteiten</a></li>
                            <li><a href="/jongere">Jongeren</a></li>
                            <li><a href="/ouder">Ouders</a></li>
                            <li><a href="/huisarts">Dokters</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Ondergeschikt</li>
                            <li><a href="/nationaliteit">Nationaliteiten</a></li>
                            <li><a href="/taal">Talen</a></li>
                            <li><a href="/groep">Groepen</a></li>
                            <li><a href="/extrainfo">Extra Info's</a></li>
                            <li><a href="/straat">Straten</a></li>
                            <li><a href="/gemeente">Gemeenten</a></li>
                            <li><a href="/relatie">Relaties contactpersonen</a></li>
                        </ul>
                    </li>
                    <li><a href="/activiteit">Activiteiten</a></li>
                    <li><a href="/storting">Stortingen</a></li>
                    <li><a href="/jongere">Jongeren</a></li>
                </ul><!--
                <ul class="nav navbar-nav navbar-right">
                    <li><div style="padding-top:15px">Aangemeld als</div></li>
                    <li><a href="#">StevenH</a></li>
                </ul>-->
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <div class="row hideMeForScreen showMeForPrint">
                <div class="col-md-12">
                    <img src="http://dentube.lampeke.be/sites/all/themes/tube/img/header-logo.png">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .hideMeForScreen {display:none}
    div{border:0px solid black;}
@media print {
.hideMeForPrint {display:none;}
a[href]:after {content: "";}
h2 {margin-bottom: 0.5cm;}
td {padding:0px !important;margin:0px!important;}
.showMeForPrint {display:block;}
}
</style>
</body>
</html>





