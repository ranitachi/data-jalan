<?php
    header("Content-Disposition: attachment; filename=Data-Jembatan.xls");
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
                            <th rowspan="2" style="width:15px;">#</th>
                            <th rowspan="2">No. Jembatan Baru</th>
                            <th rowspan="2">No. Ruas Jalan</th>
                            <th rowspan="2">Nama Ruas</th>
                            <th rowspan="2">Kecamatan</th>
                            <th colspan="2">Volume</th>
                            <th rowspan="2">STA Jembatan</th>
                            <th colspan="2">Volume</th>
                            <th colspan="4">Kondisi Jembatan</th>
                            <th rowspan="2">Penanganan</th>
                            <th colspan="6">Biaya Penanganan</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <td>Panjang (Km)</td>
                            <td>Lebar (M)</td>
                            <td>Bentang (M)</td>
                            <td>Lebar (M)</td>
                            <td>B</td>
                            <td>S</td>
                            <td>R</td>
                            <td>RB</td>
                            <td>Volume (M<sup>2</sup>)</td>
                            <td>Biaya Rp</td>
                            <td>Biaya PR (Rp)</td>
                            <td>Biaya PP (Rp)</td>
                            <td>Biaya REHAP (Rp)</td>
                            <td>Biaya PKT (Rp)</td>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item['no_jembatan'] }}</td>
                                <td>{{ $item['no_ruas_jalan'] }}</td>
                                <td>{{ isset($jalan[$item['no_ruas_jalan']]) ? $jalan[$item['no_ruas_jalan']]->nama_jalan :'' }}</td>
                                <td>{{ $item['nama_kecamatan'] }}</td>
                                <td style="text-align:center">{{ number_format($item['vol_panjang_m'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['vol_lebar_m'],2,',','.') }}</td>
                                <td style="text-align:center">{{ $item['sta_jembatan'] }}</td>
                                <td style="text-align:center">{{ number_format($item['vol_bentang'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['vol_leb'],2,',','.') }}</td>
                                <td class="text-center">{{ $item['kondisi_b'] }}</td>
                                <td class="text-center">{{ $item['kondisi_s'] }}</td>
                                <td class="text-center">{{ $item['kondisi_r'] }}</td>
                                <td class="text-center">{{ $item['kondisi_rb'] }}</td>
                                <td class="text-center">{{ $item['penanganan'] }}</td>
                                <td style="text-align:center">{{ number_format($item['volume'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['biaya_total'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['biaya_pr'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['biaya_pp'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['biaya_rehab'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['biaya_pkt'],2,',','.') }}</td>
                                <td class="text-center">{{ $item['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
