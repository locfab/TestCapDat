<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href={{url("/css/bootstrap.min.css")}}>
        <link rel="stylesheet" href={{url("/css/style.css")}}>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body id="app-layout" onload="myFunction()">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Site de form et de json
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                            <li><a href="#">abcd</a></li>
                            <li><a href="#">poiu</a></li>
                            <li><a href="#">fghj</a></li>
                            <li><a href="#">cvbn</a></li>
                            <li><a href="#">okok</a></li>
                            <li><a href="#">xdrtyhjk</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li><a href="#">Se connecter</a></li>
                            <li><a href="#">Inscription</a></li>
                    </ul>
                </div>
            </div>
        </nav>





            <div class="content">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('url' => 'file/create')) !!}
                    {{ Form::token()}}
                <h1>Metas</h1>
                    <div class="form-group">
                        {{ Form::label('client', 'Le nom du Client', array('class' => 'awesome'))}}
                        {{ Form::text('client')}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('filename', 'Le nom du fichier', array('class' => 'awesome'))}}
                        {{ Form::text('filename', \Illuminate\Support\Facades\Input::old('filename'), array('placeholder' => "fichier.extention"))}}
                    </div>

                    <div class="form-group">
                        {{Form::label('frequency', 'Frequence bro', array('class' => 'awesome'))}}
                        {{Form::select('frequency',
                                array('daily' => 'daily',
                                      'monthly' => 'monthly',
                                      'yearly' => 'yearly'
                                )
                            )
                        }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('deposit', 'heure du depot', array('class' => 'awesome'))}}
                        {{ Form::time('deposit')}}
                    </div>

                    <h2>Format</h2>

                    <div class="form-group">
                        {{Form::label('name', 'Name', array('class' => 'awesome'))}}
                        {{Form::select('name',
                                array('csv' => 'CSV',
                                      'json' => 'JSON',
                                      'xml' => 'XML'
                                )
                            )
                        }}
                    </div>


                <h1>Type</h1>
                    <div class="form-group" id="typemodif">
                        {{Form::label('type', 'type', array('class' => 'awesome'))}}
                        {{Form::select('type',
                                array(
                                    '0' => '-',
                                    'contact' => 'contact',
                                    'product' => 'product',
                                )
                            )
                        }}
                    </div>

                <script>
                    function getSelectedOption(sel) {
                        var opt;
                        for ( var i = 0, len = sel.options.length; i < len; i++ ) {
                            opt = sel.options[i];
                            if ( opt.selected === true ) {
                                break;
                            }
                        }
                        return opt;
                    }
                    var myFunction = function(){
                        document.getElementById('contact').hidden = true;
                        document.getElementById('product').hidden = true;
                    }


                    document.getElementById('type').onchange = function() {
                        var newaction = getSelectedOption(this).innerHTML;
                        if(newaction == "product")
                        {
                            document.getElementById('contact').hidden = true;
                            document.getElementById('product').hidden = false;
                        }
                        else if(newaction == "contact")
                        {
                            document.getElementById('contact').hidden = false;
                            document.getElementById('product').hidden = true;
                        }else
                        {
                            document.getElementById('contact').hidden = true;
                            document.getElementById('product').hidden = true;
                        }

                    };
                </script>

                <h1>Treatment</h1>
                        <div id="contact">
                            <div>Vous avez choisis CONTACT</div>
                            <div class="form-group">

                                {{ Form::label('firstname', 'prenom', array('class' => 'awesome'))}}
                                {{ Form::text('firstname')}}
                            </div>

                            <div class="form-group">
                                {{ Form::label('lastname', 'Nom', array('class' => 'awesome'))}}
                                {{ Form::text('lastname')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('adress', 'Adresse', array('class' => 'awesome'))}}
                                {{ Form::text('adress')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('mail', 'E-mail', array('class' => 'awesome'))}}
                                {{ Form::text('mail')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('country', 'Pays', array('class' => 'awesome'))}}
                                {{ Form::text('country')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('city', 'Ville', array('class' => 'awesome'))}}
                                {{ Form::text('city')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('postal', 'Code postale', array('class' => 'awesome'))}}
                                {{ Form::text('postal')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('source1', 'Source', array('class' => 'awesome'))}}
                                {{ Form::text('source1')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('birthday1', 'date de naissance', array('class' => 'awesome'))}}
                                {{ Form::date('birthday1')}}
                            </div>
                            <div>Vous avez choisis CONTACT</div>
                        </div>
                        <div id="product">
                            <div>Vous avez choisis PRODUCT</div>
                            <div class="form-group">
                                {{ Form::label('nameProduct', 'Nom', array('class' => 'awesome'))}}
                                {{ Form::text('nameProduct')}}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Description', array('class' => 'awesome'))}}
                                {{ Form::text('description')}}
                            </div>

                            <div class="form-group">
                                {{ Form::label('birthday2', 'date de naissance', array('class' => 'awesome'))}}
                                {{ Form::date('birthday2')}}
                            </div>
                            <div class="form-group" style="width: 25%; margin: auto">

                                {{Form::label('image', 'Image', array('class' => 'awesome'))}}
                                <div style="float: right">
                                    {{Form::file('image')}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('price', 'Prix', array('class' => 'awesome'))}}
                                {{ Form::number('price')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('currency', 'currency?', array('class' => 'awesome'))}}
                                {{ Form::text('currency')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('source2', 'Source', array('class' => 'awesome'))}}
                                {{ Form::text('source2')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('weblink', 'lien d\'internet', array('class' => 'awesome'))}}
                                {{ Form::text('weblink')}}
                            </div>
                            <div>Vous avez choisis PRODUCT</div>
                        </div>
                <div class="form-group">
                    {{Form::submit('Click Me!')}}
                </div>
                {!! Form::close() !!}
            </div>
    </body>
</html>
