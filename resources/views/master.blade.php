<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        {{-- navbar-start --}}
        <div class="row">
            <nav class="navbar navbar-expand-sm bg-dark">
                <div class="col-8">
                    <a class="navbar-brand text-info p-3 fw-bold" href="{{ url('/') }}">INVENTORY</a>
                </div>
                <div class="col-4">
                    <ul class="navbar-nav fw-bold ">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url('suppliers')}}">Supplier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url('products')}}">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url('purchases')}}">Purchase</a>
                        </li>
                        <!-- Dropdown Start -->
                        <li class="nav-item dropdown mx-5 text-white">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="ml-2">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu text-white" aria-labelledby="navbarDropdown">
                                <li>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                          this.closest('form').submit();"
                                            class="dropdown-item">
                                            <i class="icon-key"></i>
                                            <span class="ml-2 ">Logout </span>
                                        </a>

                                    </form>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                            </ul>
                        </li>
                        <!-- Dropdown End -->

                    </ul>

                </div>
            </nav>
        </div>
        {{-- navbar-end --}}
        {{-- section-part-start --}}
        <section>
            @yield('content')
        </section>
        {{-- section-part-end --}}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

</body>

</html>
