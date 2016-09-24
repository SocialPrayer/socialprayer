@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
        <div class="side-menu">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="brand-wrapper">
                        <!-- Hamburger -->
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Brand -->
                        <div class="brand-name-wrapper">
                            <span class="navbar-brand" style="text-align: center;">Destiny Christian Church</span>
                        </div>

                        <!-- Search -->
                         <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                            <span class="glyphicon glyphicon-search"></span>
                        </a>

                        <!-- Search body -->
                        <div id="search" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form class="navbar-form" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default " style="height: 50px;"><span class="glyphicon glyphicon-ok"></span></button>
                                </form>
                            </div>
                        </div>

                        <div class="brand-name-wrapper">
                            <img src="{{ asset('images/destiny_church.jpg') }}" width="100%" style="z-index: 100;" />
                        </div>

                    </div>

                </div>

                <!-- Main Menu -->
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">

                        <li><a href="#"><span class="glyphicon glyphicon-send"></span> Link</a></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li>

                        <!-- Dropdown-->
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-lvl1">
                                <span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
                            </a>

                            <!-- Dropdown level 1 -->
                            <div id="dropdown-lvl1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#">Link</a></li>
                                        <li><a href="#">Link</a></li>
                                        <li><a href="#">Link</a></li>

                                        <!-- Dropdown level 2 -->
                                        <li class="panel panel-default" id="dropdown">
                                            <a data-toggle="collapse" href="#dropdown-lvl2">
                                                <span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
                                            </a>
                                            <div id="dropdown-lvl2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="nav navbar-nav">
                                                        <li><a href="#">Link</a></li>
                                                        <li><a href="#">Link</a></li>
                                                        <li><a href="#">Link</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
    <div class="col-sm-9 col-lg-10">
      <!-- your page content -->
    </div>
  </div>
</div>
@endsection

@section('content')
<script src="/js/sidebar.js"></script>
@endsection
