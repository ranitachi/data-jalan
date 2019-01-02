<?php
    header("Content-Disposition: attachment; filename=Data-Jalan.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    // $file = "Data-Jalan.xlsx" ;
    // header('Content-Disposition: attachment; filename='.$file);
    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Length: ' . filesize($file));
    // header('Content-Transfer-Encoding: binary');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // ob_clean();
    // flush(); 
    // readfile($file);

?>
    <table border="1">
                    <thead border="1">
                        <tr>
                            <th rowspan="3" style="width:15px;">#</th>
                            <th rowspan="3">Kecamatan</th>
                            <th rowspan="3">No Ruas</th>
                            <th rowspan="3">Nama Jalan</th>
                            <th rowspan="2" colspan="2">Volume</th>
                            <th rowspan="2">Luas Jalan</th>
                            <th colspan="3" rowspan="2">Tipe Konstruksi</th>
                            <th colspan="12">Kondisi Panjang Ruas Jalan (Km)</th>
                            <th rowspan="3">Keterangan</th>
                        </tr>
                        <tr>
                            <td colspan="4">Beton</td>
                            <td colspan="4">Aspal</td>
                            <td colspan="4">Lain-lain</td>
                        </tr>
                        <tr>
                            <th>Panjang (Km)</th>
                            <th>Lebar (m)</th>
                            <th>Lebar<sup>m</sup></th>
                            <th>Beton</th>
                            <th>Aspan</th>
                            <th>Lain<sup>2</sup></th>
                            <th>B</th>
                            <th>S</th>
                            <th>R</th>
                            <th>RB</th>
                            <th>B</th>
                            <th>S</th>
                            <th>R</th>
                            <th>RB</th>
                            <th>B</th>
                            <th>S</th>
                            <th>R</th>
                            <th>RB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item['kecamatan']['nama_kecamatan'] }}</td>
                                <td>{{ $item['no_ruas'] }}</td>
                                <td>{{ $item['nama_jalan'] }}</td>
                                <td style="text-align:center">{{ $item['vol_panjang_km'] }} Km</td>
                                <td style="text-align:center">{{ $item['vol_lebar_m'] }} m</td>
                                <td style="text-align:center">{{ $item['luas_jalan_m_2'] }} m<sup>2</sup></td>
                                <td style="text-align:center">{{ $item['type_kons_beton'] }} Km</td>
                                <td style="text-align:center">{{ $item['type_kons_aspal'] }} Km</td>
                                <td style="text-align:center">{{ $item['type_kons_dll'] }} Km</td>

                                @if (isset($kondisi[$item['id']]))
                                    @foreach ($kondisi[$item['id']] as $idx=>$itm)
                                        @foreach ($itm as $id=>$it)
                                            <td style="text-align:center">{{$it}}</td>
                                        @endforeach
                                    @endforeach
                                @else
                                    <td colspan="{{count(12)}}">-</td>
                                @endif

                                @php
                                    if ($item['keterangan']=='PR')
                                        $label='label label-warning';
                                    elseif($item['keterangan']=='PKT')
                                        $label='label label-info';
                                    elseif($item['keterangan']=='REHAB')
                                        $label='label label-lightblue';
                                    elseif($item['keterangan']=='PP')
                                        $label='label label-success';
                                    elseif($data['keterangan']=='Pemb')
                                        $label='label label-danger';
                                @endphp
                                <td class="text-center"><span class="{{$label}}">{{ $item['keterangan'] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
