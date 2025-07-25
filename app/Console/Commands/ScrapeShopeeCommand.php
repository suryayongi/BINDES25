<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class ScrapeShopeeCommand extends Command
{
    protected $signature = 'scrape:shopee';
    protected $description = 'Scrape product data from Shopee using the most robust local method.';

    public function handle()
    {
        $this->info("Memulai scraping (METODE PAMUNGKAS - Versi Perbaikan)...");
        $startUrl = 'https://shopee.co.id/matahariacc';
        $screenshotPath = storage_path('app/public/failure_screenshot.png');

        File::ensureDirectoryExists(storage_path('app/public'));

        try {
            $this->info("Membuka halaman, ini akan sangat lama (bisa 3 menit), mohon bersabar...");

            // --- PERBAIKAN SINTAKS DI SINI ---
            $html = Browsershot::url($startUrl)
                ->noSandbox()
                ->userAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36')
                ->windowSize(1920, 1080)
                ->setDelay(3000)
                ->setTimeout(180) // Set timeout utama menjadi 3 menit (dalam detik)
                ->waitForSelector('.shopee-search-item-result__items') // Tunggu selector ini muncul
                ->bodyHtml();

            $this->info("SUKSES! Berhasil mendapatkan konten HTML halaman.");

            $domCrawler = new DomCrawler($html);
            $productItems = $domCrawler->filter('ul.shopee-search-item-result__items > li');

            if ($productItems->count() === 0) {
                $this->error('GAGAL: Produk tidak ditemukan meskpun halaman berhasil dimuat.');
                Browsershot::url($startUrl)->save($screenshotPath);
                $this->info('Screenshot kegagalan disimpan di: ' . $screenshotPath);
                return 1;
            }

            $this->info('MANTAP! Menemukan ' . $productItems->count() . ' item produk. Menyimpan ke database...');

            $productItems->each(function (DomCrawler $node) {
                 try {
                    $productLinkNode = $node->filter('a')->first();
                    $product_url = 'https://shopee.co.id' . $productLinkNode->attr('href');
                    $name = $productLinkNode->filter('div[data-sqe="name"] > div')->text();
                    $price = $productLinkNode->filter('div[data-sqe="name"] + div')->text();
                    $imageUrl = $productLinkNode->filter('img')->attr('src');

                    if ($imageUrl && $name && $price) {
                        Product::updateOrCreate(
                            ['product_url' => $product_url],
                            ['name' => trim($name), 'price' => trim($price), 'image_url' => $imageUrl]
                        );
                        $this->line("  -> Tersimpan: " . Str::limit(trim($name), 50));
                    }
                } catch (\Exception $e) {
                    $this->warn("  -> Melewati 1 item (kemungkinan iklan/struktur berbeda).");
                }
            });

            $this->info("SEMUA SELESAI DENGAN SEMPURNA! Proyek ini berhasil kita taklukkan.");
            return 0;

        } catch (\Exception $e) {
            $this->error("ERROR FATAL: " . $e->getMessage());
            
            try {
                Browsershot::url($startUrl)->save($screenshotPath);
                $this->info('Screenshot kegagalan disimpan di: ' . $screenshotPath);
                $this->warn("Silakan cek screenshot untuk melihat apa yang terjadi di browser.");
            } catch (\Exception $shotError) {
                $this->error("Gagal mengambil screenshot: " . $shotError->getMessage());
            }

            $this->warn("Jika masih gagal, ini konfirmasi akhir bahwa ada Antivirus/Firewall yang memblokir. Coba matikan sementara lalu jalankan lagi.");
            return 1;
        }
    }
}