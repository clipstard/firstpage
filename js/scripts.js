var bani = [1, 5, 10, 25, 50];
var currentBan = 0;

function getNext() {
    currentBan++;
    if (currentBan >= bani.length) currentBan = 0;
    return bani[currentBan];
}

function init() {
    var button1 = button.getItem(1);
    button1.addEventListener('click', function () {
        alert(1)
    });
    setInterval(() => {
        header.setImage(getNext());
    }, 1500);
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
var button = {
    getItem: function (id) {
        return document.getElementById(this.getFullId(id));
    },
    getFullId: function (id) {
        return 'button' + id.toString();
    }
};


init();