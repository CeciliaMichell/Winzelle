// slider
var cnt = 1, start = true;
setInterval(function(){
    if(start){
         
        cnt++
        if(cnt > 3) start = false
    }
    if(start == false){
        cnt--
        document.getElementById('radio' + cnt).checked = true
        if(cnt == 1) start = true
    }
}, 3000);

// searching
const keyword = document.querySelector('.keyword');
const containerSearch = document.querySelector('.section-search');
keyword.addEventListener('keyup', function(){
    const url = 'html/ajaxIndex.php?key=' + keyword.value
    fetch(url)
        .then((response) => response.text())
        .then((response) => (containerSearch.innerHTML = response));
});

// category
const containerCategory = document.querySelector('.ctg-product');
function ajaxCategory(ctgID){
    console.log('masuk');
    const url = 'html/ajaxCategory.php?ctg=' + ctgID
    fetch(url)
        .then((response) => response.text())
        .then((response) => {
            containerCategory.innerHTML = response;
    })
}