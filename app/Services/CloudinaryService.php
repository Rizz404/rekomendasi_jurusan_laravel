<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
  protected $cloudinary;

  public function __construct()
  {
    // Dapatkan path ke CA bundle
    $caBundle = env('CURL_CA_BUNDLE');

    $this->cloudinary = new Cloudinary([
      'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET')
      ],
      'url' => [
        'secure' => true // Gunakan HTTPS
      ]
    ]);
    // Konfigurasi curl dengan CA bundle
    if ($caBundle && file_exists($caBundle))
    {
      $this->cloudinary->configuration->api->curlOptions = [
        CURLOPT_CAINFO => $caBundle
      ];

      Log::info('Cloudinary: Using custom CA bundle at ' . $caBundle);
    }
    else
    {
      Log::warning('Cloudinary: Custom CA bundle not found or not configured');
    }
  }

  /**
   * Upload file ke Cloudinary
   *
   * @param UploadedFile $file File yang akan diupload
   * @param string|null $folder Nama folder di Cloudinary (opsional)
   * @param array $options Opsi tambahan untuk upload
   * @return array URL dan public_id dari gambar yang diupload
   * @throws Exception
   */
  public function upload(UploadedFile $file, ?string $folder = null, array $options = [])
  {
    try
    {
      // Set opsi dasar
      $uploadOptions = [
        'resource_type' => 'auto', // Deteksi otomatis tipe file
        'unique_filename' => true, // Generate nama file unik
      ];

      // Tambahkan folder jika disediakan
      if ($folder)
      {
        $uploadOptions['folder'] = $folder;
      }

      // Tambahkan opsi kustom
      $uploadOptions = array_merge($uploadOptions, $options);

      // Upload file
      $result = $this->cloudinary->uploadApi()->upload(
        $file->getRealPath(),
        $uploadOptions
      );

      Log::info('Cloudinary upload success: ' . $result['public_id']);

      // Kembalikan URL dan ID dari file yang diupload
      return [
        'url' => $result['secure_url'],
        'id' => $result['public_id']
      ];
    }
    catch (Exception $e)
    {
      Log::error('Cloudinary upload error: ' . $e->getMessage());
      throw new Exception('Upload gambar gagal: ' . $e->getMessage());
    }
  }

  /**
   * Hapus file dari Cloudinary
   *
   * @param string $publicId Public ID dari file yang akan dihapus
   * @param string $resourceType Tipe resource (default: 'image')
   * @return bool True jika berhasil dihapus
   * @throws Exception
   */
  public function delete(string $publicId, string $resourceType = 'image')
  {
    try
    {
      $result = $this->cloudinary->uploadApi()->destroy($publicId, [
        'resource_type' => $resourceType
      ]);

      Log::info('Cloudinary delete: ' . json_encode($result));

      return $result['result'] === 'ok';
    }
    catch (Exception $e)
    {
      Log::error('Cloudinary delete error: ' . $e->getMessage());
      throw new Exception('Hapus gambar gagal: ' . $e->getMessage());
    }
  }

  /**
   * Menghasilkan URL dengan transformasi gambar
   *
   * @param string $publicId Public ID dari gambar
   * @param array $transformations Array transformasi yang akan diterapkan
   * @return string URL gambar yang sudah ditransformasi
   */
  public function getImageUrl(string $publicId, array $transformations = [])
  {
    return $this->cloudinary->image($publicId)
      ->toUrl($transformations);
  }

  /**
   * Resize gambar dengan berbagai opsi
   *
   * @param string $publicId Public ID dari gambar
   * @param int $width Lebar gambar
   * @param int $height Tinggi gambar
   * @param string $crop Metode crop (fill, scale, fit, dll)
   * @return string URL gambar yang sudah di-resize
   */
  public function resizeImage(string $publicId, int $width, int $height, string $crop = 'fill')
  {
    return $this->cloudinary->image($publicId)
      ->resize(Resize::fill($width, $height))
      ->toUrl();
  }
}
