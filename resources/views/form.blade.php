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
                {!! Form::open(array('url' => 'file/create')) !!}
                    {{ Form::token()}}
                    <div class="form-group">
                        {{ Form::label('filename', 'Le nom du fichier', array('class' => 'awesome'))}}
                        {{ Form::text('filename', "fichier.extention")}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('date', 'date a choisir', array('class' => 'awesome'))}}
                        {{ Form::date('date')}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('deposit', 'heure du depot', array('class' => 'awesome'))}}
                        {{ Form::time('deposit')}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('chemin', 'chemin du fihchier', array('class' => 'awesome'))}}
                        {{ Form::text('chemin', "/**/**/**/**")}}
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
                        {{Form::label('encoding', 'Encoding', array('class' => 'awesome'))}}
                        {{Form::select('encoding',
                                array('1' => 'ISO8859-1',
                                      '2' => 'ISO8859-2',
                                      '3' => 'ISO8859-3'
                                )
                            )
                        }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('firstname', 'prenom', array('class' => 'awesome'))}}
                        {{ Form::text('firstname')}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('lastname', 'Nom', array('class' => 'awesome'))}}
                        {{ Form::text('nom')}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('birthday', 'date de naissance', array('class' => 'awesome'))}}
                        {{ Form::date('birthday')}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('filename', 'Le nom du fichier', array('class' => 'awesome'))}}
                        {{ Form::text('filename', "fichier.extention")}}
                    </div>

                    <div class="form-group">
                        {{Form::submit('Click Me!')}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </body>
</html>
