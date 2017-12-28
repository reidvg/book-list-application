<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
    <style>
        tr td:first-child {
            width: 10%;
        }

        tr td:last-child {
            width: 20%;
        }

        td img {
            max-height: 100px;
            max-width: 100px;
        }

        .table tbody tr td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand">|</a>
                @if(Auth::check())
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Home
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Home
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="{{ route('book.index') }}">My Books</a></li>
                        <li><a href="{{ route('book-list.index') }}">My Book Lists</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
<script>
    $(document).ready(function () {
        $('.typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 3,
            source: function (query, process) {
                return $.getJSON(
                    '/book-api/query/',
                    {query: query},
                    function (data) {
                        //return data.docs
                        return process(data.docs);
                    });
            },
            matcher: function(item) {
                for (var attr in item) {
                    if (~item[attr].toString().toLowerCase().indexOf(this.query.toLowerCase()))	return true
                }
                return false
            },
            displayText: function(item) {
                return JSON.stringify(item)
            },
            highlighter: function(item) {
                item = JSON.parse(item);
                return '<span><h4>'+item.title_suggest + '</h4></span>'
            },
            afterSelect: function(item) {
                this.$element[0].value = item.title;
                if(item.hasOwnProperty('author_name')) {
                    $('#author').val(item.author_name[0]);
                }
                if(item.hasOwnProperty('publish_date')) {
                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var date = item.publish_date[0]+"-"+(month)+"-"+(day);
                    $('#publication_date').val(date);
                }

                $('#description').html(item.title_suggest);
            }
        });
    });
</script>
</body>
</html>
