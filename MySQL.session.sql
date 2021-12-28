CREATE VIEW monthly_report AS
SELECT s.barang_id as id_barang,
  b.nama_barang as nama_barang,
  MONTH(s.created_at) as bulan,
  MONTHNAME(s.created_at) as nama_bulan,
  IFNULL(
    (
      SELECT SUM(ssupplier.jumlah)
      FROM status ssupplier
        INNER JOIN pengguna p ON p.id = ssupplier.user_id
      WHERE p.role = 'supplier'
        AND ssupplier.barang_id = id_barang
        AND MONTH(ssupplier.created_at) = bulan
    ),
    0
  ) as jumlah_masuk,
  IFNULL(
    (
      SELECT SUM(sdistributor.jumlah)
      FROM status sdistributor
        INNER JOIN pengguna p ON p.id = sdistributor.user_id
      WHERE p.role = 'distributor'
        AND sdistributor.barang_id = id_barang
        AND MONTH(sdistributor.created_at) = bulan
    ),
    0
  ) as jumlah_keluar,
  IFNULL(
    (
      SELECT SUM(ssupplier.jumlah)
      FROM status ssupplier
        INNER JOIN pengguna p ON p.id = ssupplier.user_id
      WHERE p.role = 'supplier'
        AND ssupplier.barang_id = id_barang
        AND MONTH(ssupplier.created_at) = bulan
    ),
    0
  ) - IFNULL(
    (
      SELECT SUM(sdistributor.jumlah)
      FROM status sdistributor
        INNER JOIN pengguna p ON p.id = sdistributor.user_id
      WHERE p.role = 'distributor'
        AND sdistributor.barang_id = id_barang
        AND MONTH(sdistributor.created_at) = bulan
    ),
    0
  ) as stok_sekarang
FROM status s
  LEFT JOIN pengguna p ON p.id = s.user_id
  LEFT JOIN barang b ON b.id = s.barang_id
GROUP BY s.barang_id,
  MONTH(s.created_at);
CREATE VIEW avg_supplies_per_supplier AS
SELECT b.id as barang_id,
  p.nama as nama_supplier,
  b.nama_barang,
  AVG(s.jumlah) as avg_supplies
FROM status s
  LEFT JOIN barang b ON b.id = s.barang_id
  LEFT JOIN pengguna p ON p.id = s.user_id
WHERE p.role = 'supplier'
GROUP BY p.id,
  b.id
SELECT *
FROM avg_supplies_per_supplier;
SELECT *
FROM monthly_report