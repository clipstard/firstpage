var menuItems = ['home', 'imaginary'];
var blocks = [11, 12, 13, 21, 22, 23, 31, 32, 33];

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
        Animation.trigger(scrollIndex);
    });

});


var Animation = {
    init: function () {

    },
    trigger: function (i) {
        Animation.block1(i);
        Animation.block2(i);
        Animation.block3(i);
        Animation.blockFormular();
        Animation.reset();
    },
    block1: function (i) {
        $('#block11').css({left: (i - 48) * (10 + i / 5)}).css({top: 120});
        $('#block12').css({left: (i - 63) * (10 + i / 5)}).css({top: 120});
        $('#block13').css({left: (i - 78) * (10 + i / 5)}).css({top: 120});
    },
    block2: function (i) {
        $('#block21').css({left: (i - 93) * (10 + i / 5)}).css({top: 400});
        $('#block22').css({left: (i - 108) * (10 + i / 5)}).css({top: 400});
        $('#block23').css({left: (i - 123) * (10 + i / 5)}).css({top: 400});
    },
    block3: function (i) {
        $('#block31').css({left: (i - 138) * (10 + i / 5)}).css({top: 720});
        $('#block32').css({left: (i - 153) * (10 + i / 5)}).css({top: 720});
        $('#block33').css({left: (i - 168) * (10 + i / 5)}).css({top: 720});
    },
    blockFormular: function () {
        if ($(document).scrollTop() > 5000) {
            $('#blockFormular').fadeIn('slow');
            Animation.hideOthers();
        } else {
            $('#blockFormular').fadeOut('fast');
            Animation.showOthers();
        }
    },
    reset: function () {
        if ($(document).scrollTop() === 0) scrollIndex = 50;
    },
    status: false,
    hideOthers: function () {
        for (let i of blocks) {
            $('#block' + i).hide('fast');
        }
    },
    showOthers: function () {
        for (let i of blocks) {
            $('#block' + i).show('fast');
        }
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