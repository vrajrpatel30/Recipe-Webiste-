const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

fetch(`details.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('main').innerHTML = data;
    });

fetch('about.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('sidebar').innerHTML += data;
    })