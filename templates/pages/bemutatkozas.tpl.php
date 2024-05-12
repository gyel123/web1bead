<h2>Rövid bemutatkozás:</h2>
<p>Teherautók nyomkövetésére létrejött szolgáltatás vagyunk.
Az elmúlt pár évben lettünk piacvezetők magyarországon a nyomkövetésben!
Próbálja ki, nem fogja megbánni.</p>
<iframe width="420" height="315" src="https://www.youtube.com/embed/hkysTzikBBU?si=lrtRjPvPqYkcwgNQ"></iframe><br/>
<h3> Egyedi gépjárművek is vannak</h3>
<video width="420" height="315" controls>
<source src="video/volvo.mp4" type="video/mp4">
</video>
<!--GPS-->
<p>Az aktuális helyzeted GPS koordinátája</p>
<p>Hasonló elven működik a gépkocsik aktuális helyzetlekérése:</p>
<button onclick="getLocation()">Próbáld ki, klikkelj ide</button>
<p id="demo"></p>

<script>
    var x = document.getElementById("demo");
    
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Ez a böngésző nem támogatja a földrajzi helymeghatározást.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Szélesség: " + position.coords.latitude + "<br> Hosszúság: " + position.coords.longitude;
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "Felhasználó elutasította a helymeghatározást.";
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Nem lehet meghatározni a helyet.";
                break;
            case error.TIMEOUT:
                x.innerHTML = "A helymeghatározás túllépte az időkorlátot.";
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "Ismeretlen hiba történt a helymeghatározás során.";
                break;
        }
    }
</script>
