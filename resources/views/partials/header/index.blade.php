<div class="menu bg-success">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-toggleable-sm">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleContainer" aria-controls="navbarsExampleContainer" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{$logo_url}}">
                <img src="/assets/images/mic-mini-logo-white.png" width="100">
            </a>
            <div class="collapse navbar-collapse" id="navbarsExampleContainer">
                <ul class="navbar-nav mr-auto">
                    <!--                 <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{$logo_url}}">{{trans('app.aplicaAcum')}}<span class="sr-only"></span></a>
                    </li>
                    @if($authCheck)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('agreement')}}">{{trans('app.contracte')}}<span class="sr-only"></span></a>
                        </li>
                    @endif

                    <!--                 <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>
                @if($authCheck)
                    <ul class="navbar-nav pull-md-right pull-sm-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$authDealerName}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                            </div>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</div>