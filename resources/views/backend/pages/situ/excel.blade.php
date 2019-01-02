<?php
    header("Content-Disposition: attachment; filename=Data-Situ.xls");
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
                            <th rowspan="2">Nama SITU</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">Desa</th>
                            <th rowspan="2">DAS</th>
                            <th colspan="2">Luas</th>
                            <th colspan="3">Pengelolaan</th>
                            <th rowspan="2">Kondisi</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <td>Asal (Ha)</td>
                            <td>Sekarang (Ha)</td>
                            <td>Pusat</td>
                            <td>Provinsi</td>
                            <td>Kabupaten</td>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item['nama_situ'] }}</td>
                                <td>{{ $item['kecamatan']['nama_kecamatan'] }}</td>
                                <td>{{ $item['kelurahan']['nama_kelurahan'] }}</td>
                                <td>{{ $item['das'] }}</td>
                                <td style="text-align:center">{{ number_format($item['luas_asal'],2,',','.') }}</td>
                                <td style="text-align:center">{{ number_format($item['luas_sekarang'],2,',','.') }}</td>
                                <td class="text-center">{{ $item['pengelolaan_pusat']==1 ? 'Pusat' : '' }}</td>
                                <td class="text-center">{{ $item['pengelolaan_provinsi']==1 ? 'Provinsi' : '' }}</td>
                                <td class="text-center">{{ $item['pengelolaan_kabupaten']==1 ? 'Kabupaten' : '' }}</td>
                                <td class="text-center">{{ $item['kondisi'] }}</td>
                                <td class="text-center">{{ $item['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
