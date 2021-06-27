# Keybmin

Kolay admin paneli yapımı scripti.

Bu script ile sayfalarınızı ve menülerinizi oluşturup kolay bir şekilde yetkilendirebilirsiniz.


## Kurulum

Öncelikle sunucunuz veya bilgisayarınızda [composer](https://getcomposer.org/download/) kurulu olmalıdır.

Composer kurduktan sonra ana dizinde konsoldan aşağıdaki komutu yazıp entere basın ve gerekli tüm kütüphanaleri "vendor" klasörüne kursun

```bash
composer install
```

Bu işlemi yaptıktan sonra veritabanı bilgilerinizi index.php den düzenleyebilirsiniz.

```php
$keybmin = new keybmin('keybmin', [
        'test'    => true,
        'lang'    => 'tr_TR',
        'page'    => 'dashboard',
        'db_type' => 'mysqli',
        'db_name' => '',
        'db_user' => '',
        'db_pass' => '',
]);
```

Parametreler | Açıklama | Alabileceği Değer
--- | --- | --- 
test | Bu ayar ile css ve js leriniz sıkışmaz yani geliştirme modunu açıp kapatır | true / false
lang  | Henüz yapım aşamasında | tr_TR
page | Kullanıcı girişinden sonra açılacak ilk sayfa | sayfanızın adı ÖRN: dashboard

## Admin Kullanıcı Bilgileri


Kullanıcı adı | admin@admin.com
--- | ---
Şifre | admin
