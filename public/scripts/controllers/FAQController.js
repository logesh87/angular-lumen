module.exports = ["FAQService", "$uibModal", "$location", "$rootScope", "$scope",
    function(FAQService, $uibModal, $location, $rootScope, $scope) {
        var vm = this;
        vm.Faqs = [];    

        vm.showForm = false;
        vm.update = false;

		$scope.model = {
			name: 'Tabs'
		};

		vm.showModForm = false;

        vm.currentPage = 1;
        vm.FaqsPerPage = 20;

        vm.login = function() {
            FAQService.login(vm.username, vm.password).then(function success(res) {
                $location.path('/bo');
                $rootScope.isLoggedIn = true;
            }, function(res) {
                if (res = "INVALID_CREDENTIALS") {
                    alert("Please enter valid credentials")
                }
            });
        };


        $rootScope.logout = function() {
            FAQService.logout();            
        };

        vm.saveFaq = function() {

            if (vm.update) {
                vm.updateFaq();
            } else {
                vm.Faq.token = FAQService.getToken();
                FAQService.saveFaq(vm.Faq)
                    .then(function success(res) {
                        vm.Faqs.push(vm.Faq);
                        vm.showForm = false;
                    }, function(res) {
                        console.log(res);
                    });
            }

        };

        vm.getFaqs = function() {
            var begin = ((vm.currentPage - 1) * vm.FaqsPerPage),
                end = begin + vm.FaqsPerPage;

            FAQService.getFaqs(begin)
                .then(function success(res) {
                    vm.Faqs = res.data;
                    vm.totalItems = vm.Faqs[0].totalCount;
                    console.log(vm.Faqs[0]);
                    vm.generic.number = vm.Faqs[0].generic_number;
                    vm.generic.price = vm.Faqs[0].price;
                }, function(res) {
                    console.log(res);
                });
        }

        vm.setPage = function(pageNo) {
            vm.currentPage = pageNo;
        };

        vm.pageChanged = function() {
            vm.getFaqs();
        };

        vm.getFaq = function(id) {
            FAQService.getFaq(id)
                .then(function success(res) {
                    vm.Faq = res.data;
                    vm.showForm = true;
                    vm.update = true;
                }, function(res) {
                    console.log(res);
                });
        }

        vm.updateFaq = function() {
            vm.Faq.token = FAQService.getToken();
            FAQService.updateFaq(vm.Faq)
                .then(function success(res) {
                    vm.getFaqs();
                    vm.showForm = false;
                }, function(res) {
                    console.log(res);
                });
        }


        vm.deleteFaq = function(id) {

            var modalInstance = $uibModal.open({
                animation: true,
                templateUrl: 'scripts/partials/deleteConfirm.tmpl.html',
                controller: ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
                    $scope.ok = function() {
                        $uibModalInstance.close(id);
                    };

                    $scope.cancel = function() {
                        $uibModalInstance.dismiss('cancel');
                    };
                }],
                size: 'sm'
            });

            modalInstance.result.then(function(id) {
                var data = {
                    token: FAQService.getToken(),
                    id: id
                };

                FAQService.deleteFaq(data)
                    .then(function success(res) {
                        vm.Faqs.forEach(function(Faq, i) {
                            if (Faq.id == id) {
                                vm.Faqs.splice(i, 1);
                            }
                        });
                    }, function(res) {
                        console.log(res);
                    });
            }, function() {
                console.log("Modal closed");
            });
        };

        vm.navigate = function(link) {
            if (link == 'form') {
                resetForm();
                vm.update = false;
                vm.showForm = true;
                $scope.bo.form.$setPristine();
                $scope.bo.form.$setUntouched();
            } else if (link == 'grid') {
                vm.showForm = false;
            }
        }

        //vm.getFaqs();


    }
];
