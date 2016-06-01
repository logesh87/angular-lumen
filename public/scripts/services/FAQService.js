module.exports = ["$http", "$q", "BASE_URL", "$window",
    function($http, $q, BASE_URL, $window) {

        var Faq = $window.localStorage;
        var key = 'auth-token';

        function saveFaq(Faq) {
            return $http.post(BASE_URL + 'saveFaq', Faq)
        }

        function getFaqs(begin) {
            return $http.get(BASE_URL + 'faqs/' + begin);
        }

        function getFaqArchived() {
            return $http.get(BASE_URL + 'faqArchived/');
        }

        function getFaq(id) {
            return $http.get(BASE_URL + 'faq/' + id);
        }

        function updateFaq(Faq) {
            return $http.post(BASE_URL + 'updateFaq', Faq);
        }

        function deleteFaq(data) {
            return $http.post(BASE_URL + 'deleteFaq', data);
        }

        function login(username, password) {
            var deferred = $q.defer();
            $http.post(BASE_URL + 'login', {
                username: username,
                password: password,
                token: getToken()
            }).then(function success(res) {
                
                if (res.data.message == "INVALID_CREDENTIALS") {
                    deferred.reject(res.data.message);
                }else{
                    deferred.resolve({message: "Success"});
                    setToken(res.data.token);
                }                
            }, function(res){
                deferred.reject(res);
            });

            return deferred.promise;
        }

        function logout() {
            setToken();
            $window.location.reload();
        }

        function getToken() {
            return Faq.getItem(key);
        }

        function setToken(token) {
            if (token) {
                Faq.setItem(key, token)
            } else {
                Faq.removeItem(key);
            }
        }

/*        function addToken(config) {
            var token = AuthTokenFactory.getToken();
            if (token) {
                config.headers = config.headers || {};
                config.headers.Authorization = 'Bearer ' + token;
            }
            return config;
        }*/

        return {
            saveFaq: saveFaq,
            getFaqs: getFaqs,
            getFaq: getFaq,
            updateFaq: updateFaq,
            deleteFaq: deleteFaq,
            getToken : getToken,
            setToken : setToken,
            getFaqArchived: getFaqArchived,
            login: login,
            logout:logout
        }


    }
]
