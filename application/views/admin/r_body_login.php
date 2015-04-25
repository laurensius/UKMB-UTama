    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href=""> Administrator UKM Bola UTama</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Menu / Navigasi</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav pull-right">
                        <li class="active"><a href="<?php echo site_url();?>/admin/index"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="container-fluid" style="margin-top: 55px;min-height:50px">
            <?php echo $message?>
        </div>
        
        <div class="container-fluid" style="margin-top: 5px;">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form action="<?php echo site_url()?>/admin/verifikasi/" method="post">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Administrator</div>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                            </div> 
                            <br>
                            <input type="submit" value="Login" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4"></div>
            </div>
        </div>
