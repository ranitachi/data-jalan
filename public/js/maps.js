var jlh, jlhodp, jlhphp, positif,url;

function addDataToMap(data, map) {
    var dataLayer = L.geoJson(data,{
        style: {
            weight: 1.2,
            color: "#000",
            opacity: 1,
            fillColor: "#decdec",
            fillOpacity: 0.9
        },
        pointToLayer: function (feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: "#ff7800",
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });
            }
    });
    dataLayer.addTo(map);
}

function peta_map(lebar)
{
    var lat = -6.1785876
    var lng = 106.53510427;
    var map = L.map('map-main', {
        center: [lat, lng],
        minZoom: 2,
        zoom: (lebar<700 ? 10 : 12),
        scrollWheelZoom: false,
        zoomControl: false
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '<a href="https://tangerangkab.go.id" target="_blank" style="float:left">Kabupaten Tangerang&nbsp;|&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a', 'b', 'c'],
        opacity:0.4
    }).addTo(map);

    // $.getJSON(baseurl + "/files/kelurahan/BatasDesa.geojson", function (data) { addDataToMap(data, map); });

    // L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=qAMFOSY9huv3KFrdR8Ct', {
    //     attribution: '<a href="https://tangerangkab.go.id" target="_blank" style="float:left">Kabupaten Tangerang&nbsp;|&nbsp;</a><a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
    //     subdomains: ['a', 'b', 'c']
    // }).addTo(map);

   
    // L.geoJSON(batas_kecamatan, {
    //     style: {
    //         weight: 1,
    //         color: "#000",
    //         opacity: 1,
    //         fillColor: "#decdec",
    //         fillOpacity: 0.7
    //     },
    //     onEachFeature: onEachFeature,
    // }).addTo(map);

    

    $.getJSON(baseurl +'/files/BatasKecamatan.geojson', function(data){
        L.geoJSON(data, {
            style: {
                weight: 1,
                color: "#123123",
                opacity: 1,
                fillColor: "#92278f",
            },
            onEachFeature: onEachFeature,
        }).addTo(map);
    });

    $.getJSON(baseurl + '/files/KecamatanLabel.geojson', function (data) {
        L.geoJSON(data, {
            pointToLayer: markerKecamatan,
            onEachFeature: labelKecamatan,
        }).addTo(map);
    });
    // if(lebar >= 700 )
    // {
        $.getJSON(baseurl + '/files/KecamatanPoint.geojson', function (data) {
            L.geoJSON(data, {
                pointToLayer: createCircleMarker,
                onEachFeature: labelODP,
            }).addTo(map);
        });
        
        $.getJSON(baseurl + '/files/KecamatanPoint2.geojson', function (data) {
            L.geoJSON(data, {
                pointToLayer: createCircleMarker2,
                onEachFeature: labelPositif,
            }).addTo(map);
        });
        $.getJSON(baseurl + '/files/KecamatanPoint3.geojson', function (data) {
            L.geoJSON(data, {
                pointToLayer: createCircleMarker3,
                onEachFeature: labelCirclePdp,
            }).addTo(map);
        });
    // }
    // $.getJSON(baseurl + "/files/kelurahan/BatasDesa.geojson", function (data) {
    //     // L.geoJson function is used to parse geojson file and load on to map
    //     L.geoJSON(data, {
    //         style: {
    //             weight: 0.4,
    //             color: "#888",
    //             fillColor: "#decdec",
    //             opacity: 1,
    //             fillOpacity: 0.4
    //         },
    //         pointToLayer: createCircleMarker
    //     }).addTo(map);
    // });

    // L.geoJSON(myLines, {
    //     style: myStyle
    // }).addTo(map);

    
}
function markerKecamatan(feature, latlng) {
    // Change the values of these options to change the symbol's appearance
    let options = {
        radius: 0,
        weight: 0,
        opacity: 1,
        fillOpacity: 1.0
    }
    return L.circleMarker(latlng, options);
}
function createCircleMarker(feature, latlng) {
    // Change the values of these options to change the symbol's appearance
    let options = {
        radius: 11,
        fillColor: "blue",
        color: "black",
        weight: 2,
        opacity: 1,
        fillOpacity: 1.0
    }
    return L.circleMarker(latlng, options);
}
function createCircleMarker2(feature, latlng) {
    // Change the values of these options to change the symbol's appearance
    let options = {
        radius: 11,
        fillColor: "#f12a51",
        color: "black",
        weight: 2,
        opacity: 1,
        fillOpacity: 1.0
    }
    return L.circleMarker(latlng, options);
}
function createCircleMarker3(feature, latlng) {
    // Change the values of these options to change the symbol's appearance
    let options = {
        radius: 11,
        fillColor: "#f2c94c",
        color: "black",
        weight: 2,
        opacity: 1,
        fillOpacity: 1.0
    }
    return L.circleMarker(latlng, options);
}
function labelODP(feature, layer)
{
    url = baseurl + '/jlh-per-kecamatan/' + feature.properties.kecamatan;
    $.getJSON(url, function (data) {

        var jlh = data.jlhodp.toString()
        if(jlh!='0')
        {
            layer.bindTooltip(jlh, {
                permanent: true,
                direction: 'center',
                className: 'countryLabel'
            });
        }
        else
        {
            layer.setStyle({
                radius: 0,
                weight: 0,
                opacity: 0,
                fillOpacity: 0.0
            });
        }
    });
}
function labelPositif(feature, layer)
{
    url = baseurl + '/jlh-per-kecamatan/' + feature.properties.kecamatan;
    $.getJSON(url, function (data) {

        var jlh = data.positif.toString()
        if (jlh != '0') {
            layer.bindTooltip(jlh, {
                permanent: true,
                direction: 'center',
                className: 'countryLabel'
            });
        }
        else
        {
            layer.setStyle({
                radius: 0,
                weight: 0,
                opacity: 0,
                fillOpacity: 0.0
            });
        }
    });
}
function labelCirclePdp(feature, layer)
{
    url = baseurl + '/jlh-per-kecamatan/' + feature.properties.kecamatan;
    $.getJSON(url, function (data) {

        var jlh = data.jlhpdp.toString()
        if (jlh != '0') {
            layer.bindTooltip(jlh, {
                permanent: true,
                direction: 'center',
                className: 'countryLabelPDP'
            });
        }
        else
        {
            layer.setStyle({
                radius: 0,
                weight: 0,
                opacity: 0,
                fillOpacity: 0.0
            });
        }
    });
}
function labelKecamatan(feature, layer) {
    var kec=feature.properties.kecamatan
    if(lebar>=700)
    {

        layer.bindTooltip(kec, {
            permanent: true,
            direction: 'center',
            className: 'countryLabelKecamatan'
        });
    }
    else
    {
        layer.bindTooltip(kec, {
            permanent: true,
            direction: 'center',
            className: 'countryLabelKecamatanSm'
        });
        
    }
}
function onEachFeature(feature, layer) {
    var popupContent = "";
    
    // L.marker([lat, lon]).addTo(map);
    url = baseurl + '/jumlah-per-kecamatan/' + feature.properties.name;
    // url = baseurl + '/jumlah-per-kelurahan/' + (feature.properties.KECAMATAN) + '/' + (feature.properties.name);
    $.getJSON(url, function (data) {
        jlh = data.total;
        jlhodp = data.jlhodp;
        jlhphp = data.jlhpdp;
        meninggal = data.meninggal;
        positif = data.positif;
        popupContent = '<div class="infobox" style="width:500px">\n\
                            <div style="width:100%;height:150px">\n\
                                <div style="width:300px;float:left">\n\
                                    <div class="title text-left">\n\
                                        <div class="row">\
                                            <div class="col-md-4"><img src="'+ baseurl +'/logo-tangkab.png" style="height:65px;"></div>\
                                            <div class="col-md-8 text-left" style="padding-top:5px"><a href="#">Kecamatan ' + feature.properties.name + '</a></div>\
                                        </div>\
                                    </div>\n\
                                    <div class="content clearfix">\n\
                                        <div class="text-center">\n\
                                        </div>\n\
                                    </div>\n\
                                        <div class="infobox-footer text-color-primary text-left">\n\
                                            <div class="property-preview-f-left text-left"> \n\
                                                    <div class="row" style="color:#0d11ff"> \n\
                                                        <div class="col-sm-5 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                Jumlah ODP \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-center" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                : \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-3 text-right" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                ' + jlhodp + ' Orang\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                \n\
                                                            </span> \n\
                                                        </div> \n\
                                                    </div> \n\
                                                    <div class="row" style="color:#f2c94c"> \n\
                                                        <div class="col-sm-5 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                Jumlah PDP \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-center" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                : \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-3 text-right" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                ' + jlhphp + ' Orang\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                \n\
                                                            </span> \n\
                                                        </div> \n\
                                                    </div> \n\
                                                    <div class="row" style="color:red"> \n\
                                                        <div class="col-sm-5 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                Terkonfirmasi (+)\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-center" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                : \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-3 text-right" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                ' + positif + ' Orang\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value"> \n\
                                                                \n\
                                                            </span> \n\
                                                        </div> \n\
                                                    </div> \n\
                                                    <!--<div class="row" style="color:black"> \n\
                                                        <div class="col-sm-5 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                Meninggal\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-center" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                : \n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-3 text-right" style="font-size:12px;"> \n\
                                                            <span class="property-card-value" style="font-weight:bold"> \n\
                                                                ' + meninggal + ' Orang\n\
                                                            </span> \n\
                                                        </div> \n\
                                                        <div class="col-sm-1 text-left" style="font-size:12px;"> \n\
                                                            <span class="property-card-value"> \n\
                                                                \n\
                                                            </span> \n\
                                                        </div> \n\
                                                    </div>--> \n\
                                            </div> \n\
                                        </div>\n\
                                    </div>\n\
                                    <div style="width:150px;float:right;"><div style="height:90px;margin-top:25px;width:100%;text-align:center">' + data.piechart + '</div></div>\n\
                                </div>\n\
                                <div class="infobox-footer text-color-primary bg-primary text-center" style="padding:10px 0px;"><a href="sebaran-data/'+data.idkec+'/'+feature.properties.name+'" style="color:white !important;font-weight:bold;">Klik Disini Untuk Melihat Data Lengkap Per Kelurahan <i class="fa fa-chevron-right"></i> </a></div>\n\
                            </div>';
                        var kec = feature.properties.name.replace(/ /g, ' ');
                        layer.on({
                            mouseover: function () {
                                this.setStyle({
                                    'fillColor': '#dddddd',
                                });
                            },
                            mouseout: function () {
                                this.setStyle({
                                    'fillColor': '#92278f',
                                });
                            },
                            click: function () {
                                // TODO Link to page
                                // alert('/Clicked on ' + feature.properties.kecamatan)
                            }
                        });
                        layer.bindPopup(popupContent, {
                            maxWidth: 510
                        });
                    
    });

    // if (feature.properties && feature.properties.popupContent) {
    //     popupContent += feature.properties.popupContent;
    // }

    // 
    
}
function pilihkecamatan(val) {
    location.href = baseurl + '/sebaran-data/' + val;
}

// var MyBarChartMethods = {
//     // sort a dataset
//     sort: function (chart, datasetIndex) {
//         var data = []
//         chart.datasets.forEach(function (dataset, i) {
//             dataset.bars.forEach(function (bar, j) {
//                 if (i === 0) {
//                     data.push({
//                         label: chart.scale.xLabels[j],
//                         values: [bar.value]
//                     })
//                 } else
//                     data[j].values.push(bar.value)
//             });
//         })

//         data.sort(function (a, b) {
//             if (a.values[datasetIndex] > b.values[datasetIndex])
//                 return -1;
//             else if (a.values[datasetIndex] < b.values[datasetIndex])
//                 return 1;
//             else
//                 return 0;
//         })

//         chart.datasets.forEach(function (dataset, i) {
//             dataset.bars.forEach(function (bar, j) {
//                 if (i === 0)
//                     chart.scale.xLabels[j] = data[j].label;
//                 bar.label = data[j].label;
//                 bar.value = data[j].values[i];
//             })
//         });
//         chart.update();
//     },
//     // reload data
//     reload: function (chart, datasetIndex, labels, values) {
//         var diff = chart.datasets[datasetIndex].bars.length - values.length;
//         if (diff < 0) {
//             for (var i = 0; i < -diff; i++)
//                 chart.addData([0], "");
//         } else if (diff > 0) {
//             for (var i = 0; i < diff; i++)
//                 chart.removeData();
//         }

//         chart.datasets[datasetIndex].bars.forEach(function (bar, i) {
//             chart.scale.xLabels[i] = labels[i];
//             bar.value = values[i];
//         })
//         chart.update();
//     }
// }