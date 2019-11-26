<?php

namespace App\Imports;

use App\Cd;
use App\Bibliografi;
use App\Genre;
use App\Songwriter;
use App\Access;
use App\Categories;
use App\Currencies;
use App\Language;
use App\Location;
use App\SourceType;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class BibliografiCdImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // Create Token
        $token = strtotime("now");
        $updateToken = strtotime("now");

        foreach ($rows as $row) {
            if ($row[0] === '#' || $row[1] === 'ISBN') {
                continue;
            }

            // Bibliogarfi
            Bibliografi::create([
                'isbn' => $row[1],
                'no_panggil' => $row[2],
                'judul' => $row[3],
                'anak_judul' => $row[4],
                'edisi' => $row[5],
                'publisher_id' => auth()->user()->id,
                'bentuk_fisik' => 'CD',
                'harga' => $row[17],
                'nama_sumber' => $row[19],
                'tanggal_pengadaan' => date('Y-m-d', strtotime("now")),
                'create_token' => $token,
            ]);

            $bibli_id = Bibliografi::where('create_token', $token)
                ->value('bibliografi_id');

            // CD
            Cd::create([
                'bibliografi_id' => $bibli_id,
                'penerbit' => $row[6],
                'tempat_terbit' => $row[7],
                'tahun_terbit' => $row[8],
                'jumlah_keping' => $row[9],
            ]);

            $cd_id = Cd::where('bibliografi_id', $bibli_id)
                ->value('cd_id');

            // -- CD DATABASE --
            // Songwriter
            $songwriter = Songwriter::where('name', $row[10])->first();
            if ($songwriter['name'] === null) {
                Songwriter::create(['name' => $row[10]]);
            }

            // Genre
            $genre = Genre::where('genre', $row[11])->first();
            if ($genre['genre'] === null) {
                Genre::create(['genre' => $row[11]]);
            }

            // -- BIBLIOGRAFI DATABASE --
            // Location
            $location = Location::where('lokasi', $row[12])->first();
            if ($location['lokasi'] === null) {
                Location::create(['lokasi' => $row[12]]);
            }

            // Language
            $language = Language::where('bahasa', $row[13])->first();
            if ($language['bahasa'] === null) {
                Language::create(['bahasa' => $row[13]]);
            }

            // Category
            $category = Categories::where('kategori', $row[14])->first();
            if ($category['kategori'] === null) {
                Categories::create(['kategori' => $row[14]]);
            }
            
            // Access
            $access = Access::where('akses', $row[15])->first();
            if ($access['akses'] === null) {
            Access::create([
                'akses' => $row[15]
                ]);
            }

            // Source Type
            $source_type = SourceType::where('jenis_sumber', $row[18])->first();
            if ($source_type['jenis_sumber'] === null) {
                SourceType::create(['jenis_sumber' => $row[18]]);
            }

            $token += 1;
        }

        foreach ($rows as $row) {
            if ($row[0] === '#' || $row[1] === 'ISBN') {
                continue;
            }

            $bibli_id = Bibliografi::where('create_token', $updateToken)
                ->value('bibliografi_id');

            $cd_id = Cd::where('bibliografi_id', $bibli_id)
            ->value('cd_id');

            // -- CD DATABASE --
            // Songwriter
            $newSongwriter = Songwriter::where('name', $row[10])->value('id');
            // Genre
            $newGenre = Genre::where('genre', $row[11])->value('id');

            Cd::where('cd_id', $cd_id)->update([
                'pencipta_id' => $newSongwriter,
                'genre_id' => $newGenre,
            ]);

            // -- BIBLIOGRAFI DATABASE --
            // Location
            $newLocation = Location::where('lokasi', $row[12])->value('id');
            // Language
            $newLanguage = Language::where('bahasa', $row[13])->value('id');
            // Category
            $newCategories = Categories::where('kategori', $row[14])->value('id');
            // Access
            $newAccess = Access::where('akses', $row[15])
                                ->value('id');
            // Source Type
            $newSourceType = SourceType::where('jenis_sumber', $row[18])->value('id');
            // Currency
            $currency_code = $row[16];
            $myArray = explode('-', $currency_code);
            $currency = Currencies::where('code', $myArray[1])->value('code');
            
            if ($currency !== null) {
                Bibliografi::where('bibliografi_id', $bibli_id)->update([
                    'lokasi_id' => $newLocation,
                    'bahasa_id' => $newLanguage,
                    'kategori_id' => $newCategories,
                    'akses_id' => $newAccess,
                    'mata_uang_id' => $currency,
                    'jenis_sumber_id' => $newSourceType,
                ]);
            } else {
                Bibliografi::where('bibliografi_id', $bibli_id)->update([
                    'lokasi_id' => $newLocation,
                    'bahasa_id' => $newLanguage,
                    'kategori_id' => $newCategories,
                    'akses_id' => $newAccess,
                    'mata_uang_id' => null, 
                    'jenis_sumber_id' => $newSourceType,
                ]);
            }

            $updateToken += 1;
        }
    }
}
