(function () {
  "use strict";
  var DATA = window.DOKTER_DATA || [];

  function rupiah(n) { return "Rp " + Number(n).toLocaleString("id-ID"); }

  function kartu(m) {
    var bh = "";
    if (m.label) { var cl = m.label === "Terlaris" ? "badge-terlaris" : m.label === "Baru" ? "badge-baru" : "badge-diskon"; bh = '<span class="badge ' + cl + '">' + m.label + '</span>'; }
    var dk = "";
    if (m.hargaAsli) { dk = '<span class="harga-asli">' + rupiah(m.hargaAsli) + '</span>'; if (m.label !== "Diskon") bh += '<span class="badge badge-diskon">-' + Math.round((1 - m.harga / m.hargaAsli) * 100) + '%</span>'; }
    return '<article class="card" data-id="' + m.id + '">'
      + '<div class="card-gambar" style="background:linear-gradient(135deg,' + m.warna[0] + ',' + m.warna[1] + ')"><div class="img-lapis"><i class="fa-solid fa-user-doctor"></i></div>' + bh + '</div>'
      + '<div class="card-body"><span class="card-kat">' + m.spesialisasi + '</span><h3 class="card-nama">' + m.nama + '</h3><p class="card-desk">' + m.deskripsi + '</p>'
      + '<div class="meta-dokter"><span><i class="fa-solid fa-briefcase-medical"></i> ' + m.pengalaman + '</span><span><i class="fa-solid fa-calendar-day"></i> ' + m.jadwal + '</span></div>'
      + '<div class="harga">' + rupiah(m.harga) + dk + '</div><a class="btn-tambah" href="janji.php?dokter=' + m.id + '">Buat Janji</a></div></article>';
  }

  function render() {
    var w = document.getElementById("menu-grid");
    if (!w) return;
    var fk = document.getElementById("filter-kategori");
    var kat = fk ? (fk.getAttribute("data-aktif") || "Semua") : "Semua";
    var q = (document.getElementById("cari-dokter") || {}).value || "";
    q = q.trim().toLowerCase();
    var d = DATA.filter(function (m) {
      var s = m.spesialisasi || "";
      var okK = kat === "Semua" || s === kat;
      var okN = !q || m.nama.toLowerCase().indexOf(q) !== -1 || s.toLowerCase().indexOf(q) !== -1;
      return okK && okN;
    });
    w.innerHTML = d.map(kartu).join("");
    var info = document.getElementById("jumlah-produk");
    if (info) info.textContent = d.length + " dokter ditemukan";
    if (window.AOS) window.AOS.refresh();
  }

  function tanggalKode() { var d = new Date(); var m = d.getMonth() + 1; return "" + d.getFullYear() + (m < 10 ? "0" + m : m) + (d.getDate() < 10 ? "0" + d.getDate() : d.getDate()); }
  function acak(min, max) { return Math.floor(Math.random() * (max - min + 1)) + min; }

  var tt = null;
  function toast(t) { var el = document.getElementById("toast"); if (!el) { el = document.createElement("div"); el.id = "toast"; el.className = "toast"; document.body.appendChild(el); } el.textContent = t; el.classList.add("muncul"); if (tt) clearTimeout(tt); tt = setTimeout(function () { el.classList.remove("muncul"); }, 2600); }

  function pasangForm() {
    var f = document.getElementById("form-janji");
    if (!f) return;
    f.addEventListener("submit", function (ev) {
      ev.preventDefault();
      var nama = document.getElementById("nama").value.trim();
      var telp = document.getElementById("telepon").value.trim();
      var tanggal = document.getElementById("tanggal").value;
      var jam = document.getElementById("jam").value;
      var did = document.getElementById("pilih-dokter").value;
      if (!nama || !telp) { toast("Lengkapi nama dan telepon"); return; }
      if (!tanggal) { toast("Tentukan tanggal kunjungan"); return; }
      if (!/^[0-9+\- ]{9,15}$/.test(telp)) { toast("Nomor telepon tidak valid"); return; }
      var dk = null; for (var i = 0; i < DATA.length; i++) if (DATA[i].id === +did) { dk = DATA[i]; break; }
      if (!dk) { toast("Pilih dokter dahulu"); return; }
      var kode = "MK-" + tanggalKode() + "-" + acak(1000, 9999);
      fetch("api/simpan_janji.php", { method: "POST", headers: { "Content-Type": "application/json" }, body: JSON.stringify({ nama: nama, telepon: telp, tanggal: tanggal, jam: jam, keluhan: document.getElementById("keluhan").value.trim(), kode: kode, dokter_id: dk.id, dokter_nama: dk.nama, harga: dk.harga }) })
        .then(function (r) { return r.json(); })
        .then(function (res) { sukses(res && res.ok ? res.kode : kode, nama); })
        .catch(function () { sukses(kode, nama); });
    });
  }

  function sukses(kc, nm) {
    document.getElementById("kode-janji").textContent = kc;
    document.getElementById("nama-pasien").textContent = nm;
    document.getElementById("modal-sukses").classList.add("buka");
    var f = document.getElementById("form-janji"); if (f) f.reset();
    var tm = document.getElementById("tutup-modal");
    if (tm) tm.addEventListener("click", function () { window.location.href = "index.php"; });
  }

  document.addEventListener("click", function (e) {
    var b = e.target.closest(".btn-filter");
    if (!b) return;
    var w = document.getElementById("filter-kategori");
    var p = w.querySelector(".btn-filter.aktif");
    if (p) p.classList.remove("aktif");
    b.classList.add("aktif");
    w.setAttribute("data-aktif", b.getAttribute("data-kategori"));
    render();
  });

  document.addEventListener("DOMContentLoaded", function () {
    render();
    pasangForm();
    var c = document.getElementById("cari-dokter"); if (c) c.addEventListener("input", render);
    var tg = document.getElementById("menu-toggle"), nav = document.getElementById("nav-menu"); if (tg && nav) tg.addEventListener("click", function () { nav.classList.toggle("buka"); });
    if (window.AOS) window.AOS.init({ duration: 700, easing: "ease-out-cubic", once: true, offset: 50 });
  });
})();