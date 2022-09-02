const urlParams = new URLSearchParams(window.location.search);
const q = urlParams.get('q');

fetch(`course.php?q=${q}`)
.then(response => response.json())
.then(data => {
    document.getElementById('main').innerHTML = data;
})

fetch('about.php')
.then(response => response.json())
.then(data => {
    document.getElementById('sidebar').innerHTML += data;
})