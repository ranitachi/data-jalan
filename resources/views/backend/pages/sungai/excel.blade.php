<?php
    header("Content-Disposition: attachment; filename=Data-Sungai.xls");
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
                            <th rowspan="3">Nama Sungai</th>
                            <th rowspan="3">Jenis</th>
                            <th rowspan="3">Kecamatan</th>
                            <th rowspan="3">Areal</th>
                            <th colspan="3">Panjang Sungai</th>
                            <th colspan="3">Bangunan Utama</th>
                            <th colspan="3">Bangunan Pelengkap</th>
                            <th colspan="2">Saluran</th>
                            <th colspan="8">Yang Sudah Dibangun</th>
                            <th rowspan="3">Sisa</th>
                            <th rowspan="3">Keterangan</th>
                        </tr>
                        <tr>
                            <td>Primer</td>
                            <td>Sekunder</td>
                            <td>Tersier</td>
                            <td>Bendung</td>
                            <td>Pintu Air</td>
                            <td>Bangunan Bagi Sadap</td>
                            <td>Box Tersier</td>
                            <td>Gorong-Gorong</td>
                            <td>Jembatan</td>
                            <td>Pasangan</td>
                            <td>Tanah</td>
                            <td>Bendung</td>
                            <td>Pintu Air</td>
                            <td>Bangunan Bagi Sadap</td>
                            <td>Box Tersier</td>
                            <td>Gorong2</td>
                            <td>Jembatan</td>
                            <td>Pasangan</td>
                            <td>Tanah</td>
                        </tr>
                        <tr>
                            <td>M'</td>
                            <td>M'</td>
                            <td>M'</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>M'</td>
                            <td>M'</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>( Bh )</td>
                            <td>M'</td>
                            <td>M'</td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item['nama_sungai'] }}</td>
                                <td>{{ $item['jenis'] }}</td>
                                <td>{{ $item['kecamatan']}}</td>
                                <td style="text-align:center">{{ number_format($item['areal'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_sungai_primer'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_sungai_sekunder'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_sungai_tersier'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_bendung'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_pintu_air'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_bagi_sadap'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_terlengkap_box_tersier'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_terlengkap_box_gorong'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_terlengkap_box_jembatan'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['saluran_bendung'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['saluran_tanah'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_bendung'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_pintu_air'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_bagi_sadap'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_box_tersier'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_gorong'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_jembatan'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_pasangan'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sudah_dibangun_tanah'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['sisa'],2,',','.') }}</td>
                                <td class="text-center">{{ $item['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
