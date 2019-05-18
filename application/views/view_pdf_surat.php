<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <style type="text/css">
      /*TAGS*/
      @page{
        margin: 0.8cm 1.2cm 0.6cm;
      }
      body {
        outline:2px solid black;
        padding: 0.375em 1em;
      }

      hr{
        margin: 0;
        padding: 0;
      }
      /*TAGS*/

      /*FONTS*/
      .sans-serif-font{
        font-family: sans-serif;
      }
      .center{
        align-items: center;
        text-align: center;
        -webkit-align-content: center;
        align-content: center;
        vertical-align: middle;
      }
      .underline{
        text-decoration: underline;
      }
      .bold{
        font-weight: bold;
      }
      .italic{
        font-style: italic;
      }
      /*FONTS*/

      /* CLASSES */
      .header, .title{
        align-items: center;
        text-align: center;
      }      
      .header h3{
        margin-top: 2px;
        margin-bottom: 2px;
      }
      .header p {
        margin-top: 0px;
        font-size: 11px;
      }

      .title h2{
        text-decoration: underline;
        margin-top: 1em;
        margin-bottom: 8px;
        font-size: 24px;
      }

      .content{
        margin:0;
      }
      .content-header{
        margin: 0;
      }
      .content-header tr td:first-child{
        padding-left: 2.5em;
      }
      .content-data tr td:nth-child(even), .content-data tr:first-child td:nth-child(odd){
        border-bottom: 1px solid black;
      }
      .content-data tr:first-child td:nth-child(even), .content-data tr:first-child td:first-child{
        border-bottom: none;
      }

      .firman{
        margin: 0;
        padding: 0;
      }
      .ayat{
        font-size: 12px;
      }
      .ayat:first-child{
        text-align: justify;
        text-justify: inter-word;
        margin-left: 3em;
        margin-top: 3px;
        margin-right: 3.5em;
        margin-bottom: 0px;
        line-height: 11pt;
      }
      .ayat:last-child{
       text-align: right;
        margin-top: 0px;
        margin-bottom: 8px;
      }

      .pernyataan{
        text-align: center;
        margin-bottom: 8px
      }
      .pernyataan p{
        font-size: 12px;
      }
      .pernyataan p:first-child{
        margin: 4px 0 0 0;
      }
      .pernyataan p:last-child{
        margin: 0 0 0 4px; 
      }

      .footer{
        max-width: 40%;
        float: right;
        font-size: 12px;
        margin-top: 6px;
        margin-right: 7em;
      }
      .footer p{
        text-align: center;
        margin: 0;
        padding: 0;
      }

    </style>
  </head>
  <body>
    
    <div class="header">
      <h3>GEREJA PANTEKOSTA TABERNAKEL</h3>
      <p>Terdaftar pada Diljen Bimas (KRISTEN) Protestan Depag RI. SK No. 58 Tahun 1987 Tgl. 30 April 1987</p>
    </div>

    <div class="title">
      <h2>SURAT BAPTISAN</h2>
    </div>

    <div class="content">
      <table class="content-header">
        <tr class="nomor">
          <td width="10%">
              <p><span class="sans-serif-font bold">No</span></p>
          </td>
          <td width="20%"><p><?php echo $nomor_surat; ?></p></td>
          <td width="70%">
            <hr />
            <div class="firman">
              
              <p class="italic ayat">Dengan demikian kita telah dikuburkan bersama-sama dengan Dia oleh Baptisan dalam kematian, supaya sama seperti Kristus telah dibangkitkan dari antara orang mati oleh kemuliaan Bapa, demikian juga kita akan hidup dalam hidup yang baru</p>
              <p class="bold italic ayat">Roma 6:4</p>

            </div> 
            <hr />     
          </td>
        </tr>  
      </table>
      
      <div class="pernyataan">
        <p>TELAH DIBAPTISKAN DALAM NAMA ALLAH BAPA, ANAK LAKI-LAKI DAN ROH KUDUS</p>
        <p>yaitu: TUHAN YESUS KRISTUS</p>
      </div>
      
      <table style="font-size: 14px; width: 100%;" class="content-data">
        <tr>
          <td rowspan="7" width="140px">
            <div style="display: block; min-width:100px; min-height: 100px;"></div>
          </td>
          <td>Pada hari</td> 
          <td><span class="center bold"><?php echo $hari_baptis;?></span></td>
          <td>tanggal</td> 
          <td><span class="center bold"><?php echo $tgl_baptis;?></span></td>
        </tr>  
        <tr>
          <td colspan="4">di hadapan Sidang Jemaat <span class="bold">GPT. Gereja Petra, Jl. S.Saddang No. 32, Makassar</span></td>
        </tr>
        <tr>
          <td> Sdr/Sdri. </td>
          <td colspan="3">
            <span class="center bold"><?php echo $nama_penerima; ?></span>
          </td>
        </tr>
        <tr>
          <td> lahir di </td>
          <td>
            <span class="bold"><?php echo $tempat_lahir;?></span>
          </td>
          <td>Tanggal </td>
          <td>
            <span class="bold"><?php echo $tanggal_lahir;?></span>
          </td>
        </tr>
        <tr>
          <td>Alamat </td>
          <td colspan="3">
            <span class="bold"><?php echo $alamat;?></span>
          </td>
        </tr>
        <tr>
          <td>Ayah </td>
          <td>
            <span class="bold"><?php echo $ayah;?></span>
          </td>
          <td>Ibu</td> 
          <td>
            <span class="bold"><?php echo $ibu;?></span>
          </td>
        </tr>
        <tr>
          <td>Oleh Pendeta </td>
          <td colspan="3">
            <span class="bold"><?php echo $oleh;?></span>
          </td>
        </tr>
      </table>
      
    </div>

    <div class="footer">
      <p>a/n. GEREJA PANTEKOSTA TABERNAKEL</p>
      <p class="bold" style="letter-spacing: 2px;">PETRA</p>
      <img height="40px" width="140px" src="" alt="tanda tangan"><br/><br/>
      <p>Pdt. Paulus Yedid Yan</p>
      <p>( <span class="italic">Senior Pastor</span> )</p>
    </div>

  </body>
</html>
