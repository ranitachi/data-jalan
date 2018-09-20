@php
    $kel=$d_kel=$jlh=$dt=array();
    $id=0;
    foreach ($d_upk as $k => $v) 
    {
        $n_kel=str_replace(array('DS.','ds.','Ds. ','Ds.','DS. ','ds. ','KEL. ','KEL.','kel.','kel. ','Kelurahan','Kelurahan.','KP.','kp.'),'',$v->desa);
        
        $kel[$id]=$n_kel;
        $d_kel[$n_kel]=$n_kel;
        if(isset($usul[$v->id]))
        {
            $jh=0;
            foreach($usul[$v->id] as $idx => $val)
            {
                $jh++;
            }
            $jlh[$id]=$jl=$jh;
        }
        else 
        {
            $jlh[$id]=$jl=0;
        }
        $dt[$id]=array(
            'label'=> $n_kel,
            'backgroundColor'=>('#'.random_color()),
            'data'=>array($jl,22)
        );
        $id++;
    }
    // echo '<pre>';
    // print_r($dt);
    // echo '/<pre>';
    // echo json_encode($dt);
@endphp
            <h3 style="text-align:right;float:right">Kecamatan : <span>{{$kecamatan}}</span></h3>
            </div>
            <!-- listsearch-input-wrap  -->  
            <div class="listsearch-input-wrap fl-wrap" style="margin-top:40px;">
                
                <div class="listsearch-input-item" style="width:100%">
                    <select data-placeholder="Location" class="chosen-select" onchange="detailkelurahan('{{str_replace(' ','%20',$kecamatan)}}',this.value)">
                        <option value="0">--Seluruh Kelurahan--</option>
                        @foreach ($d_kel as $item)
                            <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- hidden-listing-filter end -->
               
            </div>
            <!-- listsearch-input-wrap end -->
            <div class="dashboard-header fl-wrap" style="margin-top:40px;">
                <h3>Statistik Rumah Tidak Layak Huni Per Kelurahan</h3>
            </div>
            <div class="col-md-12" style="padding-top:20px;">
                <canvas id="myChart" height="100"></canvas>
            </div>
<script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>   
<script>
        //labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        //data: [12, 19, 3, 5, 2, 3],
        /*
        [
                    {
                        label: '# of Votes',
                        backgroundColor: "#000080",
                        data: [80]
                    }, {
                        label: '# of Votes2',
                        backgroundColor: "#d3d3d3",
                        data: [90]
                    }, {
                        label: '# of Votes3',
                        backgroundColor: "#add8e6",
                        data: [45]
                    }
                ]*/
        var ctx = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Kelurahan'],
                datasets: <?php echo json_encode($dt);?>
            },

            options: {
                legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: "#000080",
                }
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                },
                plugins: {
                    datalabels: {
                            align: 'bottom',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.');
                            }
                        }
                    }
            }
        });
        </script>