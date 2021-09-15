<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://www.google.com/recaptcha/api.js"></script>
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            form .invalid{
                border: 1px solid #a70000;
                color: #a70000;
            }
            
            ul.errors{
                background-color: #eee;
                padding: 10px;
                color: #a70000;
                list-style-position: inside;
                display: inline-block;
                width: 250px;
            }
            
            .flash-success{
                background-color: #eee;
                color: #08a700;
                padding: 10px;
                display: inline-block;
                width: 250px;            
            }
        </style>
    </head>
    <body>
               <form method="POST" action="{{ action('ContactController@index') }}">
                    @csrf

                    <p>
                        <label for="name">Your name</label>
                        <input 
                            type="text" id="name" name="name"            
                            class="{{ $errors->has('name') ? 'invalid' : '' }}"            
                            value="{{ old('name') }}" />
                    </p>

                    <p>
                        <label for="email">Your email address</label>
                        <input 
                            type="email" id="email" name="email"
                            class="{{ $errors->has('email') ? 'invalid' : '' }}"
                            value="{{ old('email') }}" />
                    </p>

                    <p>
                        <label for="subject">Subject</label>
                        <input 
                            type="text" id="subject" name="subject"
                            class="{{ $errors->has('subject') ? 'invalid' : '' }}"
                            value="{{ old('subject') }}" />
                    </p>

                    <p>
                        <label for="message">Message</label>
                        <textarea 
                            id="message" name="message"
                            class="{{ $errors->has('message') ? 'invalid' : '' }}" >{{ 
                            old('message') 
                            }}</textarea>
                    </p>

                    <p><button type="submit" class="button">SEND</button></p>     

                    <p><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div></p>

                </form>


                    @if ($success = session('success'))
                    <div class="flash-success">{{ $success }}</div>
                    @endif


                    @if (count($errors))
                    <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>    
                    @endif

    </body>
</html>
