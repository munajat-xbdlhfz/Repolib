<?php

namespace App\Imports;

use App\Access;
use App\Author;
use App\AuthorBook;
use App\Bibliografi;
use App\Book;
use App\BookClassification;
use App\BookSubject;
use App\BookType;
use App\Categories;
use App\Currencies;
use App\Language;
use App\Location;
use App\SourceType;
use App\WrittenForm;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class BibliografiBookImport implements ToCollection
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
                'bentuk_fisik' => 'Buku',
                'harga' => $row[24],
                'nama_sumber' => $row[26],
                'tanggal_pengadaan' => date('Y-m-d', strtotime("now")),
                'create_token' => $token,
            ]);

            $bibli_id = Bibliografi::where('create_token', $token)
                ->value('bibliografi_id');

            // Book
            Book::create([
                'bibliografi_id' => $bibli_id,
                'penerbit' => $row[8],
                'tempat_terbit' => $row[9],
                'tahun_terbit' => $row[10],
                'tinggi_buku' => $row[11],
                'jumlah_halaman' => $row[12],
                'jumlah_buku' => $row[13],
                'opac' => $row[27],
            ]);

            $book_id = Book::where('bibliografi_id', $bibli_id)
                ->value('buku_id');

            // -- BOOK DATABASE --
            // Written Form
            $written_form = WrittenForm::where('bentuk_karya_tulis', $row[15])->first();
            if ($written_form['bentuk_karya_tulis'] === null) {
                WrittenForm::create(['bentuk_karya_tulis' => $row[15]]);
            }

            // Book Type
            $book_type = BookType::where('jenis_buku', $row[16])->first();
            if ($book_type['jenis_buku'] === null) {
                BookType::create(['jenis_buku' => $row[16]]);
            }

            // Book Subject
            $book_subject = BookSubject::where('subjek', $row[22])->first();
            if ($book_subject['subjek'] === null) {
                BookSubject::create(['subjek' => $row[22]]);
            }

            // Book Classification
            $book_classification = BookClassification::where('klasifikasi_buku', $row[14])->first();
            if ($book_classification['klasifikasi_buku'] === null) {
                BookClassification::create(['klasifikasi_buku' => $row[14]]); 
            }

            // -- BIBLIOGRAFI DATABASE --
            // Location
            $location = Location::where('lokasi', $row[18])->first();
            if ($location['lokasi'] === null) {
                Location::create(['lokasi' => $row[18]]);
            }

            // Language
            $language = Language::where('bahasa', $row[19])->first();
            if ($language['bahasa'] === null) {
                Language::create(['bahasa' => $row[19]]);
            }

            // Category
            $category = Categories::where('kategori', $row[20])->first();
            if ($category['kategori'] === null) {
                Categories::create(['kategori' => $row[20]]);
            }
            
            // Access
            $access = Access::where('akses', $row[21])->first();
            if ($access['akses'] === null) {
            Access::create([
                'akses' => $row[21]
                ]);
            }

            // Source Type
            $source_type = SourceType::where('jenis_sumber', $row[25])->first();
            if ($source_type['jenis_sumber'] === null) {
                SourceType::create(['jenis_sumber' => $row[25]]);
            }

            // -- AUTHOR --
            // Get Author Primary ID
            $checkAuthorPrimary = Author::where('name', $row[6])
                ->where('status', 'primary')
                ->value('id');
                               
            // Check if Authors Name in Database or not
            if ($checkAuthorPrimary != null) {
                AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $checkAuthorPrimary]);
            } else {
                Author::create(['name' => $row[6], 'status' => 'primary']);
                $newAuthor = Author::where('name', $row[6])
                    ->where('status', 'primary')
                    ->value('id');
                AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $newAuthor]);
            }

            // Author Additional
            $additional = $row[7];
            $myArray = explode(', ', $additional);

            if ($additional != null) {
                for ($i = 0; $i < count($myArray); $i++ ) {
                    // Get Author Primary ID
                    $checkAuthorAdditional = Author::where('name', $myArray[$i])
                        ->where('status', 'additional')
                        ->value('id');

                    // Check if Authors Name in Database or not
                    if ($checkAuthorAdditional != null) {
                        AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $checkAuthorAdditional]);
                    }
                    else {
                        Author::create(['name' => $myArray[$i], 'status' => 'additional']);
                        $newAuthor = Author::where('name', $myArray[$i])
                            ->where('status', 'additional')
                            ->value('id');
                        AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $newAuthor]);
                    }
                }
            }

            $token += 1;
        }

        foreach ($rows as $row) {
            if ($row[0] === '#' || $row[1] === 'ISBN') {
                continue;
            }

            $bibli_id = Bibliografi::where('create_token', $updateToken)
                ->value('bibliografi_id');

            $book_id = Book::where('bibliografi_id', $bibli_id)
            ->value('buku_id');

            // -- BOOK DATABASE --
            // Written Form
            $newWrittenForm = WrittenForm::where('bentuk_karya_tulis', $row[15])->value('id');
            // Book Type
            $newBookType = BookType::where('jenis_buku', $row[16])->value('id');
            // Book Subject
            $newBookSubject = BookSubject::where('subjek', $row[17])->value('id');
            // Book Classification
            $newBookClassification = BookClassification::where('klasifikasi_buku', $row[14])->value('id');

            Book::where('buku_id', $book_id)->update([
                'karya_tulis_id' => $newWrittenForm,
                'jenis_buku_id' => $newBookType,
                'subjek_id' => $newBookSubject,
                'klasifikasi_buku_id' => $newBookClassification,
            ]);

            // -- BIBLIOGRAFI DATABASE --
            // Location
            $newLocation = Location::where('lokasi', $row[18])->value('id');
            // Language
            $newLanguage = Language::where('bahasa', $row[19])->value('id');
            // Category
            $newCategories = Categories::where('kategori', $row[20])->value('id');
            // Access
            $newAccess = Access::where('akses', $row[21])
                                ->value('id');
            // Source Type
            $newSourceType = SourceType::where('jenis_sumber', $row[25])->value('id');
            // Currency
            $currency_code = $row[23];
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
