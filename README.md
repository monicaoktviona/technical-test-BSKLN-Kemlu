# Technical Test Calon Peserta Magang Bersertifikat - Kementerian Luar Negeri Republik Indonesia
Nama: Monica Oktaviona <br>
NIM: 2106701210 <br>
Posisi: Fullstack Developer
# Jawaban
## <b>1. Rancangan database <br><br></b>
![Rancangan database](/public/screenshot/1.png) <br><br><br><br>
## <b>2. Data Negara (JSON) <br><br></b>
<b>Link API: http://127.0.0.1:8000/api/negara [GET]</b> -> Get All Negara<br><br>
<b>Link API: http://127.0.0.1:8000/api/negara/<id_negara> [GET]</b> -> Get Negara by ID<br><br>
![Data Negara (JSON)](/public/screenshot/2.png) <br><br><br><br>
## <b>3.1. API <i>Create</i> Negara <br><br></b>
### 3.1.1. API Request <br>
<b>Link API: http://127.0.0.1:8000/api/negara [POST]</b><br>
<b>Request body:</b> `nama_negara`, `kode_negara`, `id_kawasan`, `id_direktorat` <br>
![API Create Negara Request](/public/screenshot/3.2.1.png) <br><br>
### 3.1.2. API Response <br>
![API Create Negara Response](/public/screenshot/3.2.2.png)
<br><br><br><br>
## <b>3.2. API <i>Delete</i> Negara by ID<br><br></b>
<b>Link API: http://127.0.0.1:8000/api/negara/<id_negara> [DELETE]</b><br>
![API Delete Negara](/public/screenshot/3.1.png) <br><br><br><br>
## <b>4. Visualisasi Data <br><br></b>
### 4.1. Geomap <br>
<b>Link: http://127.0.0.1:8000/geomap</b><br>
Catatan: Data yang ditampilkan hanya data sampel yang tersedia di soal (terdiri dari 7 negara). Apabila data negara ditambahkan ke database maka tampilan akan menyesuaikan.<br>
![API Create Negara Request](/public/screenshot/4.1.png) <br><br>
### 4.2. Datatables <br>
<b>Link: http://127.0.0.1:8000/datatables</b><br>
![API Create Negara Response](/public/screenshot/4.2.png)
<br><br><br><br>


### Referensi:
