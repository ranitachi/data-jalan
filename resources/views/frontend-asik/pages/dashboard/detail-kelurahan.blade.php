@php
    $ds=$d_kel=$d_ds=$jlh=$dt=array();
    $id=0;
    foreach ($d_upk as $k => $v) 
    {
        $n_kel=str_replace(array('DS.','ds.','Ds. ','Ds.','DS. ','ds. ','KEL. ','KEL.','kel.','kel. ','Kelurahan','Kelurahan.','KP.','kp.'),'',$v->desa);
        $d_kel[$n_kel]=$n_kel;
        if(isset($d_kpm[$v->id]))
        {
            foreach ($d_kpm[$v->id] as $kk => $vv) 
            {
                $ds[$id]=$vv->nama;
                if(isset($usul[$v->id][$kk]))
                {
                    $jh=0;
                    foreach ($usul[$v->id][$kk] as $key => $value) {
                        $jh++;
                    }
                    $jlh[$id]=$jl=$jh;
                }
                else
                    $jlh[$id]=$jl=0;
                    
                $dt[$id]=array(
                    'label'=> str_replace(array('KPM','kpm'),'',$vv->nama),
                    'backgroundColor'=>('#'.random_color()),
                    'data'=>array($jl)
                );
                $id++;
            }
        }
    }
    // echo json_encode($dt);
@endphp
            <h3 style="text-align:right;float:right">Kelurahan : <span>{{$kell}}</span></h3>
            </div>
            <!-- listsearch-input-wrap  -->  
            <div class="listsearch-input-wrap fl-wrap" style="margin-top:40px;">
                
                <div class="listsearch-input-item" style="width:100%">
                    <select data-placeholder="Location" class="chosen-select" onchange="detailkelurahan('{{str_replace(' ','%20',$kecamatan)}}',this.value)">
                        <option value="0">--Seluruh Kelurahan--</option>
                        @foreach ($d_kel as $item)
                            @if (strtolower($item)==strtolower($kell))
                                <option value="{{$item}}" selected="selected">{{$item}}</option>
                            @else
                                <option value="{{$item}}">{{$item}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <!-- hidden-listing-filter end -->
               
            </div>
            <!-- listsearch-input-wrap end -->
            <div class="dashboard-header fl-wrap" style="margin-top:40px;">
                <h3>Jumlah Rumah Tidak Layak Huni Per Kampung/Desa </h3>
            </div>
            <div class="col-md-12">
                <canvas id="myChart" height="100"></canvas>
            </div>
      <script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>    
<script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['KPM'],
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