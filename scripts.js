function clearAddRecipeForm() {
    var arr = document.getElementsByTagName("input");
    Array.prototype.forEach.call(arr, function(element) {
        if(element.getAttribute("type")=="text") {
            //console.log(element);
            element.value = "";
        }
    });
    arr = document.getElementsByTagName("textarea");
    Array.prototype.forEach.call(arr, function(element) {
        element.value = "";
    });
}