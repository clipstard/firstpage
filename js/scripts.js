var lei = [1, 5, 10 , 20, 50, 100, 200, 500, 1000];
var bani = [1, 5, 10, 25, 50];
var currentBan = 9990;

var getNext = function() {
    currentBan++;
    if (currentBan >= bani.length) currentBan = 0;
    return bani[currentBan];
};

function init() {
    setInterval(() => {
        header.setImage(getNext());
    }, 1500);

    for(let i = 0; i < lei.length; i++) {
        image.insert(image.id('lei'), lei[i], false);
        image.insert(image.id('lei_verso'), lei[i], true);
    }
}

var header = {
  setImage: function (id) {
    this.getImage().src = this.getImageName(id);
  },
  getImage: function () {
      return document.getElementById('header-img');
  },
    getImageName: function (id) {
      return 'img/bani_' + id + '.png';
    }

};
var image = {
  insert: function (id, value, type = false) {
    var elem = document.createElement('div');
    var image = document.createElement('img');
    image.width = 380;
    image.height = 180;
    image.src = (type) ?
        'img/lei_' + value + '_verso.png' :
        'img/lei_' + value + '.png';
    elem.append(image);
    id.append(elem);
  },

  id: function (elem) {
      return document.getElementById(elem);
  }

};


init();