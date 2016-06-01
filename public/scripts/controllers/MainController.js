module.exports = function(){
    var vm = this;
    vm.toggleMenu = false;
    
    vm.toggleMenuClass = function(e){
        e.preventDefault();
        vm.toggleMenu = !vm.toggleMenu;
    }
};