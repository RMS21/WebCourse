var my_top = localStorage.getItem('scroll-top');
if(my_top) {
  window.scrollTo(0, my_top*1);
}
document.onscroll = function() {
  var doc = document.documentElement;
  var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  localStorage.setItem('scroll-top', top);
};
