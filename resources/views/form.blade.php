<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
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
                        {{ Form::label('date', 'date a choisir', array('class' => 'awesome'))}}
                        {{ Form::date('date')}}
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
                    <div class="form-group" id="typemodif" onload="myFunction()">
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

                    document.getElementById('type').onchange = function() {
                        var newaction = getSelectedOption(this).innerHTML;
                        if(newaction == "product")
                        {
                            document.getElementById('contact').style.display = "none";
                            document.getElementById('product').style.display = "block";
                        }
                        else if(newaction == "contact")
                        {
                            document.getElementById('contact').style.display = "block";
                            document.getElementById('product').style.display = "none";
                        }else
                        {
                            document.getElementById('contact').style.display = "none";
                            document.getElementById('product').style.display = "none";
                        }

                    };
                </script>

                <h1>Treatment</h1>
                        <div id="contact" style="display: none">
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
                                {{ Form::label('birthday', 'date de naissance', array('class' => 'awesome'))}}
                                {{ Form::date('birthday')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('source', 'Source', array('class' => 'awesome'))}}
                                {{ Form::text('source')}}
                            </div>
                            <div>Vous avez choisis CONTACT</div>
                        </div>
                        <div id="product" style="display: none">
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
                                {{ Form::label('birthday', 'date de naissance', array('class' => 'awesome'))}}
                                {{ Form::date('birthday')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('image', 'Image', array('class' => 'awesome'))}}
                                {{Form::file('image')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('price', 'Prix', array('class' => 'awesome'))}}
                                {{ Form::number('price')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('currency', 'currency?', array('class' => 'awesome'))}}
                                {{ Form::number('currency')}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('source', 'Source', array('class' => 'awesome'))}}
                                {{ Form::text('source')}}
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
        </div>
    </body>
</html>
