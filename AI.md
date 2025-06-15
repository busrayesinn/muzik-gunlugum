# 🎧 AI.md – Kişisel Müzik Günlüğü Projesi: Yapay Zeka Destekli Sorular & Kod Örnekleri

Bu dosya, PHP & MySQL ile geliştirdiğim "Kişisel Müzik Günlüğü" projesinde ChatGPT'den aldığım destekle çözülen konuları içerir.

---

## 1️⃣ Kullanıcı Girişi ve Şifre Kontrolü

**Soru:** `password_verify()` neden şifre doğru olduğu halde false dönüyor?

**Yanıt:**  
- `password_hash()` ile kayıt sırasında şifreyi güvenli şekilde veritabanına kaydettik.  
- `password_verify()` ile girişte kontrol sağladık.

**Kod:**
```php
// Kayıt sırasında:
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Giriş sırasında:
if (password_verify($_POST['password'], $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
}
````

---

## 2️⃣ Kartları Grid Yapısında Yan Yana Dizme

**Soru:** `index.php`'de kartlar alt alta duruyor, Yan yana 3’lü dizilimi nasıl yaparım?

**Yanıt:** Bootstrap grid sistemi kullanılarak çözüldü.

**Kod:**

```php
<div class="row">
<?php foreach ($entries as $entry): ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h5><?= $entry['title'] ?></h5>
        <p><?= $entry['artist'] ?></p>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
```

---

## 3️⃣ Özel Renk Temasıyla Butonları Stilize Etme

**Soru:** `btn-primary` gibi butonları projemdeki mor tonunda renklerle değiştirebilir miyim?

**Yanıt:**
Evet, özel CSS sınıfları tanımlayarak mor tonları gibi projeye özel renkler kullanıldı.

**Kod (CSS):**

```css
.custom-edit {
  background-color: #7B68EE;
  color: white;
  border: none;
}

.custom-delete {
  background-color: #FF6B6B;
}
```

**HTML:**

```php
<a class="btn custom-edit">Düzenle</a>
<a class="btn custom-delete">Sil</a>
```
