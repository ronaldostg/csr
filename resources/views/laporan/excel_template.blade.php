 

<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="8">
                <h1 style="text-align:center; font-weight:bold; font-size:40px;">
                    Laporan Realisasi Kemitraan Unit {{ $data['nama_pemda'] }} tahun {{ $data['tahun'] }} </h1>
            </th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th>
            Total Alokasi = </th>
            <th>
                Rp.{{ number_format($data['total']) }} </th>
        
        </tr>
        <tr>
            <th>
            Sisa Alokasi = </th>
            <th>
                Rp.{{ number_format($data['belumDipakai']) }} </th>
        
        </tr>
        <tr>
            <th>
            Total keseluruhann = </th>
            <th>
                Rp.{{ number_format($data['totalAll']) }} </th>
        
        </tr>
        <tr></tr>
 
        
            
        <tr>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Cabang</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Pemda</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Nama Program</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Nominal (Rp.)</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Pilar</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">No. Surat</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Nama Penerima</th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">Alamat </th>
            <th style="text-align: center; background-color:#6c757d;color:white; font-weight:bold;">No. Rekening</th>
			
        </tr>
    
           
    </thead>
    <tbody>
        @foreach($data['report'] as $rp)
        <tr>
            <td>{{ $rp->nama_unit }}</td>
            <td>{{ $rp->pemda }}</td>
            <td>{{ $rp->nama_kegiatan }}</td>
            <td>{{ $rp->nominal }}</td>
            <td>{{ $rp->ruang_lingkup }}</td>
            <td>{{ $rp->no_surat_edoc }}</td>
            <td>{{ $rp->nama }}</td>
            <td>{{ $rp->lokasi_kegiatan }}</td>
            <td>{{ str($rp->norek) }}</td>
            
        </tr>
            
        @endforeach
        
    </tbody>
 
        

 


</table>