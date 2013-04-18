function GoogleMapInit() {
    console.log(userOriginLat+','+userOriginLng);
    initMap();
    initUserMarker()
    //wyszukujemy sklepy z query
    searchResults();

}

function initMap() {
    var styles = [
        { "featureType":"poi", "stylers":[
            { "visibility":"off" }
        ] }
    ];
    var mapOptions = {
        center:new google.maps.LatLng(userOriginLat, userOriginLng),
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        styles:styles,
        zoom:12
    }
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

}

function initGeoLocation() {
    userOriginLat = 52.104475;
    userOriginLng = 20.635167;
    UserMarker = new Object();
    UserMarker.gm_position = (userOriginLat+','+userOriginLng);
    if (navigator.geolocation) {
        var ng = navigator.geolocation.getCurrentPosition(
            function (position) {
                userOriginLat = position.coords.latitude;
                userOriginLng = position.coords.longitude;
                navMode = 'live';
                UserMarker.gm_position = (userOriginLat+','+userOriginLng);
                GoogleMapInit();
                initUserMarker();
            },
            function (error) {
                switch (error.code) {
                    case error.TIMEOUT:
                        alert('Timeout');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert('Position unavailable');
                        break;
                    case error.PERMISSION_DENIED:
                        alert('Permission denied');
                        break;
                    case error.UNKNOWN_ERROR:
                        alert('Unknown error');
                        break;
                }
            }
        );
    };

}
//search
function searchResults() {
    if (POST.length <= 0) {
        displayNoResults();
    } else {
        url = 'http://www.vertesprojekty.pl/go/www/index.php/jsroute';
        var result = null;
        $.ajax({
            dataType:"json",
            //dataType: "html",
            url:url,
            type:"POST",
            data:{
                data:'',
                method:'searchQuery',
                query:POST.query
            },
            success:function (data, textStatus, jqXHR) {
                searchresult = data;
                if (searchresult.results.length > 0) {
                    filtrateSearchResults();
                }
            }
        });
    }
}

function filtrateSearchResults() {
    if (searchresult) {
        if (POST.km_distance) {
            //km_distance = POST.km_distance;
        }
        for (i in searchresult.results) {
            var start = new google.maps.LatLng(userOriginLat, userOriginLng);
            var posElem = searchresult.results[i].gm_position.split(',');
            var destination = new google.maps.LatLng(posElem[0], posElem[1]);
            var distance = (google.maps.geometry.spherical.computeDistanceBetween(start, destination) / 1000);
            if (distance <= km_distance) {
                markers.push(searchresult.results[i]);
            }
        }
        if (markers.length > 0) {
            initMarkers();
            displayShopsList(markers);
        } else {
            displayNoResults();
        }
    }
}
function initUserMarker() {
    data = UserMarker;
    pos = data.gm_position.split(',');
    var marker = new google.maps.Marker({
        map:map,
        icon: new google.maps.MarkerImage(
            "http://www.vertesprojekty.pl/go/icon/phones.png"
        ),
        position:new google.maps.LatLng(pos[0], pos[1]),
        title:'User'
    });
    google.maps.event.addListener(marker, 'click', function() {
        alert("I am marker " + marker.position);
    });
}
function initMarkers() {
    for (x in markers) {
        data = markers[x];
        pos = data.gm_position.split(',');
        if (data.gm_icon_url != '') {
            var marker = new google.maps.Marker({
                map:map,
                icon: new google.maps.MarkerImage(
                    data.gm_icon_url
                ),
                position:new google.maps.LatLng(pos[0], pos[1]),
                title:data.title
            });
            google.maps.event.addListener(marker, 'click', function() {
                alert("I am marker " + marker.position);
            });
        }
    }
}