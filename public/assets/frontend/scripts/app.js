'use strict';

var app = angular.module('app', ['ui.router', 'ui.bootstrap', 'angular-loading-bar', 'datatables', 'datatables.bootstrap', 'ngStorage']);

app.config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
    $stateProvider.state('home', {
        url: '/',
        templateUrl: 'partials/home.html',
        controller: 'HomeController'
    });

    $stateProvider.state('storyDetail', {
        url: '/stories/:slug',
        templateUrl: 'partials/story.html',
        controller: 'StoryController',
        resolve: {
            Data: ['apiService', '$stateParams', function (apiService, $stateParams) {
                return apiService.getChapters($stateParams.slug);
            }]
        }
    });

    $stateProvider.state('storyRead', {
        url: '/read/:storySlug/:chapterSlug',
        views: {
            'read-settings': {
                templateUrl: 'partials/read-settings.html',
                controller: 'SettingController'
            },
            '': {
                templateUrl: 'partials/read.html',
                controller: 'ReadController',

            }
        },
        bodyClass: 'reader'
    });

    $urlRouterProvider.otherwise('/');
}]);

app.run(['$rootScope', 'settingService', function ($rootScope, settingService) {
    $rootScope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
        $rootScope.bodyClass = toState.bodyClass;
    });
}]);

app.service('apiService', function ($http, $q) {
    var vm = this,
        baseUrl = "http://novel.dev/api/v1/novels/stories";
    var cacheStory = {};

    this.get = function (url) {
        return $http.get(url).then(function (res) {
            return res.data;
        }, function (err) {
            return null;
        });
    }
    this.getStories = function (limit, page = 1) {
        var url = baseUrl + "?limit=" + limit + "&page=" + page;
        return this.get(url).then(function (data) {
            return data;
        });
    };

    this.getChapters = function (slug) {
        var url = baseUrl + "/" + slug;
        return this.get(url).then(function (data) {
            return data;
        });
    };

    this.getChapterContent = function (story, slug) {
        var url = baseUrl + "/" + story + "/" + slug;
        return this.get(url).then(function (data) {
            return data;
        });
    };

    return vm;
});

app.service('settingService', ['$rootScope', '$localStorage',
    function ($rootScope, $localStorage) {
        var vm = this;

        var settings = $localStorage.$default({
            fontSize: 16,
            theme: 'light'
        });

        var emit = function () {
            $rootScope.$emit('theme-changed', settings);
            $rootScope.settings = settings;
        }

        this.getSettings = function () {
            return settings;
        };

        this.changeSize = function (period) {
            settings.fontSize += period;
            if(settings.fontSize > 76 || settings.fontSize < 10) {
                settings.fontSize -= period;
            }
            emit();
            return settings.fontSize;
        };

        emit();

        return vm;
    }
]);

app.directive('navbarAffix', ['$window', function ($window) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var current;
            current = $window.pageYOffset;
            angular.element($window).on('scroll', function () {
                var ref;
                if ($window.pageYOffset > 50) {
                    if ($window.innerHeight + $window.pageYOffset >= document.body.offsetHeight) {
                        scope.scrolled = false;
                    } else {
                        scope.scrolled = (ref = this.pageYOffset > current) != null ? ref : { 'true': false };
                    }
                    current = this.pageYOffset;
                    return scope.$apply();
                }
            });
        }
    };
}]);

app.directive("scrollUp",
    function() {
        return {
            restrict: 'A',
            controller: function($scope) {
                $scope.scrollToTop = function() {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 900);
                }
            },
            link: function(scope, element, attrs) {
                $(element).bind('click', scope.scrollToTop);
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 200) {
                        $(element).show();
                    } else {
                        $(element).hide();
                    }
                });
            }
        }
    }
);
app.directive('textCollapse', ['$compile', function ($compile) {

    return {
        restrict: 'A',
        scope: true,
        link: function (scope, element, attrs) {
            scope.collapsed = false;
            scope.toggle = function () {
                scope.collapsed = !scope.collapsed;
            };
            attrs.$observe('text', function (text) {

                // get the length from the attributes
                var maxLength = scope.$eval(attrs.maxLength);

                if (text.length > maxLength) {
                    // split the text in two parts, the first always showing
                    var firstPart = String(text).substring(0, maxLength);
                    var secondPart = String(text).substring(maxLength, text.length);

                    // create some new html elements to hold the separate info
                    var firstSpan = $compile('<span>' + firstPart + '</span>')(scope);
                    var secondSpan = $compile('<span ng-if="collapsed">' + secondPart + '</span>')(scope);
                    var moreIndicatorSpan = $compile('<span ng-if="!collapsed">... </span>')(scope);
                    var lineBreak = $compile('<br ng-if="collapsed">')(scope);
                    var toggleButton = $compile('<span class="collapse-text-toggle" ng-click="toggle()">{{collapsed ? "Thu gọn" : "Xem thêm"}}</span>')(scope);

                    // remove the current contents of the element
                    // and add the new ones we created
                    element.empty();
                    element.append(firstSpan);
                    element.append(secondSpan);
                    element.append(moreIndicatorSpan);
                    element.append(lineBreak);
                    element.append(toggleButton);
                }
                else {
                    element.empty();
                    element.append(text);
                }
            });
        }
    };
}]);