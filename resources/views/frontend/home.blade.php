<!DOCTYPE html>
<html ng-app="app" lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>trinvh's API Practicing | Demo Application</title>
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/plugins/angular-datatables/dist/css/angular-datatables.min.css" rel="stylesheet">
    <link href="/assets/plugins/angular-datatables/dist/plugins/bootstrap/datatables.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/plugins/angular-loading-bar/build/loading-bar.min.css" rel="stylesheet">
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/frontend/css/custom.css" rel="stylesheet">

    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/assets/plugins/angular/angular.js"></script>
    <script src="/assets/plugins/angular-resource/angular-resource.min.js"></script>
    <script src="/assets/plugins/ngstorage/ngStorage.min.js"></script>
    <script src="/assets/plugins/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="/assets/plugins/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="/assets/plugins/angular-file-saver/dist/angular-file-saver.bundle.min.js"></script>
    <script src="/assets/plugins/angular-datatables/dist/angular-datatables.min.js"></script>
    <script src="/assets/plugins/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js"></script>
    <script src="/assets/plugins/angular-loading-bar/build/loading-bar.min.js"></script>
    <script src="/assets/frontend/scripts/app.js"></script>
    <script src="/assets/frontend/scripts/controllers.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body ng-class="[bodyClass, settings.theme]">
    <div class="branch-shadow">
        <h1 class="name">Readable</h1></div>
    <nav class="navbar navbar-bee navbar-fixed-top" navbar-affix ng-class='{ "scrolled" : scrolled }' scroll-class=''>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" ng-click="isCollapsed = !isCollapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ng-href="#/">Readable</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse hidden-xs">
                <ul class="nav navbar-nav">
                    <li><a href="">Hướng dẫn</a></li>
                </ul>
                <div id="bar-search" ng-controller="BarSearchController">
                    <form class="navbar-form">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" 
                                ng-model="keyword"
                                ng-change="search()"
                                ng-blur="onBlur()"
                                ng-focus="searching=true"
                                ng-model-options="{debounce: 700}" 
                                placeholder="Tìm kiếm truyện, tác giả...">
                            <span class="form-control-feedback"><i class="fa fa-search"></i></span>
                        </div>
                    </form>
                    <div class="search-results" ng-if="results.length && searching">
                        <ul>
                            <li ng-repeat="result in results">
                                <a ui-sref="storyDetail({slug: result.slug})">
                                    <h4 class="ellipsis">@{{ result.name }}</h4>
                                    <div class="meta">
                                        @{{ result.author }} <span class="pull-right">Cập nhật @{{ result.updated_at }}</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right navbar-settings" ui-view name="read-settings">

                </ul>
            </div>
            <nav class="visible-xs navbar-xs" uib-collapse="!isCollapsed">
                <ul class="nav navbar-nav">
                    <li><a ui-sref="home" ng-click="isCollapsed = !isCollapsed">Home</a></li>
                    <li><a ui-sref="home" ng-click="isCollapsed = !isCollapsed">Home</a></li>

                </ul>
            </nav>

        </div>
    </nav>
    <div id="wrapper">
        <ui-view></ui-view>
    </div>

</body>

</html>