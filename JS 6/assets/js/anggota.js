const dataAnggotaCadangan = [
    { no_anggota: "A001", nama: "Siti Aminah", alamat: "Malang", no_hp: "0812xxxx" },
    { no_anggota: "A002", nama: "Budi Santoso", alamat: "Batu", no_hp: "0813xxxx" },
    { no_anggota: "A003", nama: "Citra Lestari", alamat: "Malang", no_hp: "0814xxxx" },
    { no_anggota: "A004", nama: "Dimas Pratama", alamat: "Kepanjen", no_hp: "0815xxxx" }
];

function tampilkanAnggota(tbody, dataAnggota) {
    tbody.innerHTML = "";

    dataAnggota.forEach(function (anggota) {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${anggota.no_anggota}</td>
            <td>${anggota.nama}</td>
            <td>${anggota.alamat}</td>
            <td>${anggota.no_hp}</td>
            <td>
                <button type="button">Edit</button>
                <button type="button" class="btn-hapus">Hapus</button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

async function muatDaftarAnggota() {
    const tbody = document.querySelector("#tabel-anggota");
    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="5">Memuat data...</td>
        </tr>
    `;

    try {
        const response = await fetch("../data/anggota.json");

        if (!response.ok) {
            throw new Error("Gagal mengambil data anggota.");
        }

        const dataAnggota = await response.json();
        tampilkanAnggota(tbody, dataAnggota);
    } catch (error) {
        console.warn("JSON anggota tidak dapat dimuat, memakai data cadangan.", error);
        tampilkanAnggota(tbody, dataAnggotaCadangan);
    }
}
document.addEventListener("DOMContentLoaded", muatDaftarAnggota);