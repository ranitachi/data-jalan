<?php
    header("Content-Disposition: attachment; filename=Data-Irigasi.xls");
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
                            <th rowspan="2">Daerah Irigasi</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">Areal (Ha)</th>
                            <th colspan="3">Panjang Saluran</th>
                            <th colspan="3">Bangunan Utama</th>
                            <th colspan="3">Bangunan Pelengkap</th>
                            <th rowspan="2">Sumber Air</th>
                        </tr>
                        <tr>
                            <td>Primer (m)</td>
                            <td>Sekunder (m)</td>
                            <td>Tersier (m)</td>
                            <td>Bendung (Bh)</td>
                            <td>Pintu Air (Bh)</td>
                            <td>Bang Bagi/Intake (Bh)</td>
                            <td>Box Tersier (Bh)</td>
                            <td>Gorong-Gorong (Bh)</td>
                            <td>Jembatan (Bh)</td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item['daerah_irigasi'] }}</td>
                                <td>{{ $item['id_kecamatan'] }}</td>
                                <td style="text-align:center">{{ number_format($item['areal'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_saluran_primer'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_saluran_sekunder'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['panjang_saluran_tersier'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_gedung'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_pintu_air'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['bangunan_utama_intake'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['pelengkap_box_tersier'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['pelengkap_gorong'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['pelengkap_jembatan'],2,',','.') }}</td>
                                <td class="text-center">{{ $item['sumber_air'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
