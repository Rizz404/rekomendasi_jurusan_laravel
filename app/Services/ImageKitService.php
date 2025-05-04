<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use ImageKit\ImageKit;
use Exception;

class ImageKitService
{
  protected $imageKit;

  public function __construct()
  {
    // Pastikan semua credential terisi dengan benar
    $publicKey = env('IMAGEKIT_PUBLIC_KEY');
    $privateKey = env('IMAGEKIT_PRIVATE_KEY');
    $urlEndpoint = env('IMAGEKIT_URL_ENDPOINT');

    // Log untuk debugging
    Log::info("ImageKit initialization with: " . substr($publicKey, 0, 3) . "... " .
      substr($urlEndpoint, 0, 10) . "...");

    // Periksa apakah credential sudah diisi
    if (empty($publicKey) || empty($privateKey) || empty($urlEndpoint))
    {
      Log::error("ImageKit credentials missing. Please check environment variables.");
      throw new Exception("Konfigurasi ImageKit belum lengkap");
    }

    try
    {
      $this->imageKit = new ImageKit(
        $publicKey,
        $privateKey,
        $urlEndpoint
      );
    }
    catch (Exception $e)
    {
      Log::error("ImageKit initialization error: " . $e->getMessage());
      throw new Exception("Gagal menginisialisasi layanan ImageKit");
    }
  }

  public function upload($file, $fileName)
  {
    try
    {
      // Validasi file
      if (!$file || !$file->isValid())
      {
        Log::error("Invalid file provided for upload");
        throw new Exception("File tidak valid");
      }

      // Mendapatkan file content
      $fileContent = file_get_contents($file->getRealPath());
      if ($fileContent === false)
      {
        Log::error("Could not read file content");
        throw new Exception("Gagal membaca konten file");
      }

      // Coba Upload menggunakan metode alternatif jika tersedia
      $uploadOptions = [
        'file' => base64_encode($fileContent),
        'fileName' => $fileName,
      ];

      Log::info("Uploading file: " . $fileName . " (size: " . strlen($fileContent) . " bytes)");
      $uploadFile = $this->imageKit->upload($uploadOptions);

      // Log respons untuk debugging
      Log::info("ImageKit raw response: " . json_encode($uploadFile));

      // Periksa format respons
      if (is_object($uploadFile))
      {
        if (isset($uploadFile->error) && $uploadFile->error)
        {
          Log::error("ImageKit error: " . $uploadFile->error);
          throw new Exception("Gagal upload: " . $uploadFile->error);
        }

        // Periksa objek "success" jika ada
        if (isset($uploadFile->success) && $uploadFile->success === false)
        {
          Log::error("ImageKit upload failed: " . json_encode($uploadFile));
          throw new Exception("Upload gagal dengan status error");
        }

        // Jika response memiliki url dan fileId langsung di level utama
        if (isset($uploadFile->url) && isset($uploadFile->fileId))
        {
          return [
            'url' => $uploadFile->url,
            'id' => $uploadFile->fileId,
          ];
        }

        // Jika response memiliki result yang berisi url dan fileId
        if (isset($uploadFile->result) && is_object($uploadFile->result))
        {
          if (isset($uploadFile->result->url) && isset($uploadFile->result->fileId))
          {
            return [
              'url' => $uploadFile->result->url,
              'id' => $uploadFile->result->fileId,
            ];
          }
        }

        // Jika format response tidak sesuai dengan yang diharapkan
        Log::error("Unexpected ImageKit response format: " . json_encode($uploadFile));
        throw new Exception("Format respons ImageKit tidak sesuai");
      }
      else
      {
        Log::error("Invalid response from ImageKit: " . json_encode($uploadFile));
        throw new Exception("Respons tidak valid dari ImageKit");
      }
    }
    catch (Exception $e)
    {
      Log::error("ImageKit upload error: " . $e->getMessage());
      throw new Exception("Upload gambar gagal: " . $e->getMessage());
    }
  }

  // public function delete($fileId)
  // {
  //   try
  //   {
  //     if (empty($fileId))
  //     {
  //       Log::error("No fileId provided for deletion");
  //       throw new Exception("ID file tidak boleh kosong");
  //     }

  //     Log::info("Deleting file with ID: " . $fileId);
  //     $response = $this->imageKit->deleteFile($fileId);

  //     Log::info("Delete response: " . json_encode($response));

  //     // Periksa format respons
  //     if (is_object($response))
  //     {
  //       if (isset($response->error) && $response->error)
  //       {
  //         Log::error("ImageKit delete error: " . $response->error);
  //         throw new Exception("Gagal menghapus: " . $response->error);
  //       }

  //       if (isset($response->success) && $response->success === true)
  //       {
  //         return true;
  //       }

  //       if (isset($response->result) && $response->result === true)
  //       {
  //         return true;
  //       }

  //       Log::error("Unexpected delete response format: " . json_encode($response));
  //       throw new Exception("Format respons hapus tidak sesuai");
  //     }
  //     else
  //     {
  //       Log::error("Invalid delete response: " . json_encode($response));
  //       throw new Exception("Respons hapus tidak valid");
  //     }
  //   }
  //   catch (Exception $e)
  //   {
  //     Log::error("ImageKit delete error: " . $e->getMessage());
  //     throw new Exception("Hapus gambar gagal: " . $e->getMessage());
  //   }
  // }

  public function delete($fileId)
  {
    return $this->imageKit->deleteFile($fileId);
  }
}
