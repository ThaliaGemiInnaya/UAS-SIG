<!DOCTYPE html>
<html>

<head>
    <title>APLIKASI GIS LAHAN PERTANIAN INDONESIA</title>

    <meta charset="UTF-8">
    <meta name="description" content="Clean and responsive administration panel">
    <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
    <meta name="author" content="Erik Campobadal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('public/') ?>images/logo.png">

    <link rel="stylesheet" href="<?= base_url('public/') ?>css/uikit.min.css" />
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('public/') ?>css/style.css" />
    <link rel="stylesheet" href="<?= base_url('public/') ?>css/notyf.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?= base_url('public/') ?>js/uikit.min.js"></script>
    <script src="<?= base_url('public/') ?>js/uikit-icons.min.js"></script>
    <!-- leaflet koneksi -->
    <link rel="stylesheet" href="<?= base_url('public/') ?>leaflet/leaflet.css" />
    <script src="<?= base_url('public/') ?>leaflet/leaflet.js"></script>
    <!-- leaflet koneksi -->
    <!-- Pencarian GIS -->

    <link rel="stylesheet" href="<?= base_url('public/') ?>leaflet-cari/src/leaflet-search.css" />
    <script src="<?= base_url('public/') ?>leaflet-cari/src/leaflet-search.js"></script>
    <!-- Pencarian GIS -->

    <style typle="text/css">
        #mapid {
            height: 700px;
        }
    </style>
</head>

<body>
    <div class="uk-navbar-container tm-navbar-container uk-active">
        <div class="uk-container uk-container-expand">
            <nav uk-navbar>
                <div class="uk-navbar-left">
                    <a href="#" class="uk-navbar-item uk-logo">
                    <img width="140" src="<?= base_url('public/') ?>images/sc.png" /> &nbsp;
                    </a>
                </div>
                <div class="uk-navbar-right">

                </div>
            </nav>
        </div>
    </div>
    <div class="uk-container uk-container-large">
        <article class="uk-comment uk-comment-primary">
            <div id="mapid"></div>
        </article>

        <script type="text/javascript">
            var data = [
                <?php
                foreach ($pertanian as $key => $r) { ?> {
                        "lokasi": [<?= $r->latitudepertanian ?>, <?= $r->longitudepertanian ?>],
                        "kecamatan": "<?= $r->kecamatanpertanian ?>",
                        "keterangan": "<?= $r->keteranganpertanian ?>",
                        "tempat": "<?= $r->lokasipertanian ?>",
                        "kategori": "<?= $r->kategoripertanian ?>"
                    },
                <?php } ?>
            ];

            var map = new L.Map('mapid', {
                zoom: 10,
                center: new L.latLng(-0.789275 , 113.921327)
            });
            map.addLayer(new L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11'
            }));

            var markersLayer = new L.LayerGroup();
            map.addLayer(markersLayer);

            var controlSearch = new L.Control.Search({
                position: 'topleft',
                layer: markersLayer,
                initial: false,
                zoom: 25,
                marker: false
            });

            map.addControl(new L.Control.Search({

                layer: markersLayer,
                initial: false,
                collapsed: true,
            }));

            var angin = L.icon({
                iconUrl: '<?= base_url('public/icon/angin.png') ?>',
                iconSize: [30, 30]
            });

            var banjir = L.icon({
                iconUrl: '<?= base_url('public/icon/banjir.png') ?>',
                iconSize: [30, 30]
            });

            var gempabumi = L.icon({
                iconUrl: '<?= base_url('public/icon/gempabumi.png') ?>',
                iconSize: [30, 30]
            });

            var kebakaran = L.icon({
                iconUrl: '<?= base_url('public/icon/kebakaran.png') ?>',
                iconSize: [30, 30]
            });

            var kecelakaan = L.icon({
                iconUrl: '<?= base_url('public/icon/kecelakaan.png') ?>',
                iconSize: [30, 30]
            });

            var longsor = L.icon({
                iconUrl: '<?= base_url('public/icon/longsor.png') ?>',
                iconSize: [30, 30]
            });

            var pohontumbang = L.icon({
                iconUrl: '<?= base_url('public/icon/pohontumbang.png') ?>',
                iconSize: [30, 30]
            });

            var tsunami = L.icon({
                iconUrl: '<?= base_url('public/icon/tsunami.png') ?>',
                iconSize: [30, 30]
            });

            var icons = "";
            for (i in data) {
                var kecamatan = data[i].kecamatan;
                var lokasi = data[i].lokasi;
                var tempat = data[i].tempat;
                var keterangan = data[i].keterangan;
                var kategori = data[i].kategori;

                if (kategori == "kebun cabai") {
                    icons = banjir;
                } else if (kategori == "sawah") {
                    icons = angin;
                } else if (kategori == "kebun kopi") {
                    icons = tsunami;

                } else if (kategori == "kebun teh") {
                    icons = gempabumi;

                } else if (kategori == "kebun sawit") {
                    icons = kebakaran;

                } else if (kategori == "kebun kelapa") {
                    icons = kecelakaan;
                } else if (kategori == "kebun pisang") {
                    icons = longsor;
                } else if (kategori == "kebun tebu") {
                    icons = pohontumbang;
                }

                var marker = new L.Marker(new L.latLng(lokasi), {
                    title: kecamatan,
                    icon: icons
                });
                marker.bindPopup('<b>Kecamatan: ' + kecamatan + ' <br> Lokasi: ' + tempat + '<br> Keterangan: ' + keterangan + '</b>');
                markersLayer.addLayer(marker);
            }

            var map = L.map('maps').setView({
        lat: 0.7893,
        lon: 113.9213
    }, 5);

    /* warna menggambarkan nilai suatu data */
    function getColor(d) { //add
        return d > (nilaiMax / 8) * 7 ? '#800026' :
            d > (nilaiMax / 8) * 6 ? '#BD0026' :
            d > (nilaiMax / 8) * 5 ? '#E31A1C' :
            d > (nilaiMax / 8) * 4 ? '#FC4E2A' :
            d > (nilaiMax / 8) * 3 ? '#FD8D3C' :
            d > (nilaiMax / 8) * 2 ? '#FEB24C' :
            d > (nilaiMax / 8) * 1 ? '#FED976' :
            '#FFEDA0';
    }

    function style(feature) { //add
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColor(parseInt(feature.properties.nilai))
        };
    }
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    // L.marker({lat : 0.7893, lon : 113.9213}).bindPopup('Hello Indonesia').addTo(map);

    var geojson = L.geoJson(data, {
        style: style,
        onEachFeature: onEachFeature
    }).addTo(map);
    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, (nilaiMax / 8) * 1, (nilaiMax / 8) * 2, (nilaiMax / 8) * 3, (nilaiMax / 8) * 4, (nilaiMax / 8) * 5, (nilaiMax / 8) * 6, (nilaiMax / 8) * 7],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };
    legend.addTo(map);
        </script>
    </div>

</body>

</html>

<!-- MODAl -->
<div id="modal-center" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-container uk-container-large">
            <article class="uk-comment uk-comment-primary">
                <header class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar" src="<?= base_url('public/') ?>images/logo.png" width="80" height="80" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Kembang Negara</a></h4>
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Penelitian,Pengabdian dan Pengajaran</a></h4>

                        </div>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <b>
                        <center>Aplikasi Tentang Lokasi Pemetaan</center>
                    </b>
                </div>
            </article>


        </div>

    </div>
</div>
<!-- MODAl -->