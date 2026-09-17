const dataBukuLokal = [
    { judul: "Laskar Pelangi", pengarang: "Andrea Hirata", tahun: 2005, stok: 4 },
    { judul: "Bumi Manusia", pengarang: "Pramoedya Ananta Toer", tahun: 1980, stok: 2 },
    { judul: "Negeri 5 Menara", pengarang: "Ahmad Fuadi", tahun: 2009, stok: 0 },
    { judul: "Filosofi Teras", pengarang: "Henry Manampiring", tahun: 2018, stok: 5 },
    { judul: "Ronggeng Dukuh Paruk", pengarang: "Ahmad Tohari", tahun: 1982, stok: 1 },
    { judul: "Perahu Kertas", pengarang: "Dee Lestari", tahun: 2009, stok: 3 },
    { judul: "Ayat-Ayat Cinta", pengarang: "Habiburrahman El Shirazy", tahun: 2004, stok: 2 },
    { judul: "Pulang", pengarang: "Tere Liye", tahun: 2015, stok: 4 },
    { judul: "Dilan 1990", pengarang: "Pidi Baiq", tahun: 2014, stok: 3 },
    { judul: "Cantik Itu Luka", pengarang: "Eka Kurniawan", tahun: 2002, stok: 2 }
];

function tampilkanBuku(tbody, dataBuku) {
    tbody.innerHTML = "";

    dataBuku.forEach(function (buku) {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${buku.judul}</td>
            <td>${buku.pengarang}</td>
            <td>${buku.tahun}</td>
            <td>${buku.stok}</td>
            <td>
                <button type="button">Edit</button>
                <button type="button" class="btn-hapus">Hapus</button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

async function muatDaftarBuku() {
    const tbody = document.querySelector("#tabel-buku");

    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="5">Memuat data...</td>
        </tr>
    `;

    try {
        const response = await fetch("../data/buku.json");

        if (!response.ok) {
            throw new Error("Gagal mengambil data buku.");
        }

        const dataBuku = await response.json();
        tampilkanBuku(tbody, dataBuku);
    } catch (error) {
        console.warn("JSON buku tidak dapat dimuat, memakai data lokal.", error);
        tampilkanBuku(tbody, dataBukuLokal);
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBuku);