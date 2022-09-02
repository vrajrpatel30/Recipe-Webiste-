fetch('about.php')
.then(response => response.json())
.then(data => {
    document.getElementById('sidebar').innerHTML += data;
})