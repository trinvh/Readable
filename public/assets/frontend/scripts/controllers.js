'use strict';

app.controller('HomeController', ['$scope', '$rootScope', 'apiService', 'Data',
    function ($scope, $rootScope, apiService, Data) {
        $scope.slides = [
            'http://image.mp3.zdn.vn/banner/9/a/9a7d07fb377e3b4f599faae889c405ec_1461813175.jpg',
            'http://image.mp3.zdn.vn/banner/b/9/b9841d04d10b3c23b636cac9fc8e9805_1461811029.jpg',
            'http://image.mp3.zdn.vn/banner/9/a/9a7d07fb377e3b4f599faae889c405ec_1461747199.jpg',
            'http://image.mp3.zdn.vn/banner/d/2/d29e9f67c89612375d00707ce1df4709_1461643227.jpg'
        ];
        $scope.stories = Data.data;
    }
]);

app.controller('StoryController', ['$scope', '$rootScope', 'apiService', '$http', '$state', '$stateParams', 'DTOptionsBuilder', 'DTColumnDefBuilder', 'Data', '$q', '$timeout',
    function ($scope, $rootScope, apiService, $http, $state, $stateParams, DTOptionsBuilder, DTColumnDefBuilder, Data, $q, $timeout) {
        var slug = $stateParams.slug;

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withBootstrap()
            .withBootstrapOptions({
                pagination: {
                    classes: {
                        ul: 'pagination pagination-sm'
                    }
                }
            });
        $scope.dtColumnDefs = [
            DTColumnDefBuilder.newColumnDef(0).withOption('sWidth', '80px'),
            DTColumnDefBuilder.newColumnDef(1),
            DTColumnDefBuilder.newColumnDef(2).withOption('sWidth', '100px').notSortable()
        ];

        $scope.story = Data;

        $scope.readFirstChap = function () {
            var firstChap = $scope.story.chapters[0];
            $state.go('storyRead', { storySlug: $scope.story.slug, chapterSlug: firstChap.slug });
        }

        $scope.readLastChap = function () {
            var lastChap = $scope.story.chapters[$scope.story.chapters.length - 1];
            $state.go('storyRead', { storySlug: $scope.story.slug, chapterSlug: lastChap.slug });
        }

        $scope.downloadEpub = function () {
            $scope.clickedDownloadEpub = true;
            $timeout(function () {
                apiService.getStoryMobiFile($scope.story.slug, 'epub').then(function (data) {
                    $scope.$broadcast('gotDownloadLink', data);
                });
            }, 1000);

        }
    }
]);

app.controller('ReadController', ['$scope', 'apiService', '$stateParams', '$rootScope', 'settingService',
    function ($scope, apiService, $stateParams, $rootScope, settingService) {
        var story_slug = $stateParams.storySlug;
        var slug = $stateParams.chapterSlug;

        $scope.settings = settingService.getSettings();

        apiService.getChapterContent(story_slug, slug).then(function (data) {
            $scope.chapter = data.chapter;
            $scope.story = data.story;
            $scope.next = data.next;
            $scope.previous = data.previous;

        });

        $rootScope.$on('theme-changed', function (e, settings) {
            $scope.settings = settings;
        });
    }
]);

app.controller('SettingController', ['$scope', '$rootScope', 'settingService',
    function ($scope, $rootScope, settingService) {
        $scope.changeSize = function (period) {
            settingService.changeSize(period);
        }

        $scope.colorchooser = "colorchooser.html";
    }
])

app.controller('BarSearchController', ['$scope', 'apiService', 'Story', '$timeout',
    function ($scope, apiService, Story, $timeout) {
        $scope.keyword = "";
        
        $scope.results = [];
        
        $scope.search = function () {
            $scope.searching = true;
            Story.get({keyword: $scope.keyword, limit: 5}, function(data) {
                $scope.results = data.data;
            });
        };
        
        $scope.onBlur = function() {
            $timeout(function() {
                $scope.searching = false;
            }, 100);
        }
    }


]);