<?php require_once __DIR__ . '/config.php'; ?>
  </main>

  <footer class="footer">
    <div class="container footer-grid">
      <div class="footer-kol">
        <a href="index.php" class="logo"><i class="fa-solid fa-staff-snake"></i> Medika<span>Care</span></a>
        <p>Klinik kesehatan terpercaya dengan dokter profesional dan fasilitas modern. Jaga kesehatan Anda bersama kami.</p>
      </div>
      <div class="footer-kol">
        <h4>Navigasi</h4>
        <?php foreach ($menuNav as $m): ?><a href="<?= e($m['url']) ?>"><?= e($m['label']) ?></a><?php endforeach; ?>
      </div>
      <div class="footer-kol">
        <h4>Jam Praktik</h4>
        <p>Buka setiap hari<br><b><?= e($kontak['jam']) ?></b></p>
        <p>Antrean online &amp; halte bus</p>
      </div>
      <div class="footer-kol">
        <h4>Kontak</h4>
        <p><i class="fa-solid fa-location-dot"></i> <?= e($kontak['alamat']) ?></p>
        <p><i class="fa-solid fa-phone"></i> <?= e($kontak['telepon']) ?></p>
        <p><i class="fa-solid fa-envelope"></i> <?= e($kontak['email']) ?></p>
      </div>
    </div>
    <div class="footer-bawah">Copyright <?= date('Y') ?> <?= e($namaKlinik) ?>. Seluruh hak cipta dilindungi.</div>
  </footer>

  <script>window.DOKTER_DATA = <?= json_encode($daftarDokter, JSON_UNESCAPED_UNICODE) ?>;</script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/script.js"></script>
  <div class="cursor-denyut" id="kursorDenyut" aria-hidden="true"><span class="titik"><i class="fa-solid fa-stethoscope"></i></span></div>
  <script>
  (function () {
    if (window.matchMedia('(max-width:768px)').matches) return;
    var k = document.getElementById('kursorDenyut'), n = 0;
    document.addEventListener('mousemove', function (e) {
      k.style.left = e.clientX + 'px'; k.style.top = e.clientY + 'px';
      var p = document.createElement('span'); p.className = 'pulsa'; k.appendChild(p); setTimeout(function(){ p.remove(); }, 1050);
      if (n++ % 3 === 0) { var g = document.createElement('span'); g.className = 'garis'; k.appendChild(g); setTimeout(function(){ g.remove(); }, 1250); }
    });
  })();
  </script>
</body>
</html>