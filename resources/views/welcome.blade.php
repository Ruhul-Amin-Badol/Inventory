<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>INVENTORY</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    

          
    </head>
    <body >
        <div class="card shadow-lg m-5 p-5">
            <div class="card-body">
                <h3 class="text-center">INVENTORY</h3>
            @if (Route::has('login'))
                <div class=" mt-5">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                    @else
                    <div class="text-center ">
                        <button class="btn btn-md btn-primary  m-5"><a class="text-light" href="{{ route('login') }}" >Log in</a>
                        </div></button>
                    
                        @if (Route::has('register'))
                        <div class="text-center">
                            <button class="btn btn-md btn-warning"><a class="text-light" href="{{ route('register') }}" class="">Register</a></button>
                        </div>
                        @endif
                    @endauth
                </div>
            @endif

           

                

        </div>   
        </div>

         
           
      
    </body>
</html>
