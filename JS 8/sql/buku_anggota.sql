-- Jobsheet 8: skema database simpus_mini untuk PostgreSQL Laragon.
CREATE DATABASE simpus_mini;

\c simpus_mini;

CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun INTEGER NOT NULL CHECK (tahun BETWEEN 1900 AND 9999),
    isbn VARCHAR(50),
    stok INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    alamat VARCHAR(255),
    no_hp VARCHAR(30)
);

INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) VALUES
('Laskar Pelangi', 'Andrea Hirata', 2005, '9789793062792', 4, 'fiksi'),
('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, '9789799731234', 2, 'fiksi'),
('Negeri 5 Menara', 'Ahmad Fuadi', 2009, '9789792248616', 0, 'fiksi'),
('Filosofi Teras', 'Henry Manampiring', 2018, '9786024125189', 5, 'referensi'),
('Ronggeng Dukuh Paruk', 'Ahmad Tohari', 1982, '9789794072524', 1, 'fiksi'),
('Perahu Kertas', 'Dee Lestari', 2009, '9789791227648', 3, 'fiksi'),
('Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 2004, '9789793604059', 2, 'fiksi'),
('Pulang', 'Tere Liye', 2015, '9786020331607', 4, 'fiksi'),
('Dilan 1990', 'Pidi Baiq', 2014, '9786027870994', 3, 'fiksi'),
('Cantik Itu Luka', 'Eka Kurniawan', 2002, '9786020312589', 2, 'fiksi'),
('Madilog', 'Tan Malaka', 1943, '9789799731296', 1, 'referensi'),
('Laut Bercerita', 'Leila S. Chudori', 2017, '9786024246942', 3, 'fiksi');

INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES
('Siti Aminah', 'A001', 'Malang', '0812xxxx'),
('Budi Santoso', 'A002', 'Batu', '0813xxxx'),
('Citra Lestari', 'A003', 'Malang', '0814xxxx'),
('Dimas Pratama', 'A004', 'Kepanjen', '0815xxxx'),
('Rina Kartika', 'A005', 'Lawang', '0816xxxx'),
('Andi Wijaya', 'A006', 'Singosari', '0817xxxx'),
('Maya Putri', 'A007', 'Blitar', '0818xxxx'),
('Fajar Hidayat', 'A008', 'Kediri', '0819xxxx')
ON CONFLICT (no_anggota) DO NOTHING;