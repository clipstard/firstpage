var menuItems = ['home', 'imaginary']

var menuManager = {
    id: function (name) {
        return 'nav-' + name;
    },
    elem: function (id) {
        return $('#' + this.id(id));
    },
    activate: function (elem) {
        for (let item of menuItems) {
            this.elem(item).removeClass('active');
        }
        elem.addClass('active');
    },
    init: function (){
        let _this = this;
        for(let item of menuItems) {
            this.elem(item).on('click', function () {
                _this.activate(_this.elem(item));
            })
        }
        _this.activate(_this.elem(menuItems[0]));
    }
};

$(document).ready(function () {
   menuManager.init();
   var i = 50;
   var scrollDetector = 0;
    $('body').css({backgroundColor: 'rgb(72, 68,' + i++ + ')'})
   $(document).on('scroll', function () {
       ($(document).scrollTop() > scrollDetector) ? i++ : i--;
       scrollDetector = $(document).scrollTop();
      $('body').css({backgroundColor: 'rgb(72,68,' + i + ')'})
   });
});