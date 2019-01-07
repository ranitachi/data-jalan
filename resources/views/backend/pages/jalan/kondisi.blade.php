<div class="row bottom-10">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-5 text-left">Kecamatan</div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{$data->kecamatan->nama_kecamatan}}</b></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-5 text-left">Vol. Panjang </div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{ $data->vol_panjang_km }} Km</b></div>
        </div>
    </div>
</div>
<div class="row bottom-10">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-5 text-left">Nama Ruas Jalan</div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{$data->nama_jalan}}</b></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-5 text-left">Vol. Lebar </div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{ $data->vol_lebar_m }} m</b></div>
        </div>
    </div>
</div>
<div class="row bottom-10">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-5 text-left">No Ruas Jalan</div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{$data->no_ruas}}</b></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-5 text-left">Luas Jalan </div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;<b>{{number_format($data->luas_jalan_m_2,0,',','.')}} m<sup>2</sup></b></div>
        </div>
    </div>
</div>
<div class="row bottom-10">
    <div class="col-md-7">
        &nbsp;
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-5 text-left">Keterangan </div>
            <div class="col-md-7 text-left">:&nbsp;&nbsp;
                @php
                    if ($data->keterangan=='PR')
                    {
                        $label='label label-warning';
                        $ket='Pemeliharaan Rutin';
                    }
                    elseif($data->keterangan=='PKT')
                    {
                        $label='label label-info';
                        $ket='Peningkatan';
                    }
                    elseif($data->keterangan=='REHAB')
                    {
                        $label='label label-lightblue';
                        $ket='Rehabilitasi';
                    }
                    elseif($data->keterangan=='PP')
                    {
                        $label='label label-success';
                        $ket='Pemeliharaan Periodik';
                    }
                    elseif($data->keterangan=='Pemb')
                    {
                        $label='label label-danger';
                        $ket='Pembangunan';
                    }
                @endphp
                <b><span class="{{$label}}">{{$ket}}</span></b>
            </div>
        </div>
    </div>
</div>
<table id="kondisi-table" class="table table-striped table-bordered">
    <thead>
        <tr>

            <th rowspan="2" class="text-center">Type Konstruksi</th>
            <th class="text-center" colspan="4">Kondisi Panjang Ruas Jalan (KM)</th>
            <th rowspan="2" class="text-center">Prosentase <br>Kerusakan (%)</th>
        </tr>
        <tr>
            @foreach ($kond as $idx=>$item)
                <th class="text-center">{{$item}}</th>
            @endforeach
           
        </tr>
    </thead>
    <tbody>
        @foreach ($type as $ix=>$item)
            <tr>
                <td class="text-left">{{$item}}</td>
                @foreach ($kond as $idx=>$itm)
                    <td class="text-right">{{isset($kondisi[$ix][$idx]) ? number_format($kondisi[$ix][$idx],2,',','.') : 0}}</td>
                @endforeach
                @if ($ix=='beton')
                    <td class="text-center" style="vertical-align:middle;" rowspan="3">{{number_format($persentase,2,',','.')}} %</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>