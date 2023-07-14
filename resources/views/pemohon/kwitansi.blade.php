<html>
<head>
    <title>Kwitansi</title>
<body>


    <h2 style="text-align: center;"><u> KWITANSI (TANDA PEMBAYARAN)</u></h2>
    <table style="width: 100%;height: auto;">
        <tr>
            <td style="width: 25%;">SUDAH TERIMA DARI</td>
            <td>:</td>
            <td style="width: 70%;">PT Bank Sumut Sekretaris Perusahaan Unit CSR</td>
        </tr>
        {{-- <tr>
<td>UANG SEBANYAK</td>
<td>:</td>
<td>{{Riskihajar\Terbilang\Facades\Terbilang::make($rows1->nominal)}} rupiah</td>
        </tr> --}}
        <tr>
            <td>UNTUK</td>
            <td>:</td>
            <td>Pembayaran lunas atas Program Kemitraan PT Bank Sumut untuk kegiatan {{$rows1->nama_kegiatan}} sesuai dengan Berita Acara Serah Terima Pembayaran Program Kemitraan PT Bank Sumut Tahun Buku ------------ No.------------------ Tgl. ----------------- 202---</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>Rp.{{ number_format($rows1->nominal, 2, ',', '.'); }},-</td>
        </tr>
        <tr>
            <td>TERBILANG</td>
            <td>:</td>
            <td><b>{{Riskihajar\Terbilang\Facades\Terbilang::make($rows1->nominal)}} rupiah</b></td>
        </tr>
    </table>

    <table style="width: 100%;height: auto;margin-top: 7%">

        <tr>
            <td></td>
            <td>
                <p style="margin-left: 25%;">'.................... , '............................... 202-----</p>
            </td>
        </tr>
        <tr>
            <td>Diketahui Oleh :<br> {{ explode(',', $nama_surat[1]['value_setting'])[1] }}</td>
            <td>
                <p style="margin-left: 25%;">Yang Menerima</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <font size="1">
                    <div style="border: 1px;border-style: solid;width: 140px;position: relative;left: 20%;">Materai 10.000</div>
                </font>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-top: 9%;">{{ explode(',', $nama_surat[1]['value_setting'])[0] }}<br />NPP. .......................</p>
            </td>
            <td>
                <table style="margin-left: 25%;margin-top: 9%;font-size: 14px;">
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td>{{ $bapi->nama }}</td>
                    </tr>
                    <tr>
                        <td>JABATAN</td>
                        <td>:</td>
                        <td>{{ $bapi->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>NO REK</td>
                        <td>:</td>
                        <td>{{ $rows1->norek }}</td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>:</td>
                        <td>{{ $bapi->alamat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    </font>
</body>
</html>
