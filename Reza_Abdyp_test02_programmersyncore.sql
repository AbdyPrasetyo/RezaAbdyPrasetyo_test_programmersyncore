
-- 1. Menampilkan data member yang berada pada provinsi sumatera utara dan dalam satu kabupaten 
SELECT m.id_member, m.nama, m.email, p.nama_provinsi, k.nama_kabupaten
FROM mst_member m
JOIN mst_provinsi p ON m.id_provinsi = p.id_propinsi
JOIN mst_kabupaten k ON m.id_kabupaten = k.id_kabupaten
WHERE p.nama_provinsi = 'Sumatera Utara' AND k.nama_kabupaten = 'Medan';


-- 2. Menampilkan data provinsi yang tidak ada dalam data member
SELECT p.id_propinsi, p.kode_propinsi, p.nama_provinsi
FROM mst_provinsi p
LEFT JOIN mst_member m ON p.id_propinsi = m.id_provinsi
WHERE m.id_provinsi IS NULL;


-- 3. Menampilkan data kabupaten yang tidak ada dalam data member
SELECT k.id_kabupaten, k.kode_kabupaten, k.nama_kabupaten
FROM mst_kabupaten k
LEFT JOIN mst_member m ON k.id_kabupaten = m.id_kabupaten
WHERE m.id_kabupaten IS NULL;

-- 4. Menampilkan data kecamatan yang tidak ada dalam data member
SELECT k.id_kecamatan, k.kode_kecamatan, k.nama_kecamatan
FROM mst_kecamatan k
LEFT JOIN mst_member m ON k.id_kecamatan = m.id_kecamatan
WHERE m.id_kecamatan IS NULL;


-- 5.Menampilkan nama member yang terdapat di Kab. Simalungun
SELECT m.nama, m.email
FROM mst_member m
JOIN mst_kabupaten k ON m.id_kabupaten = k.id_kabupaten
WHERE k.nama_kabupaten = 'Simalungun';


-- 6.Menampilkan jumlah data instansi pada Kab. Bireuen dan Kab. Bener Meriah
SELECT k.nama_kabupaten, COUNT(i.id_instansi) AS jumlah_instansi
FROM mst_instansi i
JOIN mst_kabupaten k ON i.kode_kabupaten = k.kode_kabupaten
WHERE k.nama_kabupaten IN ('Bireuen', 'Bener Meriah')
GROUP BY k.nama_kabupaten;

-- 7.Menampilkan data member yang berawalan huruf “M”
SELECT id_member, nama, email
FROM mst_member
WHERE nama LIKE 'M%';

-- 8.Menampilkan alamat email yang mempunyai karakter “no” dan terdapat di provinsi Sumatera Utara
SELECT m.email
FROM mst_member m
JOIN mst_provinsi p ON m.id_provinsi = p.id_propinsi
WHERE p.nama_provinsi = 'Sumatera Utara' AND m.email LIKE '%no%';

-- 9.Menampilkan data member yang mempunyai kode instansi “2004”
SELECT m.id_member, m.nama, m.email
FROM mst_member m
JOIN mst_instansi i ON m.id_instansi = i.id_instansi
WHERE i.kode_instansi = '2004';

-- 10.Menampilkan data member yang mempunyai karakter kode kecamatan “.08.”
SELECT m.id_member, m.nama, m.email
FROM mst_member m
JOIN mst_kecamatan k ON m.id_kecamatan = k.id_kecamatan
WHERE k.kode_kecamatan LIKE '%.08.%';

