var menuItems = ['home', 'imaginary'];

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
    init: function () {
        let _this = this;
        for (let item of menuItems) {
            this.elem(item).on('click', function () {
                _this.activate(_this.elem(item));
            })
        }
        _this.activate(_this.elem(menuItems[0]));
    }
};
var scrollIndex = 50;
$(document).ready(function () {
    $('#blockFormular').hide('fast');
    menuManager.init();
    var scrollDetector = 0;
    $('body').css({backgroundColor: 'rgb(72, 68,' + scrollIndex + ')'});
    $(document).on('scroll', function () {
        ($(document).scrollTop() > scrollDetector) ? scrollIndex++ : scrollIndex--;
        scrollDetector = $(document).scrollTop();
        $('body').css({backgroundColor: 'rgb(72,68,' + scrollIndex + ')'});
    });

});

document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc");
    } else {
        isEscape = (evt.keyCode === 27);
    }
    if (isEscape) {
        hideRegisterModal();
    }
};

var Basic = {
  id: function(index) {
      return $('#' + index);
  }
};
var Form = {
    _this: this,
    errors: [],
    validate: function() {
        this.errors = [];
       this
           .checkLength('materialRegisterFormFirstName')
           .checkLength('materialRegisterFormLastName')
           .checkLength('materialRegisterFormPassword')
           .checkEmail('materialRegisterFormEmail')
        ;
    },
    checkLength: function(id) {
        Basic.id(id).removeClass('has-error');
        if (Basic.id(id).val().length < 3) {
            this.errors.push(id);
        }
        return this;
    },
    checkEmail: function(id) {
        if (Basic.id(id).val().length <= 3) {
            this.errors.push(id);
        } else if (!~Basic.id(id).val().indexOf('@') || !~Basic.id(id).val().indexOf('.')) {
            this.errors.push(id);
        }
        return this;
    },
    submit: function(){
        this.validate();
        if (!this.errors.length) {
            $('form').submit();
        }else {
            for (let error of this.errors) {
                Basic.id(error).addClass('has-error');
            }
        }
    }
};

function test() {
    Form.submit();
    return false;
}


function showRegisterModal() {
    $('#blockFormular').fadeIn('slow');
    $('.curtain').css({width: '100%', height: '100%'});
}

function hideRegisterModal() {
    $('#blockFormular').fadeOut(500);
    setTimeout(() => {
        $('.curtain').css({width: 0, height: 0});
    }, 475);
}